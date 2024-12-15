<?php

namespace App\Livewire\Workers;

use App\Models\User;
use Livewire\Component;

class Workers extends Component
{
    public $users ;
    public $search ;

    public function mount()
    {
        $this->users = User::where('role', 'user')->get();
    }
    public function delete($id)
    {
        $user = User::find($id);
        
        if ($user) {
            $user->delete();  // Delete the category
        }
    
        $this->users = User::where('role', 'user')->get();
    }
    
    public function thesearch()
    {
        $this->users = User::where('name', 'like', '%' . $this->search . '%')->get();
    }
    public function toggleStatus($userID)
    {
        $user = User::find($userID);
        
        if ($user) {
            $user->is_active = !$user->is_active; // Toggle the status
            $user->save();
        }
        $this->users = User::where('role', 'user')->get();
    }
    public function toggleBoxAccess($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $user->box_access = !$user->box_access; // Toggle the status
            $user->save();
        }
        $this->users = User::where('role', 'user')->get();
    }
    public function toggleEditIvoicesAccess($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $user->edit_invoices_access = !$user->edit_invoices_access; // Toggle the status
            $user->save();
        }
        $this->users = User::where('role', 'user')->get();
    }



    public function viewAll() {

        $this->users = User::where('role', 'user')->get();
    }

    public function render()
    {
        return view('livewire.workers.workers' , 
        [
          
          
        ]
    );
    }
}
