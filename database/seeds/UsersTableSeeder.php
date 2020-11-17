<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
        	'name' => 'admin user',
        	'email' => 'admin@gmail.com',
        	'password' => Hash::make('12345678')
        ]);

        $author = User::create([
        	'name' => 'author user',
        	'email' => 'author@gmail.com',
        	'password' => Hash::make('12345678')
        ]);

        $user = User::create([
        	'name' => 'user user',
        	'email' => 'user@gmail.com',
        	'password' => Hash::make('12345678')
        ]);

        $yf = User::create([
        	'name' => 'Yanfen',
        	'email' => 'yanfen@gmail.com',
        	'password' => Hash::make('yanfen123')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
        $yf->roles()->attach($adminRole);
        
    }
}
