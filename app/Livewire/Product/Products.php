<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Livewire\Component;

class Products extends Component
{
    public $products;
    public $categories;
    public $search;



    public $productQuantityAdded;
    public $quantityDropdown = 1;
    public $price;

    public function mount()
    {
        $this->products = Product::all();
        $this->categories = Category::all();
    }
    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();  // Delete the category
        }

        $this->products = Product::all();
    }

    public function thesearch()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }
    public function toggleStatus($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $product->isActive = !$product->isActive; // Toggle the status
            $product->save();
        }
        $this->products = Product::all();
    }



    public function viewAll()
    {

        $this->products = Product::all();
    }

    public function alerted()
    {
        $this->products = Product::whereColumn('itemStock', '<', 'stockAlert')->get();
    }

    public function stockFilter($min, $max)
    {
        $this->products = Product::whereBetween('itemStock', [$min, $max])->get();
    }
    public function categoryFilter($id)
    {
        $this->products = Product::where('category_id', $id)->get();
    }


    public function addProductToStock($id)
    {
        $this->validate([
            'productQuantityAdded' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
        ]);

        $product = Product::find($id);

        if ($this->quantityDropdown == 1) {  // Use == for comparison
            $product->itemStock += $this->productQuantityAdded;
            $product->save();
            $this->products = Product::all();
        } elseif ($this->quantityDropdown != 1) {
            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'type' => $this->quantityDropdown,  
                ],
                [
                    'quantity' => $this->productQuantityAdded,  
                    'price' => $this->price,
                ]
            );
        } else {
            return;  // Handle any other cases if necessary
        }
    }

    public function render()
    {
        return view('livewire.product.products');
    }
}
