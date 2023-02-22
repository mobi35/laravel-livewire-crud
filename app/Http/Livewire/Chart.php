<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Chart extends Component
{

    public $chartData = [];

    public function addSomething()
    {
        $this->chartData = User::selectRaw('month(created_at) as month')
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->values()->toArray();

    }

    public function render()
    {
        $this->chartData = User::selectRaw('month(email_verified_at) as month')
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->values()->toArray();

        return view('livewire.chart');
    }
}
