<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserIntraprom;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('Usuario', 'gatho')->first();
        $admin->assignRole(['Administracion']);
        // User::create([
        //     'name' => 'Gatho',
        //     'apaterno' => 'KatzeSystems',
        //     'amaterno' => 'Developer',
        //     'email' => 'mauricio2769@gmail.com',
        //     'usuario' => 'gatho',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $intraUsers = UserIntraprom::all();
        // $this->command->getOutput()->writeln("Copiando usuarios de INTRAPROM a SYS_PROM:");
        // $this->command->getOutput()->progressStart(count($intraUsers));
        // foreach ($intraUsers as $u) {
        //     User::create([
        //         'intraprom_id' => $u->idusuario,
        //         'name' => $u->Nombre,
        //         'email' => $u->mail,
        //         'usuario' => $u->Usuario,
        //         'password' => bcrypt($u->PWD),
        //     ]);
        //     $this->command->getOutput()->progressAdvance();
        // }
        // $this->command->getOutput()->progressFinish();
    }
}
