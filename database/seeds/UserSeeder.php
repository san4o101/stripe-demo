<?php

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
        $user = factory(\App\Models\User::class)->create();
        echo 'email: ' . $user->email . PHP_EOL;
        echo 'password: password';
    }
}
