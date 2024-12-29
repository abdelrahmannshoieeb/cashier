<?php

namespace App\Livewire\Suppliers;

use App\Models\settings;
use App\Models\Supplier;
use App\Models\SupplierBond;
use Livewire\Component;

class AddSupplierBalance extends Component
{

    public $type = 1;   
    public $amount;   
    public $note;   
    public $method = 'cash';   


    public $suppliers;   
    public $search;   
    public $supplier_id;   

    public function mount()
    {
        $this->suppliers = Supplier::all();
    }

    public function thesearch()
    {
        $this->suppliers = Supplier::where('name', 'like', '%' . $this->search . '%')->get();
    }
    public function viewAll()
    {
        $this->suppliers = Supplier::all();
    }

    public function create()
    {
        
        $settings = settings::first();
        $this->validate([
            'amount' => 'required|numeric',
            'type' => 'required',
            'method' => 'required',
            'supplier_id' => 'required',
        ]);
        
        if ($this->type == 1) {
             $addToBalance= SupplierBond::create([
                'type' => 'add',
                'value' => $this->amount,
                'notes' => $this->note,
                'method' => $this->method,
                'supplier_id' => $this->supplier_id
            ]);

            if($addToBalance){
                $addToBalance->supplier->balance = $addToBalance->supplier->balance + $addToBalance->value; 
                $addToBalance->supplier->save();
            }

            if($settings->subtract_Suppliers_fund_from_box ){
                $settings->update([
                    'box_value' => $settings->box_value + $this->amount,
                ]);
            }
            
            session()->flash('addsuccess', 'تم إضافة المبلغ بنجاح');
            $this->reset(['amount', 'note' , 'method' , 'supplier_id' , 'search']);
        } else {
             $subtractFromBalance = SupplierBond::create([
                'type' => 'subtract',
                'value' => $this->amount,
                'notes' => $this->note,
                'method' => $this->method,
                'supplier_id' => $this->supplier_id
            ]);
            if($subtractFromBalance){
                $subtractFromBalance->supplier->balance = $subtractFromBalance->supplier->balance - $subtractFromBalance->value; 
                $subtractFromBalance->supplier->save();
            }

            if($settings->subtract_Suppliers_fund_from_box ){
                $settings->update([
                    'box_value' => $settings->box_value - $this->amount,
                ]);
            }
            

            session()->flash('subtractmessage', 'تم اضافة المبلغ بنجاح');

            $this->reset(['amount', 'note' , 'method' , 'supplier_id' , 'search']);
        }
    }
    public function render()
    {
        return view('livewire.suppliers.add-supplier-balance');
    }
}
