<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::insert([
            [
                'id' => 1,
                'name' => 'MacBook Pro 14"',
                'description' => 'Powerful laptop with Apple M1 Pro chip, perfect for professionals and creators.',
                'price' => 1999.99,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Sony WH-1000XM5',
                'description' => 'Industry-leading noise-canceling headphones with premium sound quality.',
                'price' => 399.99,
                'stock' => 15,
                'image' => 'https://plus.unsplash.com/premium_photo-1679513691641-9aedddc94f96?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8aGVhZHBob25lfGVufDB8fDB8fHww',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Samsung Galaxy S23 Ultra',
                'description' => 'Flagship smartphone with stunning display and top-tier camera system.',
                'price' => 1199.99,
                'stock' => 10,
                'image' => 'https://images.samsung.com/id/smartphones/galaxy-s23-ultra/buy/kv_group_MO_v2.jpg',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Canon EOS R6',
                'description' => 'Full-frame mirrorless camera perfect for professional photography and videography.',
                'price' => 2499.99,
                'stock' => 5,
                'image' => 'https://main.mobile.doss.co.id/storage/uploads/2022/12/medium/canon-eos-r6-mark-ii-mirrorless-camera-with-24-105mm-f4-7-1-lens.webp',
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Apple Watch Series 9',
                'description' => 'Advanced smartwatch with fitness tracking, heart rate monitoring, and more.',
                'price' => 399.00,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1603791440384-56cd371ee9a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
                'is_active' => true,
            ],
            [
                'id' => 6,
                'name' => 'Logitech MX Master 3S',
                'description' => 'Ergonomic wireless mouse designed for precision and productivity.',
                'price' => 99.99,
                'stock' => 30,
                'image' => 'https://resource.logitech.com/content/dam/logitech/en/products/mice/mx-master-3s/migration-assets-for-delorean-2025/gallery/mx-master-3s-top-view-graphite.png',
                'is_active' => true,
            ],
            [
                'id' => 7,
                'name' => 'Dell UltraSharp 27"',
                'description' => 'High-resolution 4K monitor with accurate color reproduction for creative professionals.',
                'price' => 649.99,
                'stock' => 7,
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
                'is_active' => true,
            ],
            [
                'id' => 8,
                'name' => 'Bose SoundLink Revolve+',
                'description' => 'Portable Bluetooth speaker with 360° sound and deep bass.',
                'price' => 299.99,
                'stock' => 12,
                'image' => 'https://bettersound.id/wp-content/uploads/Bose-SoundLink-Revolve-Plus-8.jpg',
                'is_active' => true,
            ],
        ]);
    }
}
