<?php

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
//         $this->call(UsersTableSeeder::class);
        factory(App\User::class)->create(['is_admin' => 1,'username'=>'admin' ]);
        factory(App\User::class)->create(['is_author' => 1,'username'=>'author' ]);
        factory(App\User::class)->create(['is_editor' => 1,'username'=>'editor']);
    }
}
