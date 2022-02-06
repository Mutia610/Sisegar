<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->email = "admin2@gmail.com";
        $administrator->password = \Hash::make("12345678");
        $administrator->name = "Application Administrator";
        $administrator->level = "admin";
        $administrator->gender = "wanita";
        $administrator->avatar = "none.png";
        $administrator->address = "Padang";
        $administrator->phone = "08537283748";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
