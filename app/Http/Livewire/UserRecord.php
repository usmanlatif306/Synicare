<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserRecord extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.user-record', [
            'users' => User::where('role_id', 0)->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            })->select(['id', 'name', 'email', 'phone'])->paginate(10)
        ]);
    }
}
