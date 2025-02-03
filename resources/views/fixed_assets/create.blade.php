<x-layouts.dashboard-layout>
    <h1>Create New Fixed Asset</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('fixed_assets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" class="form-control" value="{{ old('code') }}" required>
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Fixed Asset</button>
        <a href="{{ route('fixed_assets.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</x-layouts.dashboard-layout>
