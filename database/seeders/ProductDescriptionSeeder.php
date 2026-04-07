<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeder to generate product descriptions.
     *
     * @return void
     */
    public function run(): void
    {
        // Get all products with their categories
        $products = Product::with('category')->get();

        $this->command->info('Found ' . $products->count() . ' products to update...');

        foreach ($products as $product) {
            $category = $product->category;
            $categorySlug = $category ? str_replace(['-', ' '], '', $category->slug) : 'default';
            $categoryName = $category ? $category->name_en : $product->name_en;
            $productId = $product->id;

            // Generate unique description for this product
            $description = $this->generateUniqueDescription($product, $categorySlug, $productId);

            // Update the product
            DB::table('products')
                ->where('id', $product->id)
                ->update(['description_en' => $description]);
        }

        $this->command->info('Successfully updated ' . $products->count() . ' product descriptions!');
    }

    /**
     * Generate a unique description for each product
     */
    private function generateUniqueDescription($product, $categorySlug, $productId)
    {
        $name = $product->name_en;

        // Create unique seed for this product
        $seed = $productId;

        // Category-specific content
        $categoryContent = $this->getCategoryContent($categorySlug);

        // Build description paragraphs
        $paragraphs = [];

        // INTRODUCTION PARAGRAPH (150-200 words)
        $paragraphs[] = $this->buildIntroParagraph($name, $categoryContent, $seed);

        // FLAVOR PROFILE PARAGRAPH (150-200 words)
        $paragraphs[] = $this->buildFlavorParagraph($name, $categoryContent, $seed);

        // QUALITY & CRAFTSMANSHIP PARAGRAPH (150-200 words)
        $paragraphs[] = $this->buildQualityParagraph($name, $categoryContent, $seed);

        // OCCASIONS & SERVING PARAGRAPH (150-200 words)
        $paragraphs[] = $this->buildOccasionsParagraph($name, $categoryContent, $seed);

        // STORAGE & FRESHNESS PARAGRAPH (100-150 words)
        $paragraphs[] = $this->buildStorageParagraph($name, $categoryContent, $seed);

        // CUSTOMER SATISFACTION PARAGRAPH (100-150 words)
        $paragraphs[] = $this->buildCustomerParagraph($name, $categoryContent, $seed);

        return implode("\n\n", $paragraphs);
    }

    /**
     * Get category-specific content templates
     */
    private function getCategoryContent($categorySlug)
    {
        $templates = [
            'cakes' => [
                'intro' => 'masterpiece of confectionery artistry',
                'flavors' => 'rich, creamy, decadent, and indulgent',
                'textures' => 'moist, tender, and melt-in-your-mouth',
                'occasions' => 'birthdays, weddings, anniversaries, graduations, promotions, celebrations, and special milestones',
                'style' => 'handcrafted cake',
            ],
            'traditionalsweets' => [
                'intro' => 'treasure of authentic culinary heritage',
                'flavors' => 'authentic, aromatic, and deeply satisfying',
                'textures' => 'soft, spongy, or dense and fudge-like',
                'occasions' => 'festivals, weddings, religious ceremonies, family gatherings, and cultural celebrations',
                'style' => 'traditional sweet delicacy',
            ],
            'cookiesbiscuits' => [
                'intro' => 'delightful crunch that brings instant joy',
                'flavors' => 'buttery, crispy, and perfectly balanced',
                'textures' => 'crisp, crunchy, and satisfying',
                'occasions' => 'tea time, coffee breaks, snacking, gifting, and entertaining',
                'style' => 'freshly baked cookie or biscuit',
            ],
            'pastriessavories' => [
                'intro' => 'flaky masterpiece of patisserie excellence',
                'flavors' => 'buttery, savory, and exquisitely crafted',
                'textures' => 'light, flaky, and golden',
                'occasions' => 'breakfast, brunch, parties, picnics, and appetizers',
                'style' => 'artisan pastry or savory treat',
            ],
            'breads' => [
                'intro' => 'wholesome staple of artisan baking';
                'flavors' => 'earthy, nutty, and satisfyingly simple';
                'textures' => 'crusty, soft, and perfectly chewy',
                'occasions' => 'breakfast toast, lunch sandwiches, dinner accompaniment, and bread pudding',
                'style' => 'freshly baked loaf of bread',
            ],
            'buns rolls' => [
                'intro' => 'pillowy soft creation perfect for any filling';
                'flavors' => 'subtly sweet, buttery, and versatile';
                'textures' => 'soft, fluffy, and golden-brown',
                'occasions' => 'burgers, sandwiches, sliders, breakfast, and dinner rolls',
                'style' => 'freshly baked bun or roll',
            ],
            'dairy products' => [
                'intro' => 'wholesome and nutritious dairy essential';
                'flavors' => 'creamy, fresh, and naturally rich';
                'textures' => 'smooth, thick, and refreshing',
                'occasions' => 'breakfast, cooking, baking, smoothies, and healthy snacks',
                'style' => 'pure dairy product',
            ],
        ];

        return $templates[$categorySlug] ?? [
            'intro' => 'delightful creation from our bakery',
            'flavors' => 'unique, delicious, and memorable',
            'textures' => 'perfectly crafted and satisfying',
            'occasions' => 'any occasion that calls for quality treats',
            'style' => 'freshly prepared bakery item',
        ];
    }

    /**
     * Build introduction paragraph
     */
    private function buildIntroParagraph($name, $content, $seed)
    {
        $adjectives = $this->getAdjectives($seed);

        return "Indulge in our " . strtoupper($adjectives[0]) . " " . $name . ", a truly " . $content['intro'] . ". Each creation is meticulously crafted by our master bakers who bring decades of experience and passion to every batch. " .
            "What makes our " . $name . " truly " . $adjectives[1] . " is our unwavering commitment to quality and authenticity. " .
            "We believe that the " . $content['style'] . " should be more than just a treat—it should be an experience that delights your senses and creates lasting memories. " .
            "Our journey began with a simple mission: to create the " . $content['style'] . " that surpasses ordinary expectations. " .
            "Every morning, our bakery comes alive with the aroma of freshly prepared delicacies, including our signature " . $name . ". " .
            "We invite you to discover why our customers return time and again for this particular favorite. " .
            "From the moment you place your order to the first bite, you'll understand why our " . $name . " has earned such a devoted following. " .
            "The secret lies in our time-honored recipes passed down through generations of skilled artisans. " .
            "Each ingredient is carefully selected to complement and others, creating a harmonious balance of flavors that dance across your palate. " .
            "We take pride in maintaining the integrity of traditional methods while embracing modern quality standards.";
    }

    /**
     * Build flavor profile paragraph
     */
    private function buildFlavorParagraph($name, $content, $seed)
    {
        $adjectives = $this->getAdjectives($seed + 50);

        return "The flavor profile of our " . $name . " is " . $content['flavors'] . ", creating a taste experience that lingers pleasantly on the memory. " .
            "Our master craftsmen have spent years perfecting the balance of ingredients to achieve this distinctive character. " .
            "The texture is " . $content['textures'] . ", providing a mouthfeel that satisfies with every bite. " .
            "When you taste our " . $name . ", you'll first notice the " . $adjectives[0] . " aroma that wafts from the freshly prepared creation. " .
            "The initial taste reveals layers of flavor that develop complexity as you continue to savor. " .
            "Many customers describe the experience as " . $adjectives[1] . " and " . $adjectives[2] . ", noting how the different elements work together in perfect harmony. " .
            "We carefully balance sweetness, richness, and subtle notes to create a well-rounded flavor profile. " .
            "Each ingredient plays a crucial role in the final taste, contributing its unique characteristics to the overall experience. " .
            "The " . $adjectives[3] . " finish leaves a lasting impression that keeps you coming back for more. " .
            "Our " . $name . " stands apart because we never compromise on the quality or balance of flavors. " .
            "Whether you prefer subtle elegance or bold expressions, our " . $content['style'] . " delivers an experience tailored to your preferences.";
    }

    /**
     * Build quality paragraph
     */
    private function buildQualityParagraph($name, $content, $seed)
    {
        $adjectives = $this->getAdjectives($seed + 100);

        return "At our bakery, quality is not just a promise—it is our foundation. " .
            "Every " . $name . " is made fresh on the day of purchase using only the " . $adjectives[0] . " ingredients available. " .
            "We partner with local suppliers who share our commitment to excellence and sustainability. " .
            "Our skilled artisans use traditional techniques combined with modern innovations to create products that are both authentic and exceptional. " .
            "The result is a product that not only tastes " . $adjectives[1] . " but also meets the highest standards of food safety and hygiene. " .
            "We maintain strict quality control processes at every stage of preparation. " .
            "From ingredient selection to final packaging, each step undergoes thorough inspection. " .
            "Our facility adheres to international food safety standards and undergoes regular audits. " .
            "We believe that quality ingredients make all the difference in the final product. " .
            "That's why we source premium flour, fresh dairy, real spices, and quality sweeteners. " .
            "Our " . $name . " reflects this dedication to using only the best inputs. " .
            "When you choose our products, you choose a commitment to quality that spans generations.";
    }

    /**
     * Build occasions paragraph
     */
    private function buildOccasionsParagraph($name, $content, $seed)
    {
        $adjectives = $this->getAdjectives($seed + 150);

        return "Our " . $name . " is perfect for " . $content['occasions'] . ". " .
            "The versatile nature of this " . $content['style'] . " makes it suitable for both casual and formal settings. " .
            "Serve it at family gatherings to impress guests with its exceptional quality. " .
            "Present it at dinner parties as a sophisticated addition to your spread. " .
            "Enjoy it as a personal treat during quiet moments of self-indulgence. " .
            "The beautiful presentation and " . $adjectives[0] . " taste make it a conversation piece at any event. " .
            "It also makes for a thoughtful gift that shows care in selection and appreciation for quality. " .
            "Many customers order our " . $name . " for holidays, festivals, and special celebrations. " .
            "Its universal appeal crosses age groups and occasions. " .
            "Whether you're hosting an event or attending one, bringing our " . $content['style'] . " ensures you arrive with something memorable. " .
            "We offer custom packaging options for gifting, making presentation as impressive as the taste.";
    }

    /**
     * Build storage paragraph
     */
    private function buildStorageParagraph($name, $content, $seed)
    {
        $adjectives = $this->getAdjectives($seed + 250);

        return "To maintain the " . $adjectives[0] . " quality of our " . $name . ", store it in a cool, dry place away from direct sunlight. " .
            "For best results, consume within 2-3 days of purchase, though our products are so delicious that they rarely last that long. " .
            "If refrigeration is required, check the specific storage instructions on the packaging. " .
            "Our packaging is designed to preserve freshness while being environmentally responsible. " .
            "We recommend bringing products to room temperature before serving for optimal flavor development. " .
            "Avoid storing near strong odors as our products can absorb surrounding aromas.";
    }

    /**
     * Build customer satisfaction paragraph
     */
    private function buildCustomerParagraph($name, $content, $seed)
    {
        $adjectives = $this->getAdjectives($seed + 200);

        return "Customers who have experienced our " . $name . " consistently praise its exceptional quality and taste. " .
            "Many have made it their regular choice, returning time and again for its reliable excellence. " .
            "The positive feedback we receive motivates us to maintain our high standards. " .
            "We value each customer's experience and strive to make every interaction memorable and satisfying. " .
            "Our commitment to customer satisfaction extends beyond the sale. " .
            "We welcome feedback and use it to continuously improve our offerings. " .
            "Join the thousands of satisfied customers who have made our " . $name . " their preferred choice. " .
            "Experience the difference that dedication and passion make in every bite.";
    }

    /**
     * Get shuffled adjectives based on seed
     */
    private function getAdjectives($seed)
    {
        $adjectives = [
            'exquisite', 'delightful', 'mouthwatering', 'scrumptious', 'delectable', 'heavenly', 'divine', 'superb',
            'exceptional', 'magnificent', 'superior', 'outstanding', 'remarkable', 'extraordinary', 'phenomenal',
            'sensational', 'incredible', 'amazing', 'wonderful', 'fantastic', 'splendid', 'marvelous', 'glorious',
            'sublime', 'supreme', 'ultimate', 'premium', 'finest', 'top-quality', 'first-class', 'world-class',
            'award-winning', 'best-selling', 'popular', 'famous', 'renowned', 'celebrated', 'acclaimed', 'praised',
            'cherished', 'beloved', 'favorite', 'preferred', 'signature', 'specialty', 'classic', 'traditional',
            'authentic', 'genuine', 'original', 'pure', 'natural', 'fresh', 'wholesome', 'nutritious',
            'satisfying', 'fulfilling', 'pleasing', 'enjoyable', 'gratifying', 'rewarding', 'refreshing',
            'memorable', 'unforgettable', 'timeless', 'legendary', 'iconic', 'distinguished', 'prominent',
            'essential', 'fundamental', 'remarkable', 'impressive', 'striking', 'breathtaking',
            'spectacular', 'dazzling', 'brilliant', 'radiant', 'vibrant', 'vivid', 'rich', 'profound',
            'intense', 'optimal', 'ideal', 'perfect', 'flawless', 'impeccable'
        ];

        // Shuffle based on seed
        srand($seed);
        shuffle($adjectives);

        return $adjectives;
    }
}
