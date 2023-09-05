<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $model = new User();

        $temp  = $model::first();

        if (!$temp) {

            User::insert([
                [
                    'name' => 'Mg Mg',
                    'email' => 'mg@gmail.com',
                    'password' => Hash::make('123456'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Kyaw Kyaw',
                    'email' => 'kyaw@gmail.com',
                    'password' => Hash::make('123456'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Tun Tun',
                    'email' => 'tun@gmail.com',
                    'password' => Hash::make('123456'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]);
        }
    }
}
