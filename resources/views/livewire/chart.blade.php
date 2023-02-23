

<div wire:ignore x-data="{
   
    selectedYear: @entangle('selectedYear'),
    thisYearOrders: @entangle('thisYearOrders'),
    init() {


    const newChart = new Chart(this.$refs.canvas, {
        type: 'bar',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: '# of Votes',
            data: this.thisYearOrders ,
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });


    Livewire.on('updateTheChart', () => {
        newChart.data.datasets[0].data = this.thisYearOrders;
        newChart.update();
    })

    }




}">
    <canvas x-ref="canvas" id="myChart"></canvas>

    {{ array_sum($thisYearOrders) }} <br/>
    {{ array_sum($lastYearOrders) }} 

    <br> <br>
   muri:  <p x-text="selectedYear"> </p>

    <select  wire:change="updateOrdersCount" wire:model="selectedYear"  id="available_year">
        @foreach ($available_years as $day)
            <option value="{{ $day }} ">{{ $day }}</option>
        @endforeach

    </select>


</div>

