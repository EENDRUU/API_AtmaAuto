<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['owner','cs','kasir'];

        foreach($roles as $role){
            $this->command->info('Creating User '. strtoupper($role));
            $user = new User();
            $user->username = $role;
            $user->password = bcrypt('password');
            $user->save();
        }

    }
}
