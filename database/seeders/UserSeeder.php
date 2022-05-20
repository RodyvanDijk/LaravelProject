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
        // create student
        $student = User::factory()->create([
            'name' => 'user',
            'email' => 'user@tcrmbo.nl',
            'password' => Hash::make('user')
        ]);
        $student->assignRole('user');

        // create teacher
        $teacher = User::factory()->create([
            'name' => 'salesperson',
            'email' => 'salesperson@tcrmbo.nl',
            'password' => Hash::make('salesperson')
        ]);
        $teacher->assignRole('salesperson');


        // create Admin
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@tcrmbo.nl',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole('admin');
    }
}
