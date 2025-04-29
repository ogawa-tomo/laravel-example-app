<?php

namespace Tests\Feature\Admin;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookUpdateTest extends TestCase
{
    private $categories;
    private $book;
    private $authors;

    public function setUp(): void
    {
        parent::setUp();

        $this->categories = Category::factory(3)->create();

        $this->book = Book::factory()->create([
            'title' => 'Laravel Book',
            'category_id' => $this->categories[1]->id,
        ]);

        $this->authors = Author::factory(4)->create();

        $this->book->authors()->attach([
            $this->authors[0]->id,
            $this->authors[2]->id,
        ]);
    }

    /** @test */
    public function バリデーション()
    {
        $url = route('book.update', $this->book);

        $this->from(route('book.edit', $this->book))
            ->put($url, ['category_id' => ''])
            ->assertRedirect(route('book.edit', $this->book));

        $this->put($url, ['category_id' => ''])
            ->assertInvalid(['category_id' => 'カテゴリ は必須']);
        
        $this->put($url, ['category_id' => $this->categories[2]->id])
            ->assertValid('category_id');
        
        $this->put($url, ['title' => ''])
            ->assertInvalid(['title' => 'タイトル は必須入力']);
        
        $this->put($url, ['title' => 'a'])
            ->assertValid('title');
        
        $this->put($url, ['title' => str_repeat('a', 100)])
            ->assertValid('title');

        $this->put($url, ['title' => str_repeat('a', 101)])
            ->assertInvalid(['title' => 'タイトル は 100 文字以内']);
        
        $this->put($url, ['price' => 'a'])
            ->assertInvalid(['price' => '価格 は数値']);
        
        $this->put($url, ['price' => '0'])
            ->assertInvalid(['price' => '価格 は 1 以上']);
        
        $this->put($url, ['price' => '1'])
            ->assertValid('price');
        
        $this->put($url, ['price' => '99999'])
            ->assertValid('price');
        
        $this->put($url, ['price' => '1000000'])
            ->assertInvalid(['price' => '価格 は 999999 以下']);
        
        $this->put($url, ['author_ids' => []])
            ->assertInvalid(['author_ids' => '著者 は必須入力']);
        
        $this->put($url, ['author_ids' => ['0']])
            ->assertInvalid(['author_ids.0' => '正しい 著者']);
        
        $this->put($url, ['author_ids' => [$this->authors[2]->id]])
            ->assertValid('author_ids.0');
    }

    /** @test */
    public function 更新処理(): void
    {
        $url = route('book.update', $this->book);

        $param = [
            'category_id' => $this->categories[0]->id,
            'title' => 'New Laravel Book',
            'price' => '10000',
            'author_ids' => [
                $this->authors[1]->id,
                $this->authors[2]->id,
            ],
        ];

        $this->put($url, $param)
            ->assertRedirect(route('book.index'));
        
        $updatedBook = [
            'id' => $this->book->id,
            'category_id' => $param['category_id'],
            'title' => $param['title'],
            'price' => $param['price'],
        ];

        $this->assertDatabaseHas('books', $updatedBook);

        foreach ($this->authors as $author) {
            $authorBook = [
                'book_id'=> $this->book->id,
                'author_id' => $author->id,
            ];
            if (in_array($author->id, $param['author_ids'])) {
                $this->assertDatabaseHas('author_book', $authorBook);
            } else {
                $this->assertDatabaseMissing('author_book', $authorBook);
            }
        }

        $this->get(route('book.index'))
            ->assertSee($param['title'] . 'を変更しました');
    }
}
