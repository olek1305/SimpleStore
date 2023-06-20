<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class RandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'iPhone',
                'description' => 'Smartphone by Apple',
                'image' => 'submarine.png',
                'price' => 1000,
            ],
            [
                'name' => 'Samsung TV',
                'description' => 'Smart TV by Samsung',
                'image' => 'game.png',
                'price' => 1500,
            ],
            [
                'name' => 'LG Monitor',
                'description' => 'Computer monitor by LG',
                'image' => 'safe.png',
                'price' => 500,
            ],
            [
                'name' => 'Android',
                'description' => 'Android by Samsung',
                'image' => 'submarine.png',
                'price' => 400,
            ],
            [
                'name' => 'PlayStation 5',
                'description' => 'PS5 by Playstation',
                'image' => 'game.png',
                'price' => 920,
            ],
            [
                'name' => 'Knife',
                'description' => 'the sharpest knife that can cut through a piece of paper',
                'image' => 'safe.png',
                'price' => 100,
            ],
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setImage($productData['image']);
            $product->setPrice($productData['price']);
            $product->save();
        }
    }
}
