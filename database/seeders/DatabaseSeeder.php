<?php

namespace Database\Seeders;

use App\Models\Mesin;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Harga;
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
        
        User::create([
            'id' => "123456789",
            'name' => 'admin',
            'password' => bcrypt('testes'),
            'role' => 'Admin',
            'status' => 'Active',
        ]);

        Harga::create([
            'id' => '1', 
            'nama_harga' => 'Tagihan/kubik',
            'harga' => '20000',
            'keterangan' => 'Harga air perkubik',
        ]);

        Harga::create([
            'id' => '2', 
            'nama_harga' => 'Biaya Admin',
            'harga' => '5000',
            'keterangan' => 'Biaya admin pertransaksi',
        ]);
    }
}
