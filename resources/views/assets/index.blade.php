<x-layouts.dashboard-layout>
    <h1>Asset Dashboard</h1>

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
    <a href="{{ route('assets-sagara.create') }}" class="btn btn-primary mb-5">Add New Asset</a>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Assets Table
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location Area</th>
                            <th>Custom Number</th>
                            <th>Non Depreciation</th>
                            <th>Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $asset)
                            <tr>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->location_area }}</td>
                                <td>{{ $asset->custom_number }}</td>
                                <td>
                                    @if ($asset->non_depreciation == 1)
                                        True
                                    @else
                                        False
                                    @endif
                                </td>
                                <td>{{ $asset->method }}</td>
                                <td>
                                    <a href="{{ route('assets-sagara.show', $asset->id) }}"
                                        class="btn btn-info">Show</a>
                                    <a href="{{ route('assets-sagara.edit', $asset->id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('assets-sagara.destroy', $asset->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this Asset?')">Delete</button>
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
