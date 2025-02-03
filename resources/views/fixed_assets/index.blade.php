<x-layouts.dashboard-layout>
    <h1>Fixed Asset Dashboard</h1>

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
    <a href="{{ route('fixed_assets.create') }}" class="btn btn-primary mb-5">Add New Fixed Asset</a>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Fixed Asset Table
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
                                    <a href="{{ route('fixed_assets.show', $fixedAsset->id) }}"
                                        class="btn btn-info">Show</a>
                                    <a href="{{ route('fixed_assets.edit', $fixedAsset->id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('fixed_assets.destroy', $fixedAsset->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this Fixed Asset?')">Delete</button>
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
