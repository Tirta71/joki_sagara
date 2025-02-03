<x-layouts.dashboard-layout>
    <h1>Location Details</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Location Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $location->code }}</h5>
            <h5 class="card-title">Name: {{ $location->name }}</h5>
            <p class="card-text">Address: {{ $location->address }}</p>
        </div>
    </div>

    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning mt-3">Edit</a>

    <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
    </form>

    <a href="{{ route('locations.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</x-layouts.dashboard-layout>
