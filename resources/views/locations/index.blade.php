<x-layouts.dashboard-layout>
    <h1>Dashboard Lokasi</h1>

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
        <a href="{{ route('locations.create') }}" class="btn btn-primary px-4 py-2 mb-0">Buat Lokasi Baru</a>
    </div>
    

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tabel Lokasi
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $location->code }}</td>
                                <td>{{ $location->name }}</td>
                                <td>{{ $location->address }}</td>
                                <td>
                                    <!-- Show Button -->
                                    <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye"></i> 
                                    </a>
                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i> 
                                    </a>
                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this location?')">
                                            <i class="bi bi-trash"></i> 
                                        </button>
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
