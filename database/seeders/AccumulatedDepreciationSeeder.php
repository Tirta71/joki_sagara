<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccumulatedDepreciationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $adminUuid = User::first()->id;

    DB::table('accumulation_depreciations')->insert([
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.01',
        'name' => 'Akumulasi Penyusutan - Bangunan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.02',
        'name' => 'Akumulasi Penyusutan - Building Improvements',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.03',
        'name' => 'Akumulasi Penyusutan - Kendaraan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.04',
        'name' => 'Akumulasi Penyusutan - Mesin & Peralatan',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.05',
        'name' => 'Akumulasi Penyusutan - Peralatan Kantor',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.06',
        'name' => 'Akumulasi Penyusutan - Aset Sewa Guna Usaha',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
      [
        'id' => Str::uuid()->toString(),
        'code' => '1-10800.07',
        'name' => 'Akumulasi Amortisasi',
        'created_at' => now(),
        'updated_at' => now(),
        'created_by_id' => $adminUuid,
      ],
    ]);
  }
}
