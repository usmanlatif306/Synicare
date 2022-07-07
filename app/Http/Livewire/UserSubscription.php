<?php

namespace App\Http\Livewire;

use App\Models\Subscription;
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
            'subscriptions' => auth()->user()->role_id == 1 ? Subscription::with(['user:id,first_name,last_name'])->paginate(10) : auth()->user()->subscriptions()->paginate(10)
        ]);
    }
}
