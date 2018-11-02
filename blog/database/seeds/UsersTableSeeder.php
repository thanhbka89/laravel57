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
    	$faker = Faker\Factory::create();
        #Tao user random
    	foreach (range(1, 100) as $index) {
    		User::create([
    			'name' => $faker->userName,
    			'email' => $faker->email,
    			'password' => bcrypt('secret')
    		]);
    	}

        #Tao user co role superadmin
        $user = User::create([
            'name' => 'thanhnm',
            'email' => 'thanhbka@yahoo.com',
            'password' => bcrypt('123456a@')
        ]);
        $user->assignRole('superadmin'); //gan role

        #Cach 2
        // factory(User::class, 5)->create()->each(function($u) {
        //     if ($u->id == 1) {
        //       $u->assignRole('administrator');
        //     } else {
        //       $u->assignRole('user');
        //     }
        // });
    }
}
