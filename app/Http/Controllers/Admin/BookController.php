<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
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

        return view('admin/book/create', [
            'categories' => $categories,
        ]);
    }

    public function store(BookPostRequest $request): RedirectResponse
    {
        $book = new Book();
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->save();
        return redirect(route('book.index'))->with('message', $book->title . 'を追加しました。');
    }
}
