<?php

use Illuminate\Database\Seeder;

class ExternalTypesSeeder extends Seeder
{
    /**
     * Auto generated seed file
     * @return void
     */
    public function run()
    {
        if (DB::table('article_externals')->count() != 0) {
            return;
        }

        DB::table('article_externals')->insert([
            [
                'id' => 1,
                'name' => 'Rbc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
