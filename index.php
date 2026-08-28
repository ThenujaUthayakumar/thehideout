<?php
/**
 * The Hide Out Cafe — Home Page
 * Hero + Featured Menu Items + About Snippet + Testimonials + Opening Hours
 */
require_once __DIR__ . '/config/functions.php';

$pageTitle    = 'Welcome';
$settings     = getSettings();
$featured     = getFeaturedProducts(6);
$testimonials = getLatestTestimonials(3);
$hours        = getOpeningHours();
$status       = isOpenNow();
$socialLinks  = getSocialLinks();
$currentDay   = date('l');

require_once __DIR__ . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════════════════════ -->
<section class="hero-section relative">
    <div class="hero-bg"></div>
    <div class="hero-glow" style="top: 20%; left: 10%;"></div>
    <div class="hero-glow" style="bottom: 10%; right: 5%; animation-delay: -3s;"></div>

    <!-- Transparent Background Logo -->
    <div class="absolute inset-0 z-0 flex items-center justify-center pointer-events-none opacity-15">
        <img src="<?= baseUrl() ?>/assets/img/hideout.jpeg" alt="" class="w-[350px] sm:w-[500px] md:w-[650px] h-auto object-contain">
    </div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">

        <!-- Status Badge -->
        <div class="mb-6 fade-in-up">
            <?php if ($status['open']): ?>
                <span class="badge-open">
                    <span class="pulse-dot"></span>
                    Open Now · Closes <?= e($status['closes_at'] ?? '') ?>
                </span>
            <?php else: ?>
                <span class="badge-closed">
                    <i class="fa-regular fa-clock text-[10px]"></i>
                    <?= e($status['message']) ?>
                    <?php if (!empty($status['opens_at'])): ?>
                        · Opens <?= e($status['opens_at']) ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Main Heading -->
        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-tight mb-6 fade-in-up">
            Welcome to<br>
            <span class="text-red-500"><?= e($settings['cafe_name'] ?? 'The Hide Out Cafe') ?></span>
        </h1>

        <!-- Tagline -->
        <p class="text-stone-400 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed fade-in-up">
            <?= e($settings['cafe_tagline'] ?? 'Specialty Coffee, Fresh Bakes & Chill Vibes') ?>
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 fade-in-up">
            <a href="menu.php" class="btn-primary text-sm">
                <i class="fa-solid fa-utensils"></i>
                Explore Our Menu
            </a>
            <a href="contact.php" class="btn-outline text-sm">
                <i class="fa-solid fa-location-dot"></i>
                Find Us
            </a>
        </div>

        <!-- Scroll Indicator -->
        <div class="mt-16 fade-in-up">
            <a href="#featured" class="text-stone-500 hover:text-red-500 transition-colors">
                <i class="fa-solid fa-chevron-down animate-bounce text-lg"></i>
            </a>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     FEATURED MENU ITEMS
     ═══════════════════════════════════════════════════════════ -->
