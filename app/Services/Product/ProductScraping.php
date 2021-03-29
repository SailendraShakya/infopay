<?php

namespace App\Services\Product;

use App\Models\Product;
use Goutte\Client;

class ProductScraping implements ProductInterface
{
    
    /**
     * insertProducts
     *
     * @param  mixed $url
     * @return array
     */
    public function insertProducts(string $url): array
    {
        try {
            $client = new Client();
            $page = $client->request('GET', 'https://www.apple.com/shop/buy-mac/macbook-pro/13-inch');
            $products = $page->filter('.as-bundle-selector-wrapper');

            $macProducts = $products->each(function ($product) {
                $imageHTML = $product->filter('.as-btr-optionimage')->html();
                $macPro['image'] = $this->imageSrc($imageHTML);
                $macPro['name'] = $product->filter('.add-to-cart .label .visuallyhidden')->html();
                $macPro['description'] = $product->filter('.as-macbundle-modelspecs')->html();
                $macPro['price'] = $product->filter('.as-price .as-bundleselection-fullprice .as-price-currentprice span')->html();
                $macPro['status'] = 'scraping';

                $product = Product::where('name', $macPro['name'])->first();

                if ($product) {
                    $product->update($macPro);
                } else {
                    Product::create($macPro);
                }

            });
        } catch (\Exception $ex) {
            Logger('Error occured during fetching API Run at ' . now());
            Logger('Error - ' . $ex);
        }

        
        return $macProducts;

    }

    /**
     * imageSrc
     *
     * @param  mixed $string
     * @return void
     */
    protected function imageSrc(string $string): string
    {
        preg_match('/<img\s.*?\bsrc="(.*?)".*?>/si', $string, $matches);
        return isset($matches['1']) ? $matches['1'] : '';

    }

}
