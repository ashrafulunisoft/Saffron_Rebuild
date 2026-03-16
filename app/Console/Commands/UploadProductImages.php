<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-product-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload product images from source directory to products';

    /**
     * The source directory containing product images.
     *
     * @var string
     */
    protected $sourceDir = '/home/ashraful/Downloads/Saffron/All Products/Kimi_Agent_Rosogolla product image request/products';

    /**
     * Mapping of image filenames to product SKUs.
     *
     * @var array
     */
    protected $imageSkuMapping = [
        // Breads
        'premium_milk_bread.png' => 'BRD-001',
        'whole_wheat_bread.png' => 'BRD-002',
        'brown_bread.png' => 'BRD-003',
        'garlic_bread.png' => 'BRD-004',
        'dinner_rolls.png' => 'BRD-005',
        'fruit_bread.png' => 'BRD-006',
        'cheese_bread.png' => 'BRD-007',
        'multigrain_bread.png' => 'BRD-008',
        'butter_bread.png' => 'BRD-009',
        'burger_bun.png' => 'BRD-010',
        'toast_bread.png' => 'BRD-011',
        'bread_loaf.png' => 'BRD-012',
        'bread_slices.png' => 'BRD-013',
        'milk_bread_premium.png' => 'BRD-014',

        // Cakes
        'vanilla_sponge_cake.png' => 'CAK-001',
        'chocolate_sponge_cake.png' => 'CAK-002',
        'black_forest_cake.png' => 'CAK-003',
        'marble_cake.png' => 'CAK-004',
        'pound_cake.png' => 'CAK-005',
        'chocolate_truffle_cake.png' => 'CAK-006',
        'red_velvet_cake.png' => 'CAK-007',
        'lemon_pound_cake.png' => 'CAK-008',
        'coffee_cake.png' => 'CAK-009',
        'eid_special_cake.png' => 'CAK-010',
        'pohela_boishakh_cake.png' => 'CAK-011',
        'birthday_cake_basic.png' => 'CAK-012',
        'wedding_cake_3tier.png' => 'CAK-013',
        'cream_cake.png' => 'CAK-014',
        'fruit_cake.png' => 'CAK-015',
        'anniversary_cake.png' => 'CAK-016',
        'heart_shape_cake.png' => 'CAK-017',
        'square_shape_cake.png' => 'CAK-018',
        'round_shape_cake.png' => 'CAK-019',
        'custom_cake.png' => 'CAK-020',
        'cartoon_cake.png' => 'CAK-021',
        'photo_cake.png' => 'CAK-022',
        'fruit_flavored_cake.png' => 'CAK-023',
        'sponge_cake_generic.png' => 'CAK-024',

        // Cookies & Biscuits
        'butter_cookies.png' => 'CKI-001',
        'chocolate_chip_cookies.png' => 'CKI-002',
        'digestive_biscuits.png' => 'CKI-003',
        'nankhatai.png' => 'CKI-004',
        'cashew_cookies.png' => 'CKI-005',
        'almond_cookies.png' => 'CKI-006',
        'coconut_cookies.png' => 'CKI-007',
        'oats_cookies.png' => 'CKI-008',
        'sugar_cookies.png' => 'CKI-009',
        'cream_biscuit.png' => 'CKI-010',
        'coconut_biscuit.png' => 'CKI-011',
        'jam_biscuit.png' => 'CKI-012',
        'assorted_biscuits.png' => 'CKI-013',

        // Traditional Sweets
        'rosogolla.png' => 'SWT-001',
        'roshogolla_12pcs.png' => 'SWT-002',
        'sandesh.png' => 'SWT-003',
        'sandesh_cream.png' => 'SWT-004',
        'sandesh_pistachio.png' => 'SWT-005',
        'sandesh_saffron.png' => 'SWT-006',
        'gulab_jamun.png' => 'SWT-007',
        'gulab_jamun_rose.png' => 'SWT-008',
        'kalo_jam.png' => 'SWT-009',
        'kalo_jam_24pcs.png' => 'SWT-010',
        'khejur.png' => 'SWT-011',
        'roshmalai.png' => 'SWT-012',
        'mawa.png' => 'SWT-013',
        'shingara.png' => 'SWT-014',
        'jalebi.png' => 'SWT-015',
        'jalebi_thin.png' => 'SWT-016',
        'chamcham.png' => 'SWT-017',
        'pantua.png' => 'SWT-018',
        'laddu.png' => 'SWT-019',
        'laddu_color.png' => 'SWT-020',
        'barfi.png' => 'SWT-021',
        'payesh.png' => 'SWT-022',
        'kheer.png' => 'SWT-023',
        'rasgulla.png' => 'SWT-024',

        // Dairy Products
        'sweet_yogurt_250g.png' => 'DYR-001',
        'sweet_yogurt_500g.png' => 'DYR-002',
        'plain_yogurt_250g.png' => 'DYR-003',
        'doi_1kg.png' => 'DYR-004',
        'pure_ghee_500g.png' => 'DYR-005',
        'butter.png' => 'DYR-006',
        'dairy_creamer.png' => 'DYR-007',

        // Buns & Rolls
        'cream_bun.png' => 'BUN-001',
        'cheese_bun.png' => 'BUN-002',
        'chocolate_bun.png' => 'BUN-003',
        'cinnamon_bun.png' => 'BUN-004',
        'garlic_bun.png' => 'BUN-005',
        'cheese_roll.png' => 'BUN-006',
        'egg_bun.png' => 'BUN-007',
        'hot_dog_bun.png' => 'BUN-008',
        'pastry_bun.png' => 'BUN-009',
        'fruit_bun.png' => 'BUN-010',

        // Pastries & Savories
        'puff.png' => 'PST-001',
        'meat_puff.png' => 'PST-002',
        'vegetable_puff.png' => 'PST-003',
        'cream_roll.png' => 'PST-004',
        'fruit_pastry.png' => 'PST-005',
        'croissant.png' => 'PST-006',
        'danish_pastry.png' => 'PST-007',
        'sausage_roll.png' => 'PST-008',
        'chicken_roll.png' => 'PST-009',
        'pizza_pastry.png' => 'PST-010',
        'samosa.png' => 'PST-011',
    ];

    /**
     * Category directory mapping.
     *
     * @var array
     */
    protected $categoryDirs = [
        'breads',
        'cakes',
        'cookies_biscuits',
        'traditional_sweets',
        'dairy_products',
        'buns_rolls',
        'pastries_savories',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting product image upload...');
        $this->info('Source directory: ' . $this->sourceDir);

        // Ensure the products directory exists in storage
        $targetDir = storage_path('app/public/products');
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
            $this->info('Created target directory: ' . $targetDir);
        }

        $uploadedCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        foreach ($this->imageSkuMapping as $imageFile => $sku) {
            // Find the product by SKU
            $product = Product::where('sku', $sku)->first();

            if (!$product) {
                $this->warn("Product not found for SKU: {$sku}");
                $failedCount++;
                continue;
            }

            // Search for the image file in category directories
            $sourcePath = $this->findImageFile($imageFile);

            if (!$sourcePath) {
                $this->warn("Image file not found: {$imageFile} for SKU: {$sku}");
                $failedCount++;
                continue;
            }

            // Check if the product already has images
            if ($product->images()->count() > 0) {
                $this->line("Product {$sku} already has images. Skipping...");
                $skippedCount++;
                continue;
            }

            // Generate unique filename
            $extension = pathinfo($imageFile, PATHINFO_EXTENSION);
            $filename = Str::uuid() . '.' . $extension;
            $targetPath = $targetDir . '/' . $filename;

            // Copy the image file
            if (copy($sourcePath, $targetPath)) {
                // Create product image record
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/' . $filename,
                    'is_primary' => true,
                ]);

                $this->info("✓ Uploaded image for {$sku}: {$product->name_en}");
                $uploadedCount++;
            } else {
                $this->error("Failed to copy image for SKU: {$sku}");
                $failedCount++;
            }
        }

        $this->newLine();
        $this->info('Image upload completed!');
        $this->info("Uploaded: {$uploadedCount}");
        $this->info("Skipped: {$skippedCount}");
        $this->info("Failed: {$failedCount}");

        return Command::SUCCESS;
    }

    /**
     * Find the image file in category directories.
     *
     * @param string $imageFile
     * @return string|null
     */
    protected function findImageFile($imageFile)
    {
        foreach ($this->categoryDirs as $categoryDir) {
            $path = $this->sourceDir . '/' . $categoryDir . '/' . $imageFile;
            if (file_exists($path)) {
                return $path;
            }
        }
        return null;
    }
}
