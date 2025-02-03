<x-layouts.dashboard-layout>
    <h1>Category Details</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Category Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $category->code }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $category->name }}</h5>
        </div>
    </div>

    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mt-3">Edit</a>

    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</x-layouts.dashboard-layout>
