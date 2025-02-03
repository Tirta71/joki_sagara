<x-layouts.dashboard-layout>
    <h1>Dashboard Aset Tetap </h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-cente mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4 py-2">Kembali</a>
        <a href="{{ route('fixed_assets.create') }}" class="btn btn-primary px-4 py-2">Buat Aset Tetap Baru</a>
    </div>

    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tabel Aset Tetap
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fixedAssets as $fixedAsset)
                            <tr>
                                <td>{{ $fixedAsset->code }}</td>
                                <td>{{ $fixedAsset->name }}</td>
                         

                                <td>
                                    <a href="{{ route('fixed_assets.show', $fixedAsset->id) }}" class="btn btn-outline-primary btn-sm"> <i class="bi bi-eye"></i> </a>
                                    <a href="{{ route('fixed_assets.edit', $fixedAsset->id) }}"
                                        class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('fixed_assets.destroy', $fixedAsset->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this Fixed Asset?')"> <i class="bi bi-trash"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layouts.dashboard-layout>
