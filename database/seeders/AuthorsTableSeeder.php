<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\AuthorDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthorDetail::factory(5)->create();
    }
}
