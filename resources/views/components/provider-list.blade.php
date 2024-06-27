<!-- x-provider-list -->
<div class="block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium focus:outline-none focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out">
    <div class="flex items-center">
        <div>
            <img class="h-24 w-24 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
        </div>
        <div class="ml-4 flex-1">
        <div class="flex justify-between items-center">
                <div class="font-medium">{{ 'Provider name' }}</div>
                <div>{{ '16 hires' }}</div>
            </div>
            <div>{{ 'Ratings:'}}</div>
            <div class="w-80">{{ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque id leo ac eleifend. Nulla sed leo maximus, tempor nisl vitae, interdum diam. Nullam varius dui nibh, sed porta augue pharetra quis. Proin vulputate velit ac purus congue venenatis.'}}</div>

            <div class="flex justify-end items-center mt-2">
                <x-primary-button class="text-sm h-8 w-36 rounded-1 bg-transparent border-2 border-custom-dark-blue text-custom-dark-blue hover:border-transparent hover:text-white" :href="route('register')">
                    {{ __('View Profile') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</div>