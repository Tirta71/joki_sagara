<x-layouts.dashboard-layout>
    <h1>Fixed Asset Details</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Fixed Asset Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $fixedAsset->code }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $fixedAsset->name }}</h5>
        </div>
    </div>

    <a href="{{ route('fixed_assets.edit', $fixedAsset->id) }}" class="btn btn-warning mt-3">Edit</a>

    <form action="{{ route('fixed_assets.destroy', $fixedAsset->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('Are you sure you want to delete this Fixed Asset?')">Delete</button>
    </form>

    <a href="{{ route('fixed_assets.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</x-layouts.dashboard-layout>
