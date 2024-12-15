<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddProduct extends Component
{

    public $name;
    public $description;
    public $price1;
    public $price2;
    public $price3;
    public $buying_price;
    public $itemStock;
    public $packetStock;
    public $items_in_packet;
    public $stockAlert;
    public $isActive;
    public $category_id;

    public $categories;
    public function mount()
    {
        $this->categories = Category::all();
    }
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price1' => 'nullable|numeric',
        'price2' => 'nullable|numeric',
        'price3' => 'nullable|numeric',
        'buying_price' => 'nullable|numeric',
        'itemStock' => 'nullable|integer',
        'packetStock' => 'nullable|integer',
        'items_in_packet' => 'nullable|integer',
        'stockAlert' => 'nullable|integer',
        'isActive' => 'boolean',
        'category_id' => 'nullable|exists:categories,id',
    ];

    protected function rules()
    {
        return $this->rules;
    }

    protected function customValidate()
    {
        $this->validate();

        // Custom validation logic
        if ($this->buying_price !== null) {
            if ($this->buying_price >= $this->price1 || $this->buying_price >= $this->price2 || $this->buying_price >= $this->price3) {
                throw ValidationException::withMessages([
                    'buying_price' => 'يجب ان يكون سعر الشراء اقل من سعر البيع.',
                ]);
            }
        }

        if ($this->stockAlert !== null && $this->stockAlert >= $this->itemStock) {
            throw ValidationException::withMessages([
                'stockAlert' => 'يجب ان يكون تنبيه المخزون اقل من العدد في المخزون.',
            ]);
        }
    }
    public function save()
    {
        $this->customValidate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price1' => $this->price1,
            'price2' => $this->price2,
            'price3' => $this->price3,
            'buying price' => $this->buying_price,
            'itemStock' => $this->itemStock,
            'packetStock' => $this->packetStock,
            'items_in_packet' => $this->items_in_packet,
            'stockAlert' => $this->stockAlert,
            'isActive' => $this->isActive,
            'category_id' => $this->category_id,
        ]);

        $this->reset('name', 'description', 'price1', 'price2', 'price3', 'buying_price', 'itemStock', 'packetStock', 'items_in_packet', 'stockAlert');
        session()->flash('message', 'تم اضافة المنتج بنجاح');
    }



    public function render()
    {
        return view('livewire.product.add-product');
    }
}
