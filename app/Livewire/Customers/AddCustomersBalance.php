<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use App\Models\CustomerBonnd;
use App\Models\settings;
use Livewire\Component;

class AddCustomersBalance extends Component
{

    public $type = 1;   
    public $amount;   
    public $note = 'لا يوجد ملاحظات';   
    public $method = 'cash';   


    public $customers;   
    public $search;   
    public $customer_id;   

    public function mount()
    {
        $this->customers = Customer::all();
    }

    public function thesearch()
    {
        $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
    }
    public function viewAll()
    {
        $this->customers = Customer::all();
        
    }
    public function create()
    {
        $settings = settings::first();
        $validation = $this->validate([
            'amount' => 'required|numeric',
            'note' => 'string',
            'type' => 'required',
            'method' => 'required',
            'customer_id' => 'required',
        ]);
        
        if ($this->type == 1) {
             $addToBalance= CustomerBonnd::create([
                'type' => 'add',
                'value' => $this->amount,
                'notes' => $this->note,
                'method' => $this->method,
                'customer_id' => $this->customer_id
            ]);

            if($addToBalance){
                $addToBalance->customer->balance = $addToBalance->customer->balance + $addToBalance->value; 
                $addToBalance->customer->save();
            }


            if($settings->adding_customers_fund_to_box ){
                $settings->update([
                    'box_value' => $settings->box_value + $this->amount,
                ]);
            }
            session()->flash('addsuccess', 'تم إضافة المبلغ بنجاح');
            $this->reset(['amount', 'note' , 'method' , 'customer_id' , 'search']);
        } else {
             $subtractFromBalance = CustomerBonnd::create([
                'type' => 'subtract',
                'value' => $this->amount,
                'notes' => $this->note,
                'method' => $this->method,
                'customer_id' => $this->customer_id
            ]);
            if($subtractFromBalance){
                $subtractFromBalance->customer->balance = $subtractFromBalance->customer->balance - $subtractFromBalance->value; 
                $subtractFromBalance->customer->save();
            }

            if($settings->adding_customers_fund_to_box ){
                $settings->update([
                    'box_value' => $settings->box_value - $this->amount,
                ]);
            }
            session()->flash('subtractmessage', 'تم اضافة المبلغ بنجاح');

            $this->reset(['amount', 'note' , 'method' , 'customer_id' , 'search']);
        }
    }

    public function render()
    {
        return view('livewire.customers.add-customers-balance');
    }
}
