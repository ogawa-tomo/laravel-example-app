<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): Collection
    {
        $books = Book::all();

        return $books;
    }

    public function show(string $id): Book
    {
        $book = Book::findOrFail($id);
        return $book;
    }
}
