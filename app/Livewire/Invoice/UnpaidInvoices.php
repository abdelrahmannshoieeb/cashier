<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class UnpaidInvoices extends Component
{

    public $unpaid_invoices;
    public $customerName;
    public $invoiceId;

    public function mount()
    {
        $this->unpaid_invoices = Invoice::where('status', 'unpaid')->get();
      
    }

    public function searchByCustomer()
    
    {
        if ($this->customerName) {
            $this->unpaid_invoices = Invoice::whereHas('customer', function ($query) {
                $query->where('name', 'like', '%' . $this->customerName . '%');
            })->get();
        }
        else {
            $this->unpaid_invoices = Invoice::where('status', 'unpaid')->get();
        }
    }

    public function searchByInvoice() {
        if ($this->invoiceId) {
            $this->unpaid_invoices = Invoice::where('id', $this->invoiceId)
            ->where('status', 'unpaid')
            ->get();
        }
        else
        {
            $this->unpaid_invoices = Invoice::where('status', 'unpaid')->get();
        }
    }
    

    public function viewAll(){

        $this->unpaid_invoices = Invoice::where('status', 'unpaid')->get();
    }

    public function render()
    {
        return view('livewire.invoice.unpaid-invoices');
    }
}
