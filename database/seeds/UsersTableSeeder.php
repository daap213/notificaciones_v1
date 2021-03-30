<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editor = User::create([
            'name' => 'martirn',
            'email' => 'martin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $editor->assignRole('lector');

        $moderador = User::create([
            'name' => 'jose jose',
            'email' => 'jose@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $moderador->assignRole('escritor');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $admin->assignRole('admin');
    }
}
