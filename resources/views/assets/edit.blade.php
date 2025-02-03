<x-layouts.dashboard-layout>
    <h1>Edit Asset</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assets-sagara.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $asset->name) }}"
                required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <select id="location" name="location_area" class="form-control" required>
                <option value="">Select a Location</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}"
                        {{ old('location_area', $asset->location_area) == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
            @error('location_area')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control" required>
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category', $asset->category) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="fixed_asset">Account Fixed Asset</label>
            <select id="fixed_asset" name="account_fixed_asset" class="form-control" required>
                <option value="">Select a Fixed Asset</option>
                @foreach ($fixedAssets as $fixedAsset)
                    <option value="{{ $fixedAsset->id }}"
                        {{ old('account_fixed_asset', $asset->account_fixed_asset) == $fixedAsset->id ? 'selected' : '' }}>
                        {{ $fixedAsset->name }}
                    </option>
                @endforeach
            </select>
            @error('account_fixed_asset')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control"
                value="{{ old('description', $asset->description) }}" required>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="acquisition_date">Acquisition Date</label>
            <input type="date" id="acquisition_date" name="acquisition_date" class="form-control"
                value="{{ old('acquisition_date', $asset->acquisition_date) }}" required>
            @error('acquisition_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="acquisition_cost">Acquisition Cost</label>
            <input type="number" id="acquisition_cost" name="acquisition_cost" class="form-control"
                value="{{ old('acquisition_cost', $asset->acquisition_cost) }}" required>
            @error('acquisition_cost')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="non_depreciation">Non Depreciation</label>
            <input type="checkbox" id="non_depreciation" name="non_depreciation" value="1"
                {{ old('non_depreciation', $asset->non_depreciation) ? 'checked' : '' }}>
            <span class="form-check-label">Yes</span>
            @error('non_depreciation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="method">Method</label>
            <select id="method" name="method" class="form-control" required>
                <option value="">Select a Method</option>
                <option value="0" {{ old('method', $asset->method) === 'Straight Line' ? 'selected' : '' }}>False
                </option>
                <option value="1" {{ old('method', $asset->method) === 'Reducing Balance' ? 'selected' : '' }}>
                    True</option>
            </select>
            @error('method')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="usage_period">Usage Period</label>
            <input type="number" id="usage_period" name="usage_period" class="form-control"
                value="{{ old('usage_period', $asset->usage_period) }}" required>
            @error('usage_period')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="usage_value_per_year">Usage Value Per Year</label>
            <input type="number" step="0.01" id="usage_value_per_year" name="usage_value_per_year"
                class="form-control" value="{{ old('usage_value_per_year', $asset->usage_value_per_year) }}" required>
            @error('usage_value_per_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="depreciation">Depreciation Account</label>
            <select id="depreciation" name="depreciation_account" class="form-control" required>
                <option value="">Select a Depreciation</option>
                @foreach ($depreciations as $depreciation)
                    <option value="{{ $depreciation->id }}"
                        {{ old('depreciation_account', $asset->depreciation_account) == $depreciation->id ? 'selected' : '' }}>
                        {{ $depreciation->name }}
                    </option>
                @endforeach
            </select>
            @error('depreciation_account')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="accumulated_depreciation">Accumulation Depreciation Account</label>
            <select id="accumulated_depreciation" name="accumulated_depreciation_account" class="form-control"
                required>
                <option value="">Select an Accumulation Depreciation Account</option>
                @foreach ($accumulatedDepreciations as $accumulatedDepreciation)
                    <option value="{{ $accumulatedDepreciation->id }}"
                        {{ old('accumulated_depreciation_account', $asset->accumulated_depreciation_account) == $accumulatedDepreciation->id ? 'selected' : '' }}>
                        {{ $accumulatedDepreciation->name }}
                    </option>
                @endforeach
            </select>
            @error('accumulated_depreciation_account')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Asset</button>
        <a href="{{ route('assets-sagara.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</x-layouts.dashboard-layout>
