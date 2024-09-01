@extends('layouts.app')

@section('content')
    {{-- <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 pt-8 mx-auto overflow-hidden bg-gray-100">
        <!-- Navigation Links -->
        <div class="flex justify-center text-center w-full">
            <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('My Requests') }}
                </x-nav-link>
                <x-nav-link href="{{ route('analytics') }}" :active="request()->routeIs('analytics')">
                    {{ __('Analytics') }}
                </x-nav-link>
            </div>
        </div>
    </div> --}}

    <div class="flex justify-center">
        <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center border-custom-cat-border"></div>
    </div>

    <div class="flex justify-center">
        <div class="w-4/5">
            <div class="p-6 bg-background">
                {{-- <header class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <label class="mr-2 text-muted">Timeframe:</label>
                        <select class="border border-muted rounded p-1">
                            <option>All-time</option>
                        </select>
                        <label class="mx-2 text-muted">Services:</label>
                        <select class="border border-muted rounded p-1">
                            <option>All</option>
                        </select>
                    </div>
                </header> --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Performance Chart -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-primary">Performance</h2>
                        <div class="mt-4">
                            <canvas id="performanceChart"></canvas>
                        </div>
                        <p class="mt-2 text-muted">{{ $completedServices }} Services Completed</p>
                    </div>

                    <!-- Customer Satisfaction Chart -->
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-primary">Customer Satisfaction</h2>
                        <div class="mt-4">
                            <canvas id="satisfactionChart"></canvas>
                        </div>
                        <p class="mt-2 text-muted">{{ $completedServices }} Ratings</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mt-4">
                    <!-- Completion Rate -->
                    <div class="bg-white p-4 rounded-lg shadow md:col-span-1">
                        <h3 class="text-lg font-semibold text-primary">Completion Rate</h3>
                        <p class="text-2xl font-bold">{{ number_format($completionRate, 2) }}%</p>
                        <p class="text-muted">{{ $completedServices }}</p>
                    </div>

                    <!-- Most Availed Service -->
                    <div class="bg-white p-4 rounded-lg shadow md:col-span-1">
                        <h3 class="text-lg font-semibold text-primary">Most Availed Service</h3>
                        <p class="text-2xl font-bold">{{ $mostAvailedService->category }}</p>
                        <p class="text-muted">{{ $mostAvailedService->completed_services }}</p>
                    </div>

                    <!-- Most Loyal Provider (slightly bigger) -->
                    <div class="bg-white p-4 rounded-lg shadow md:col-span-3">
                        <h3 class="text-lg font-semibold text-primary">Most Availed Provider</h3>
                        <p class="text-2xl font-bold">{{ $mostLoyalProvider->name }}</p>
                        <p class="text-muted">{{ $mostLoyalProvider->completed_services }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($performanceData['data'])) !!},
                datasets: [{
                    label: '# of Services',
                    data: {!! json_encode(array_values($performanceData['data'])) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Customer Satisfaction Chart
        const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
        new Chart(satisfactionCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(['Communication', 'Respectfulness', 'Preparation', 'Responsiveness', 'Fairness']) !!},
                datasets: [{
                    label: 'Satisfaction (%)',
                    data: [
                        {{ $customerSatisfactionData->communication }},
                        {{ $customerSatisfactionData->respectfulness }},
                        {{ $customerSatisfactionData->preparation }},
                        {{ $customerSatisfactionData->responsiveness }},
                        {{ $customerSatisfactionData->fairness }}
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // This makes the bars horizontal
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
</x-dashboard>