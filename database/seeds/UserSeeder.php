<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['System', 'Admin'],
            ['Jaycee','Mariano'],
            ['Charlotte', 'Valenzuela'],
            ['Robert', 'Harris'],
            ['Marvin', 'Guela'],
            ['Quinn', 'Alpas'],
            ['Dennis', 'Orcales'],
            ['Vernan', 'Domingo'],
            ['Marites', 'Sarmiento'],
            ['Fei', 'Tuazon'],
            ['Evangeline', 'Portacio'],
            ['Alexander', 'Diez'],
            ['Teena', 'Nartea'],
        ];

        foreach($users as $user)
        {
            DB::table('users')->insertGetId([
                'name'          => $user[0] . ' ' . $user[1],
                'email'         => strtolower($user[0]).'.'.strtolower($user[1]).'@planate.net',
                'password'      => bcrypt('password'),
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ]);
        }
    }
}
