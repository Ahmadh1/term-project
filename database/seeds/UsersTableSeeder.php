<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name'	=>	'Ahamd',
        		'email'	=>	'admin@ldf.com',
        			'admin'	=>	1,
        				'password'	=>	bcrypt('secret'),
        					'avatar'	=> asset('/avatars/user.png'),
        ]);
    }
}
