<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="text-lg font-semibold mb-2">Provider: <span class="text-gray-600">{{ $providerName }}</span></div>
    <div class="text-lg font-semibold mb-4">Category: <span class="text-gray-600">{{ $category }}</span></div>
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Rate Your Experience</h2>

    <form action="{{ route('submit.rating') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="channel_id" value="{{ $channel_id }}">
        <input type="hidden" name="rated_for_id" value="{{ $rated_for_id }}">

        @php
            $criteria = [];
            $highlightClass = '';

            if (Auth::user()->role == '2') {
                $criteria = ['Communication', 'Fairness', 'Respectfulness', 'Preparation', 'Responsiveness'];
                $highlightClass = 'bg-custom-light-blue text-white';
            } elseif (Auth::user()->role == '3') {
                $criteria = ['Quality of Service', 'Communication', 'Professionalism', 'Cleanliness and Tidiness', 'Value for Money'];
                $highlightClass = 'bg-custom-lightest-blue text-white';
            }
        @endphp

        @foreach($criteria as $criterion)
            <div class="space-y-2">
                <label class="block text-lg font-medium text-gray-700 text-center">{{ $criterion }}</label>
                <div class="flex flex-wrap justify-center space-x-2 pb-8">
                    @for ($i = 0; $i <= 10; $i++)
                        <input type="radio" name="rating_{{ strtolower(str_replace(' ', '_', $criterion)) }}" value="{{ $i }}" id="{{ strtolower(str_replace(' ', '_', $criterion)) }}-{{ $i }}" class="hidden" />
                        <label for="{{ strtolower(str_replace(' ', '_', $criterion)) }}-{{ $i }}" class="flex items-center justify-center w-10 h-10 mb-2 md:mb-0 border border-gray-300 rounded-full cursor-pointer hover:bg-gray-200 transition-colors duration-150" onclick="highlightSelected(this, '{{ $highlightClass }}')">
                            {{ $i }}
                        </label>
                    @endfor
                </div>
            </div>
        @endforeach

        <div class="space-y-2 pt-4">
            <label for="feedback" class="block text-lg font-medium text-gray-700">Additional Feedback (Optional)</label>
            <textarea name="feedback" id="feedback" rows="4" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Share your thoughts...">{{ old('feedback') }}</textarea>
        </div>

        <div class="flex justify-center pt-4">
            <button type="submit" class="px-6 py-2 {{ $highlightClass }} rounded-md hover:bg-opacity-75 focus:outline-none">Submit</button>
        </div>
    </form>
</div>

<script>
    function highlightSelected(label, highlightClass) {
        const group = label.parentElement.querySelectorAll('label');
        group.forEach(l => l.classList.remove('bg-custom-light-blue', 'bg-custom-lightest-blue', 'text-white'));
        label.classList.add(...highlightClass.split(' '));
    }
</script>
