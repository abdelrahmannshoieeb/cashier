<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\settings;
use Livewire\Component;

class AddExpense extends Component
{

    public $type = 1;
    public $amount;
    public $name;
    public $method;

    public function mount() {}

    public function create()
    {
        $settings = settings::first();
        
        if ($this->type == 1) {
            Expense::create([
                'type' => 'add',
                'value' => $this->amount,
                'name' => $this->name,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('addsuccess', 'تم إضافة سند المصاريف بنجاح');
            
            if($settings->subtract_Expenses_from_box == 1){
                $settings->update([
                    'box_value' => $settings->box_value + $this->amount,
                ]);
            }
        }elseif($this->type == 0 && $settings->box_value >= $this->amount) {
            Expense::create([
                'type' => 'subtract',
                'value' => $this->amount,
                'name' => $this->name,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('subtractmessage', 'تم السحب بنجاح');
            if($settings->subtract_Expenses_from_box == 1){
                $settings->update([
                    'box_value' => $settings->box_value - $this->amount,
                ]);
            }
        } 
         else {
            session()->flash('subtractmessagefailed', 'لا يوجد مبلغ كافي في الصندوق');
        }
    
        $this->reset('type', 'amount', 'name');
    }

    public function render()
    {
        return view('livewire.expenses.add-expense');
    }
}
