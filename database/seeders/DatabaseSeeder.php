<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create([
        // 	'id' => '1',
        // 	'name' => 'Developer',
        //     'email' => 'developer@gmail.com',
        //     'password' => Hash::make('developer123'),
        //     'role' => 'super-admin',
        //     'gender' => 'male',
        //     'phone' => '0812345678',
        //     'address' => 'Jl. Ringroad',
        //     'joined_on' => '2022-08-21',
        // ]);

        Attendance::factory()
            ->count(50)
            ->for(User::factory()->state([
                'id' => '1',
                'name' => 'Developer',
                'email' => 'developer@gmail.com',
                'password' => Hash::make('developer123'),
                'role' => 'super-admin',
                'gender' => 'male',
                'phone' => '0812345678',
                'address' => 'Jl. Ringroad',
                'joined_on' => '2022-08-21',
            ]))
            ->create();

            Attendance::factory()
            ->count(50)
            ->for(User::factory()->state([
                'id' => '2',
                'name' => 'Cindai',
                'email' => 'cindai@gmail.com',
                'password' => Hash::make('cindai123'),
                'role' => 'staff',
                'gender' => 'female',
                'phone' => '0834565873',
                'address' => 'Jl. Veteran 1',
                'joined_on' => '2021-06-23',
            ]))
            ->create();
        
        User::factory(50)->create();
        Attendance::factory(50)->create();
    }
}
