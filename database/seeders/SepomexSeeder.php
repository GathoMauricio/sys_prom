<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Http\Controllers\DataMigrater;
use App\Models\Sepomex;

class SepomexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        //Cargar BD SEPOMEX
        Sepomex::truncate();
        $sepomex = DataMigrater::ExcelArray('sepomex.xlsx', 'app/db');
        $this->command->getOutput()->writeln("Registrando sepomex");
        $this->command->getOutput()->progressStart(count($sepomex));
        foreach ($sepomex as $item) {
            Sepomex::create([
                //'id' => $item['id'],
                'idEstado' => $item['idEstado'],
                'estado' => $item['estado'],
                'idMunicipio' => $item['idMunicipio'],
                'municipio' => $item['municipio'],
                'ciudad' => $item['ciudad'],
                'zona' => $item['zona'],
                'cp' => $item['cp'],
                'asentamiento' => $item['asentamiento'],
                'tipo' => $item['tipo'],
            ]);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
