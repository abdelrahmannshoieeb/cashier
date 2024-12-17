<?php

namespace App\Livewire\Box;

use App\Models\BoxOperation;
use App\Models\settings;
use Livewire\Component;

class BoxOperations extends Component
{

    public $type = 1;
    public $amount;
    public $note;

    public function mount() {}

    public function create()
    {
        $settings = settings::first();
        
        if ($this->type == 1) {
            BoxOperation::create([
                'type' => 'add',
                'value' => $this->amount,
                'note' => $this->note,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('addsuccess', 'تم إضافة المبلغ بنجاح');
            
            if($settings->subtract_Expenses_from_box == 1){
                $settings->update([
                    'box_value' => $settings->box_value + $this->amount,
                ]);
            }
        }
    
        if ($this->type == 0 && $settings->box_value >= $this->amount) {
            BoxOperation::create([
                'type' => 'subtract',
                'value' => $this->amount,
                'note' => $this->note,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('subtractmessage', 'تم السحب بنجاح');
            if($settings->subtract_Expenses_from_box == 1){
                $settings->update([
                    'box_value' => $settings->box_value - $this->amount,
                ]);
            }
        } else {
            session()->flash('subtractmessagefailed', 'لا يوجد مبلغ كافي في الصندوق');
        }
    
        $this->reset('type', 'amount', 'note');
    }
    
    public function render()
    {
        return view('livewire.box.box-operations');
    }
}
