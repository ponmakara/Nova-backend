<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::whereIn('slug', [
            'beauty-personal-care',
            'sports-outdoor',
            'jewelry-watches',
        ])->pluck('id', 'slug');

        $products = [
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Hydrating Face Cream',
                'slug' => 'hydrating-face-cream',
                'description' => 'Daily moisturizer for soft and hydrated skin.',
                'price' => 18.50,
                'stock' => 40,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Vitamin C Serum',
                'slug' => 'vitamin-c-serum',
                'description' => 'Brightening serum for a fresh skincare routine.',
                'price' => 24.99,
                'stock' => 35,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Gentle Face Cleanser',
                'slug' => 'gentle-face-cleanser',
                'description' => 'Mild cleanser for daily face washing.',
                'price' => 12.75,
                'stock' => 50,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Matte Lipstick Set',
                'slug' => 'matte-lipstick-set',
                'description' => 'Long lasting lipstick set with everyday colors.',
                'price' => 21.00,
                'stock' => 28,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Liquid Foundation',
                'slug' => 'liquid-foundation',
                'description' => 'Smooth foundation with natural coverage.',
                'price' => 19.99,
                'stock' => 32,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Herbal Shampoo',
                'slug' => 'herbal-shampoo',
                'description' => 'Refreshing shampoo for clean and healthy hair.',
                'price' => 10.50,
                'stock' => 60,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Repair Hair Conditioner',
                'slug' => 'repair-hair-conditioner',
                'description' => 'Conditioner for smoother and stronger hair.',
                'price' => 11.25,
                'stock' => 45,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Rose Perfume',
                'slug' => 'rose-perfume',
                'description' => 'Soft floral perfume for daily wear.',
                'price' => 34.99,
                'stock' => 25,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Fresh Body Wash',
                'slug' => 'fresh-body-wash',
                'description' => 'Personal hygiene body wash with a clean scent.',
                'price' => 8.99,
                'stock' => 70,
            ],
            [
                'category_slug' => 'beauty-personal-care',
                'name' => 'Daily Deodorant',
                'slug' => 'daily-deodorant',
                'description' => 'Long lasting deodorant for everyday freshness.',
                'price' => 6.50,
                'stock' => 80,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Adjustable Dumbbell Set',
                'slug' => 'adjustable-dumbbell-set',
                'description' => 'Compact dumbbell set for home fitness training.',
                'price' => 79.99,
                'stock' => 18,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Yoga Mat',
                'slug' => 'yoga-mat',
                'description' => 'Non slip yoga mat for stretching and workouts.',
                'price' => 22.00,
                'stock' => 55,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Resistance Bands',
                'slug' => 'resistance-bands',
                'description' => 'Training bands for strength and mobility exercises.',
                'price' => 15.99,
                'stock' => 65,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Running T-Shirt',
                'slug' => 'running-t-shirt',
                'description' => 'Lightweight sportswear shirt for running.',
                'price' => 17.50,
                'stock' => 42,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Training Shorts',
                'slug' => 'training-shorts',
                'description' => 'Comfortable shorts for gym and outdoor sports.',
                'price' => 16.75,
                'stock' => 38,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Camping Tent',
                'slug' => 'camping-tent',
                'description' => 'Outdoor tent for weekend camping trips.',
                'price' => 89.00,
                'stock' => 14,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Sleeping Bag',
                'slug' => 'sleeping-bag',
                'description' => 'Warm sleeping bag for camping and travel.',
                'price' => 45.50,
                'stock' => 24,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Mountain Bicycle',
                'slug' => 'mountain-bicycle',
                'description' => 'Durable bicycle for trails and outdoor rides.',
                'price' => 299.99,
                'stock' => 8,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Cycling Helmet',
                'slug' => 'cycling-helmet',
                'description' => 'Protective helmet for bicycle riders.',
                'price' => 29.99,
                'stock' => 30,
            ],
            [
                'category_slug' => 'sports-outdoor',
                'name' => 'Sports Water Bottle',
                'slug' => 'sports-water-bottle',
                'description' => 'Reusable bottle for workouts and outdoor activities.',
                'price' => 9.99,
                'stock' => 75,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Silver Ring',
                'slug' => 'silver-ring',
                'description' => 'Simple silver ring for everyday style.',
                'price' => 39.99,
                'stock' => 20,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Gold Plated Ring',
                'slug' => 'gold-plated-ring',
                'description' => 'Elegant gold plated ring with a polished finish.',
                'price' => 49.99,
                'stock' => 18,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Pearl Necklace',
                'slug' => 'pearl-necklace',
                'description' => 'Classic necklace with pearl style beads.',
                'price' => 59.50,
                'stock' => 16,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Pendant Chain Necklace',
                'slug' => 'pendant-chain-necklace',
                'description' => 'Minimal chain necklace with a small pendant.',
                'price' => 35.00,
                'stock' => 26,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Stud Earrings',
                'slug' => 'stud-earrings',
                'description' => 'Small stud earrings for daily outfits.',
                'price' => 19.99,
                'stock' => 40,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Hoop Earrings',
                'slug' => 'hoop-earrings',
                'description' => 'Lightweight hoop earrings with a clean shine.',
                'price' => 24.50,
                'stock' => 30,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Classic Analog Watch',
                'slug' => 'classic-analog-watch',
                'description' => 'Simple analog watch with a leather style strap.',
                'price' => 69.99,
                'stock' => 12,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Digital Sport Watch',
                'slug' => 'digital-sport-watch',
                'description' => 'Digital watch with stopwatch and alarm features.',
                'price' => 44.99,
                'stock' => 22,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Bracelet Watch',
                'slug' => 'bracelet-watch',
                'description' => 'Fashion watch with a bracelet style band.',
                'price' => 54.99,
                'stock' => 15,
            ],
            [
                'category_slug' => 'jewelry-watches',
                'name' => 'Crystal Drop Earrings',
                'slug' => 'crystal-drop-earrings',
                'description' => 'Drop earrings with crystal style accents.',
                'price' => 29.75,
                'stock' => 24,
            ],
        ];

        foreach ($products as $product) {
            $categoryId = $categoryIds[$product['category_slug']] ?? null;

            if (!$categoryId) {
                continue;
            }

            unset($product['category_slug']);

            Product::updateOrCreate(
                ['slug' => $product['slug']],
                array_merge($product, [
                    'category_id' => $categoryId,
                    'is_active' => true,
                ])
            );
        }
    }
}
