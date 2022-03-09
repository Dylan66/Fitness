<?php

use App\Post;
use App\Role;
use App\User;
use App\Booking;
use App\Service;
use App\Trainer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 7)->create();
        factory(Post::class, 8)->create();
        factory(Service::class, 4)->create();
        factory(Trainer::class, 10)->create();
        factory(Booking::class, 100)->create();
    }
}
