<x-layouts.dashboard-layout>
    <h1>Depreciation Dashboard</h1>

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
    <a href="{{ route('dashboard') }}">Back</a>
    <a href="{{ route('depreciations.create') }}" class="btn btn-primary mb-5">Add New Depreciation</a>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Depreciation Table
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
                        @foreach ($depreciations as $depreciation)
                            <tr>
                                <td>{{ $depreciation->code }}</td>
                                <td>{{ $depreciation->name }}</td>
                                <td>
                                    <a href="{{ route('depreciations.show', $depreciation->id) }}"
                                        class="btn btn-info">Show</a>
                                    <a href="{{ route('depreciations.edit', $depreciation->id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('depreciations.destroy', $depreciation->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this Depreciation?')">Delete</button>
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
