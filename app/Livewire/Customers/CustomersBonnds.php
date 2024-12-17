<?php

namespace App\Livewire\Customers;

use App\Models\CustomerBonnd;
use App\Models\SupplierBond;
use Livewire\Component;

class CustomersBonnds extends Component
{
    public $customersBonds; 
    public $search ;

    public function mount()
    {
        $this->customersBonds = CustomerBonnd::all();
    }
    public function delete($id)
    {
        $user = CustomerBonnd::find($id);
        
        if ($user) {
            $user->delete();  // Delete the category
        }
    
        $this->customersBonds = CustomerBonnd::all();
    }

    public function thesearch()
    {
        $searchTerm = $this->search;
        $this->customersBonds = CustomerBonnd::whereHas('customer', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        })->get();
       
    }

    public function viewAll() {

        $this->customersBonds = CustomerBonnd::all();
    }

    public function forhim() {
        $this->customersBonds = CustomerBonnd::where('type', 'add')->get();
    }
    public function onhim() {
        $this->customersBonds = CustomerBonnd::where('type', 'subtract')->get();
    }
    public function empty() {
        $this->customersBonds = CustomerBonnd::all();
    }
    public function render()
    {
        return view('livewire.customers.customers-bonnds');
    }
}
