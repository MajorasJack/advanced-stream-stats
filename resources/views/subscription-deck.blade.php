<h3>Interested in seeing more stats?</h3>
<small>Subscribe below!</small>

<div class="container mb-5 mt-3">
    <div class="pricing card-deck flex-column flex-md-row mb-3 d-flex">
        @foreach($subscriptions as $subscription)
            <div class="card card-pricing text-center px-3 mb-4">
                <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">{{ $subscription->name }}</span>
                <div class="bg-transparent card-header pt-4 border-0">
                    <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="15"><span class="price">{{ $subscription->price }}</span><span class="h6 text-muted ml-2">/ per {{ $subscription->yearly ? 'year' : 'month' }}</span></h1>
                </div>
                <div class="card-body pt-0">
                    <ul class="list-unstyled mb-4">
                        <li>Extended Stats</li>
                        <li>
                            @if(str_contains($subscription->name, 'Pro'))
                                Detailed Reporting
                            @else
                                <strike>Detailed Reporting</strike>
                            @endif
                        </li>
                    </ul>
                    <form method="post" action="{{ route('subscription.store') }}">
                        {{ @csrf_field() }}
                        <input type="hidden" name="plan" value="{{ $subscription->external_subscription_id }}">
                        <button type="submit" class="btn btn-outline-secondary mb-3">Subscribe Now</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
