<x-provider-profile-edit>
    <script src="{{ asset('js/addtextbox.js') }}"></script>
    <form action="{{ route('save-step1') }}" method="POST">
        @csrf
<x-provider-details/>     
    </form>   

</x-provider-profile-edit>