<?php
/**
 * The Hide Out Cafe — About Page
 */
require_once __DIR__ . '/config/functions.php';

$pageTitle = 'About Us';
$settings  = getSettings();
$hours     = getOpeningHours();
$currentDay = date('l');

require_once __DIR__ . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════════════════════════ -->
<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 relative overflow-hidden">
    <div class="absolute bottom-0 left-1/2 w-[600px] h-[400px] bg-red-600/5 rounded-full blur-[120px] -translate-x-1/2"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">Get to Know Us</span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-white mt-3">About <span class="text-red-500">The Hide Out</span></h1>
            <div class="section-divider mt-4"></div>
            <p class="text-stone-400 text-sm mt-4 max-w-lg mx-auto">A story brewed with passion, served with love</p>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     OUR STORY
     ═══════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- Text -->
            <div class="fade-in-left">
                <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">Our Story</span>
                <h2 class="font-display text-3xl sm:text-4xl font-black text-white mt-3 mb-6">Where Every Cup Tells a Story</h2>

                <div class="space-y-4 text-stone-400 text-sm leading-relaxed">
                    <p>
                        <span class="text-white font-semibold">The Hide Out</span> was born from a simple dream — to create a welcoming space where delicious food, refreshing drinks, and warm hospitality come together. Located in the heart of Jaffna, our cafe is a place for friends, families, and food lovers to relax, connect, and enjoy memorable moments.
                    </p>
                    <p>
                       What started as a passion for bringing people together has grown into a cozy cafe experience where every detail matters. From mouthwatering burgers and freshly prepared waffles to refreshing mojitos, creamy milkshakes, and a variety of delicious treats, we aim to serve something special for everyone.
                    </p>
                    <p>
                        Every cup we serve is a reflection of our commitment to quality — from the ethically sourced beans we roast to perfection, to the locally sourced ingredients in our kitchen. At The Hide Out, we believe that great coffee is more than a drink; it's an experience.
                    </p>
                    <p>
                        At The Hideout, we believe that a great cafe is about more than just food and drinks. It's about the atmosphere, the people, the conversations, and the memories created along the way.

                        Whether you're stopping by for a quick refreshment, enjoying a meal with friends, or simply looking for a little escape from your busy day, we're always happy to welcome you.
                    </p>
                </div>
            </div>

            <!-- Visual Card Stack -->
            <div class="space-y-4 fade-in-right">
                <div class="glass-card p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-red-600/15 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-seedling text-red-500 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Single-Origin Beans</h4>
                        <p class="text-stone-400 text-xs mt-1">Ethically sourced, freshly roasted in small batches for peak flavor</p>
                    </div>
                </div>

                <div class="glass-card p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-red-600/15 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-bread-slice text-red-500 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Baked Fresh Daily</h4>
                        <p class="text-stone-400 text-xs mt-1">French croissants, sourdough, and pastries crafted each morning</p>
                    </div>
                </div>

                <div class="glass-card p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-red-600/15 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-users text-red-500 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Community-Driven</h4>
                        <p class="text-stone-400 text-xs mt-1">A warm, welcoming space for locals, remote workers, and travelers alike</p>
                    </div>
                </div>

                <div class="glass-card p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-red-600/15 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-leaf text-red-500 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Sustainability First</h4>
                        <p class="text-stone-400 text-xs mt-1">Eco-friendly packaging, plant-milk options, and responsible sourcing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     WHAT WE OFFER
     ═══════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24 relative">
    <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/5 rounded-full blur-[120px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-14 fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">What We Offer</span>
            <h2 class="font-display text-3xl sm:text-4xl font-black text-white mt-3">The Hide Out Experience</h2>
            <div class="section-divider mt-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="glass-card p-8 text-center fade-in-up">
                <div class="w-16 h-16 bg-red-600/15 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-mug-hot text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Delicious Food</h3>
                <p class="text-stone-400 text-xs leading-relaxed">Enjoy a selection of tasty favourites, including juicy burgers, hot dogs, and delicious bites, freshly prepared to satisfy your cravings.</p>
            </div>

            <div class="glass-card p-8 text-center fade-in-up" style="transition-delay: 100ms">
                <div class="w-16 h-16 bg-red-600/15 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-utensils text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Waffles & Sweet Treats</h3>
                <p class="text-stone-400 text-xs leading-relaxed">Treat yourself to delicious waffles with chocolate, Nutella, and tempting toppings. Perfect for anyone with a sweet tooth.</p>
            </div>

            <div class="glass-card p-8 text-center fade-in-up" style="transition-delay: 200ms">
                <div class="w-16 h-16 bg-red-600/15 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-drink text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Refreshing Drinks</h3>
                <p class="text-stone-400 text-xs leading-relaxed">Beat the heat with our refreshing mojitos, iced teas, creamy milkshakes, and other delicious cold beverages.</p>
            </div>

            <div class="glass-card p-8 text-center fade-in-up" style="transition-delay: 100ms">
                <div class="w-16 h-16 bg-red-600/15 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-couch text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">A Cozy Place to Relax</h3>
                <p class="text-stone-400 text-xs leading-relaxed">Enjoy a comfortable indoor atmosphere where you can take a break, catch up with friends, spend time with family, or simply unwind.</p>
            </div>

            <div class="glass-card p-8 text-center fade-in-up" style="transition-delay: 200ms">
                <div class="w-16 h-16 bg-red-600/15 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-wifi text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Made for Good Moments</h3>
                <p class="text-stone-400 text-xs leading-relaxed">Whether it's a casual meetup, a little celebration, or an everyday food craving, The Hideout is a place to enjoy good food and create happy memories.</p>
            </div>

            <div class="glass-card p-8 text-center fade-in-up" style="transition-delay: 300ms">
                <div class="w-16 h-16 bg-red-600/15 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-award text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-white font-bold text-base mb-2">Friendly Hospitality</h3>
                <p class="text-stone-400 text-xs leading-relaxed">We believe every guest deserves a warm welcome. Our goal is to make every visit enjoyable with friendly service, delicious choices, and great vibes.</p>
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
                <h3 class="font-display text-2xl font-black text-white">Visit Us</h3>
                <p class="text-stone-400 text-xs mt-2"><?= e($settings['cafe_address'] ?? '') ?></p>
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

            <div class="text-center mt-6">
                <a href="contact" class="btn-primary text-sm">
                    <i class="fa-solid fa-location-dot"></i>
                    Get Directions
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
