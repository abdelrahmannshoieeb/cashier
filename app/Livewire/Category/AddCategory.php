<?php

namespace App\Livewire\Category;

use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Livewire\Component;

class AddCategory extends Component
{

    public $name;
    public $search;
    public $categories;


 public function mount()
{
    $this->categories = Category::all(); 
}

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);
        
        Category::create([
            'name' => $this->name,
            'user_id' => auth()->user()->id
        ]);
        $this->name = '';
        $this->categories = Category::all(); 

    }

    public function delete($id)
    {
        $category = Category::find($id);
        
        if ($category) {
            $category->delete();  // Delete the category
        }
    
        $this->categories = Category::all();
    }
    
    public function thesearch()
    {
        $this->categories = Category::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function viewAll() {

        $this->categories = Category::all();
    }

    
    public function render()
    {
        return view('livewire.category.add-category');
    }
}
