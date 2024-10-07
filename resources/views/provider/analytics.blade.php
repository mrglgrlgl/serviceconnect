<x-dashboard>
    <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 pt-8 mx-auto overflow-hidden bg-gray-100">
        <!-- Navigation Links -->
        <div class="flex justify-center text-center w-full">
            <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                <x-nav-link href="{{ route('provider.dashboard') }}" :active="request()->routeIs('provider.dashboard')">
                    {{ __('Open Requests') }}
                </x-nav-link>
                <x-nav-link href="{{ route('provider.myrequests') }}" :active="request()->routeIs('provider.myrequests')">
                    {{ __('My Requests') }}
                </x-nav-link>
                <x-nav-link href="{{ route('provider.analytics') }}" :active="request()->routeIs('provider.analytics')">
                    {{ __('Analytics') }}
                </x-nav-link>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center border-custom-cat-border"></div>
    </div>

    <div class="flex justify-center">
        <div class="w-4/5">
            @if ($completedServices <= 5)
                <!-- Show error message banner -->
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">Complete service requests to fill up analytics data!</span>
                </div>
            @else
                <div class="p-6 bg-background">
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
                        </div>

                        <!-- Most Loyal Seeker (slightly bigger) -->
                        <div class="bg-white p-4 rounded-lg shadow md:col-span-3">
                            <h3 class="text-lg font-semibold text-primary">Most Loyal Seeker</h3>
                            <p class="text-2xl font-bold">{{ $mostLoyalSeeker->name }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if ($completedServices > 5)
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
                labels: {!! json_encode(['Communication', 'Professionalism', 'Quality of Service', 'Cleanliness', 'Value for Money']) !!},
                datasets: [{
                    label: 'Satisfaction (%)',
                    data: [
                        {{ $customerSatisfactionData->communication }},
                        {{ $customerSatisfactionData->professionalism }},
                        {{ $customerSatisfactionData->quality_of_service }},
                        {{ $customerSatisfactionData->cleanliness_tidiness }},
                        {{ $customerSatisfactionData->value_for_money }}
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
    @endif
</x-dashboard>
