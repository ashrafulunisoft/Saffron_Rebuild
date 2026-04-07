<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDescriptionUpdateSeeder extends Seeder
{
    private $adjectives = [
        'exquisite', 'delightful', 'mouthwatering', 'scrumptious', 'delectable', 'heavenly', 'divine', 'superb',
        'exceptional', 'magnificent', 'superior', 'outstanding', 'remarkable', 'extraordinary', 'phenomenal',
        'sensational', 'incredible', 'amazing', 'wonderful', 'fantastic', 'splendid', 'marvelous', 'glorious',
        'sublime', 'supreme', 'ultimate', 'premium', 'finest', 'top-quality', 'first-class', 'world-class',
        'award-winning', 'best-selling', 'popular', 'famous', 'renowned', 'celebrated', 'acclaimed', 'praised',
        'cherished', 'beloved', 'favorite', 'preferred', 'signature', 'specialty', 'classic', 'traditional',
        'authentic', 'genuine', 'original', 'pure', 'natural', 'fresh', 'wholesome', 'nutritious',
        'satisfying', 'fulfilling', 'pleasing', 'enjoyable', 'gratifying', 'rewarding', 'refreshing',
        'memorable', 'unforgettable', 'timeless', 'legendary', 'iconic', 'distinguished', 'prominent',
        'essential', 'impressive', 'striking', 'breathtaking', 'spectacular', 'dazzling', 'brilliant',
        'radiant', 'vibrant', 'vivid', 'rich', 'profound', 'intense', 'optimal', 'ideal', 'perfect', 'flawless'
    ];

    private $categoryTemplates = [
        'cakes' => [
            'intro_phrases' => ['masterpiece of confectionery artistry', 'stunning celebration centerpiece', 'works of edible art'],
            'flavor_words' => ['rich', 'creamy', 'decadent', 'indulgent', 'luscious', 'velvety'],
            'texture_words' => ['moist', 'tender', 'melt-in-your-mouth', 'light', 'fluffy', 'dense'],
            'occasions' => ['birthdays', 'weddings', 'anniversaries', 'graduations', 'promotions', 'celebrations', 'special milestones'],
            'style' => 'handcrafted cake',
            'ingredients' => ['premium Belgian chocolate', 'farm-fresh eggs', 'pure vanilla extract', 'real buttercream', 'fresh cream'],
        ],
        'traditional-sweets' => [
            'intro_phrases' => ['treasure of authentic culinary heritage', 'time-honored delicacy', 'cherished family recipe'],
            'flavor_words' => ['authentic', 'aromatic', 'deeply satisfying', 'nostalgic', 'heartwarming', 'rich'],
            'texture_words' => ['soft', 'spongy', 'dense', 'fudge-like', 'silky', 'creamy'],
            'occasions' => ['festivals', 'weddings', 'religious ceremonies', 'family gatherings', 'cultural celebrations', 'Eid', 'Puja'],
            'style' => 'traditional sweet delicacy',
            'ingredients' => ['pure ghee', 'premium milk solids', 'authentic spices', 'natural sweeteners', 'fresh nuts'],
        ],
        'cookies-biscuits' => [
            'intro_phrases' => ['delightful crunch that brings instant joy', 'perfect companion for your tea', 'crispy temptation'],
            'flavor_words' => ['buttery', 'crispy', 'perfectly balanced', 'golden', 'warm', 'comforting'],
            'texture_words' => ['crisp', 'crunchy', 'satisfying', 'snap-fresh', 'golden-brown', 'textured'],
            'occasions' => ['tea time', 'coffee breaks', 'snacking', 'gifting', 'entertaining', 'office treats', 'children parties'],
            'style' => 'freshly baked cookie',
            'ingredients' => ['real butter', 'pure vanilla', 'premium chocolate chips', 'rolled oats', 'fresh eggs'],
        ],
        'pastries-savories' => [
            'intro_phrases' => ['flaky masterpiece of patisserie excellence', 'golden layers of perfection', 'artisan creation'],
            'flavor_words' => ['buttery', 'savory', 'exquisitely crafted', 'layered', 'complex', 'sophisticated'],
            'texture_words' => ['light', 'flaky', 'golden', 'crisp', 'tender'],
            'occasions' => ['breakfast', 'brunch', 'parties', 'picnics', 'appetizers'],
            'style' => 'artisan pastry',
            'ingredients' => ['French butter', 'all-butter puff pastry', 'fresh herbs', 'premium cheese', 'seasonal vegetables'],
        ],
        'breads' => [
            'intro_phrases' => ['wholesome staple of artisan baking', 'daily essential crafted with care', 'foundation of great meals'],
            'flavor_words' => ['earthy', 'nutty', 'satisfyingly simple', 'hearty', 'rustic'],
            'texture_words' => ['crusty', 'soft', 'perfectly chewy', 'airy', 'dense', 'well-structured'],
            'occasions' => ['breakfast toast', 'lunch sandwiches', 'dinner accompaniment', 'bread pudding'],
            'style' => 'freshly baked bread',
            'ingredients' => ['stone-ground flour', 'natural sourdough starter', 'sea salt', 'filtered water', 'olive oil'],
        ],
        'buns-rolls' => [
            'intro_phrases' => ['pillowy soft creation perfect for any filling', 'soft embrace for culinary creativity'],
            'flavor_words' => ['subtly sweet', 'buttery', 'versatile', 'mild', 'complementary', 'balanced'],
            'texture_words' => ['soft', 'fluffy', 'golden-brown', 'pillowy', 'springy'],
            'occasions' => ['burgers', 'sandwiches', 'sliders', 'breakfast', 'dinner rolls'],
            'style' => 'freshly baked bun or roll',
            'ingredients' => ['enriched dough', 'fresh milk', 'real butter', 'free-range eggs', 'sesame seeds'],
        ],
        'dairy-products' => [
            'intro_phrases' => ['wholesome and nutritious dairy essential', 'farm-fresh purity in every serving', "nature\'s perfect nutrition"],            'flavor_words' => ['creamy', 'fresh', 'naturally rich', 'pure', 'clean', 'wholesome'],
            'flavor_words' => ['creamy', 'fresh', 'naturally rich', 'pure', 'clean', 'wholesome'],
            'texture_words' => ['smooth', 'thick', 'refreshing', 'silky', 'luscious', 'velvety'],
            'occasions' => ['breakfast', 'cooking', 'baking', 'smoothies', 'healthy snacks', 'desserts', 'coffee'],
            'style' => 'pure dairy product',
            'ingredients' => ['farm-fresh milk', 'live cultures', 'natural enzymes', 'no preservatives', 'vitamin-enriched'],
        ],
    ];

    public function run(): void
    {
        $products = Product::with('category')->get();
        $this->command->info('Found ' . $products->count() . ' products to update...');

        $bar = $this->command->getOutput()->createProgressBar($products->count());

        foreach ($products as $product) {
            $categorySlug = $product->category ? $product->category->slug : 'default';
            $description = $this->generateUniqueDescription($product, $categorySlug);

            DB::table('products')
                ->where('id', $product->id)
                ->update(['description_en' => $description]);

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine(2);
        $this->command->info('Successfully updated ' . $products->count() . ' product descriptions!');
    }

    private function generateUniqueDescription($product, $categorySlug): string
    {
        $name = $product->name_en;
        $productId = $product->id;

        $template = $this->categoryTemplates[$categorySlug] ?? $this->categoryTemplates['breads'];
        $seed = $productId;
        $adjectives = $this->getShuffledAdjectives($seed);
        $adj = $adjectives;

        $paragraphs = [];

        $paragraphs[] = $this->buildIntro($name, $template, $adj, $productId);
        $paragraphs[] = $this->buildFlavorTexture($name, $template, $adj, $productId);
        $paragraphs[] = $this->buildQuality($name, $template, $adj, $productId);
        $paragraphs[] = $this->buildOccasions($name, $template, $adj, $productId);
        $paragraphs[] = $this->buildStorage($name, $adj, $productId);

        return implode("\n\n", $paragraphs);
    }

    private function buildIntro($name, $template, $adj, $id): string
    {
        $introPhrase = $template['intro_phrases'][$id % count($template['intro_phrases'])];

        return '<p>Indulge in our <strong>' . strtoupper($adj[0]) . '</strong> ' . $name . '</strong>, a truly ' . $introPhrase . ' that has been captivating taste buds for generations. Each creation that leaves our bakery represents the pinnacle of culinary craftsmanship, bringing together time-honored traditions and modern excellence. Our master bakers pour their passion and expertise into every single ' . $template['style'] . ', ensuring that you <sup> receive nothing short of perfection.</p>

<p>The journey of our <strong>' . $name . '</strong> begins long before it reaches your table, starting with the careful selection of only the <strong>' . $adj[1] . '</strong> ingredients sourced from trusted suppliers who share our commitment to quality. We believe that exceptional food should be an experience that engages all your senses, from the moment you first see its <strong>' . $adj[2] . '</strong> appearance to the lingering satisfaction after the last bite.</p>

<p>What truly sets our <strong>' . $name . '</strong> apart is our unwavering dedication to authenticity and the pursuit of excellence in every aspect of preparation. From ingredient selection through final packaging, each step undergoes thorough inspection. Our facility adheres to international food safety standards and undergoes regular audits. We believe that quality ingredients make all the difference in the final product. That\'s why we source premium flour, fresh dairy, real spices, and quality sweeteners. Our <strong>' . $name . '</strong> reflects this dedication to using only the best inputs. When you choose our products, you are choosing a commitment to quality that spans generations.</p>';
    }

    private function buildFlavorTexture($name, $template, $adj, $id): string
    {
        $flavorWord1 = $template['flavor_words'][$id % count($template['flavor_words'])];
        $flavorWord2 = $template['flavor_words'][($id + 1) % count($template['flavor_words'])];
        $textureWord1 = $template['texture_words'][$id % count($template['texture_words'])];
        $textureWord2 = $template['texture_words'][($id + 2) % count($template['texture_words'])];

        return '<p>The flavor profile of our <strong>' . $name . '</strong> is nothing short of <strong>' . $adj[3] . '</strong>, presenting a harmonious symphony of <strong>' . $flavorWord1 . '</strong> and <strong>' . $flavorWord2 . '</strong> notes that dance gracefully across your palate. Our culinary artisans have spent years perfecting this distinctive character, carefully balancing each element to achieve a taste that is both memorable and deeply satisfying.</p>

<p>The texture is gloriously <strong>' . $textureWord1 . '</strong> and <strong>' . $textureWord2 . '</strong>, creating a mouthfeel that provides the perfect complement to the rich flavors. When you take your first bite of our <strong>' . $name . '</strong>, you will immediately notice the <strong>' . $adj[4] . '</strong> aroma that rises to greet you, hinting at the delicious experience to come. As you continue to savor each morsel, layers of complexity unfold, revealing subtle nuances that make our <strong>' . $template['style'] . '</strong> truly unique.</p>

<p>Customers frequently describe the experience as <strong>' . $adj[5] . '</strong> and <strong>' . $adj[6] . '</strong>, often remarking how the various flavor components work together in perfect harmony without any single note overwhelming the others. We take great pride in achieving this delicate balance, understanding that the best flavors are those that evolve as you eat, revealing new dimensions with each bite.</p>

<p>The finish is clean yet memorable, leaving a pleasant reminder of the <strong>' . $adj[7] . '</strong> experience that invites you to return for more.</p>';
    }

    private function buildQuality($name, $template, $adj, $id): string
    {
        $ingredient1 = $template['ingredients'][$id % count($template['ingredients'])];
        $ingredient2 = $template['ingredients'][($id + 1) % count($template['ingredients'])];

        return '<p>At our establishment, quality is not merely a goal but the very foundation upon which we build everything we create. Every <strong>' . $name . '</strong> is prepared fresh using only the <strong>' . $adj[8] . '</strong> ingredients available, with absolutely no compromises on quality or freshness. We take great pride in our partnerships with local farmers and suppliers who share our dedication to excellence and sustainable practices.</p>

<p>Our <strong>' . $template['style'] . '</strong> begins with <strong>' . $ingredient1 . '</strong> and <strong>' . $ingredient2 . '</strong>, each ingredient carefully chosen for its superior quality and contribution to the final product. Our skilled artisans combine traditional techniques passed down through generations with modern innovations to create products that are both authentically crafted and exceptionally delicious.</p>

<p>The result is a product that not only tastes <strong>' . $adj[9] . '</strong> but also meets the most stringent standards of food safety and hygiene. We maintain rigorous quality control processes at every stage, from ingredient selection through preparation to final packaging, ensuring that what reaches you is nothing short of perfect.</p>

<p>Our facility undergoes regular audits and adheres to international food safety standards because we believe you deserve complete confidence in every product you purchase from us. When you choose our <strong>' . $name . '</strong>, you are choosing a commitment to quality that spans generations and a dedication to excellence that will never waver.</p>';
    }

    private function buildOccasions($name, $template, $adj, $id): string
    {
        $occasion1 = $template['occasions'][$id % count($template['occasions'])];
        $occasion2 = $template['occasions'][($id + 1) % count($template['occasions'])];

        return '<p>Our <strong>' . $name . '</strong> is the perfect choice for <strong>' . $occasion1 . '</strong> and <strong>' . $occasion2 . '</strong>, bringing joy and satisfaction to any occasion. The versatile nature of this <strong>' . $adj[10] . '</strong> ' . $template['style'] . '</strong> makes it equally suitable for casual family gatherings and formal celebrations alike.</p>

<p>Present it at your next dinner party to impress guests with its exceptional quality and <strong>' . $adj[11] . '</strong> presentation that speaks to refined taste. Many of our loyal customers order our <strong>' . $name . '</strong> specifically for holidays, festivals, and milestone celebrations where only the finest will do.</p>

<p>It also makes for a thoughtful and appreciated gift, showing care in selection and an understanding of quality that recipients immediately recognize. Whether you are hosting an elaborate event or enjoying a quiet moment of personal indulgence, our <strong>' . $name . '</strong> rises magnificently to every occasion.</p>

<p>We offer elegant custom packaging options for gifting purposes, ensuring that your present looks as <strong>' . $adj[12] . '</strong> as it tastes.</p>';
    }

    private function buildStorage($name, $adj, $id): string
    {
        return '<p>To preserve the <strong>' . $adj[13] . '</strong> quality and freshness of our <strong>' . $name . '</strong>, we recommend storing it in a cool, dry place away from direct sunlight and heat sources. For optimal enjoyment, consume within 2-3 days of purchase, though our delicious creations rarely last that long once discovered. If refrigeration is recommended, please refer to the specific storage guidelines on the packaging for best results.</p>

<p>Our eco-friendly packaging is thoughtfully designed to maintain freshness while minimizing environmental impact. We suggest allowing refrigerated items to come to room temperature before serving to fully appreciate the <strong>' . $adj[14] . '</strong> flavors and textures our bakers intended.</p>

<p>Avoid storing near strong-smelling foods as our products may absorb surrounding odors.</p>';
    }

    private function getShuffledAdjectives($seed): array
    {
        $adjectives = $this->adjectives;
        mt_srand($seed);
        shuffle($adjectives);
        return $adjectives;
    }
}
