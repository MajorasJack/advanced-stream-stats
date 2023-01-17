@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Subs</th>
                                <th scope="col">Last Stream Views</th>
                                <th scope="col">7 Day View Average</th>
                                <th scope="col">30 Day View Average</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ rand(1, 1000) }}</th>
                                <td>{{ rand(1, 100) }}</td>
                                <td>{{ rand(100, 500) }}</td>
                                <td>{{ rand(500, 1000) }}</td>
                            </tr>
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
