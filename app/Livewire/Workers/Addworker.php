<?php

namespace App\Livewire\Workers;

use App\Models\Shop;
use App\Models\User; // Replace with your worker model if not `User`
use Livewire\Component;

class AddWorker extends Component
{
    public $name;
    public $pass;
    public $phone;
    public $shop_id;

    public $is_active = 0 ;
    public $box_access = 0;
    public $edit_invoices_access = 0;

    public $worker; // Worker instance to toggle access if updating an existing worker.
    public $shops; // Worker instance to toggle access if updating an existing worker.


    public function mount()
    {
        $this->shops =Shop::all();
    }
    public function save()
    {

        // dd($this->shop_id);
        $this->validate(
            [
                'name' => 'required|unique:users,name',
                'pass' => 'required|digits:6',
                'phone' => 'required|numeric|digits:11',
                'is_active' => 'required',
                'edit_invoices_access' => 'required',
                'box_access' => 'required',
            ],
            [
                'name.required' => 'الاسم مطلوب.',
                'name.unique' => 'الاسم مستخدم بالفعل.',
                'pass.required' => 'كلمة المرور مطلوبة.',
                'pass.digits' => 'كلمة المرور يجب أن تتكون من 6 أرقام.',
                'phone.required' => 'رقم الهاتف مطلوب.',
                'phone.numeric' => 'رقم الهاتف يجب أن يكون أرقام فقط.',
                'phone.digits' => 'رقم الهاتف يجب أن يتكون من 11 رقم.',
                ]
            );
            
            // dd($this->edit_invoices_access);

        $this->worker = User::create([
            'name' => $this->name,
            'password' => bcrypt($this->pass),
            'phone' => $this->phone,
            'is_active' => $this->is_active,
            'box_access' => $this->box_access,
            'edit_invoices_access' => $this->edit_invoices_access,
            'shop_id' => $this->shop_id
        ]);

        session()->flash('message', 'Worker added successfully!');
        $this->resetFields(); // Clear input fields after saving
    }

    public function resetFields()
    {
        $this->name = '';
        $this->pass = '';
        $this->phone = '';
        $this->is_active = false;
        $this->box_access = false;
        $this->edit_invoices_access = false;
    }

    public function toggleStatus()
    {
        $this->is_active = !$this->is_active;
        if ($this->worker) {
            $this->worker->update(['is_active' => $this->is_active]);
        }
    }

    public function toggleBoxAccess()
    {
        $this->box_access = !$this->box_access;
        if ($this->worker) {
            $this->worker->update(['box_access' => $this->box_access]);
        }
    }

    public function toggleEditInoviceAccess()
    {
        $this->edit_invoices_access = !$this->edit_invoices_access;
        if ($this->worker) {
            $this->worker->update(['edit_invoices_access' => $this->edit_invoices_access]);
        }
    }

    public function render()
    {
        return view('livewire.workers.addworker');
    }
}
