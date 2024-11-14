<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ecoFriendlyProductNames = [
            'Reusable Water Bottle', 
            'Eco-friendly Shoes', 
            'Recycled Plastic Table', 
            'Bamboo Chair', 
            'Biodegradable Phone Case', 
            'Recycled Paper Notebook', 
            'Eco-friendly Pen', 
            'Organic Cotton Backpack', 
            'Sustainable Sunglasses'
        ];

        $productDescriptions = [
            'Reusable Water Bottle' => 'Stay hydrated with this eco-friendly, reusable water bottle made from sustainable materials.',
            'Eco-friendly Shoes' => 'Step into comfort and style with these eco-friendly shoes, perfect for any occasion.',
            'Recycled Plastic Table' => 'This sturdy table is made from recycled plastic, offering durability and sustainability.',
            'Bamboo Chair' => 'Relax in style with this comfortable bamboo chair, a perfect addition to any eco-friendly home.',
            'Biodegradable Phone Case' => 'Protect your phone with this biodegradable phone case, combining style and sustainability.',
            'Recycled Paper Notebook' => 'Jot down your thoughts in this notebook made from recycled paper, an eco-friendly choice.',
            'Eco-friendly Pen' => 'Write smoothly with this eco-friendly pen, made from sustainable materials.',
            'Organic Cotton Backpack' => 'Carry your essentials in this organic cotton backpack, combining functionality and sustainability.',
            'Sustainable Sunglasses' => 'Look cool and stay protected with these sustainable sunglasses, perfect for sunny days.'
        ];

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

        $productName = $this->faker->unique->randomElement($ecoFriendlyProductNames);

        return [
            'name' => $productName,
            'price' => $this->faker->numberBetween(10, 50) * 1.00,
            'description' => $productDescriptions[$productName],
            'img' => $productImages[$productName],
        ];
    }
}

