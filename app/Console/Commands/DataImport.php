<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Question;
use App\Models\Review;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use DiDom\Document;

class DataImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DataImport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $product = self::getData('https://rest.bellavka.by/api/v1/products/38194392?include=brand,category,collections,colors,fabrics,heights,kits,season,sizes,photos,videos,styles');
        $questions = self::getData('https://rest.bellavka.by/api/v1/feedbacks?type=question&product=38194392&include=answers,characteristics');
        $reviews = self::parseReviews();

        if (!empty($product['data']) && $product['message'] === 'success') {
            self::addProduct($product['data']);
        }

        if (!empty($questions['data']) && $questions['message'] === 'success') {
            self::addQuestions($questions['data']);
        }

        if (!empty($reviews)) {
            self::addReviews($reviews);
        }

        return 0;
    }

    public static function getData(string $path): array
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get($path);

        return $response->json();
    }

    public static function parseReviews(): array
    {
        $reviews = [];

        $document = new Document('https://monro24.by/model.php?id=38194392', true);

        $items = $document->find('.reviews-tab-item');

        foreach ($items as $item) {
            $names = $item->find('p.reviews-item__name');
            $name_1 = trim(preg_replace('/\s\s+/', '', strip_tags($names[0]->text())));
            $name_2 = trim(preg_replace('/\s\s+/', '', strip_tags($names[1]->text())));

            $text_1 = trim(preg_replace('/\s\s+/', '', strip_tags($item->find('p.reviews-item__text')[0]->text())));
            $text_2 = trim(preg_replace('/\s\s+/', '', strip_tags($item->find('.reviews-item--1 p')[3]->text())));

            $grade = intval(preg_replace('/\D+/', '', $item->find('p.reviews-model__rating')[0]->attr('class')));

            $createdAt = trim(preg_replace('/\s\s+/', '', strip_tags($item->find('p.reviews-item__date')[0]->text())));
            $respCreatedAt = trim(preg_replace('/\s\s+/', '', strip_tags($item->find('p.reviews-item__date')[1]->text())));

            $reviews[] = [
                'author'            => $name_1,
                'text'              => $text_1,
                'grade'             => $grade,
                'responseAuthor'    => $name_2,
                'responseText'      => $text_2,
                'createdAt'        => date('Y-m-d H:i:s', strtotime($createdAt)),
                'respCreatedAt'   => date('Y-m-d H:i:s', strtotime($respCreatedAt))
            ];
        }

        return $reviews;
    }

    public static function addProduct($product)
    {
        $data = [
            'id'            => $product['id'],
            'name'          => $product['fullName'],
            'category'      => json_encode($product['category']),
            'description'   => $product['description'],
            'status'        => $product['status'],
            'favorite'      => $product['favorite'],
            'is_cotton'     => $product['isCotton'],
            'photos'        => json_encode($product['photos']),
            'videos'        => json_encode($product['videos']),
            'sale_percent'  => intval($product['salePercent'])
        ];

        Product::truncate();
        $result = Product::create($data);
    }

    public static function addQuestions($questions)
    {
        $data = [];

        foreach ($questions as $question) {
            $data[] = [
                'id'            => $question['id'],
                'product_id'    => $question['productId'],
                'name'          => $question['user']['name'],
                'photo'         => $question['user']['photo'],
                'text'          => $question['value'],
                'answer'        => $question['answers'][0]['value'],
                'created_at'    => date('Y-m-d H:i:s', strtotime($question['createdDate']))
            ];
        }

        Question::truncate();
        $result = Question::insert($data);
    }

    public static function addReviews($reviews)
    {
        $data = [];

        foreach ($reviews as $review) {
            $data[] = [
                'product_id'        => 38194392,
                'author'            => $review['author'],
                'text'              => $review['text'],
                'grade'             => $review['grade'],
                'response_author'   => $review['responseAuthor'],
                'response_text'     => $review['responseText'],
                'created_at'        => date('Y-m-d H:i:s', strtotime($review['createdAt'])),
                'resp_created_at'   => $review['respCreatedAt']
            ];
        }

        Review::truncate();
        $result = Review::insert($data);
    }
}
