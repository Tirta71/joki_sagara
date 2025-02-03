<x-layouts.dashboard-layout>
    <h1>Transaction Detail</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Transaction Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $transaction->asset_id }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $transaction->name }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Date: {{ $transaction->acquisition_date }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Cost: {{ $transaction->acquisition_cost }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Usage Value Per Year: {{ $transaction->usage_value_per_year }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Usage Period: {{ $transaction->usage_period }}</h5>
        </div>
    </div>

    <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</x-layouts.dashboard-layout>
