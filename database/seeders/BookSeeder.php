<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxCount = 10;

        $res = Http::withOptions([
            'redirect.disable' => true
        ])->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent' => 'openlibrary.php/0.0.1'
        ])->get('http://openlibrary.org/search.json', [
            'author' => 'OL25788A',
            'limit' => $maxCount,
        ]);

        foreach ($res['docs'] as $doc) {
            $workPath = $doc['key'];
            $coverKey = $doc['cover_i'];
            $firstSentence = $doc['first_sentence'][0] ?? '';

            DB::table('books')->insert([
                'title' => $doc['title'],
                'author' => $doc['author_name'][0],
                'year' => $doc['first_publish_year'],
                'cover_url' => "http://covers.openlibrary.org/b/id/$coverKey-M.jpg",
                'first_sentence' => $firstSentence,
                'url' => 'http://openlibrary.org/'. $doc['key'],
            ]);

            if ($maxCount-- == 0) break;
        }
    }
}
