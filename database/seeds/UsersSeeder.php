<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@admin.com',
            'name' => 'Vincent Kituyi',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}
