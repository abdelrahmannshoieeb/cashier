<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class Customers extends Component
{
    public $customers; 
    public $search ;

    public function mount()
    {
        $this->customers = Customer::all();
    }
    public function delete($id)
    {
        $user = Customer::find($id);
        
        if ($user) {
            $user->delete();  // Delete the category
        }
    
        $this->customers = Customer::all();
    }

    public function thesearch()
    {
        $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function viewAll() {

        $this->customers = Customer::all();
    }

    public function forhim() {
        $this->customers = Customer::where('balance', '>', 0)->get();
    }
    public function onhim() {
        $this->customers = Customer::where('balance', '=<', 0)->get();
    }

    public function empty() {
        $this->customers = Customer::where('balance', '=', 0)->get();
    }
    public function render()
    {
        return view('livewire.customers.customers');
    }
}
