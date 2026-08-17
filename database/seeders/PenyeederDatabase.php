<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PenyeederDatabase extends Seeder
{
    public function run(): void
    {
        $this->call([
            PenyeederPengguna::class,
            PenyeederJenisGelar::class,
            PenyeederProgram::class,
            PenyeederKelas::class,
        ]);
    }
}
