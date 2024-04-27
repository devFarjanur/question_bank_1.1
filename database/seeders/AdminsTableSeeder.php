<?php

// AdminsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('123456789'), // Hash the password
                'role' => 'admin',
                'status' => 'active',
            ],
        ]);
    }
}
