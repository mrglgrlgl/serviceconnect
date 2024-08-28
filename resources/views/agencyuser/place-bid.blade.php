<x-agency-dashboard>
<div class="container">
    <h1>Place Your Bid</h1>
    
    <form action="{{ route('bids.store') }}" method="POST">
        @csrf
        <input type="hidden" name="service_request_id" value="{{ $serviceRequest->id }}">
        
        <div class="form-group">
            <label for="bid_amount">Bid Amount</label>
            <input type="number" name="bid_amount" id="bid_amount" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="bid_description">Bid Description</label>
            <textarea name="bid_description" id="bid_description" class="form-control" rows="3" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="agreed_to_terms">
                <input type="checkbox" name="agreed_to_terms" id="agreed_to_terms" required>
                I agree to the terms and conditions
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Bid</button>
    </form>
</div>
</x-agency-dashboard>
