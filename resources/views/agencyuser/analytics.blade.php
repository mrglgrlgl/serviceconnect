@extends('layouts.agency-dashboard')

@section('content')

<div class="bg-background">
    

{{--
    <!-- Filter Section -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <label for="month" class="mr-2">Month</label>
            <select id="month" class="p-2 border rounded">
                <option value="">Select Month</option>
                @foreach(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'] as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="year" class="mr-2">Year</label>
            <select id="year" class="p-2 border rounded">
                <option value="">Select Year</option>
                @for($i = date('Y'); $i >= 2010; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button id="applyFilter" class="p-2 bg-primary text-white rounded">Apply Filter</button>
    </div>
--}}


<h2 class="text-2xl font-semibold">Dashboard</h2>

<div class="flex justify-center">
    <div class="border-t my-2 w-full text-center border-custom-cat-border"></div>
</div>

<div class="bg-background">
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Row 1 -->
    <div class="col-span-1">
        <!-- Performance Chart (line graph) -->
        <div class="col-span-2 bg-white p-4 rounded-lg shadow w-full h-full">
            <h2 class="text-xl font-semibold text-primary">Performance</h2>
            <div class="mt-4">
                <canvas id="performanceChart"></canvas>
            </div>
            <p class="mt-2 text-muted">{{ $completedServices }} Services Completed</p>
        </div>
    </div>


        <!-- Customer Satisfaction Chart (horizontal bar graph) -->
        <div class="col-span-2 bg-white p-4 rounded-lg shadow w-full h-auto">
            <h2 class="text-lg font-semibold text-primary">Customer Satisfaction</h2>
            <div class="mt-4">
                <canvas id="satisfactionChart"></canvas>
            </div>
            <p class="mt-2 text-muted">{{ $completedServices }} Ratings</p>
        </div>
        
                <!-- Most Availed Services Pie Chart -->
        <div class="bg-white p-4 rounded-lg shadow w-full">
            <h2 class="text-xl font-semibold text-primary">Service Categories Availed</h2>
            <div class="mt-4">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
        
        
    </div>

    <!-- Second Row: Completion Rate + Most Loyal Seeker in one row -->
    <div class="flex flex-col md:flex-row mt-4 gap-4">
        <!-- Completion Rate Card -->
        <div class="bg-white p-4 rounded-lg shadow w-full flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-primary">Completion Rate</h2>
                <div class="mt-2">
                    <p class="text-xl font-bold">{{ number_format($completionRate, 2) }}%</p>
                </div>
            </div>
            <div class="text-right">
                <p class="mt-2 text-muted">Completed: {{ $completedServices }} / {{ $totalServices }} Total</p>
            </div>
        </div>

        <!-- Most Loyal Seeker Card -->
        <div class="bg-white p-4 rounded-lg shadow w-full flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-primary">Most Loyal Seeker</h2>
                <div class="mt-2">
                    <p class="text-xl font-bold">{{ $mostLoyalSeeker ? $mostLoyalSeeker->name : 'N/A' }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="mt-2 text-muted">Services Availed: {{ $mostLoyalSeeker ? $mostLoyalSeeker->completed_services : '0' }} / {{ $completedServices }}</p>
            </div>
        </div>
    </div>

<!-- Third Row: Charts -->
<div class="grid grid-cols-1 md:grid-cols-1 mt-4 gap-4 h-56">

<!-- Frequently Used Employees Horizontal Bar Chart -->
<div class="bg-white p-4 rounded-lg shadow w-full h-56">
    <h2 class="text-xl font-semibold text-primary">Top 10 Frequently Used Employees</h2>
    <div class="mt-4">
        <canvas id="employeesChart" class="w-full h-full"></canvas> <!-- Use h-full to fill parent height -->
    </div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Performance Chart (line graph)
    const performanceCtx = document.getElementById('performanceChart').getContext('2d');
    new Chart(performanceCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC']) !!},
            datasets: [{
                label: '# of Services Completed',
                data: {!! json_encode(array_values($performanceData['data'])) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                tension: 0.1 // Makes the line smooth
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        }
                    }
                }
            }
        }
    });

    // Customer Satisfaction Chart (horizontal bar graph)
    const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
    new Chart(satisfactionCtx, {
        type: 'bar',
        data: {
            labels: ['Communication', 'Quality of Service', 'Professionalism', 'Cleanliness & Tidiness', 'Value for Money'],
            datasets: [{
                label: 'Ratings',
                data: [
                    {{ $customerSatisfactionData->communication }},
                    {{ $customerSatisfactionData->quality_of_service }},
                    {{ $customerSatisfactionData->professionalism }},
                    {{ $customerSatisfactionData->cleanliness_tidiness }},
                    {{ $customerSatisfactionData->value_for_money }}
                ],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Most Availed Services Chart (pie chart)
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($serviceCategoryNames) !!},
            datasets: [{
                label: 'Number of Services Completed',
                data: {!! json_encode($serviceCategoryCounts) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        }
    });


// Frequently Used Employees Chart (horizontal bar chart)
const employeesCtx = document.getElementById('employeesChart').getContext('2d');
new Chart(employeesCtx, {
    type: 'bar',  // Keep it as 'bar'
    data: {
        labels: {!! json_encode($frequentlyUsedEmployees->pluck('name')->toArray()) !!},
        datasets: [{
            label: 'Number of Services by Employees',
            data: {!! json_encode($frequentlyUsedEmployees->pluck('service_count')->toArray()) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allows height to be controlled by CSS
        indexAxis: 'y', // Change the index axis to horizontal
        scales: {
            x: {
                beginAtZero: true // Ensures the X-axis starts at 0
            },
            y: {
                beginAtZero: true // Ensures the Y-axis starts at 0
            }
        }
    }
});

    
    </script>
@endsection
