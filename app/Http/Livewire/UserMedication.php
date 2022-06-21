<?php

namespace App\Http\Livewire;

use App\Models\Allergy;
use App\Models\Medication;
use Livewire\Component;
use Livewire\WithPagination;

class UserMedication extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        return view('livewire.user-medication', [
            'allergies' => auth()->user()->role_id == 1 ? Allergy::where('allergies', 'like', $searchTerm)->latest()->paginate(10) : auth()->user()->allergies()->where(function ($query) use ($searchTerm) {
                $query->where('allergies', 'LIKE', $searchTerm);
            })->paginate(10)
        ]);
        // return view('livewire.user-medication', [
        //     'medications' => auth()->user()->role_id == 1 ? Medication::where('medication', 'like', $searchTerm)->orWhere('doze', 'like', $searchTerm)->orWhere('allergies', 'like', $searchTerm)->orWhere('frequency', 'like', $searchTerm)->orWhere('prescriber', 'like', $searchTerm)->latest()->paginate(10) : auth()->user()->medications()->where(function ($query) use ($searchTerm) {
        //         $query->where('medication', 'LIKE', $searchTerm)
        //             ->orWhere('doze', 'LIKE', $searchTerm)
        //             ->orWhere('allergies', 'LIKE', $searchTerm)
        //             ->orWhere('prescriber', 'LIKE', $searchTerm)
        //             ->orWhere('frequency', 'LIKE', $searchTerm);
        //     })->paginate(10)
        // ]);
    }
}
