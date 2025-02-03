<x-layouts.dashboard-layout>
    <h1>Welcome to the Dashboard</h1>

    <p>You are logged in!</p>
    <div>
        <a href="{{ route('locations.index') }}" class="btn btn-primary">View Locations</a>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">View Categories</a>
        <a href="{{ route('fixed_assets.index') }}" class="btn btn-primary">View Fixed Asset</a>
        <a href="{{ route('accumulated_depreciations.index') }}" class="btn btn-primary">View Accumulated
            Depreciation</a>
        <a href="{{ route('depreciations.index') }}" class="btn btn-primary">View Depreciation</a>
        <a href="{{ route('assets-sagara.index') }}" class="btn btn-primary">View Asset</a>
    </div>

   
</x-layouts.dashboard-layout>
