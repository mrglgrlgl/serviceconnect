{{-- Individual service request in the service request page --}}
<div class="servicerequestindividual p-4 bg-white shadow-sm rounded-lg">
    <div class="flex justify-between items-start mb-4">
        <div id="category" class="flex flex-col">
            <span class="font-bold text-lg">Category</span>
            <div id="status" class="mt-2 text-sm text-gray-600">
                status
            </div>
        </div>

        <div id="date" class="text-sm text-gray-600">
            Placeholder date
        </div>
    </div>

    <div class="mt-4 text-center">
        <div class="font-semibold text-xl mb-2">
            Title
        </div>

        <div id="requestdesc" class="mb-4">
            Desc
        </div>

        <div id="requestimg" class="mb-4">
            {{-- Request image here --}}
        </div>

        <div class="flex flex-col md:flex-row justify-center items-center md:space-x-2">
            <x-outline-button class="flex-1 md:flex-none w-full md:w-auto mb-2 md:mb-0">
                Edit
            </x-outline-button>
            <x-danger-button class="flex-1 md:flex-none w-full md:w-auto">
                Delete
            </x-danger-button>
        </div>
    </div>
</div>