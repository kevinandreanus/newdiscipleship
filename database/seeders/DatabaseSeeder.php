<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\FungsiJemaat;
use App\Models\Ibadah;
use App\Models\Jemaat;
use App\Models\Kebangsaan;
use App\Models\StatusDaftar;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User
        User::create([
            'name' => 'Kevin Andreanus',
            'email' => 'kevinandreanus10@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('qweqweqwe')
        ]);

        User::create([
            'name' => 'Elina',
            'email' => 'eliinaaa07@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('qweqweqwe')
        ]);

        User::create([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('qweqweqwe')
        ]);

        User::create([
            'name' => 'yus',
            'email' => 'ys7025@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('admin'),
            'isAdmin' => 1
        ]);

        // Kebangsaan
        $kebangsaan_data = 
        [
            'Indonesia',
            'Iran'
        ];

        for($i = 0; $i < count($kebangsaan_data); $i++)
        {
            $kebangsaan = new Kebangsaan;
            $kebangsaan->name = $kebangsaan_data[$i];
            $kebangsaan->created_by = 1;
            $kebangsaan->modified_by = 1;
            $kebangsaan->save();
        }

        // Ibadah
        $ibadah_data = 
        [
            'Internasional KTC', 'Kega Balita KTC', 'Kega Batita KTC', 'Kega Bayi KTC', 'Kega Besar KTC', 'Kega JGC', 'Kega Kecil KTC', 'Mandarin KTC', 
            'Precious Family', 'Senior KTC', 'Umum JGC', 'Umum KTC', 'Zeal KTC'
        ];

        for($i = 0; $i < count($ibadah_data); $i++)
        {
            $ibadah = new Ibadah;
            $ibadah->name = $ibadah_data[$i];
            $ibadah->created_by = 1;
            $ibadah->modified_by = 1;
            $ibadah->save();
        }

        // Fungsi Jemaat
        $fungsi_jemaat_data = 
        [
            'Jemaat', 'Pemimpin Area', 'Pemimpin Komunitas Sel', 'Penatua'
        ];

        for($i = 0; $i < count($fungsi_jemaat_data); $i++)
        {
            $fungsi_jemaat = new FungsiJemaat;
            $fungsi_jemaat->name = $fungsi_jemaat_data[$i];
            $fungsi_jemaat->created_by = 1;
            $fungsi_jemaat->modified_by = 1;
            $fungsi_jemaat->save();
        }

        // Status Daftar
        $status_daftar_data = 
        [
            'Aktif', 'Meninggal', 'Pindah', 'Tamu', 'Tidak Aktif'
        ];

        for($i = 0; $i < count($status_daftar_data); $i++)
        {
            $status_daftar = new StatusDaftar;
            $status_daftar->name = $status_daftar_data[$i];
            $status_daftar->created_by = 1;
            $status_daftar->modified_by = 1;
            $status_daftar->save();
        }

        // Jemaat
        $jemaat = new Jemaat;
        $jemaat->user_id = 1;
        $jemaat->nama_lengkap = 'Kevin Andreanus';
        $jemaat->wa_1 = '085775235125';
        $jemaat->beribadah_di_jemaat = 'Melati';
        $jemaat->fungsi_dalam_jemaat_id = 1;
        $jemaat->created_by = 1;
        $jemaat->modified_by = 1;
        $jemaat->save();

        // Jemaat
        $jemaat = new Jemaat;
        $jemaat->user_id = 2;
        $jemaat->nama_lengkap = 'Elina';
        $jemaat->wa_1 = '08577523425';
        $jemaat->beribadah_di_jemaat = 'Mawar';
        $jemaat->fungsi_dalam_jemaat_id = 1;
        $jemaat->created_by = 1;
        $jemaat->modified_by = 1;
        $jemaat->save();

        // Jemaat
        $jemaat = new Jemaat;
        $jemaat->user_id = 3;
        $jemaat->nama_lengkap = 'Manusia';
        $jemaat->wa_1 = '08521323425';
        $jemaat->beribadah_di_jemaat = 'Anggrek';
        $jemaat->fungsi_dalam_jemaat_id = 1;
        $jemaat->created_by = 1;
        $jemaat->modified_by = 1;
        $jemaat->save();

        // Jemaat
        $jemaat = new Jemaat;
        $jemaat->user_id = 4;
        $jemaat->nama_lengkap = 'yus';
        $jemaat->wa_1 = '08612734324';
        $jemaat->beribadah_di_jemaat = 'Cakra';
        $jemaat->fungsi_dalam_jemaat_id = 1;
        $jemaat->created_by = 1;
        $jemaat->modified_by = 1;
        $jemaat->save();

        // Jemaat
        $jemaat = new Jemaat;
        $jemaat->user_id = 5;
        $jemaat->nama_lengkap = 'Admin';
        $jemaat->wa_1 = '0836472432';
        $jemaat->beribadah_di_jemaat = 'Tulip';
        $jemaat->fungsi_dalam_jemaat_id = 1;
        $jemaat->created_by = 1;
        $jemaat->modified_by = 1;
        $jemaat->save();

        // Event
        $event = new Event();
        $event->name = 'Pemuridan';
        $event->save();
    }
}
