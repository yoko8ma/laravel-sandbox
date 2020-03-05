<?php

namespace App\Http\Controllers;

//APIリソースを使用
use App\Http\Resources\Book AS BookResource;

class BookController extends Controller
{
    // 一覧
    public function index() {
        return BookResource::collection(Book::all());
    }

    // 保存
    public function save(Request $request) {
        $book = new Book;
        $book->title = $request->input('book','');
        $book->author = $request->input('author','');

        $book->save();
    }

    // 表示
    public function show(Book $book) {
        return new BookResource($book);
    }

    // 更新
    public function update(Request $request, Book $book) {
        $book->title = $request->input('title','');
        $book->author = $request->input('author','');

        $book->save();
    }

    // 削除
    public function destroy(Book $book) {
        $book->delete();
    }
}
