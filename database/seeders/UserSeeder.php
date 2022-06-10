<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user
        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@tcrmbo.nl',
            'password' => Hash::make('user')
        ]);
        $user->assignRole('user');

        // create teacher
        $salesperson = User::factory()->create([
            'name' => 'salesperson',
            'email' => 'salesperson@tcrmbo.nl',
            'password' => Hash::make('salesperson')
        ]);
        $salesperson->assignRole('salesperson');


        // create Admin
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@tcrmbo.nl',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole('admin');

        $user4 = User::factory()->create([
            'name' => 'user4',
            'email' => 'user4@tcrmbo.nl',
            'password' => Hash::make('admin')
        ]);
        $user4->assignRole('admin');
    }
}
