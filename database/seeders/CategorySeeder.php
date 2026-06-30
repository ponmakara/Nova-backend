<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Create parent categories first
        $parentCategories = [
            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty-personal-care',
                'description' => 'Skincare, makeup, hair care, perfume, and personal hygiene products',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Sports & Outdoor',
                'slug' => 'sports-outdoor',
                'description' => 'Fitness equipment, sportswear, camping gear, and bicycles',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Jewelry & Watches',
                'slug' => 'jewelry-watches',
                'description' => 'Rings, necklaces, earrings, and watches',
                'parent_id' => null,
                'is_active' => true,
            ],
        ];

        $categoryIds = [];

        foreach ($parentCategories as $category) {
            $created = Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
            $categoryIds[$category['slug']] = $created->id;
        }

        // Product types should be products under a category, not categories.
        $oldProductTypeCategories = [
            'skincare' => 'beauty-personal-care',
            'makeup' => 'beauty-personal-care',
            'hair-care' => 'beauty-personal-care',
            'perfume' => 'beauty-personal-care',
            'personal-hygiene' => 'beauty-personal-care',
            'fitness-equipment' => 'sports-outdoor',
            'sportswear' => 'sports-outdoor',
            'camping-gear' => 'sports-outdoor',
            'bicycles' => 'sports-outdoor',
            'rings' => 'jewelry-watches',
            'necklaces' => 'jewelry-watches',
            'earrings' => 'jewelry-watches',
            'watches' => 'jewelry-watches',
        ];

        foreach ($oldProductTypeCategories as $typeSlug => $parentSlug) {
            $oldCategory = Category::where('slug', $typeSlug)->first();
            $parentId = $categoryIds[$parentSlug] ?? null;

            if ($oldCategory && $parentId) {
                Product::where('category_id', $oldCategory->id)->update([
                    'category_id' => $parentId,
                ]);

                $oldCategory->delete();
            }
        }
    }
}
