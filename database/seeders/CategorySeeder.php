<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUuid = User::first()->id;

        DB::table('categories')->insert([
            [
                'id' => Str::uuid()->toString(),
                'code' => '1',
                'name' => 'Tanah',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '2',
                'name' => 'Bangunan',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '3',
                'name' => 'Building Improvements',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '4',
                'name' => 'Kendaraan',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '5',
                'name' => 'Mesin & Peralatan',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '6',
                'name' => 'Peralatan Kantor',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '8',
                'name' => 'Aset Tak Berwujud',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '7',
                'name' => 'Aset Sewa Guna Usaha',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,
            ],
        ]);
    }
}
