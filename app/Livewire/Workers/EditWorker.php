<?php

namespace App\Livewire\Workers;

use App\Models\Shop;
use App\Models\User;
use Livewire\Component;

class EditWorker extends Component
{
    public $name;
    public $pass;
    public $phone;
    public $shop_id;

    public $is_active = 0;
    public $box_access = 0;
    public $edit_invoices_access = 0;
    public $edit_product = 0; // Add this field for edit_product

    public $worker; // Worker instance for editing existing worker
    public $shops; // List of shops for selection

    public function mount($workerId = null)
    {
        // Load the list of shops
        $this->shops = Shop::all();

        $workerId = request()->segment(2);
        // If we're editing a worker, load the worker's data
        if ($workerId) {
            $this->worker = User::find($workerId);
            
            if ($this->worker) {
                $this->name = $this->worker->name;
                $this->phone = $this->worker->phone;
                $this->shop_id = $this->worker->shop_id;
                $this->is_active = $this->worker->is_active;
                $this->box_access = $this->worker->box_access;
                $this->edit_invoices_access = $this->worker->edit_invoices_access;
                $this->edit_product = $this->worker->edit_product; // Populate edit_product if editing
            }
        }
    }

    public function edit()
    {
        // Validate the fields
        $this->validate(
            [
                'name' => $this->worker ? 'required|unique:users,name,' . $this->worker->id : 'required|unique:users,name',
                'pass' => 'required|digits:6',
                'phone' => 'required|numeric|digits:11',
                'is_active' => 'required',
                'edit_invoices_access' => 'required',
                'box_access' => 'required',
                'edit_product' => 'required', // Add validation for edit_product
            ],
            [
                'name.required' => 'الاسم مطلوب.',
                'name.unique' => 'الاسم مستخدم بالفعل.',
                'pass.required' => 'كلمة المرور مطلوبة.',
                'pass.digits' => 'كلمة المرور يجب أن تتكون من 6 أرقام.',
                'phone.required' => 'رقم الهاتف مطلوب.',
                'phone.numeric' => 'رقم الهاتف يجب أن يكون أرقام فقط.',
                'phone.digits' => 'رقم الهاتف يجب أن يتكون من 11 رقم.',
                'edit_product.required' => 'صلاحية تعديل المنتج مطلوبة.', // Custom message for edit_product
            ]
        );

        // Check if we are updating an existing worker or creating a new one
        if ($this->worker) {
            // Update existing worker
            $this->worker->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'is_active' => $this->is_active,
                'box_access' => $this->box_access,
                'edit_invoices_access' => $this->edit_invoices_access,
                'edit_product' => $this->edit_product, // Update edit_product
                'shop_id' => $this->shop_id,
                'password' => $this->pass ? bcrypt($this->pass) : $this->worker->password, // Only update password if it's provided
            ]);

            session()->flash('message', 'Worker updated successfully!');
        } else {
            // Create new worker
            $this->worker = User::create([
                'name' => $this->name,
                'password' => bcrypt($this->pass),
                'phone' => $this->phone,
                'is_active' => $this->is_active,
                'box_access' => $this->box_access,
                'edit_invoices_access' => $this->edit_invoices_access,
                'edit_product' => $this->edit_product, // Create edit_product
                'shop_id' => $this->shop_id,
            ]);

            session()->flash('message', 'Worker added successfully!');
        }

        // Reset the fields after saving
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->pass = '';
        $this->phone = '';
        $this->is_active = false;
        $this->box_access = false;
        $this->edit_invoices_access = false;
        $this->edit_product = false; // Reset edit_product field as well
        $this->shop_id = null; // Reset the shop ID as well
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

    public function toggleEditProductAccess()
    {
        $this->edit_product = !$this->edit_product;
        if ($this->worker) {
            $this->worker->update(['edit_product' => $this->edit_product]);
        }
    }

    public function render()
    {
        return view('livewire.workers.edit-worker');
    }
}

