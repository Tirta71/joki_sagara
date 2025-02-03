<x-layouts.dashboard-layout>
    <h1>Accumulated Depreciation Details</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Accumulated Depreciation Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $accumulatedDepreciation->code }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $accumulatedDepreciation->name }}</h5>
        </div>
    </div>

    <a href="{{ route('accumulated_depreciations.edit', $accumulatedDepreciation->id) }}"
        class="btn btn-warning mt-3">Edit</a>

    <form action="{{ route('accumulated_depreciations.destroy', $accumulatedDepreciation->id) }}" method="POST"
        style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('Are you sure you want to delete this Accumulated Depreciation?')">Delete</button>
    </form>

    <a href="{{ route('accumulated_depreciations.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</x-layouts.dashboard-layout>
