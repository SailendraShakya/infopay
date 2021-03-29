<?php

namespace App\Services\Product;

interface ProductInterface
{
    public function insertProducts(string $url): array;
}
