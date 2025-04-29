<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    /** @test */
    public function メッセージ一覧の表示(): void
    {
        Message::create(['body' => 'Hello World']);
        Message::create(['body' => 'Hello Laravel']);

        $this->get('/messages')
            ->assertOk()
            ->assertSeeInOrder([
                'Hello World',
                'Hello Laravel',
            ]);
    }
}
