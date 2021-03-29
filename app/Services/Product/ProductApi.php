<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ProductApi implements ProductInterface
{

    /**
     * insertProducts
     *
     * @param  mixed $url
     * @return void
     */
    public function insertProducts(string $url): array
    {
        try {
            $response = Http::get($url);
            $response = $response->json();
            $productList = $response['body']['marketingData']['microdataList'][0];

            $data = json_decode($productList);
            $title = $data->name;
            $array['image'] = $data->image;
            $array['description'] = $title . " - No Descriptin from API";
            $array['status'] = 'api';

            $product = [];
            foreach ($data->offers as $variant) {
                $array['price'] = $variant->price;
                $array['name'] = $title . " - " . $variant->sku;

                if (!$this->alreadyExist($array['name'])) {
                    Product::create($array);
                }

                $product[] = $array;
            }

        } catch (\Exception $ex) {
            Logger('Error occured during fetching API Run at ' . now());
            Logger('Error - '.$ex);
        }
        

        return $product;
    }

    /**
     * alreadyExist
     *
     * @param  mixed $title
     * @return void
     */
    protected function alreadyExist(string $title): bool
    {
        $product = Product::where('name', $title)->first();
        if ($product) {
            return true;
        }
        return false;
    }

}
