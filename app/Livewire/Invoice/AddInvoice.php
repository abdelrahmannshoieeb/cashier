<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Product;
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


    public function addItem()
    {
        if ($this->selectedProduct) {
            // Check if the quantity exceeds stock
            if ($this->newItem['quantity'] > $this->selectedProduct->itemStock) {
                // Set a flash message for the error
                session()->flash('quantityError', 'المخزون به ' . $this->selectedProduct->itemStock . ' . الكمية المطلوبة تتجاوز المخزون.');
                return; // Prevent adding the item
            }
    
            $this->items[] = [
                'name' => $this->selectedProduct->name,
                'quantity' => $this->newItem['quantity'], // Default quantity
                'calculated_price' => $this->sell_price, // Use sell_price
                'id' => $this->selectedProduct->id,
            ];
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
        $this->selectedProduct = Product::find($productId);

        if ($this->selectedProduct) {
            // Set default sell_price to price1
            $this->sell_price = $this->selectedProduct->price1;
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
    
            // Subtract quantity from stock
            $product = Product::find($item['id']);
            if ($product) {
                $product->itemStock -= $item['quantity'];
                $product->save();
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
    
    public function render()
    {
        return view('livewire.invoice.add-invoice');
    }
}
