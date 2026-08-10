<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $themes = [
            [
                'name'        => 'Classic Elegance (Pernikahan)',
                'slug'        => 'wedding-classic',
                'category'    => 'wedding',
                'description' => 'Tema klasik mewah berwujud emas & floral untuk pernikahan anggun.',
                'thumbnail'   => 'themes/previews/wedding-classic.png',
                'blade_path'  => 'front-end.master',
                'is_active'   => true,
            ],
            [
                'name'        => 'Floral Romance (Pernikahan)',
                'slug'        => 'wedding-floral',
                'category'    => 'wedding',
                'description' => 'Tema dengan nuansa pastel floral dan typography modern romantis.',
                'thumbnail'   => 'themes/previews/wedding-floral.png',
                'blade_path'  => 'themes.wedding.floral',
                'is_active'   => true,
            ],
            [
                'name'        => 'Islamic Gold (Khitanan)',
                'slug'        => 'khitanan-islamic',
                'category'    => 'khitanan',
                'description' => 'Tema Islami khusus khitanan dengan aksen ornamen emas dan ucapan doa anak soleh.',
                'thumbnail'   => 'themes/previews/khitanan-islamic.png',
                'blade_path'  => 'themes.khitanan.islamic',
                'is_active'   => true,
            ],
            [
                'name'        => 'Ceria Blue (Khitanan)',
                'slug'        => 'khitanan-ceria',
                'category'    => 'khitanan',
                'description' => 'Tema khitanan bernuansa biru muda cerah khas anak-anak.',
                'thumbnail'   => 'themes/previews/khitanan-ceria.png',
                'blade_path'  => 'themes.khitanan.ceria',
                'is_active'   => true,
            ],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(['slug' => $theme['slug']], $theme);
        }
    }
}
