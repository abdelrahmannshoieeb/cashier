<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Product;
use Livewire\Component;

class AddInvoice extends Component
{
    public $products;
    public $selectedProduct;
    public $search;
    public $searchCustomer;
    public $customers;
    public $selectedCustomerId;

    public $sell_price;
    public $items = [
        [
            'name' => '',
            'quantity' => '',
            'sell_price' => 1, // Default sell_price option
            'calculated_price' => 0,
            'id' => '',
            'notes' => '',
        ]
    ];
    public $customerss = [
        [
            'name' => '',
            'balance' => '',
            'limit' => '', // Default sell_price option
        ]
    ];

    public $payMethod;
    public $payedAmount;
    public $notes;
    public $discount = 0;
    public $status = 'unpaid';
    public $customerType;
    public $customer_id;

    public function addItem()
    {
        $this->items[] = [
            'name' => '',
            'quantity' => '',
            'sell_price' => 1,
            'calculated_price' => 0,
            'id' => '',
            'notes' => '',
        ];
    }

   
    public function selectProduct($itemIndex, $productId)
    {
        $this->selectedProduct = Product::find($productId);


        if ($this->selectedProduct) {
            $this->items[$itemIndex]['name'] = $this->selectedProduct->name;
            $this->items[$itemIndex]['price'] = $this->selectedProduct->price;
            $this->items[$itemIndex]['id'] = $this->selectedProduct->id;
        }
    }
    public function selectedCustomer($customerId)
    {
        // Set the selected customer ID
        $this->selectedCustomerId = $customerId;
    
        // Optionally, you can fetch the customer data here or pass it to other variables
        $customer = Customer::find($customerId);
        $this->searchCustomer = $customer->name; // Update the search term to customer name
        // You can also pass customer data to other variables if necessary
    }

    public function updatePrice($itemIndex)
    {
        $productId = $this->items[$itemIndex]['id'];
        $sellPrice = $this->items[$itemIndex]['sell_price'];

        $product = Product::find($productId);

        if ($product) {
            if ($sellPrice == 1) {
                $this->items[$itemIndex]['calculated_price'] = $product->price1;
            } elseif ($sellPrice == 2) {
                $this->items[$itemIndex]['calculated_price'] = $product->price2;
            } elseif ($sellPrice == 3) {
                $this->items[$itemIndex]['calculated_price'] = $product->price3;
            }
        }
    }


    public function saveInvoice()
    {
        // Calculate total
        $total = collect($this->items)->sum(function ($item) {
            return $item['quantity'] * $item['calculated_price'];
        });

        // Save Invoice
        $invoice = Invoice::create([
            'total' => $total,
            'payMethod' => $this->payMethod,
            'payedAmount' => $this->payedAmount,
            'notes' => $this->notes,
            'discount' => $this->discount,
            'status' => $this->status,
            'customerType' => $this->customerType,
            'customer_id' => $this->customer_id,
        ]);

        // Save Invoice Items
        foreach ($this->items as $item) {
            Invoice_item::create([
                'qty' => $item['quantity'],
                'sellPrice' => $item['calculated_price'],
                'notes' => $item['notes'],
                'product_id' => $item['id'],
                'invoice_id' => $invoice->id,
            ]);
        }

        // Reset fields
        $this->reset(['items', 'payMethod', 'payedAmount', 'notes', 'discount', 'status', 'customerType', 'customer_id']);
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
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }
    public function thesearchCustomer()
    {
        // Search for customers based on the search term
        $this->customers = Customer::where('name', 'like', '%' . $this->searchCustomer . '%')->get();
    }



    public function removeItem($index)
    {
        // Unset the item at the given index
        unset($this->items[$index]);
    
        // Optionally reindex the array to fix any gaps in the array keys
        $this->items = array_values($this->items);
    }
    
    public function render()
    {
        return view('livewire.invoice.add-invoice');
    }
}
