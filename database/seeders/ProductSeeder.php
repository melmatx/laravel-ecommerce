<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category' => 'Computers',
                'name' => 'Apple MacBook Pro',
                'description' => '13-inch MacBook Pro with M1 chip, 8GB RAM, 256GB SSD storage',
                'price' => 1299.00,
                'image_url' => 'https://mobilio.com.ph/cdn/shop/products/MacBook_Pro_13-in_Space_Gray_Pure_Top_Open_US-EN_SCREEN_580x.png?v=1622077925',
            ],
            [
                'category' => 'Computers',
                'name' => 'Dell XPS 15',
                'description' => '15.6-inch Laptop with 11th Generation Intel Core i7, 16GB RAM, 512GB SSD',
                'price' => 1999.99,
                'image_url' => 'https://media.croma.com/image/upload/v1655807221/Croma%20Assets/Computers%20Peripherals/Laptop/Images/255340_w12cpl.png',
            ],
            [
                'category' => 'Mobile & Accessories',
                'name' => 'Samsung Galaxy S23',
                'description' => 'Latest Samsung flagship phone with 5G connectivity, triple camera setup, and 128GB storage',
                'price' => 999.99,
                'image_url' => 'https://images.samsung.com/is/image/samsung/p6pim/ph/2302/gallery/ph-galaxy-s23-s918-sm-s918bzkqphl-534856231?$650_519_PNG$',
            ],
            [
                'category' => 'Mobile & Accessories',
                'name' => 'Anker PowerCore Portable Charger',
                'description' => 'High-capacity 20100mAh portable charger with high-speed charging technology',
                'price' => 49.99,
                'image_url' => 'https://cdn.shopify.com/s/files/1/0493/9834/9974/products/999.png?v=1676466195',
            ],
            [
                'category' => 'Gaming',
                'name' => 'Sony PlayStation 5',
                'description' => 'Next generation gaming console with ultra-high-speed SSD and integrated ray tracing',
                'price' => 499.99,
                'image_url' => 'https://lzd-img-global.slatic.net/g/p/cd43672a63f6356bd4199d4ae6d1d480.png_1200x1200q80.png_.webp',
            ],
            [
                'category' => 'Gaming',
                'name' => 'Razer BlackWidow Elite Mechanical Gaming Keyboard',
                'description' => 'RGB mechanical gaming keyboard with fully programmable macros',
                'price' => 169.99,
                'image_url' => 'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RWlusg?ver=7e50',
            ],
            [
                'category' => 'Cameras & Photography',
                'name' => 'Canon EOS 5D Mark IV',
                'description' => 'Full frame DSLR camera with 30.4 megapixel resolution and 4K video recording',
                'price' => 2499.00,
                'image_url' => 'https://s3-eu-west-1.amazonaws.com/innoverne-t4-public/products/HAC00-07903/images/5D-IV-TSE.png',
            ],
            [
                'category' => 'Cameras & Photography',
                'name' => 'Sony Alpha a7 III',
                'description' => 'Mirrorless camera with 24.2MP full-frame image sensor and 4K HDR video',
                'price' => 1998.00,
                'image_url' => 'https://res-5.cloudinary.com/grover/image/upload/v1666980796/cjqehjoqvfdc28svllxk.png',
            ],
            [
                'category' => 'Audio & Video',
                'name' => 'Bose QuietComfort 35 II',
                'description' => 'Wireless Bluetooth headphones with noise cancelling features and built-in Alexa voice control',
                'price' => 299.00,
                'image_url' => 'https://assets.bose.com/content/dam/cloudassets/Bose_DAM/Web/consumer_electronics/global/products/headphones/qc35_ii/product_silo_images/qc35_ii_black_EC_hero.png/jcr:content/renditions/cq5dam.web.1280.1280.png',
            ],
            [
                'category' => 'Audio & Video',
                'name' => 'Sonos Beam Sound Bar',
                'description' => 'Compact smart soundbar for TV, music, and more with built-in Alexa',
                'price' => 399.00,
                'image_url' => 'https://skybygramophone.com/cdn/shop/products/beam-gen2-angle-front-black_1024x1024.png?v=1685124422',
            ],
            [
                'category' => 'Office Electronics & Supplies',
                'name' => 'Epson EcoTank ET-3760',
                'description' => 'Wireless color all-in-one cartridge-free printer with scanner, copier and Ethernet',
                'price' => 349.99,
                'image_url' => 'https://crdms.images.consumerreports.org/prod/products/cr/models/400277-all-in-one-inkjet-printers-epson-ecotank-et-3760-10011118.png',
            ],
            [
                'category' => 'Office Electronics & Supplies',
                'name' => 'Fellowes Powershred 79Ci Paper Shredder',
                'description' => '100% Jam Proof medium-duty cross-cut shredder, 16 sheet capacity',
                'price' => 194.98,
                'image_url' => 'https://ph-test-11.slatic.net/p/052641531f05cef6b8b37bcd1a73826c.png',
            ]
        ];


        foreach($products as $product) {
            Product::factory()->create([
                'seller_id' => User::first()->id ?? 1,
                'category_id' => Category::where('name', $product['category'])->first()->id,
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'image_url' => $product['image_url'],
                'quantity' => rand(20, 100),
            ]);
        }
    }
}
