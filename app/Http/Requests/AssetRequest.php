<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "location_area" => "required|uuid",
            "category" => "required|string",
            "account_fixed_asset" => "required|uuid",
            "description" => "required|string",
            "acquisition_date" => "required|date",
            "acquisition_cost" => "required|numeric",
            "non_depreciation" => "boolean",
            "method" => "required_if:non_depreciation,0|string",
            "usage_period" => "required_if:non_depreciation,0|integer",
            "usage_value_per_year" => "required_if:non_depreciation,0|numeric",
            "depreciation_account" => "required_if:non_depreciation,0|uuid",
            "accumulated_depreciation_account" => "required_if:non_depreciation,0|uuid",
        ];
    }
}
