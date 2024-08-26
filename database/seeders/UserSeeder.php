<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_user')->insert([
            [
                'kode_user' => 'ADM001',
                'nama_user' => 'Admin User',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_user' => 'USR001',
                'nama_user' => 'John Doe',
                'password' => Hash::make('123'),
                'role' => 'camaba',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_user' => 'ADM002',
                'nama_user' => 'admin',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
