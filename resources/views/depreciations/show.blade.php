<x-layouts.dashboard-layout>
    <h1>Depreciation Details</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Depreciation Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $depreciation->code }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $depreciation->name }}</h5>
        </div>
    </div>

    <a href="{{ route('depreciations.edit', $depreciation->id) }}" class="btn btn-warning mt-3">Edit</a>

    <form action="{{ route('depreciations.destroy', $depreciation->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('Are you sure you want to delete this Depreciation?')">Delete</button>
    </form>

    <a href="{{ route('depreciations.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</x-layouts.dashboard-layout>
