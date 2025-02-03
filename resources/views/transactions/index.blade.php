<x-layouts.dashboard-layout>
    <h1>Dashboard Transaksi</h1>

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
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4 py-2">Kembali</a>
    </div>
 
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title" >
                    Tabel Transaksi
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Asset Number</th>
                            <th>Name</th>
                            <th>Acquisition Date</th>
                            <th>Acquisition Cost</th>
                            <th>Usage Period</th>
                            <th>Usage Value Per Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->asset->custom_number }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>{{ $transaction->acquisition_date }}</td>
                                <td>{{ $transaction->acquisition_cost }}</td>
                                <td>{{ $transaction->usage_period }}</td>
                                <td>{{ $transaction->usage_value_per_year }}</td>
                                <td>
                                    <a href="{{ route('transactions.show', $transaction->id) }}"
                                        class="btn btn-info">Show</a>
                                    <form action="{{ route('transactions.depreciate', $transaction->asset_id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info"
                                            onclick="return confirm('Are you sure you want to depreciate this transaction?')">Depreciate</button>
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
