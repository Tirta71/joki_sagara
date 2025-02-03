<x-layouts.dashboard-layout>
    <h1>Detail Informasi</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Informasi Kategori
        </div>
        <div class="card-body">
            <h5 class="card-title">Code: {{ $category->code }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $category->name }}</h5>
        </div>
    </div>

    <div class="d-flex justify-content-start gap-3 ">
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning px-4 py-2">Ubah</a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger px-4 py-2"
                onclick="return confirm('Are you sure you want to delete this category?')">Hapus</button>
        </form>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4 py-2 ">Kembali</a>
    </div>
</x-layouts.dashboard-layout>