<section id="featured" class="py-20 sm:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center mb-14 fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">From Our Kitchen</span>
            <h2 class="font-display text-3xl sm:text-4xl font-black text-white mt-3">Featured Picks</h2>
            <div class="section-divider mt-4"></div>
            <p class="text-stone-400 text-sm mt-4 max-w-lg mx-auto">Hand-picked favorites from our artisan menu — crafted with love and the finest ingredients</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($featured as $index => $product): ?>
                <div class="product-card fade-in-up" style="transition-delay: <?= $index * 100 ?>ms">
                    <!-- Category Badge -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-red-500/70 flex items-center gap-1.5">
                            <i class="fa-solid <?= e($product['category_icon'] ?? 'fa-mug-hot') ?> text-red-500/50"></i>
                            <?= e($product['category_name']) ?>
                        </span>
                        <span class="text-red-500 font-extrabold text-lg"><?= formatPrice($product['price']) ?></span>
                    </div>

                    <!-- Product Info -->
                    <h3 class="text-white font-bold text-base mb-2"><?= e($product['name']) ?></h3>
                    <p class="text-stone-400 text-xs leading-relaxed"><?= e($product['description'] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- View Full Menu CTA -->
        <div class="text-center mt-12 fade-in-up">
            <a href="menu.php" class="btn-outline text-sm">
                <i class="fa-solid fa-arrow-right"></i>
                View Full Menu
            </a>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     ABOUT SNIPPET
     ═══════════════════════════════════════════════════════════ -->
<section class="py-20 sm:py-28 relative overflow-hidden">
    <!-- Subtle red glow -->
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-red-600/5 rounded-full blur-[100px] -translate-y-1/2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Text Content -->
            <div class="fade-in-left">
                <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">Our Story</span>
                <h2 class="font-display text-3xl sm:text-4xl font-black text-white mt-3 mb-6">More Than Just <span class="text-red-500">Coffee</span></h2>
                <p class="text-stone-400 text-sm leading-relaxed mb-4">
                    Nestled along Colombo's vibrant Beach Road, The Hide Out Cafe is where specialty coffee meets artisan cuisine. We source the finest single-origin beans, bake our pastries fresh daily, and create a space where every visit feels like coming home.
                </p>
                <p class="text-stone-400 text-sm leading-relaxed mb-8">
                    Whether you're here for our signature Flat White, a flaky butter croissant, or simply the cozy ambiance — we're always brewing something special for you.
                </p>
                <a href="about.php" class="btn-primary text-sm">
                    <i class="fa-solid fa-heart"></i>
                    Learn More About Us
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 gap-4 fade-in-right">
                <div class="glass-card p-6 text-center">
                    <div class="text-3xl font-black text-red-500 mb-1">24+</div>
                    <div class="text-stone-400 text-xs">Menu Items</div>
                </div>
                <div class="glass-card p-6 text-center">
                    <div class="text-3xl font-black text-red-500 mb-1">8</div>
                    <div class="text-stone-400 text-xs">Categories</div>
                </div>
                <div class="glass-card p-6 text-center">
                    <div class="text-3xl font-black text-red-500 mb-1">4.8</div>
                    <div class="text-stone-400 text-xs flex items-center justify-center gap-1"><i class="fa-solid fa-star text-red-500 text-[10px]"></i> Avg Rating</div>
                </div>
                <div class="glass-card p-6 text-center">
                    <div class="text-3xl font-black text-red-500 mb-1">7</div>
                    <div class="text-stone-400 text-xs">Days Open</div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     OPENING HOURS
     ═══════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card p-8 sm:p-10 fade-in-up">
            <div class="text-center mb-8">
                <i class="fa-regular fa-clock text-red-500 text-2xl mb-3"></i>
                <h3 class="font-display text-2xl font-black text-white">Opening Hours</h3>
                <div class="section-divider mt-3"></div>
            </div>

            <table class="hours-table w-full text-sm">
                <tbody>
                    <tr class="today">
                        <td class="font-semibold text-red-400 flex items-center gap-2 py-3">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            Monday — Sunday
                            <span class="text-[10px] font-bold text-red-500/60 uppercase">(Everyday)</span>
                        </td>
                        <td class="text-right text-red-400 font-semibold py-3">
                            9:00 AM — 11:00 PM
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     TESTIMONIALS
     ═══════════════════════════════════════════════════════════ -->
<?php if (!empty($testimonials)): ?>
<section class="py-20 sm:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">What People Say</span>
            <h2 class="font-display text-3xl sm:text-4xl font-black text-white mt-3">Customer Love</h2>
            <div class="section-divider mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($testimonials as $index => $review): ?>
                <div class="testimonial-card fade-in-up" style="transition-delay: <?= $index * 120 ?>ms">
                    <div class="mb-3"><?= renderStars((int)$review['rating']) ?></div>
                    <p class="text-stone-300 text-sm leading-relaxed mb-4 italic">"<?= e($review['message']) ?>"</p>
                    <div class="flex items-center gap-3 pt-3 border-t border-white/5">
                        <div class="w-9 h-9 rounded-full bg-red-600/20 flex items-center justify-center text-red-400 font-bold text-xs">
                            <?= strtoupper(substr($review['name'], 0, 1)) ?>
                        </div>
                        <div>
                            <div class="text-white text-sm font-semibold"><?= e($review['name']) ?></div>
                            <div class="text-stone-500 text-xs"><?= timeAgo($review['created_at']) ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-10 fade-in-up">
            <a href="feedback.php" class="btn-outline text-sm">
                <i class="fa-solid fa-comments"></i>
                Read All Reviews
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════════════════════════
     CTA BANNER
     ═══════════════════════════════════════════════════════════ -->
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-red-900/20 via-transparent to-red-900/20"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 fade-in-up">
        <h2 class="font-display text-3xl sm:text-4xl font-black text-white mb-4">Ready to Experience <span class="text-red-500">The Hide Out</span>?</h2>
        <p class="text-stone-400 text-sm mb-8 max-w-xl mx-auto">Come for the coffee, stay for the vibes. We're waiting to brew your perfect cup.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="contact.php" class="btn-primary text-sm">
                <i class="fa-solid fa-map-pin"></i>
                Visit Us Today
            </a>
            <?php
            $waLink = '';
            foreach ($socialLinks as $s) {
                if (strtolower($s['platform']) === 'whatsapp') { $waLink = $s['url']; break; }
            }
            ?>
            <?php if ($waLink): ?>
                <a href="<?= e($waLink) ?>" target="_blank" class="btn-outline text-sm !border-green-600/50 !text-green-400 hover:!bg-green-600/10">
                    <i class="fa-brands fa-whatsapp"></i>
                    WhatsApp Us
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
