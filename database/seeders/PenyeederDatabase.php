<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PenyeederDatabase extends Seeder
{
    public function run(): void
    {
        $this->call([
            PenyeederJenisGelar::class,
            PenyeederProgram::class,
            PenyeederPengguna::class,
            PenyeederKelas::class,
            PenyeederSemester::class,
            PenyeederPencapaian::class,
            PenyeederBeasiswa::class,
        ]);
    }
}
