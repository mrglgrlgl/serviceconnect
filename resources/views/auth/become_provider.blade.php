<form action="{{ route('requests.store') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <input type="hidden" name="status" value="pending">
    <button type="submit">Send Request</button>
</form>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
