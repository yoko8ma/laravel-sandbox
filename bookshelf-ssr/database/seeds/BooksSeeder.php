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
        // テーブルのクリア
        DB::table('books')->truncate();

        $books = [
            ['title' => '鬼滅の刃 19', 'author' => '吾峠呼世晴'],
        ];

        foreach($books as $book) {
            \App\Book::create($book);
        }

    }
}
