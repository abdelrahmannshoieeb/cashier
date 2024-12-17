<?php

namespace App\Livewire\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class AddSupplier extends Component
{
    public $name;
    public $notes;
    public $addrees;
    public $phone;




    public function save()
    {

        $this->validate(
            [
                'name' => 'required|string|unique:customers|string|max:255',
                'notes' => 'nullable|string',
                'addrees' => 'nullable|string',
                'phone' => 'required|numeric',
                'phone' => 'nullable|numeric',

            ],
            [
                'name.required' => 'الاسم مطلوب.',
                'name.unique' => 'الاسم مستخدم بالفعل.',
                'name.string' => 'الملاحظات يجب ان تكون نص.',
                'notes.string' => 'الملاحظات يجب ان تكون نص.',
                'addrees.string' => 'الملاحظات يجب ان تكون نص.',
                'phone.numeric' => 'رقم الهاتف يجب ان يكون من ارقام.',
                'phone.required' => 'رقم الهاتف مطلوب.',

            ]
        );
        Supplier::create([
            'name' => $this->name,
            'notes' => $this->notes,
            'address' => $this->addrees,
            'phone' => $this->phone,
            'balance' => 0,
        ]);

        $this->reset('name', 'notes', 'addrees', 'phone');
        session()->flash('message', 'تم اضافة العميل بنجاح');
    }
    public function render()
    {
        return view('livewire.suppliers.add-supplier');
    }
}
