<x-layouts.dashboard-layout>
    <h1>Ubah Penyusutan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('depreciations.update', $depreciation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" class="form-control"
                value="{{ old('code', $depreciation->code) }}" required>
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control"
                value="{{ old('name', $depreciation->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Penyusutan</button>
        <a href="{{ route('depreciations.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</x-layouts.dashboard-layout>
