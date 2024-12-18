<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\User;
use Livewire\Component;

class Expenses extends Component
{
    public $expenses; 
    public $users; 
    public $search ;

    public function mount()
    {
        $this->expenses = Expense::all();
        $this->users = User::all();
    }
    public function delete($id)
    {
        $user = expenses::find($id);
        
        if ($user) {
            $user->delete();  // Delete the category
        }
    
        $this->expenses = Expense::all();
    }

    public function thesearch()
    {
        $searchTerm = $this->search;
        $this->expenses = Expense::whereHas('user', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        })->get();
       
    }

    public function viewAll() {

        $this->expenses = Expense::all();
    }

    public function forhim() {
        $this->expenses = Expense::where('type', 'add')->get();
    }
    public function onhim() {
        $this->expenses = Expense::where('type', 'subtract')->get();
    }
   


    public function cheque() {
        $this->expenses = Expense::where('method', 'box')->get();
    }
    public function credit() {
        $this->expenses = Expense::where('method', 'credit')->get();
    }
    public function box() {
        $this->expenses = Expense::where('method', 'cash')->get();
    }


    public function userFilter($userId) {
        $this->expenses = Expense::where('user_id', $userId)->get();
    }

    public function render()
    {
        return view('livewire.expenses.expenses');
    }
}
