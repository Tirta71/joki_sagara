<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepreciationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $adminUuid = User::first()->id;

    DB::table('depreciations')->insert([
      [
        'id' => Str::uuid()->toString(),
        'code' => '6-60500.01',
        'name' => 'Penyusutan - Bangunan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '6-60500.02',
        'name' => 'Penyusutan - Building Improvements',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '6-60500.03',
        'name' => 'Penyusutan - Kendaraan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '6-60500.04',
        'name' => 'Penyusutan - Mesin & Peralatan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '6-60500.05',
        'name' => 'Penyusutan - Peralatan Kantor',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '6-60500.06',
        'name' => 'Penyusutan - Aset Sewa Guna Usaha',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
    ]);
  }
}
