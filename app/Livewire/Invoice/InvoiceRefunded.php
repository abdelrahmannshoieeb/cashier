<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceRefunded extends Component
{

    public $refunded_invoices;
    public $customerName;
    public $invoiceId;

    public function mount()
    {
        $this->refunded_invoices = Invoice::where('status', 'refunded')->get();
      
    }

    public function searchByCustomer()
    
    {
        if ($this->customerName) {
            $this->refunded_invoices = Invoice::where('status', 'refunded')
            ->whereHas('customer', function ($query) {
                $query->where('name', 'like', '%' . $this->customerName . '%');
            })->get();
        }
        else {
            $this->refunded_invoices = Invoice::where('status', 'refunded')->get();
        }
    }

    public function searchByInvoice() {
        if ($this->invoiceId) {
            $this->refunded_invoices = Invoice::where('id', $this->invoiceId)
            ->where('status', 'refunded')
            ->get();
        }
        else
        {
            $this->refunded_invoices = Invoice::where('status', 'refunded')->get();
        }
    }
    

    public function viewAll(){

        $this->refunded_invoices = Invoice::where('status', 'refunded')->get();
    }
    
    public function render()
    {
        return view('livewire.invoice.invoice-refunded');
    }
}
