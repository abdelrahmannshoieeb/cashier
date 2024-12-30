<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Product;
use App\Models\Refunded;
use App\Models\settings;
use App\Models\Stock;
use GuzzleHttp\Promise\Create;
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
    public $showTotalMessage = 0;
    public $invoices;
    public $invoice_search;
    public $invoice_search_items;

    public function mount()
    {
        $this->showRefundSection = false;
        $this->showTotalMessage = false;
    }
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
                    $stockMessages[] = 'الكمية المطلوبة أكبر من المتوفر. تم استخدام المتوفر فقط (' . ($requestedQuantity - $remainingQuantity) . '). الباقي ' . $remainingQuantity . ' سيتم إضافته إلى الفاتورة القادمة.';
                    session()->flash('quantityError', implode(' ', $stockMessages));
                    return; // Prevent adding the item
                }
            }

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
        if ($customer->balance < 0) {
            $this->showButtons = false;
        } else {
            $this->showButtons = true;
        }
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


        // Convert fields to proper types
        $this->total = is_numeric($this->total) ? (float) $this->total : 0.0;
        $this->payedAmount = is_numeric($this->payedAmount) ? (float) $this->payedAmount : 0.0;
        $this->discount = is_numeric($this->discount) ? (float) $this->discount : 0.0;

        
       

        // Calculate total
        $this->total = collect($this->items)->sum(function ($item) {
            return ($item['quantity'] * $item['calculated_price']) - (float) $this->discount;
        });


        // Validation
        $this->validate([
            'items' => 'required|array|min:1',
        ]);

        if ($this->customerType === false) {
            $this->customerType = 'unattached';
            $this->validate([
                'customerName' => 'required', // Ensure customerName is required
            ]);
        }

      

       
        if ($this->customerType === 'attached') {
            $customer = Customer::find($this->selectedCustomerId);
            $remainingBalance = $customer->balance - $this->total + $this->payedAmount + $this->discount;

            if ($customer->balance > $remainingBalance) {
                $message = $remainingBalance > 0
                    ? 'العميل ما زال له ' . $remainingBalance
                    : 'العميل ما زال عليه ' . abs($remainingBalance);
                session()->flash('balance', $message);

                $customer->balance = $remainingBalance;
                $customer->save();
            }
        }
       
         
      

        // Set invoice status
        if ($this->payedAmount < $this->total && $this->payedAmount != 0) {
            $this->status = 'partiallyPaid';
            $this->still = $this->total - $this->payedAmount;
        } elseif ($this->payedAmount == $this->total) {
            $this->status = 'paid';
        } else {
            $this->status = 'unpaid';
            $this->still = $this->total;
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
            'customerName' => $this->customerType === 'unattached' ? $this->customerName : null,
            'customer_id' => $this->customerType === 'attached' ? $this->selectedCustomerId : null,
            'still' => $this->still,
            'user_id' => auth()->user()->id,
        ]);
        

        $this->invoice = $invoice;

        // Save Invoice Items and Update Stock
        foreach ($this->items as $item) {
            Invoice_item::create([
                'qty' => $item['quantity'],
                'sellPrice' => $item['calculated_price'],
                'product_id' => $item['id'],
                'invoice_id' => $invoice->id,
            ]);

            $remainingQty = $item['quantity'];
            $product = Product::find($item['id']);

            if ($product) {
                if ($product->itemStock >= $remainingQty) {
                    $product->itemStock -= $remainingQty;
                    $product->save();
                    $remainingQty = 0;
                } else {
                    $remainingQty -= $product->itemStock;
                    $product->itemStock = 0;
                    $product->save();
                }

                if ($remainingQty > 0) {
                    $stocks = Stock::where('product_id', $item['id'])->orderBy('type')->get();

                    foreach ($stocks as $stock) {
                        if ($stock->quantity >= $remainingQty) {
                            $stock->quantity -= $remainingQty;
                            $stock->save();
                            $remainingQty = 0;
                            break;
                        } else {
                            $remainingQty -= $stock->quantity;
                            $stock->quantity = 0;
                            $stock->save();
                        }
                    }
                }
            }

        
        }

        // Handle settings
        $settings = settings::first();
        if ($settings->adding_sellers_fund_to_box) {
            $settings->update([
                'box_value' => $settings->box_value + $this->payedAmount,
            ]);
        }

       
        session()->flash('message', 'Invoice created successfully.');
        $this->showRefundSection = !$this->showRefundSection;
        $this->reset(['items', 'payMethod', 'payedAmount', 'notes', 'discount', 'status', 'customer_id']); 
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



    public function toggleRefundSection()
    {
        $this->showRefundSection = !$this->showRefundSection;
    }

    public function serachInvoice()
    {

        if ($this->invoice_search) {
            $this->invoices = Invoice::where('id', 'like', '%' . $this->invoice_search . '%')
                ->where('status', '!=', 'refunded') // Exclude refunded status
                ->with('items.product')
                ->first();
        }

        if ($this->invoices) {
            $this->invoice_search_items = $this->invoices->items;
        }


        // dd($this->invoice_search_items);

    }

    public function refundInvoice($itemId)
    {
        $item = Invoice_item::find($itemId);
        $invoiceRefunded = Invoice::find($item->invoice_id);


        if ($this->total) {

            $this->total = $this->total - $invoiceRefunded->items->map(function ($item) {
                return (float) $item->sellPrice * (float) $item->qty;
            })->sum();
            $this->invoice->total = $this->total;
            $this->invoice->save();
        }
        $this->showTotalMessage = true;
        $invoiceRefunded->status = 'refunded';
        $this->still = $this->total - $this->payedAmount;
        $invoiceRefunded->save();

        $refunded = Refunded::create([
            'current_invoice_id' => $this->invoice->id,
            'refunded_invoice_id' => $invoiceRefunded->id,
            'type' => "refundAll",
        ]);

        // dd($refunded);

    }
    public function render()
    {
        return view('livewire.invoice.add-invoice');
    }
}
