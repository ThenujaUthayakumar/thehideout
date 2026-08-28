<?php
/**
 * The Hide Out Cafe — Website Footer
 */
$footerSettings = getSettings();
$footerHours    = getOpeningHours();
$footerSocial   = getSocialLinks();
$footerStatus   = isOpenNow();
$currentDay     = date('l');
?>

    <!-- ═══ Footer ═══ -->
    <footer class="footer-section pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Footer Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

                <!-- Col 1: Brand & About -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="<?= baseUrl() ?>/assets/img/hideout.jpeg" alt="The Hide Out Cafe" class="w-10 h-10 rounded-xl object-cover">
                        <span class="text-white font-extrabold text-lg"><?= e($footerSettings['cafe_name'] ?? 'The Hide Out Cafe') ?></span>
                    </div>
                    <p class="text-stone-400 text-sm leading-relaxed mb-5">
                        <?= e($footerSettings['cafe_tagline'] ?? 'Specialty Coffee, Fresh Bakes & Chill Vibes') ?>
                    </p>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-3">
                        <?php foreach ($footerSocial as $link): ?>
                            <?php if (strtolower($link['platform']) !== 'google maps'): ?>
                                <a href="<?= e($link['url']) ?>" target="_blank" rel="noopener"
                                   class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-stone-400 hover:text-red-500 hover:border-red-500/30 hover:bg-red-500/10 transition-all text-sm"
                                   title="<?= e($link['platform']) ?>">
                                    <i class="<?= e($link['icon']) ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-sm mb-4 tracking-wide uppercase">Quick Links</h4>
                    <ul class="space-y-2.5">
                        <li><a href="<?= baseUrl() ?>/" class="text-stone-400 hover:text-red-400 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-red-600"></i> Home</a></li>
                        <li><a href="<?= baseUrl() ?>/menu.php" class="text-stone-400 hover:text-red-400 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-red-600"></i> Our Menu</a></li>
                        <li><a href="<?= baseUrl() ?>/about.php" class="text-stone-400 hover:text-red-400 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-red-600"></i> About Us</a></li>
                        <li><a href="<?= baseUrl() ?>/contact.php" class="text-stone-400 hover:text-red-400 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-red-600"></i> Contact</a></li>
                        <li><a href="<?= baseUrl() ?>/feedback.php" class="text-stone-400 hover:text-red-400 text-sm transition-colors flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-red-600"></i> Customer Reviews</a></li>
                    </ul>
                </div>

                <!-- Col 3: Opening Hours -->
                <div>
                    <h4 class="text-white font-bold text-sm mb-4 tracking-wide uppercase">Opening Hours</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm text-stone-400">
                            <span class="flex items-center gap-2">Monday — Sunday</span>
                            <span>9:00 AM – 11:00 PM</span>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="mt-3">
                        <?php if ($footerStatus['open']): ?>
                            <span class="badge-open text-[10px]">
                                <span class="pulse-dot" style="width:6px;height:6px"></span>
                                Open · Closes <?= e($footerStatus['closes_at'] ?? '') ?>
                            </span>
                        <?php else: ?>
                            <span class="badge-closed text-[10px]">
                                <i class="fa-regular fa-clock text-[8px]"></i>
                                <?= e($footerStatus['message']) ?>
                                <?php if (!empty($footerStatus['opens_at'])): ?>
                                    · Opens <?= e($footerStatus['opens_at']) ?>
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Col 4: Contact Info -->
                <div>
                    <h4 class="text-white font-bold text-sm mb-4 tracking-wide uppercase">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm">
                            <i class="fa-solid fa-location-dot text-red-500 mt-0.5"></i>
                            <span class="text-stone-400"><?= e($footerSettings['cafe_address'] ?? '') ?></span>
                        </li>
                        <li class="flex items-center gap-3 text-sm">
                            <i class="fa-solid fa-phone text-red-500"></i>
                            <a href="tel:<?= e($footerSettings['cafe_phone'] ?? '') ?>" class="text-stone-400 hover:text-red-400 transition-colors"><?= e($footerSettings['cafe_phone'] ?? '') ?></a>
                        </li>
                        <li class="flex items-center gap-3 text-sm">
                            <i class="fa-solid fa-envelope text-red-500"></i>
                            <a href="mailto:<?= e($footerSettings['cafe_email'] ?? '') ?>" class="text-stone-400 hover:text-red-400 transition-colors"><?= e($footerSettings['cafe_email'] ?? '') ?></a>
                        </li>
                    </ul>

                    <!-- WhatsApp CTA -->
                    <?php
                    $waLink = '';
                    foreach ($footerSocial as $s) {
                        if (strtolower($s['platform']) === 'whatsapp') { $waLink = $s['url']; break; }
                    }
                    ?>
                    <?php if ($waLink): ?>
                        <a href="<?= e($waLink) ?>" target="_blank" class="mt-4 inline-flex items-center gap-2 bg-green-600/20 text-green-400 border border-green-600/30 px-4 py-2 rounded-full text-xs font-semibold hover:bg-green-600/30 transition-all">
                            <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/5 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-stone-500 text-xs">
                    &copy; <?= date('Y') ?> <?= e($footerSettings['cafe_name'] ?? 'The Hide Out Cafe') ?>. All rights reserved.
                </p>
                <p class="text-stone-600 text-[10px] flex items-center gap-1.5">
                    <i class="fa-solid fa-mug-hot text-red-600/40"></i>
                    Crafted with love in Colombo, Sri Lanka
                </p>
            </div>
        </div>
    </footer>

    <!-- Main JS -->
    <script src="<?= rtrim(baseUrl(), '/') ?>/assets/js/main.js"></script>
</body>
</html>
