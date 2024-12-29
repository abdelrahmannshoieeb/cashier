<?php

namespace App\Livewire\Money;

use App\Models\Invoice_item;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sellers extends Component
{
    public $products;
    public $search = '';

    public function mount()
    {
        $this->products = DB::table('invoice_items')
    ->select(
        'products.id as product_id',
        'products.name as product_name',
        DB::raw('SUM(invoice_items.qty * invoice_items.sellPrice) as total_sell_price'),
        DB::raw('SUM(invoice_items.qty ) as qty'),
        DB::raw('SUM(invoice_items.qty * invoice_items.sellPrice) - (SUM(invoice_items.qty) * `products`.`buying price`) as earnings')
    )
    ->join('products', 'products.id', '=', 'invoice_items.product_id')
    ->groupBy('products.id', 'products.name', 'products.buying price') // No backticks here
    ->get();


        // dd($this->products);
    }

    public function thesearch(){
        $this->products = DB::table('invoice_items')
        ->select(
            'products.id as product_id',
            'products.name as product_name',
            DB::raw('SUM(invoice_items.qty * invoice_items.sellPrice) as total_sell_price'),
            DB::raw('SUM(invoice_items.qty ) as qty'),
            DB::raw('SUM(invoice_items.qty * invoice_items.sellPrice) - (SUM(invoice_items.qty) * `products`.`buying price`) as earnings')
        )
        ->join('products', 'products.id', '=', 'invoice_items.product_id')
        ->where('products.name', 'like', '%' . $this->search . '%')
        ->groupBy('products.id', 'products.name', 'products.buying price') // No backticks here
        ->get();
    }

    public function viewAll(){
        $this->products = DB::table('invoice_items')
        ->select(
            'products.id as product_id',
            'products.name as product_name',
            DB::raw('SUM(invoice_items.qty * invoice_items.sellPrice) as total_sell_price'),
            DB::raw('SUM(invoice_items.qty ) as qty'),
            DB::raw('SUM(invoice_items.qty * invoice_items.sellPrice) - (SUM(invoice_items.qty) * `products`.`buying price`) as earnings')
        )
        ->join('products', 'products.id', '=', 'invoice_items.product_id')
        ->groupBy('products.id', 'products.name', 'products.buying price') // No backticks here
        ->get();
    
    }
    public function render()
    {
        return view('livewire.money.sellers');
    }
}
