<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Admin',
            'email' => 'test@mail.com',
            'password' => bcrypt('admin123'),
            'gender'=>'LAKI-LAKI',
            'nik'=>'0000000000000000',
            'address'=>'-',
            'blood_type'=>'-',
            'phone'=>'000000000000',
            'emergency_phone'=>'000000000000',
            'is_admin' => true
        ]);
        $user->save();
    }
}
