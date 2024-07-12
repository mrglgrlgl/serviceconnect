<div x-data="{ isOpen: false }" @open-modal.window="if ($event.detail.id === 'serviceRequestModal') isOpen = true">

    <div x-show="isOpen" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Service Request Form
                            </h3>

                            <div class="mt-2">
                                {{-- For for service request --}}
                                <form method="POST" action="{{ route('service.request') }}" class="space-y-4">
                                    @csrf

                                    <!-- Category -->
                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                                        <x-selection type="text" name="category" id="category" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                                    </div>

                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700">{{ __('Choose From Service Request List') }}</label>
                                        <x-selection type="text" name="category" id="category" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                                    </div>

                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700">{{ __('Service Request Title') }}</label>
                                        <input type="text" name="category" id="category" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <!-- Description -->
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                        <input type="text" name="description" id="description" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                    </div>
                                    <!-- Buttons -->
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" @click="isOpen = false" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Cancel
                                        </button>
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>