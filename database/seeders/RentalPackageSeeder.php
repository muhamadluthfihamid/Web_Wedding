<?php

namespace Database\Seeders;

use App\Models\RentalPackage;
use Illuminate\Database\Seeder;

class RentalPackageSeeder extends Seeder
{
    public function run(): void
    {
        RentalPackage::updateOrCreate(
            ['nama' => 'Basic'],
            [
                'deskripsi'    => 'Paket terjangkau untuk pasangan yang ingin tampilan undangan digital sederhana namun elegan.',
                'harga'        => 15000,
                'durasi_hari'  => 90,
                'fitur'        => [
                    'Website undangan digital',
                    'Halaman profil pengantin',
                    'Countdown timer pernikahan',
                    'Galeri foto (maks. 10 foto)',
                    'Form RSVP tamu',
                    'Link undangan unik',
                    'Support 3 bulan',
                ],
                'warna_badge'  => 'indigo',
                'is_populer'   => false,
                'is_aktif'     => true,
            ]
        );

        RentalPackage::updateOrCreate(
            ['nama' => 'Premium'],
            [
                'deskripsi'    => 'Paket lengkap dengan semua fitur untuk pengalaman undangan digital yang tak terlupakan.',
                'harga'        => 30000,
                'durasi_hari'  => 180,
                'fitur'        => [
                    'Semua fitur Basic',
                    'Galeri foto tidak terbatas',
                    'Kirim undangan via WhatsApp (bulk)',
                    'Ucapan & doa tamu online',
                    'Info hadiah / rekening bank',
                    'Cerita cinta pengantin',
                    'Peta lokasi interaktif',
                    'Support 6 bulan',
                ],
                'warna_badge'  => 'rose',
                'is_populer'   => true,
                'is_aktif'     => true,
            ]
        );
    }
}
