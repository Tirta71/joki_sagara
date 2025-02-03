<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUuid = User::first()->id;

        DB::table('locations')->insert([
            [
                'id' => Str::uuid()->toString(),
                'code' => '01',
                'name' => 'Server',
                'address' => 'Jl. Bandung No Sekian',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,

            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '11',
                'name' => 'Toko KBB',
                'address' => 'Jl. Bandung No Sekian',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,

            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '12',
                'name' => 'Toko KBS',
                'address' => 'Jl. Bandung No Sekian',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,

            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '13',
                'name' => 'Toko KBU',
                'address' => 'Jl. Bandung No Sekian',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,

            ],
            [
                'id' => Str::uuid()->toString(),
                'code' => '14',
                'name' => 'Toko KBT',
                'address' => 'Jl. Bandung No Sekian',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by_id' => $adminUuid,

            ],
        ]);
    }
}
