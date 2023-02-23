<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Chart extends Component
{

    public $chartData = [];

    public $thisYearOrders = 0;
    public $lastYearOrders = 0;

    public $selectedYear;

    public function mount()
    {
        $this->selectedYear = date('Y');
    }

    
    public function updateOrdersCount()
    {
        $this->thisYearOrders = User::getYearOrders($this->selectedYear)->groupByMonth();
        $this->lastYearOrders = User::getYearOrders($this->selectedYear- 1)->groupByMonth();
        $this->emit('updateTheChart');
    }


    public function render()
    {
        $availableYears = [ date('Y') ,  date('Y') - 1, date('Y') - 2 , date('Y') - 3, 2013];

        $this->thisYearOrders = User::getYearOrders($this->selectedYear)->groupByMonth();
        $this->lastYearOrders = User::getYearOrders($this->selectedYear- 1)->groupByMonth();

        $this->chartData = User::groupByMonth();

        return view('livewire.chart', 
        [
            'available_years' => $availableYears
        ]);
    }
}
