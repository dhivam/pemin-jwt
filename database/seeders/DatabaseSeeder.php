<?php
namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UsersTableSeeder::class);
        Model::reguard();
        
         // $this->call('UsersTableSeeder');
         DB::table('film')->insert([
            'judul' => 'Start Up',
            'deskripsi' => 'Start-Up adalah seri televisi Korea Selatan tahun 2020 yang dibintangi oleh Bae Suzy, Nam Joo-hyuk, Kim Seon-ho, dan Kang Han-na. 
                            Drama ini disiarkan di tvN setiap Sabtu dan Minggu pukul 21:00 mulai 17 Oktober 2020 dan juga tersedia untuk penonton internasional melalui Netflix.',
            'author' => 'Joko',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('film')->insert([
            'judul' => 'Rentang Kisah',
            'deskripsi' => 'Rentang Kisah adalah sebuah film Indonesia yang diproduksi oleh Falcon Pictures. 
            Film tersebut diadaptasi dari novel Rentang Kisah tahun 2017 karya YouTuber Gita Savitri yang menceritakan pengalamannya selama tinggal di Jerman.
            Film ini dibintangi Beby Tsabina, Bio One, Junior Roberts, Cut Mini dan Donny Damara.',
            'author' => 'Aline',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
