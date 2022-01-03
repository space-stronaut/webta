<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ronald Abel',
            'email' => 'abelr6099@gmail.com',
            'password' => bcrypt(123456),
            'nomor_induk' => 11902211,
            'alamat' => 'Griya Cipaku',
            'no_telp' => '089501860576',
            'tanggal_lahir' => now()
        ]);
    }
}
