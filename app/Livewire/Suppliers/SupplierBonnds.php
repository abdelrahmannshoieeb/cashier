<?php

namespace App\Livewire\Suppliers;

use App\Models\SupplierBond;
use Livewire\Component;

class SupplierBonnds extends Component
{
    public $SupplierBonds; 
    public $search ;

    public function mount()
    {
        $this->SupplierBonds = SupplierBond::all();
    }
    public function delete($id)
    {
        $user = SupplierBond::find($id);
        
        if ($user) {
            $user->delete();  // Delete the category
        }
    
        $this->SupplierBonds = SupplierBond::all();
    }

    public function thesearch()
    {
        $searchTerm = $this->search;
        $this->SupplierBonds = SupplierBond::whereHas('supplier', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        })->get();
       
    }

    public function viewAll() {

        $this->SupplierBonds = SupplierBond::all();
    }

    public function forhim() {
        $this->SupplierBonds = SupplierBond::where('type', 'add')->get();
    }
    public function onhim() {
        $this->SupplierBonds = SupplierBond::where('type', 'subtract')->get();
    }
    public function empty() {
        $this->SupplierBonds = SupplierBond::all();
    }


    public function cheque() {
        $this->SupplierBonds = SupplierBond::where('method', 'cheque')->get();
    }
    public function credit() {
        $this->SupplierBonds = SupplierBond::where('method', 'credit')->get();
    }
    public function cash() {
        $this->SupplierBonds = SupplierBond::where('method', 'cash')->get();
    }

    public function render()
    {
        return view('livewire.suppliers.supplier-bonnds');
    }
}
