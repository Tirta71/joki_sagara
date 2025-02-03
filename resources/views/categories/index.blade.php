<x-layouts.dashboard-layout>
    <h1>Categories Dashboard</h1>

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
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-5">Add New Category</a>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Categories Table
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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->code }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}"
                                        class="btn btn-info">Show</a>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
