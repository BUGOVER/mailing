<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class AdminTableSeeder
 * @package Database\Seeders
 */
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->delete();

        \DB::table('admins')->insert([
            0 =>
                [
                    'admin_id' => 1,
                    'full_name' => 'Michael',
                    'email' => 'michael@mail.ru',
                    'password' => \Hash::make('secret'),
                ],
        ]);
    }
}
