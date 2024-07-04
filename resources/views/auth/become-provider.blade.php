<x-app-layout>
    <form action="{{ route('requests.store') }}" method="POST">
        @csrf

        <div class="md:mt-3 md:px-12 md:py-12 bg-white shadow-md sm:rounded-lg md:w-3/6 flex mx-auto">
            <div class="flex flex-col md:w-10/12 mx-auto justify-center items-center space-y-6">
                <div class="text-2xl font-bold text-custom-light-blue">
                    {{ __("Become a Provider!") }}
                </div>
                
                <div>
                    {{ __("Select Service Category") }}
                </div>
                
                <div class="border-t my-4 w-full"></div>

                {{-- Service Jobs Selection --}}
                {{-- Change if may finalized jobs --}}
                <div class="w-full md:w-8/12 mx-auto">
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <div class="flex items-center">                      
                                {{-- First category --}}
                                <input id="category1" type="checkbox" class="checkbox-align rounded border-gray-300 shadow-sm focus:ring-custom-light-blue">
                                <label for="category1" class="ml-2 text-xl text-custom-light-blue font-medium">
                                    {{ __("Category 1") }}
                                </label>
                            </div>
                            <x-selection class="mt-2 rounded shadow-sm focus:ring-custom-light-blue">
                                <option value="">{{ __("Select an option") }}</option>
                                <!-- Add more options as needed -->
                            </x-selection>
                        </div>
                        
                        <div class="flex flex-col">
                            <div class="flex items-center">
                                <input id="category2" type="checkbox" class="checkbox-align rounded border-gray-300 shadow-sm focus:ring-custom-light-blue">
                                <label for="category2" class="ml-2 text-xl text-custom-light-blue font-medium">
                                    {{ __("Category 2") }}
                                </label>
                            </div>
                            <x-selection class="mt-2 rounded shadow-sm">
                                <option value="">{{ __("Select an option") }}</option>
                            </x-selection>
                        </div>
                    </div>
                </div>

                <!-- Hidden Inputs and Submit Button -->
                <div>
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="md:mt-4 md:px-12 bg-custom-light-blue  text-white font-bold py-2 rounded-lg">
                        {{ __("Next") }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout> 