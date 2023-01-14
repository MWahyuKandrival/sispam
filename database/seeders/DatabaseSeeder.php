<?php

namespace Database\Seeders;

use App\Models\Mesin;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // User::create([
        //     'id' => "123456789",
        //     'name' => 'admin',
        //     // 'username' => 'admin',
        //     // 'email' => 'admin@gmail.com',
        //     'password' => bcrypt('testes'),
        //     'role' => 'Admin',
        //     'status' => 'Active',
        // ]);

        // User::create([
        //     'id' => "123456",
        //     'name' => 'Timmy',
        //     // 'username' => 'admin',
        //     // 'email' => 'admin@gmail.com',
        //     'password' => bcrypt('123456'),
        //     'role' => 'Petugas',
        //     'status' => 'Active',
        // ]);

        // Mesin::create([
        //     'kode_mesin'=>'1379',
        //     'name' => "Toshiba 2021",
        //     'status' => "Active",
        //     'keterangan' => 'Ada',
        // ]);

        // Pelanggan::create([
        //     'id_pelanggan' => "pelanggan_001",
        //     'name' => "Wahyu",
        //     'alamat' => "Pekanbaru",
        //     'no_telp' => "0909090",
        //     'status' => "Active",
        //     'kode_mesin' => "1379",
        //     'id_user' => "123456",
        // ]);
        
        Pelanggan::factory(10)->create();
    }
}
