<?php

namespace App\Livewire\Box;

use App\Models\settings;
use Livewire\Component;

class BoxControl extends Component
{
    public $settings;

    public $adding_customers_fund_to_box = 0;
    public $adding_sellers_fund_to_box = 0;
    public $subtract_Suppliers_fund_from_box = 0;
    public $subtract_Procurement_fund_from_box = 0;
    public $subtract_Expenses_from_box = 0;


    public function mount()
    {
     $this->settings = settings::first();   
    //  dd($this->settings);

        $this->update();
    }

    public function update()
    {
        $this->settings->update([
            'adding_customers_fund_to_box' => $this->adding_customers_fund_to_box,
            'adding_sellers_fund_to_box' => $this->adding_sellers_fund_to_box,
            'subtract_Suppliers_fund_from_box' => $this->subtract_Suppliers_fund_from_box,
            'subtract_Procurement_fund_from_box' => $this->subtract_Procurement_fund_from_box,
            'subtract_Expenses_from_box' => $this->subtract_Expenses_from_box,
        ]);
     $this->settings = settings::first();   

    }
    
    public function render()
    {
        return view('livewire.box.box-control');
    }
}
