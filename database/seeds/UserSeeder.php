<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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

        Artisan::call('acl:generate');

        foreach($users as $user)
        {
            $user = User::create([
                'name'          => $user[0] . ' ' . $user[1],
                'email'         => strtolower($user[0]).'.'.strtolower($user[1]).'@planate.net',
                'password'      => bcrypt('password'),
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now(),
            ]);

            $user->assignRole('superuser');
        }
    }
}
