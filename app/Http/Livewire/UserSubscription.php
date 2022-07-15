<?php

namespace App\Http\Livewire;

use App\Models\Subscription;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserSubscription extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.user-subscription', [
            'subscriptions' => User::where('role_id', 0)->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('last_name', 'like', $searchTerm);
            })->select(['id', 'first_name', 'last_name', 'email', 'phone'])->paginate(10)
        ]);
    }
}
