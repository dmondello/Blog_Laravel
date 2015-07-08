<?php
/**
 * Created by PhpStorm.
 * User: Daniele
 * Date: 17/06/15
 * Time: 00:06
 */
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Francesco',
            'last_name' => 'Malatesta',
            'slug' => 'francesco_malatesta',
            'email' => 'hey@hellofrancesco.com',
            'password' => \Hash::make('123456')
        ]);

        User::create([ 'first_name' => 'Paolo',
            'last_name' => 'Rossi',
            'slug' => 'paolo_rossi',
            'email' => 'hey@paolorossi.com',
            'password' => \Hash::make('654321') ]);
    }
}