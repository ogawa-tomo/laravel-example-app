<?php

namespace Tests\Unit;

use App\Models\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    /** @test */
    public function 書籍のタイトルが11文字で省略される()
    {
        $book1 = new Book();
        $book1->title = 'PHPer Book';
        $this->assertSame('PHPer Book', $book1->abbreviatedTitle());

        $book2 = new Book();
        $book2->title = 'PHPer Book2';
        $this->assertSame('PHPer Book...', $book2->abbreviatedTitle());
    }
}
