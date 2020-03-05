<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    // 一覧
    public function index()
    {
        // 全件取得
        $books = Book::all();

        return view('book/index', compact('books'));
    }

    // 詳細
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book/edit', compact('book'));
    }

    // 新規作成
    public function create()
    {
        $book = new Book();

        return view('book/create', compact('book'));
    }

    public function store(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->save();

        return redirect("/book");
    }

    // 編集
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('book/edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->save();

        return redirect("/book");
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect("/book");
    }
}
