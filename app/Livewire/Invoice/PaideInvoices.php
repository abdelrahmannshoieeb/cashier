<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;
use PhpParser\Node\Stmt\Else_;

class PaideInvoices extends Component
{

    public $paid_invoices;
    public $customerName;
    public $invoiceId;

    public function mount()
    {
        $this->paid_invoices = Invoice::where('status', 'paid')->get();
      
    }

    public function searchByCustomer()
    
    {
        if ($this->customerName) {
            $this->paid_invoices = Invoice::where('status', 'paid')
            ->whereHas('customer', function ($query) {
                $query->where('name', 'like', '%' . $this->customerName . '%');
            })->get();
        }
        else {
            $this->paid_invoices = Invoice::where('status', 'paid')->get();
        }
    }

    public function searchByInvoice() {
        if ($this->invoiceId) {
            $this->paid_invoices = Invoice::where('id', $this->invoiceId)
            ->where('status', 'paid')
            ->get();
        }
        else
        {
            $this->paid_invoices = Invoice::where('status', 'paid')->get();
        }
    }
    

    public function viewAll(){

        $this->paid_invoices = Invoice::where('status', 'paid')->get();
    }
    public function render()
    {
        return view('livewire.invoice.paide-invoices');
    }
}
