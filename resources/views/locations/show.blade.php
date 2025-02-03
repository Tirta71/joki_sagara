<x-layouts.dashboard-layout>
    <h1 class="mb-4">Detail Lokasi</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Informasi Lokasi</h4>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Code:</dt>
                <dd class="col-sm-9">{{ $location->code }}</dd>

                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{ $location->name }}</dd>

                <dt class="col-sm-3">Address:</dt>
                <dd class="col-sm-9">{{ $location->address }}</dd>
            </dl>
        </div>
    </div>

    <!-- Action buttons -->
    <div class="d-flex justify-content-start gap-3 mt-3">
        <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning px-4 py-2">Ubah</a>

        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger px-4 py-2" onclick="return confirm('Are you sure you want to delete this location?')">Hapus</button>
        </form>

        <a href="{{ route('locations.index') }}" class="btn btn-secondary px-4 py-2">Kembali</a>
    </div>
</x-layouts.dashboard-layout>
