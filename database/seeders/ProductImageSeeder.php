<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImages = [
            'Reusable Water Bottle' => 'https://images.stockcake.com/public/8/8/6/886813ca-7fb0-4868-88d4-dca74f5d85d9_large/assorted-reusable-bottles-stockcake.jpg',
            'Eco-friendly Shoes' => 'https://images.stockcake.com/public/d/8/6/d86340c3-e7ee-43a9-b8cc-a75a9fad1eb2_large/camouflage-shoes-outdoors-stockcake.jpg',
            'Recycled Plastic Table' => 'https://images.stockcake.com/public/6/1/c/61c3385c-60fe-4fbf-84d8-be9b7baf66c7_large/colorful-outdoor-seating-stockcake.jpg',
            'Bamboo Chair' => 'https://images.stockcake.com/public/1/8/2/182dec5e-fd76-4d1e-ad0b-d6063bd19c20_large/bohemian-interior-details-stockcake.jpg',
            'Biodegradable Phone Case' => 'https://images.stockcake.com/public/8/5/7/85722379-d07a-4a56-bf91-13540f2a2895_large/colorful-phone-case-stockcake.jpg',
            'Recycled Paper Notebook' => 'https://images.stockcake.com/public/a/8/e/a8e0f3a9-444f-49f8-ba3e-3e4eda0a86f5_large/morning-writing-session-stockcake.jpg',
            'Eco-friendly Pen' => 'https://images.stockcake.com/public/0/e/2/0e2f24a2-ddf6-454a-86dc-f8ba320354ae_large/organized-desk-station-stockcake.jpg',
            'Organic Cotton Backpack' => 'https://images.stockcake.com/public/c/3/0/c30a5bdb-0252-4601-a4d7-e2bc3e573bf3_large/classroom-backpack-setup-stockcake.jpg',
            'Sustainable Sunglasses' => 'https://images.stockcake.com/public/e/9/b/e9b9d72d-ab78-4d6a-a447-1c95c74d42a4_large/colorful-sunglasses-display-stockcake.jpg'
        ];

        foreach ($productImages as $name => $url) {
            // Download the image
            $imageContents = Http::get($url)->body();

            // Generate a unique file name
            $fileName = 'images/' . Str::slug($name) . '.jpg';

            // Store the image in the public/images directory
            Storage::disk('public')->put($fileName, $imageContents);

            // Update the product in the database
            Product::where('name', $name)->update(['img' => 'storage/' . $fileName]);
        }
    }
}
