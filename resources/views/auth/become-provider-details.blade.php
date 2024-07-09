<x-provider-profile-edit>
    <script src="{{ asset('js/addtextbox.js') }}"></script>
    <form action="{{ route('requests.store') }}" method="POST">
        @csrf

<x-provider-details/>        

</x-provider-profile-edit>