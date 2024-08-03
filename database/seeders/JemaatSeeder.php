<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class JemaatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // data faker indonesia
        $faker = Faker::create('id_ID');
 
        // membuat data dummy sebanyak 5 record
        for ($x = 1; $x <= 1000; $x++) {
            // insert data dummy jemaat dengan faker
            DB::table('jemaat')->insert([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tanggal_lahir' => $faker->date(),
                'kota' => $faker->randomElement(['Surabaya','Sidoarjo','Gresik']),
                'kode_pos' => $faker->postcode,
                'nomor_telepon' => $faker->phoneNumber,
                'email' => $faker->email,
                'status_baptisan' => $faker->randomElement(['Sudah','Belum']),
                'tanggal_baptisan' => $faker->optional()->date(),
                'status_anggota' => $faker->randomElement(['Jemaat Umum','Anggota Aktif','Tamu']),
                'waktu_bergabung' => $faker->dateTime(),
            ]);
        }
    }
}
