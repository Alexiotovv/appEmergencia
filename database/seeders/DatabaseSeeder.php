<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\meses;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        meses::truncate();

        DB::table('meses')->insert([
            'mes' => '1',
            'nombre' => 'enero',
        ]);
        DB::table('meses')->insert([
            'mes' => '2',
            'nombre' => 'febrero',
        ]);
        DB::table('meses')->insert([
            'mes' => '3',
            'nombre' => 'marzo',
        ]);
        DB::table('meses')->insert([
            'mes' => '4',
            'nombre' => 'abril',
        ]);
        DB::table('meses')->insert([
            'mes' => '5',
            'nombre' => 'mayo',
        ]);
        DB::table('meses')->insert([
            'mes' => '6',
            'nombre' => 'junio',
        ]);
        DB::table('meses')->insert([
            'mes' => '7',
            'nombre' => 'julio',
        ]);
        DB::table('meses')->insert([
            'mes' => '8',
            'nombre' => 'agosto',
        ]);
        DB::table('meses')->insert([
            'mes' => '9',
            'nombre' => 'setiembre',
        ]);
        DB::table('meses')->insert([
            'mes' => '10',
            'nombre' => 'octubre',
        ]);
        DB::table('meses')->insert([
            'mes' => '11',
            'nombre' => 'noviembre',
        ]);
        DB::table('meses')->insert([
            'mes' => '12',
            'nombre' => 'diciembre',
        ]);


    }
}
