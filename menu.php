<?php
/**
 * The Hide Out Cafe — Full Menu Page
 * Displays all active categories & products from POS database.
 * Features category filter tabs and product cards with variants.
 */
require_once __DIR__ . '/config/functions.php';

$pageTitle  = 'Our Menu';
$categories = getCategories();
$products   = getActiveProducts();
$variants   = getAllProductVariants();

require_once __DIR__ . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     MENU HERO
     ═══════════════════════════════════════════════════════════ -->
<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/5 rounded-full blur-[120px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">Freshly Crafted</span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-white mt-3">Our Menu</h1>
            <div class="section-divider mt-4"></div>
            <p class="text-stone-400 text-sm mt-4 max-w-lg mx-auto">From single-origin espressos to artisan pastries — every item crafted with passion and premium ingredients</p>
            <p class="text-stone-500 text-xs mt-3">
                <span id="product-count"><?= count($products) ?></span> items across <?= count($categories) ?> categories
            </p>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     CATEGORY FILTER TABS
     ═══════════════════════════════════════════════════════════ -->
<section class="sticky top-20 z-30 py-4 bg-[#0a0a0a]/95 backdrop-blur-xl border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
            <!-- All Tab -->
            <button class="category-pill active" data-category="all">
                <i class="fa-solid fa-grip-vertical mr-1.5 text-xs"></i> All
            </button>

            <?php foreach ($categories as $cat): ?>
                <button class="category-pill" data-category="<?= e($cat['slug']) ?>">
                    <i class="fa-solid <?= e($cat['icon']) ?> mr-1.5 text-xs"></i>
                    <?= e($cat['name']) ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     PRODUCTS GRID
     ═══════════════════════════════════════════════════════════ -->
<section class="py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php
        // Group products by category for section headers
        $grouped = [];
        foreach ($products as $p) {
            $grouped[$p['category_slug']][] = $p;
        }
        ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($products as $index => $product): ?>
                <?php $productVariants = $variants[$product['id']] ?? []; ?>

                <div class="product-item product-card fade-in-up"
                     data-category="<?= e($product['category_slug']) ?>"
                     style="transition: all 0.4s ease; transition-delay: <?= ($index % 9) * 60 ?>ms">

                    <!-- Header: Category + Price -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-stone-500 flex items-center gap-1.5">
                            <i class="fa-solid <?= e($product['category_icon'] ?? 'fa-mug-hot') ?> text-red-500/50 text-xs"></i>
                            <?= e($product['category_name']) ?>
                        </span>
                    </div>

                    <!-- Product Name & Description -->
                    <h3 class="text-white font-bold text-base mb-2"><?= e($product['name']) ?></h3>
                    <?php if (!empty($product['description'])): ?>
                        <p class="text-stone-400 text-xs leading-relaxed mb-4"><?= e($product['description']) ?></p>
                    <?php endif; ?>

                    <!-- Price -->
                    <div class="flex items-baseline gap-2 mb-3">
                        <span class="text-red-500 font-extrabold text-lg"><?= formatPrice($product['price']) ?></span>
                        <?php if (!empty($productVariants)): ?>
                            <span class="text-stone-500 text-[10px]">starting</span>
                        <?php endif; ?>
                    </div>

                    <!-- Variants -->
                    <?php if (!empty($productVariants)): ?>
                        <div class="border-t border-white/5 pt-3 space-y-1.5">
                            <span class="text-[10px] font-semibold text-stone-500 uppercase tracking-wide">Sizes Available</span>
                            <div class="flex flex-wrap gap-1.5 mt-1.5">
                                <?php foreach ($productVariants as $v): ?>
                                    <span class="text-[10px] px-2.5 py-1 rounded-full border border-white/10 text-stone-400 bg-white/3">
                                        <?= e($v['variant_name']) ?>
                                        <?php if ($v['extra_price'] > 0): ?>
                                            <span class="text-red-500/70 ml-0.5">+<?= formatPrice($v['extra_price']) ?></span>
                                        <?php endif; ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Product Code -->
                    <div class="mt-3 pt-2 border-t border-white/5">
                        <span class="text-[9px] text-stone-600 font-mono"><?= e($product['code']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty State -->
        <?php if (empty($products)): ?>
            <div class="text-center py-20">
                <i class="fa-solid fa-mug-hot text-red-500/20 text-5xl mb-4"></i>
                <p class="text-stone-500">Menu items are being updated. Please check back soon!</p>
            </div>
        <?php endif; ?>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     CTA
     ═══════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-20">
    <div class="max-w-3xl mx-auto px-4 text-center fade-in-up">
        <div class="glass-card p-10">
            <i class="fa-solid fa-mug-hot text-red-500 text-3xl mb-4"></i>
            <h3 class="font-display text-2xl font-black text-white mb-3">Want to Place an Order?</h3>
            <p class="text-stone-400 text-sm mb-6">Visit us in-store or reach out via WhatsApp for takeaway orders</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="contact.php" class="btn-primary text-sm">
                    <i class="fa-solid fa-location-dot"></i>
                    Find Our Location
                </a>
                <a href="feedback.php" class="btn-outline text-sm">
                    <i class="fa-solid fa-star"></i>
                    Leave a Review
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
