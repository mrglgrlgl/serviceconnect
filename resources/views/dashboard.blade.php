<x-dashboard>
    <x-slot name="dashboardbar">
        <div class="relative w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto pt-4 overflow-hidden">
            <div class="font-semibold text-3xl md:pb-4">{{ __('Service Requests') }}</div>
            <div class="flex justify-center text-center w-full">
                <div class="flex items-center space-x-4 sm:space-x-12 md:space-x-20 lg:space-x-28 xl:space-x-28 2xl:space-x-28 overflow-x-auto md:overflow-hidden">
                    <x-category-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="inline-block">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Service Requests') }}
                        </div>
                    </x-category-link>
                    <x-category-link class="inline-block">
                        <div class="flex flex-col items-center text-base md:text-xl">
                            {{ __('Analytics') }}
                        </div>
                    </x-category-link>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="border-t my-2 w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 text-center"></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full md:w-10/12 lg:w-10/12 xl:w-8/12 2xl:w-6/12 mx-auto">
 asfasfaf
 
                    </div>

        </div>

</x-dashboard>