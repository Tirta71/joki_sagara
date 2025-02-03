<x-layouts.dashboard-layout>
    <h1>Edit Location</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" class="form-control"
                value="{{ old('code', $location->code) }}" required>
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control"
                value="{{ old('name', $location->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control"
                value="{{ old('address', $location->address) }}" required>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Location</button>
        <a href="{{ route('locations.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</x-layouts.dashboard-layout>
