<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Breads',
                'name_bn' => 'রুটি',
                'slug' => 'breads',
                'description_en' => 'Fresh breads for your daily needs',
                'description_bn' => 'আপনার দৈনন্দিন প্রয়োজনের জন্য তাজা রুটি',
                'products' => [
                    ['sku' => 'BRD-001', 'name_en' => 'Premium Milk Bread', 'name_bn' => 'প্রিমিয়াম মিল্ক ব্রেড / দুধের রুটি', 'price' => 80],
                    ['sku' => 'BRD-002', 'name_en' => 'Whole Wheat Bread', 'name_bn' => 'গমের আটার রুটি', 'price' => 90],
                    ['sku' => 'BRD-003', 'name_en' => 'Brown Bread', 'name_bn' => 'ব্রাউন ব্রেড / গুড়ের রুটি', 'price' => 85],
                    ['sku' => 'BRD-004', 'name_en' => 'Garlic Bread', 'name_bn' => 'রসুনের রুটি / রসুন ব্রেড', 'price' => 120],
                    ['sku' => 'BRD-005', 'name_en' => 'Dinner Rolls / Buns', 'name_bn' => 'বান / ডিনার রোল', 'price' => 60],
                    ['sku' => 'BRD-006', 'name_en' => 'Fruit Bread', 'name_bn' => 'ফ্রুট ব্রেড', 'price' => 100],
                    ['sku' => 'BRD-007', 'name_en' => 'Cheese Bread', 'name_bn' => 'চিজ ব্রেড', 'price' => 110],
                    ['sku' => 'BRD-008', 'name_en' => 'Multigrain Bread', 'name_bn' => 'মাল্টিগ্রেইন ব্রেড / মাল্টিগ্রেইন আটার রুটি', 'price' => 130],
                    ['sku' => 'BRD-009', 'name_en' => 'Butter Bread', 'name_bn' => 'মাখ্দন রুটি / মাখন রুটি', 'price' => 95],
                    ['sku' => 'BRD-010', 'name_en' => 'Burger Bun', 'name_bn' => 'বার্গার বান', 'price' => 70],
                    ['sku' => 'BRD-011', 'name_en' => 'Toast Bread', 'name_bn' => 'টোস্ট রুটি', 'price' => 75],
                    ['sku' => 'BRD-012', 'name_en' => 'Bread Loaf', 'name_bn' => 'রুটির লোফ', 'price' => 85],
                    ['sku' => 'BRD-013', 'name_en' => 'Bread Slices', 'name_bn' => 'রুটির স্লাইস', 'price' => 80],
                    ['sku' => 'BRD-014', 'name_en' => 'Milk Bread (Premium)', 'name_bn' => 'দুধের পাউরুটি (নরম)', 'price' => 90],
                ],
            ],
            [
                'name_en' => 'Cakes',
                'name_bn' => 'কেক',
                'slug' => 'cakes',
                'description_en' => 'Delicious cakes for every occasion',
                'description_bn' => 'প্রতিটি অনুষ্ঠানের জন্য সুস্বাদু কেক',
                'products' => [
                    ['sku' => 'CAK-001', 'name_en' => 'Vanilla Sponge Cake', 'name_bn' => 'ভ্যানিলা স্পঞ্জ কেক', 'price' => 450],
                    ['sku' => 'CAK-002', 'name_en' => 'Chocolate Sponge Cake', 'name_bn' => 'চকোলেট স্পঞ্জ কেক', 'price' => 500],
                    ['sku' => 'CAK-003', 'name_en' => 'Black Forest Cake', 'name_bn' => 'ব্ল্যাক ফরেস্ট কেক', 'price' => 650],
                    ['sku' => 'CAK-004', 'name_en' => 'Marble Cake', 'name_bn' => 'মার্বল কেক / মার্বেল কেক', 'price' => 550],
                    ['sku' => 'CAK-005', 'name_en' => 'Pound Cake', 'name_bn' => 'পাউন্ড কেক', 'price' => 480],
                    ['sku' => 'CAK-006', 'name_en' => 'Chocolate Truffle Cake', 'name_bn' => 'চকোলেট ট্রাফল কেক / ট্রাফেল কেক', 'price' => 750],
                    ['sku' => 'CAK-007', 'name_en' => 'Red Velvet Cake', 'name_bn' => 'রেড ভেলভেট কেক', 'price' => 700],
                    ['sku' => 'CAK-008', 'name_en' => 'Lemon Pound Cake', 'name_bn' => 'লেমন পাউন্ড কেক', 'price' => 520],
                    ['sku' => 'CAK-009', 'name_en' => 'Coffee Cake', 'name_bn' => 'কফি কেক', 'price' => 580],
                    ['sku' => 'CAK-010', 'name_en' => 'Eid Special Cake', 'name_bn' => 'ঈদ স্পেশাল কেক', 'price' => 1200],
                    ['sku' => 'CAK-011', 'name_en' => 'Pohela Boishakh Special', 'name_bn' => 'পহেলা বৈশাখ স্পেশাল', 'price' => 950],
                    ['sku' => 'CAK-012', 'name_en' => 'Birthday Cake - Basic', 'name_bn' => 'জন্মদিনের কেক - বেসিক', 'price' => 850],
                    ['sku' => 'CAK-013', 'name_en' => 'Wedding Cake - 3 Tier', 'name_bn' => 'বিয়ের কেক - ৩ স্তর', 'price' => 3500],
                    ['sku' => 'CAK-014', 'name_en' => 'Cream Cake', 'name_bn' => 'ক্রিম কেক / মালাই কেক', 'price' => 600],
                    ['sku' => 'CAK-015', 'name_en' => 'Fruit Cake', 'name_bn' => 'ফ্রুট কেক / ফ্রুট টপিং কেক', 'price' => 680],
                    ['sku' => 'CAK-016', 'name_en' => 'Anniversary Cake', 'name_bn' => 'বার্ষিকা কেক / স্মৃতি দিনের কেক', 'price' => 1500],
                    ['sku' => 'CAK-017', 'name_en' => 'Heart Shape Cake', 'name_bn' => 'হার্ট শেপ কেক / ভালোবাসা কেক', 'price' => 720],
                    ['sku' => 'CAK-018', 'name_en' => 'Square Shape Cake', 'name_bn' => 'স্কয়ার শেপ কেক', 'price' => 650],
                    ['sku' => 'CAK-019', 'name_en' => 'Round Shape Cake', 'name_bn' => 'গোলাকার শেপ কেক', 'price' => 650],
                    ['sku' => 'CAK-020', 'name_en' => 'Custom Cake', 'name_bn' => 'কাস্টম কেক / স্পেশাল ডিজাইন কেক', 'price' => 2000],
                    ['sku' => 'CAK-021', 'name_en' => 'Cartoon Cake', 'name_bn' => 'কার্টুন কেক', 'price' => 1800],
                    ['sku' => 'CAK-022', 'name_en' => 'Photo Cake', 'name_bn' => 'ফটো কেক / ছবি প্রিন্ট কেক', 'price' => 1600],
                    ['sku' => 'CAK-023', 'name_en' => 'Fruit Flavored Cake', 'name_bn' => 'ফ্রুট ফ্লেভার কেক', 'price' => 720],
                    ['sku' => 'CAK-024', 'name_en' => 'Sponge Cake (Generic)', 'name_bn' => 'স্পঞ্জ কেক / ফোম কেক', 'price' => 420],
                ],
            ],
            [
                'name_en' => 'Cookies & Biscuits',
                'name_bn' => 'কুকি / বিস্কুট',
                'slug' => 'cookies-biscuits',
                'description_en' => 'Crispy cookies and biscuits',
                'description_bn' => 'খাস্তা কুকি এবং বিস্কুট',
                'products' => [
                    ['sku' => 'CKI-001', 'name_en' => 'Butter Cookies', 'name_bn' => 'মাখনের বিস্কুট / বাটার কুকি', 'price' => 120],
                    ['sku' => 'CKI-002', 'name_en' => 'Chocolate Chip Cookies', 'name_bn' => 'চকোলেট চিপ কুকি', 'price' => 150],
                    ['sku' => 'CKI-003', 'name_en' => 'Digestive Biscuits', 'name_bn' => 'ডাইজেস্টিভ বিস্কুট', 'price' => 100],
                    ['sku' => 'CKI-004', 'name_en' => 'Nankhatai', 'name_bn' => 'নানখাতাই', 'price' => 130],
                    ['sku' => 'CKI-005', 'name_en' => 'Cashew Cookies', 'name_bn' => 'কাজু কুকি / কাজু বাদাম কুকি', 'price' => 180],
                    ['sku' => 'CKI-006', 'name_en' => 'Almond Cookie', 'name_bn' => 'বাদাম কুকি / বাদাম বিস্কুট', 'price' => 170],
                    ['sku' => 'CKI-007', 'name_en' => 'Coconut Cookie', 'name_bn' => 'নারিকেল কুকি / নারকেল বিস্কুট', 'price' => 140],
                    ['sku' => 'CKI-008', 'name_en' => 'Oats Cookie', 'name_bn' => 'ওটস কুকি / ওটস বিস্কুট', 'price' => 135],
                    ['sku' => 'CKI-009', 'name_en' => 'Sugar Cookie', 'name_bn' => 'চিনি কুকি', 'price' => 110],
                    ['sku' => 'CKI-010', 'name_en' => 'Cream Biscuit', 'name_bn' => 'ক্রিম বিস্কুট / মালাই বিস্কুট', 'price' => 125],
                    ['sku' => 'CKI-011', 'name_en' => 'Coconut Biscuit', 'name_bn' => 'নারিকেল বিস্কুট', 'price' => 130],
                    ['sku' => 'CKI-012', 'name_en' => 'Jam Biscuit', 'name_bn' => 'জাম বিস্কুট / জাম পুরেল', 'price' => 140],
                    ['sku' => 'CKI-013', 'name_en' => 'Assorted Biscuits', 'name_bn' => 'মিক্সড বিস্কুট / বিস্কুট প্যাকেট', 'price' => 160],
                ],
            ],
            [
                'name_en' => 'Traditional Sweets',
                'name_bn' => 'ঐতিহ্যবাহী মিষ্টি',
                'slug' => 'traditional-sweets',
                'description_en' => 'Authentic Bengali sweets',
                'description_bn' => 'খাঁটি বাঙালি মিষ্টি',
                'products' => [
                    ['sku' => 'SWT-001', 'name_en' => 'Roshogolla (6 pcs)', 'name_bn' => 'রসগোল্লা (৬ পিস)', 'price' => 120],
                    ['sku' => 'SWT-002', 'name_en' => 'Roshogolla (12 pcs)', 'name_bn' => 'রসগোল্লা (১২ পিস)', 'price' => 220],
                    ['sku' => 'SWT-003', 'name_en' => 'Sandesh (10 pcs)', 'name_bn' => 'সন্দেশ (১০ পিস)', 'price' => 180],
                    ['sku' => 'SWT-004', 'name_en' => 'Sandesh (Cream)', 'name_bn' => 'ক্রিম সন্দেশ / মালাই সন্দেশ', 'price' => 220],
                    ['sku' => 'SWT-005', 'name_en' => 'Sandesh (Pistachio)', 'name_bn' => 'কাজু সন্দেশ / পিস্তাচিও সন্দেশ', 'price' => 280],
                    ['sku' => 'SWT-006', 'name_en' => 'Sandesh (Saffron)', 'name_bn' => 'জাফরান সন্দেশ', 'price' => 260],
                    ['sku' => 'SWT-007', 'name_en' => 'Gulab Jamun (12 pcs)', 'name_bn' => 'গোলাপ জামুন (১২ পিস)', 'price' => 180],
                    ['sku' => 'SWT-008', 'name_en' => 'Gulab Jamun (Rose)', 'name_bn' => 'গোলাপ গোলাব জামুন / লাল গোলাব', 'price' => 200],
                    ['sku' => 'SWT-009', 'name_en' => 'Kalo Jam', 'name_bn' => 'কালো জাম', 'price' => 160],
                    ['sku' => 'SWT-010', 'name_en' => 'Kalo Jam (24 pcs)', 'name_bn' => 'কালো জাম (২৪ পিস)', 'price' => 300],
                    ['sku' => 'SWT-011', 'name_en' => 'Khejur', 'name_bn' => 'খেজুর', 'price' => 180],
                    ['sku' => 'SWT-012', 'name_en' => 'Roshmalai', 'name_bn' => 'রশমালাই', 'price' => 220],
                    ['sku' => 'SWT-013', 'name_en' => 'Mawa', 'name_bn' => 'মোয়া / মাওয়া', 'price' => 300],
                    ['sku' => 'SWT-014', 'name_en' => 'Shingara', 'name_bn' => 'শিঙারা / সিংডা', 'price' => 40],
                    ['sku' => 'SWT-015', 'name_en' => 'Jalebi', 'name_bn' => 'জিলাপি', 'price' => 100],
                    ['sku' => 'SWT-016', 'name_en' => 'Jalebi (Thin)', 'name_bn' => 'চুনা জিলাপি', 'price' => 110],
                    ['sku' => 'SWT-017', 'name_en' => 'Chamcham', 'name_bn' => 'চমচম', 'price' => 140],
                    ['sku' => 'SWT-018', 'name_en' => 'Pantua', 'name_bn' => 'পান্তুয়া', 'price' => 150],
                    ['sku' => 'SWT-019', 'name_en' => 'Laddu', 'name_bn' => 'লাড্ডু / মোতি লাড্ডু', 'price' => 200],
                    ['sku' => 'SWT-020', 'name_en' => 'Laddu (Color)', 'name_bn' => 'রাঙ লাড্ডু', 'price' => 220],
                    ['sku' => 'SWT-021', 'name_en' => 'Barfi', 'name_bn' => 'বরফি / খোয়া বরফি', 'price' => 280],
                    ['sku' => 'SWT-022', 'name_en' => 'Payesh', 'name_bn' => 'পায়েশ / গুড়ের পায়েশ', 'price' => 350],
                    ['sku' => 'SWT-023', 'name_en' => 'Kheer', 'name_bn' => 'খীর', 'price' => 320],
                    ['sku' => 'SWT-024', 'name_en' => 'Rasgulla', 'name_bn' => 'রাসগুল্লা / পনির সন্দেশ', 'price' => 130],
                ],
            ],
            [
                'name_en' => 'Dairy Products',
                'name_bn' => 'দুগ্ধজাত',
                'slug' => 'dairy-products',
                'description_en' => 'Fresh dairy products',
                'description_bn' => 'তাজা দুগ্ধজাত পণ্য',
                'products' => [
                    ['sku' => 'DYR-001', 'name_en' => 'Sweet Yogurt (250g)', 'name_bn' => 'মিষ্টি দই (২৫০ গ্রাম)', 'price' => 80],
                    ['sku' => 'DYR-002', 'name_en' => 'Sweet Yogurt (500g)', 'name_bn' => 'মিষ্টি দই (৫০০ গ্রাম)', 'price' => 150],
                    ['sku' => 'DYR-003', 'name_en' => 'Plain Yogurt (250g)', 'name_bn' => 'সাদা দই (২৫০ গ্রাম)', 'price' => 70],
                    ['sku' => 'DYR-004', 'name_en' => 'Doi (1kg)', 'name_bn' => 'দই (১ কেজি)', 'price' => 280],
                    ['sku' => 'DYR-005', 'name_en' => 'Pure Ghee (500g)', 'name_bn' => 'খাঁটি ঘি (৫০০ গ্রাম)', 'price' => 650],
                    ['sku' => 'DYR-006', 'name_en' => 'Butter', 'name_bn' => 'মাখন', 'price' => 220],
                    ['sku' => 'DYR-007', 'name_en' => 'Dairy Creamer', 'name_bn' => 'দুগ্ধ ক্রিম / ডেইরি ক্রিম', 'price' => 180],
                ],
            ],
            [
                'name_en' => 'Buns & Rolls',
                'name_bn' => 'বান / রোল',
                'slug' => 'buns-rolls',
                'description_en' => 'Fresh buns and rolls',
                'description_bn' => 'তাজা বান এবং রোল',
                'products' => [
                    ['sku' => 'BUN-001', 'name_en' => 'Cream Bun', 'name_bn' => 'ক্রিম বান / মালাই বান', 'price' => 45],
                    ['sku' => 'BUN-002', 'name_en' => 'Cheese Bun', 'name_bn' => 'পনির বান / সন্দেশ বান', 'price' => 55],
                    ['sku' => 'BUN-003', 'name_en' => 'Chocolate Bun', 'name_bn' => 'চকলেট বান / কোকো বান', 'price' => 50],
                    ['sku' => 'BUN-004', 'name_en' => 'Cinnamon Bun', 'name_bn' => 'দারচিনি বান / ডালচিনি বান', 'price' => 48],
                    ['sku' => 'BUN-005', 'name_en' => 'Garlic Bun', 'name_bn' => 'রসুন বান / আলু বান', 'price' => 50],
                    ['sku' => 'BUN-006', 'name_en' => 'Cheese Roll', 'name_bn' => 'পনির রোল', 'price' => 60],
                    ['sku' => 'BUN-007', 'name_en' => 'Egg Bun', 'name_bn' => 'ডিম বান', 'price' => 42],
                    ['sku' => 'BUN-008', 'name_en' => 'Hot Dog Bun', 'name_bn' => 'হট ডগ বান / লং বান', 'price' => 40],
                    ['sku' => 'BUN-009', 'name_en' => 'Pastry Bun', 'name_bn' => 'পেস্ট্রি বান', 'price' => 55],
                    ['sku' => 'BUN-010', 'name_en' => 'Fruit Bun', 'name_bn' => 'ফ্রুট বান', 'price' => 48],
                ],
            ],
            [
                'name_en' => 'Pastries & Savories',
                'name_bn' => 'পেস্ট্রি / নোন-ভেজ ফুড',
                'slug' => 'pastries-savories',
                'description_en' => 'Savory pastries and snacks',
                'description_bn' => 'নোন-ভেজ পেস্ট্রি এবং স্ন্যাকস',
                'products' => [
                    ['sku' => 'PST-001', 'name_en' => 'Puff', 'name_bn' => 'পাফ / মুরগি পাফ', 'price' => 50],
                    ['sku' => 'PST-002', 'name_en' => 'Meat Puff', 'name_bn' => 'মাংসের পাফ / পোল্ট্রি পাফ', 'price' => 60],
                    ['sku' => 'PST-003', 'name_en' => 'Vegetable Puff', 'name_bn' => 'সবজি পাফ / আলুর পাফ', 'price' => 45],
                    ['sku' => 'PST-004', 'name_en' => 'Cream Roll', 'name_bn' => 'ক্রিম রোল / মালাই রোল', 'price' => 40],
                    ['sku' => 'PST-005', 'name_en' => 'Fruit Pastry', 'name_bn' => 'ফ্রুট পেস্ট্রি', 'price' => 65],
                    ['sku' => 'PST-006', 'name_en' => 'Croissant', 'name_bn' => 'ক্রোইসান / ফ্রেঞ্চ রোল', 'price' => 70],
                    ['sku' => 'PST-007', 'name_en' => 'Danish Pastry', 'name_bn' => 'ড্যানিশ পেস্ট্রি / লেয়ার্ড পেস্ট্রি', 'price' => 75],
                    ['sku' => 'PST-008', 'name_en' => 'Sausage Roll', 'name_bn' => 'সসেজ রোল', 'price' => 80],
                    ['sku' => 'PST-009', 'name_en' => 'Chicken Roll', 'name_bn' => 'চিকেন রোল', 'price' => 70],
                    ['sku' => 'PST-010', 'name_en' => 'Pizza Pastry', 'name_bn' => 'পিৎজা পেস্ট্রি', 'price' => 85],
                    ['sku' => 'PST-011', 'name_en' => 'Samosa', 'name_bn' => 'সিংডা / শিঙারা', 'price' => 25],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $products = $categoryData['products'];
            unset($categoryData['products']);

            $category = Category::create($categoryData);

            foreach ($products as $productData) {
                $productData['slug'] = Str::slug($productData['name_en']);
                $productData['category_id'] = $category->id;
                $productData['description_en'] = "Delicious {$productData['name_en']}. Made with premium ingredients following traditional recipes.";
                $productData['description_bn'] = "সুস্বাদু {$productData['name_bn']}. প্রিমিয়ম উপাদান দিয়ে ঐতিহ্যবাহী রেসিপি অনুসরণ করে তৈরি।";
                $productData['stock'] = rand(10, 100);
                $productData['price'] = $productData['price'] ?? rand(50, 500);
                $productData['sale_price'] = rand(0, 1) ? $productData['price'] * 0.9 : null;
                $productData['is_featured'] = rand(0, 1);
                $productData['is_active'] = true;

                Product::create($productData);
            }
        }

        $this->command->info('Categories and products seeded successfully!');
    }
}
