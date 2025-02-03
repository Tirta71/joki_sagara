<x-layouts.dashboard-layout>
    <h1>Detail Aset</h1>

    <!-- Display status messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Informasi Aset
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $asset->name }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Location Area: {{ $asset->location_area }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Category: {{ $asset->category }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Custom Number: {{ $asset->custom_number }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Account Fixed Asset: {{ $asset->account_fixed_asset }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Description: {{ $asset->description }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Accuisition Date: {{ $asset->accuisition_date }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Accuisition Cost: {{ $asset->accuisition_cost }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Non Depreciation: {{ $asset->non_depreciation }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Method: {{ $asset->method }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Usage Period: {{ $asset->usage_period }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Usage Value per Year: {{ $asset->usage_value_per_year }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Depreciation Account: {{ $asset->depreciation_account }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Accumulation Depreciation Account: {{ $asset->accumulation_depreciation_account }}
            </h5>
        </div>
    </div>

    <div class="d-flex justify-content-start gap-3 ">
        <a href="{{ route('assets-sagara.edit', $asset->id) }}" class="btn btn-warning px-4 py-2">Ubah</a>

        <form action="{{ route('assets-sagara.destroy', $asset->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger px-4 py-2"
                onclick="return confirm('Are you sure you want to delete this Asset?')">Hapus</button>
        </form>

        <a href="{{ route('assets-sagara.index') }}" class="btn btn-secondary px-4 py-2">Kembali</a>
    </div>
</x-layouts.dashboard-layout>
