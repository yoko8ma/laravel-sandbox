<?php

use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'title'=>'鬼滅の刃 18',
                'author'=>'吾峠呼世晴',
            ],
            [
                'title'=>'ONE PIECE 61',
                'author'=>'尾田栄一郎',
            ],
        ]);
    }
}
