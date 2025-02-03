<x-layouts.dashboard-layout>
    <h1>Dashboard Riwayat Transaksi</h1>

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
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tabel Riwayat Transaksi
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Name</th>
                            <th>Depreciation Per Year</th>
                            <th>Depreciation Per Month</th>
                            <th>Value</th>
                            <th>Depreciation Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                            <tr>
                                <td>{{ $history->transaction_id }}</td>
                                <td>{{ $history->name }}</td>
                                <td>{{ $history->depreciation_per_year }}</td>
                                <td>{{ $history->depreciation_per_month }}</td>
                                <td>{{ $history->value }}</td>
                                <td>{{ $history->depreciation_date }}</td>
                                <td>
                                    <a href="{{ route('histories.show', $history->transaction_id) }}"
                                        class="btn btn-info">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layouts.dashboard-layout>
