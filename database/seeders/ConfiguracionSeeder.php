<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracion::create(
            [
                'salario_minimo_resto_pais' => 90,
                'salario_minimo_frontera' => 100,
                'reembolso_gasolina' => 2000,
                'doc_solicitud_empleo' => 'required',
                'doc_fotografia' => ' ',
                'doc_ine' => ' ',
                'doc_acta_nacimiento' => ' ',
                'doc_nss' => ' ',
                'doc_comprobante_domicilio' => ' ',
                'doc_comprobante_estudios' => ' ',
                'doc_curp' => ' ',
                'doc_csf' => ' ',
                'doc_soporte_bancario' => ' ',
                'doc_contrato' => ' ',
            ]
        );
    }
}
