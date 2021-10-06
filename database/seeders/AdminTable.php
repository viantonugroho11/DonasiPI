<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'name' => 'admin',
            'email' => 'admin1@multi-auth.test',
            'password' => bcrypt(12345678),
            'role'=>'Master'
        ]);
    }
}
