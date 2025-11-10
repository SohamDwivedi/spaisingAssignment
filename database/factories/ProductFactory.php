<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // pick one random curated product each time
        return fake()->randomElement(self::definitionList());
    }

    /**
     * Full curated product list — used by both seeder and definition()
     */
    public static function definitionList(): array
    {
        return [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'High-fidelity wireless headphones with deep bass, noise cancellation, and 30-hour battery life.',
                'price' => 2499.00,
                'stock' => 50,
                'images' => [
                    'https://images.pexels.com/photos/3394669/pexels-photo-3394669.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/3394668/pexels-photo-3394668.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/3394659/pexels-photo-3394659.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Smart Fitness Band',
                'description' => 'Track your daily activity, sleep, and heart rate with this sleek and durable fitness tracker.',
                'price' => 1799.00,
                'stock' => 60,
                'images' => [
                    'https://images.pexels.com/photos/267394/pexels-photo-267394.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/267393/pexels-photo-267393.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/267395/pexels-photo-267395.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Gaming Laptop Pro 15"',
                'description' => 'Powerful gaming laptop with RTX graphics, 16GB RAM, 1TB SSD, and a 144Hz display.',
                'price' => 89999.00,
                'stock' => 15,
                'images' => [
                    'https://images.pexels.com/photos/577585/pexels-photo-577585.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/4050299/pexels-photo-4050299.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Wireless Bluetooth Speaker',
                'description' => 'Portable mini speaker with waterproof build and 12-hour battery life for outdoor music lovers.',
                'price' => 1499.00,
                'stock' => 40,
                'images' => [
                    'https://images.pexels.com/photos/3394664/pexels-photo-3394664.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/3394665/pexels-photo-3394665.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/373945/pexels-photo-373945.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Smartphone X20',
                'description' => 'Sleek 6.5-inch smartphone with AMOLED display, 128GB storage, and 48MP dual camera.',
                'price' => 29999.00,
                'stock' => 25,
                'images' => [
                    'https://images.pexels.com/photos/404280/pexels-photo-404280.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/607812/pexels-photo-607812.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/6078129/pexels-photo-6078129.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Classic Leather Wallet',
                'description' => 'Premium handcrafted leather wallet with RFID protection and multiple compartments.',
                'price' => 799.00,
                'stock' => 100,
                'images' => [
                    'https://images.pexels.com/photos/322207/pexels-photo-322207.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/322208/pexels-photo-322208.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/322209/pexels-photo-322209.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Mens Running Shoes',
                'description' => 'Lightweight and breathable running shoes with responsive cushioning and strong grip sole.',
                'price' => 2599.00,
                'stock' => 80,
                'images' => [
                    'https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/292999/pexels-photo-292999.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/267202/pexels-photo-267202.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Womens Handbag',
                'description' => 'Elegant leather handbag with spacious compartments and gold-plated zip finish.',
                'price' => 3499.00,
                'stock' => 30,
                'images' => [
                    'https://images.pexels.com/photos/6311395/pexels-photo-6311395.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/6311397/pexels-photo-6311397.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/322207/pexels-photo-322207.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Analog Wrist Watch',
                'description' => 'Stainless steel wristwatch with water resistance and minimalist modern design.',
                'price' => 2199.00,
                'stock' => 70,
                'images' => [
                    'https://images.pexels.com/photos/845434/pexels-photo-845434.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/845457/pexels-photo-845457.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/845471/pexels-photo-845471.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
            [
                'name' => 'Smart LED Television 50"',
                'description' => '4K Ultra HD LED Smart TV with HDR10 support and integrated Wi-Fi streaming apps.',
                'price' => 45999.00,
                'stock' => 10,
                'images' => [
                    'https://images.pexels.com/photos/331684/pexels-photo-331684.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/331685/pexels-photo-331685.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'https://images.pexels.com/photos/331686/pexels-photo-331686.jpeg?auto=compress&cs=tinysrgb&w=600',
                ],
            ],
        ];
    }
}
