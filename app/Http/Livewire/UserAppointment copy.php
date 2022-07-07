<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class UserAppointment extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        return view('livewire.user-appointment', [
            'appointments' => auth()->user()->role_id == 1 ? Appointment::with(['user:id,first_name,last_name,phone'])->where('consultant', 'like', $searchTerm)->latest()->paginate(10) : auth()->user()->appointments()->where(function ($query) use ($searchTerm) {
                $query->where('consultant', 'LIKE', $searchTerm);
            })->paginate(10)
        ]);
    }
}
