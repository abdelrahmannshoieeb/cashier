<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products ;
    public $search ;

    public function mount()
    {
        $this->products = Product::all();
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



    public function viewAll() {

        $this->products = Product::all();
    }
    public function render()
    {
        return view('livewire.product.products');
    }
}
