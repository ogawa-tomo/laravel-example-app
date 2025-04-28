<?php

namespace App\View\Components;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class BookForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $categories,
        public Collection $authors,
        public Book $book = new Book(),
        public array $authorIds = []
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-form');
    }
}
