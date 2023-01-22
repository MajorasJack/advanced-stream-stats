@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Subs</th>
            <th scope="col">Last Stream Views</th>
            <th scope="col">7 Day View Average</th>
            <th scope="col">30 Day View Average</th>
            @if($currentSubscriptionModel)
                <th scope="col">Average Stream Duration</th>
                <th scope="col">Weekly Earnings</th>
                <th scope="col">Monthly Earnings</th>
            @endif
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{ rand(1, 1000) }}</th>
            <td>{{ rand(1, 100) }}</td>
            <td>{{ rand(100, 500) }}</td>
            <td>{{ rand(500, 1000) }}</td>
            @if($currentSubscriptionModel)
                <td>{{ rand(1, 100) }}</td>
                <td>${{ rand(100, 500) }}</td>
                <td>${{ rand(500, 1000) }}</td>
            @endif
        </tr>
        </tbody>
    </table>

    @if($currentSubscriptionModel)
        @include('manage-subscription')
    @else
        @include('subscription-deck')
    @endif
</div>
@endsection
