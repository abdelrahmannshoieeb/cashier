<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class AddCustomer extends Component
{
    public $name;
    public $notes;
    public $addrees;
    public $phone1;
    public $phone2;
    public $pocket_number;
    public $sell_price = 1;
    public $credit_limit;
    public $credit_limit_days;


   

    public function save()
    {
       
        $this->validate(
            [
                'name' => 'required|unique:customers|string|max:255',
                'notes' => 'nullable|string',
                'addrees' => 'nullable|string',
                'phone1' => 'required|numeric',
                'phone2' => 'nullable|numeric',
                'pocket_number' => 'nullable|numeric',
                'credit_limit' => 'nullable|numeric',
                'credit_limit_days' => 'nullable|numeric',
               ],
            [
                'name.required' => 'الاسم مطلوب.',
                'name.unique' => 'الاسم مستخدم بالفعل.',
                'notes.string' => 'الملاحظات يجب ان تكون نص.',
                'addrees.string' => 'الملاحظات يجب ان تكون نص.',
                'phone1.numeric' => 'رقم الهاتف يجب ان يكون من ارقام.',
                'phone1.required' => 'رقم الهاتف مطلوب.',
                'phone2.numeric' => 'رقم الهاتف يجب ان يتكون من 11 رقم.',
                'pocket_number.numeric' => 'رقم الهاتف يجب ان يتكون من 11 رقم.',
                'credit_limit.numeric' => '  يجب أن يكون أرقام فقط.',
                'credit_limit_days.numeric' => '  يجب أن يكون أرقام فقط.',
                ]
            );
           
        Customer::create([
            'name' => $this->name,
            'notes' => $this->notes,
            'address' => $this->addrees,            
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,            
            'pocket_number' => $this->pocket_number,
            'sell_price' => $this->sell_price,            
            'credit_limit' => $this->credit_limit,
            'credit_limit_days' => $this->credit_limit_days, 
            'balance' => 0 
        ]);
        
        $this->reset('name', 'notes', 'addrees', 'phone1', 'phone2', 'pocket_number', 'credit_limit', 'credit_limit_days');
        session()->flash('message', 'تم اضافة العميل بنجاح');
    }

    public function mount() {}
    public function render()
    {
        return view('livewire.customers.add-customer');
    }
}
