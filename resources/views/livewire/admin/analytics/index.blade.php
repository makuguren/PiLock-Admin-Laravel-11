<x-slot:title>Analytics</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Analytics</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Analytics</li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Weekly Student RFID Taps</div>
                </div>
                <div wire:ignore id="barChart">
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Students Per Program</div>
                </div>
                <div wire:ignore id="donutChart">
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-3">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Events Per Month</div>
                </div>
                <div wire:ignore id="lineChart"></div>
            </div>

        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        var programs = @json($programs); // ["BSIT", "BSCS", "BLIS", "BSIS"]
        var programData = @json($programData); // [30, 40, 0, 50] (example)

        // Students Per Program (Donut Chart)
        var options = {
            chart: {
                type: 'donut',
                height: 300
            },
            series: programData,
            labels: programs,
        }
        var donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
        donutChart.render();

        // Weekly Student RFID Taps (Barchart)
        var options = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [{
                name: 'Students',
                data: @json($countRFIDData['data'])
            }],
            xaxis: {
                categories: @json($countRFIDData['labels'])
            }
        }
        var barChart = new ApexCharts(document.querySelector("#barChart"), options);
        barChart.render();

        // Count the Event Data
        var options = {
            series: [{
                name: "Events",
                data: @json($countEventData['data'])
            }],
            chart: {
                height: 300,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($countEventData['labels'])
            }
        };

        var lineChart = new ApexCharts(document.querySelector("#lineChart"), options);
        lineChart.render();
    </script>
</x-slot>
