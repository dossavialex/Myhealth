<?php

namespace App\Livewire;

use App\Models\Repas;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowRepas extends Component
{
    public $repasLimite; // Declare the public property
    public $search = ''; // Declare the search term

    public function mount()
    {
        // Initialize $repasLimite when the component is mounted
        $this->loadRepasLimite();
    }

    public function updatedSearch()
    {
        // Reload the data whenever the search term is updated
        $this->loadRepasLimite();
    }

    public function loadRepasLimite()
    {
        // Perform the query and store the result in the public property
        $this->repasLimite = Repas::select('libelle_repas', 'created_at')
            ->where('created_at', 'like', '%' . $this->search . '%') // Filter by 'created_at' before grouping
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d'); // Group by date (YYYY-MM-DD)
            })
            ->map(function ($group) {
                return $group->count(); // Count records for each group
            });
    }

    public function render()
    {
        // Pass the $repasLimite property to the view
        return view('livewire.show-repas', [
            'repasLimite' => $this->repasLimite,
            'dates' => Repas::select('libelle_repas', 'created_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d'); // Group by date (YYYY-MM-DD)
            })
            ->map(function ($group) {
                return $group->count(); // Count records for each group
            })->unique(),

        ]);
    }
}
