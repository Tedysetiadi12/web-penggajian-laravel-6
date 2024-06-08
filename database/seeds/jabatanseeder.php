<?php

use Illuminate\Database\Seeder;
use App\jabatan;
use Faker\Factory as Faker;

class jabatanseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $positions = [
            'Web Develofer',
            'Mobile Develofer',
            'Front-End Develofer',
            'Back-End Develofer',
            'Software Engineer',
            'Senior Javascript Developer'
        ];
            for($i=1;$i<=100;$i++){ 
                DB::table('jabatans')->insert([
                    'nama_jabatan' => $faker->randomElement($positions),
                    'gaji_pokok' => $faker->numberBetween(3000000, 10000000),
                    'uang_kesehatan' => $faker->numberBetween(500000, 3000000),
                ]);
            }
    }
}
