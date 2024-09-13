@extends('layouts.agency-dashboard')

@section('content')
    <div class="mt-6 px-6 py-8 bg-white shadow-md sm:rounded-lg w-full max-w-xl mx-auto mb-4 font-poppins">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl text-custom-header mb-4">Place Your Bid</h1>

            <form action="{{ route('bids.store') }}" method="POST" class="max-w-xl mx-auto">
                @csrf
                <input type="hidden" name="service_request_id" value="{{ $serviceRequest->id }}">

                <!-- Bid Amount -->
                <div class="mt-4">
                    <x-input-label for="bid_amount">
                        Bid Amount <span class="text-red-500">*</span>
                    </x-input-label>
                    <x-text-input id="bid_amount" name="bid_amount"
                        class="block mt-1 w-full px-3 py-2 border-gray-300 rounded-md" type="number" required />
                    <x-input-error :messages="$errors->get('bid_amount')" class="mt-2" />
                </div>

                <!-- Bid Description -->
                <div class="mt-4">
                    <x-input-label for="bid_description">
                        Work Plan <span class="text-red-500">*</span>
                    </x-input-label>
                    <textarea name="bid_description" id="bid_description"
                        class="border block mt-1 w-full px-3 py-2 border-gray-300 rounded-md" rows="3" required></textarea>
                    <x-input-error :messages="$errors->get('bid_description')" class="mt-2" />
                </div>



                <!-- Terms and Conditions -->
                <div class="block mt-4">
                    <label for="agreed_to_terms" class="flex items-start">
                        <input id="agreed_to_terms" type="checkbox"
                            class="mt-1 checkbox-align rounded border-gray-300 text-custom-light-blue shadow-sm focus:ring-custom-light-blue"
                            name="agreed_to_terms" required>
                        <span class="ms-2 text-sm text-custom-header">
                            {{ __('I agree to the terms and conditions') }}
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex items-center justify-center mt-4">
                    <x-primary-button class="h-12 px-12 justify-center text-xl border-transparent text-white">
                        {{ __('Submit Bid') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
