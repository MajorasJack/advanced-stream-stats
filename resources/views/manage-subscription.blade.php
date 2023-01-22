<h3>Your current subscription is: {{ $currentSubscriptionModel->name }}</h3>

<form method="post" action="{{ route('subscription.destroy') }}">
    {{ @csrf_field() }}
    <input type="hidden" name="plan" value="{{ $currentSubscription->id }}">
    <button type="submit" class="btn btn-outline-secondary mb-3">Cancel Subscription</button>
</form>
