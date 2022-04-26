<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techs = [
            'Git',
            'React',
            'PHP',
            'NodeJS',
            'DevOps',
            'Banco de Dados',
            'TypeScript',
        ];

        foreach($techs as $tech) {
            DB::table('knowledges')->insert([
                'title' => $tech,
            ]);
        }

    }
}
