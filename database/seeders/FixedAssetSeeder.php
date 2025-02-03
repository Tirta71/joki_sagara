<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FixedAssetSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $adminUuid = User::first()->id;

    DB::table('fixed_assets')->insert([
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.01',
        'name' => 'Aset Tetap - Tanah',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,

      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.02',
        'name' => 'Aset Tetap - Bangunan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,

      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.03',
        'name' => 'Aset Tetap - Building Improvements',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.04',
        'name' => 'Aset Tetap - Kendaraan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,

      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.05',
        'name' => 'Aset Tetap - Mesin & Peralatan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,

      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.06',
        'name' => 'Aset Tetap - Peralatan Kantor',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,

      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.07',
        'name' => 'Aset Tetap - Aset Sewa Guna Usaha',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,

      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10700.08',
        'name' => 'Aset Tak Berwujud',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
    ]);
  }
}
