<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nation;
use Illuminate\Support\Str;

class NationSeeder extends Seeder
{
    public function run(): void
    {
        $nations = [
            'Stockholms nation',
            'Uplands nation',
            'Gästrike-Hälsinge nation',
            'Östgöta nation',
            'Västgöta nation',
            'Södermanlands-Nerikes nation',
            'Västmanlands-Dala nation',
        ];

        foreach ($nations as $nation) {
            Nation::create([
                'name' => $nation,
                'slug' => Str::slug($nation),
            ]);
        }
    }
}