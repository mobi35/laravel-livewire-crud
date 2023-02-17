<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Search extends Component
{
    public $search;
    public $searchResults;

    public function render()
    {

        $response = Http::get('https://itunes.apple.com/search/?term='. $this->search . '&limit=10');
        $this->searchResults = $response->json()['results'];
        return view('livewire.search');
    }
}
