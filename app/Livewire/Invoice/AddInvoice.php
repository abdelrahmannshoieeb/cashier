<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Product;
use App\Models\Refunded;
use App\Models\Stock;
use Livewire\Component;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class AddInvoice extends Component
{
    public $bg;
    public $products;
    public $selectedProduct;
    public $priceOption = 'price1';
    public $selectedPrice = 0;
    public $search;
    public $searchCustomer;
    public $customers;
    public $selectedCustomerId;

    public $sell_price;
    public $items = [];
    public $newItem = [
        'name' => '',
        'quantity' => 1,
        'sell_price' => 0,
        'calculated_price' => 0,
    ];
    public $customerss = [
        [
            'name' => '',
            'balance' => '',
            'limit' => '', // Default sell_price option
        ]
    ];

    public $payMethod = 'cash';
    public $customerName;  //
    public $payedAmount = 0; //
    public $notes;       //
    public $discount = 0;  //
    public $status = 'unpaid';
    public $still = 0;
    public $total = 0;
    public $customerType = false; //
    public $customer_id;  //

    public $showButtons = true;
    public $invoice;



    // refund
    public $showRefundSection = 0;
    public $invoices;
    public $invoice_search;
    public $invoice_search_items;
    public function addItem()
    {
        if ($this->selectedProduct) {
            $requestedQuantity = $this->newItem['quantity'];
            $remainingQuantity = $requestedQuantity;
            $availableQuantity = $this->selectedProduct->itemStock;
            $stockMessages = [];
    
            // Step 1: Check if requested quantity can be fulfilled from itemStock
            if ($availableQuantity >= $remainingQuantity) {
                $stockMessages[] = 'تم استخدام المخزون الأساسي.';
                $remainingQuantity = 0;
            } else {
                // Not enough in itemStock
                $stockMessages[] = 'تم استخدام المخزون الأساسي بالكامل (' . $availableQuantity . ').';
                $remainingQuantity -= $availableQuantity;
    
                $stocks = Stock::where('product_id', $this->selectedProduct->id)
                    ->orderBy('type') // Order stocks by type (1, 2, 3, 4)
                    ->get();
    
                foreach ($stocks as $stock) {
                    if ($remainingQuantity <= $stock->quantity) {
                        // Enough in this stock type to fulfill the rest of the request
                        $stockMessages[] = 'تم استخدام مخزون النوع ' . $stock->type . ' (' . $remainingQuantity . ').';
                        $remainingQuantity = 0;
                        break; // Stop further processing
                    } else {
                        // Use all from this stock type
                        $stockMessages[] = 'تم استخدام مخزون النوع ' . $stock->type . ' بالكامل (' . $stock->quantity . ').';
                        $remainingQuantity -= $stock->quantity;
                    }
                }
    
                if ($remainingQuantity > 0) {
                    // Not enough in all stocks combined
                    $stockMessages[] = 'الكمية المطلوبة أكبر من المتوفر. تم استخدام المتوفر فقط (' . ($requestedQuantity - $remainingQuantity) . '). الباقي ' . $remainingQuantity . ' سيتم إضافته إلى الفاتورة القادمة.';
                    session()->flash('quantityError', implode(' ', $stockMessages));
                    return; // Prevent adding the item
                }
            }
    
            // Add item to the list if all validations pass
            $this->items[] = [
                'name' => $this->selectedProduct->name,
                'quantity' => $requestedQuantity - $remainingQuantity, // Fulfilled quantity
                'calculated_price' => $this->sell_price, // Use sell_price
                'id' => $this->selectedProduct->id,
            ];
    
            // Flash all stock messages
            session()->flash('addItem', implode(' ', $stockMessages));
        }
    }
    
    
    

    public function updateQuantity($index, $quantity)
    {
        if (isset($this->items[$index])) {
            $this->items[$index]['quantity'] = $quantity;
        }
    }



    public function selectProduct($productId)
    {
        $this->selectedProduct = Product::with('stock')->find($productId); // Eager load stocks relationship
    
        if ($this->selectedProduct) {
            if ($this->selectedProduct->itemStock > 0) {
                $this->sell_price = $this->selectedProduct->price1; // Default to Price 1 for basic stock
            } else {
                // Default to the price of the first available stock
                $firstAvailableStock = $this->selectedProduct->stock->first();
                $this->sell_price = $firstAvailableStock ? $firstAvailableStock->price : null;
            }
        }
    }
    


    private function resetNewItem()
    {
        $this->newItem = [
            'name' => '',
            'priceOption' => '',
            'quantity' => 1,
            'sell_price' => 0,
            'calculated_price' => 0,
        ];
        $this->search = '';
    }
    public function selectedCustomer($customerId)
    {
        $this->selectedCustomerId = $customerId;
        
        $customer = Customer::find($customerId);
        $this->searchCustomer = $customer->name; // Update the search term to customer name
        $this->bg = " bg-green ";
        
        // Update the $showButtons property based on customer balance
        $this->showButtons = $customer->balance >= 0;
        $this->showButtons = true;
    }
    
    

    public function updatedPriceOption()
    {
        $this->updateSelectedPrice();
    }


    private function updateSelectedPrice()
    {
        if ($this->selectedProduct) {
            $this->newItem['name'] = $this->selectedProduct->name;
            $this->newItem['calculated_price'] = $this->selectedProduct->{$this->priceOption};
        }
    }



    public function saveInvoice()
    {
        // dd([$this->items , $this->payMethod , $this->payedAmount , $this->notes , $this->discount , $this->status , $this->customerType , $this->customerName , $this->customer_id]);
        // Calculate total
        $this->total = collect($this->items)->sum(function ($item) {
            return $item['quantity'] * $item['calculated_price'] - $this->discount;
        });
        
        if($this->customerType == false) {
            $this->customerType = 'unattached';
        }

        // dd($this->customerType);
        
        if ($this->customerType === 'attached') {
            $customer = Customer::find($this->selectedCustomerId);
            $customer->balance = $customer->balance - $this->total + $this->payedAmount+$this->discount;
            $customer->save();
        }
        
        if ($this->customerType === 'attached' &&  $customer->balance > $customer->balance - $this->total + $this->payedAmount+$this->discount ) {
            session()->flash('balance', '   العميل ما زال عليه '. $customer->balance - $this->total + $this->payedAmount+$this->discount);
            $customer = Customer::find($this->selectedCustomerId);
            $customer->balance = $customer->balance - $this->total + $this->payedAmount+$this->discount;
            $customer->save();
        }

        if ($this->payedAmount < $this->total && $this->payedAmount != 1) {
            $this->status = 'partiallyPaid';
            $this->still = $this->total - $this->payedAmount;
        }elseif($this->payedAmount == $this->total){
            $this->status = 'paid';
        }elseif($this->payedAmount = 0){
            $this->status = 'unpaid';
            $this->still = $this->total;
        }else{
            return;
        }

        
        
        // Save Invoice
        $invoice = Invoice::create([
            'total' => $this->total,
            'payMethod' => $this->payMethod,
            'payedAmount' => $this->payedAmount,
            'notes' => $this->notes,
            'discount' => $this->discount,
            'status' => $this->status,
            'customerType' => $this->customerType,
            'customerName' => $this->customerName,
            'customer_id' => $this->selectedCustomerId,
            'still' => $this->still
        ]);

        $this->invoice = $invoice;

        foreach ($this->items as $item) {
            // Save Invoice Item
            Invoice_item::create([
                'qty' => $item['quantity'],
                'sellPrice' => $item['calculated_price'],
                'product_id' => $item['id'],
                'invoice_id' => $invoice->id,
            ]);
        
            $remainingQty = $item['quantity']; // The quantity to be subtracted
            $product = Product::find($item['id']);
        
            if ($product) {
                if ($product->itemStock >= $remainingQty) {
                    $product->itemStock -= $remainingQty;
                    $product->save();
                    $remainingQty = 0; // All quantity has been subtracted
                } else {
                    $remainingQty -= $product->itemStock; // Remaining quantity to subtract
                    $product->itemStock = 0; // Deplete basic stock
                    $product->save();
                }
        
                if ($remainingQty > 0) {
                    $stocks = Stock::where('product_id', $item['id'])
                        ->orderBy('type') // Order by type (1, 2, 3, 4)
                        ->get();
        
                    foreach ($stocks as $stock) {
                        if ($stock->quantity >= $remainingQty) {
                            $stock->quantity -= $remainingQty;
                            $stock->save();
                            $remainingQty = 0; // All quantity has been subtracted
                            break; // Exit the loop
                        } else {
                            $remainingQty -= $stock->quantity; // Subtract the available quantity
                            $stock->quantity = 0; // Deplete this stock
                            $stock->save();
                        }
                    }
                }
            }
            if ($remainingQty > 0) {
                throw new \Exception("Insufficient stock for product ID: {$item['id']}");
            }
        }
        


        $this->reset(['items', 'payMethod', 'payedAmount', 'notes', 'discount', 'status', 'customer_id']);
        $this->items = [
            [
                'name' => '',
                'quantity' => '',
                'sell_price' => 1,
                'calculated_price' => 0,
                'id' => '',
                'notes' => '',
            ]
        ];

        session()->flash('message', 'Invoice created successfully.');
    }

    public function thesearch()
    {
        // dd($this->search);
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
        // dd($this->products);
    }
    public function thesearchCustomer()
    {
        // Search for customers based on the search term
        $this->customers = Customer::where('name', 'like', '%' . $this->searchCustomer . '%')->get();
        $this->showButtons = false;
    }



    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array
    }


    public function toggleCustomerType()
    {
        if ($this->customerType === "attached") {
            $this->customerType = "unattached";
        } else {
            $this->customerType = "attached";
        }
    }











    public function continueInvoice($isContinue)
    {
        if ($isContinue) {
            $this->showButtons = true;
        } else {
            return redirect()->route('addInvoice');
        }
    }
    


    public function toggleRefundSection(){
        $this->showRefundSection = !$this->showRefundSection;
    }

    public function serachInvoice()
    {

        if ($this->invoice_search) {
            $this->invoices = Invoice::where('id', 'like', '%' . $this->invoice_search . '%')->with('items.product')->first();
        }
        
        if ($this->invoices) {
            $this->invoice_search_items = $this->invoices->items;
        }
        

        // dd($this->invoice_search_items);
        
    }

    public function refundInvoice($itemId){
       $item = Invoice_item::find($itemId);
       $invoiceRefunded = Invoice::find($item->invoice_id);
        $refund = Refunded::create([
            'current_invoice_id' => $this->invoice->id,
            'refunded_invoice_id' => $invoiceRefunded,
            'refund_amount' => $this->invoice->total
        ]);
    }
    public function render()
    {
        return view('livewire.invoice.add-invoice');
    }
}
