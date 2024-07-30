<x-dashboard>
    <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 pt-8 mx-auto overflow-hidden bg-gray-100">
        <div class="flex justify-center text-center w-full ">
            <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                <x-category-link class="inline-block text-custom-dark-text hover:text-custom-lightest-blue" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <div class="flex flex-col items-center text-base md:text-xl font-open-sans">
                        {{ __('My Service Requests') }}
                    </div>
                </x-category-link>
                <x-category-link class="inline-block text-custom-dark-text hover:text-custom-lightest-blue" :href="route('analytics')" :active="request()->routeIs('analytics')">
                    <div class="flex flex-col items-center text-base md:text-xl font-open-sans">
                        {{ __('Analytics') }}
                    </div>
                </x-category-link>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center border-custom-cat-border"></div>
    </div>

    
<div class="flex justify-center">
    <div class="w-4/5">
    <div class="p-6 bg-background">
        <header class="flex justify-between items-center mb-4">
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
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Performance Chart -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-primary">Performance</h2>
                <div class="mt-4">
                    <canvas id="performanceChart"></canvas>
                </div>
                <p class="mt-2 text-muted">231 Services Completed</p>
            </div>

            <!-- Customer Satisfaction Chart -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-primary">Customer Satisfaction</h2>
                <div class="mt-4">
                    <canvas id="satisfactionChart"></canvas>
                </div>
                <p class="mt-2 text-muted">231 Ratings</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <!-- Cancellation Rate -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-primary">Cancellation Rate</h3>
                <p class="text-2xl font-bold">6%</p>
                <p class="text-muted">11</p>
            </div>

            <!-- Completion Rate -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-primary">Completion Rate</h3>
                <p class="text-2xl font-bold">94%</p>
                <p class="text-muted">231</p>
            </div>

            <!-- Most Availed Service -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-primary">Most Availed Service</h3>
                <p class="text-2xl font-bold">Cleaning</p>
                <p class="text-muted">105</p>
            </div>
        </div>

        <!-- Most Loyal Seeker -->
        <div class="bg-white p-4 rounded-lg shadow mt-4">
            <h3 class="text-lg font-semibold text-primary">Most Loyal Seeker</h3>
            <p class="text-2xl font-bold">dela Cruz, Joshua.</p>
            <p class="text-muted">48</p>
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
                labels: {!! json_encode($performanceData['labels']) !!},
                datasets: [{
                    label: '# of Services',
                    data: {!! json_encode($performanceData['data']) !!},
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
            type: 'bar', // Changed from 'horizontalBar' to 'bar'
            data: {
                labels: {!! json_encode($customerSatisfactionData['labels']) !!},
                datasets: [{
                    label: 'Satisfaction (%)',
                    data: {!! json_encode($customerSatisfactionData['data']) !!},
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
