<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::all();

        return view('admin/book/index', ['books' => $books]);
    }

    public function show(Book $book): View
    {
        return view('admin/book/show', compact('book'));
    }

    public function create(): View
    {
        $categories = Category::all();

        $authors = Author::all();

        return view('admin/book/create', compact('categories', 'authors'));
    }

    public function store(BookPostRequest $request): RedirectResponse
    {
        $book = new Book();
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        DB::transaction(function() use($book, $request) {
            $book->save();
            $book->authors()->attach($request->author_ids);
        });
        return redirect(route('book.index'))->with('message', $book->title . 'を追加しました。');
    }

    public function edit(Book $book): View
    {
        $categories = Category::all();
        $authors = Author::all();

        $authorIds = $book->authors()->pluck('id')->all();

        return view('admin/book/edit', compact('book', 'categories', 'authors', 'authorIds'));
    }

    public function update(BookPutRequest $request, Book $book): RedirectResponse
    {
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        DB::transaction(function() use($book, $request) {
            $book->update();
            $book->authors()->sync($request->author_ids);
        });

        return redirect(route('book.index'))->with('message', $book->title . 'を変更しました。');
    }

    public function destroy(Book $book): RedirectResponse
    {
        DB::transaction(function() use ($book) {
            $book->authors()->detach();
            $book->delete();
        });

        return redirect(route('book.index'))->with('message', $book->title . 'を削除しました。');
    }
}
