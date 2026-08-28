<?php
/**
 * The Hide Out Cafe — Customer Reviews
 * Displays approved reviews and allows submitting new ones.
 */
require_once __DIR__ . '/config/functions.php';

$pageTitle = 'Customer Reviews';
$reviews   = getApprovedFeedback(100);

require_once __DIR__ . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════════════════════════ -->
<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[150px]"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-red-600/5 rounded-full blur-[120px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">Community Voices</span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-white mt-3">Customer Love</h1>
            <div class="section-divider mt-4"></div>
            <p class="text-stone-400 text-sm mt-4 max-w-lg mx-auto">See what our community is saying about their experiences at The Hide Out.</p>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SUBMIT REVIEW FORM
     ═══════════════════════════════════════════════════════════ -->
<section class="py-12 relative z-20 -mt-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card p-8 sm:p-10 fade-in-up border-red-500/20 shadow-2xl shadow-red-900/10">
            <div class="text-center mb-8">
                <i class="fa-solid fa-pen-nib text-red-500 text-2xl mb-3"></i>
                <h3 class="font-display text-2xl font-black text-white">Share Your Experience</h3>
                <p class="text-stone-400 text-sm mt-2">We value your feedback. Leave a review to let us know how we did!</p>
            </div>

            <form id="feedback-form" class="space-y-6">
                <!-- Hidden inputs -->
                <input type="hidden" name="type" value="review">
                <input type="hidden" name="rating" id="rating-input" value="5">

                <!-- Star Rating -->
                <div class="text-center">
                    <label class="block text-xs font-bold text-stone-400 mb-3 uppercase tracking-wide">How was your visit?</label>
                    <div class="star-selector flex justify-center gap-2">
                        <i class="fa-solid fa-star star active" data-value="1"></i>
                        <i class="fa-solid fa-star star active" data-value="2"></i>
                        <i class="fa-solid fa-star star active" data-value="3"></i>
                        <i class="fa-solid fa-star star active" data-value="4"></i>
                        <i class="fa-solid fa-star star active" data-value="5"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Your Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="form-input" placeholder="e.g. Jane Doe">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Email (Optional)</label>
                        <input type="email" name="email" class="form-input" placeholder="Used only for follow-ups">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Your Review <span class="text-red-500">*</span></label>
                    <textarea name="message" required class="form-input" placeholder="Tell us about the coffee, the food, or the vibes..."></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-comment-dots"></i>
                        Submit Review
                    </button>
                    <p class="text-stone-500 text-[10px] mt-3 uppercase tracking-wider">Reviews are moderated before publishing</p>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     ALL REVIEWS GRID
     ═══════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-10 fade-in-up">
            <h2 class="font-display text-2xl font-black text-white">Recent Reviews</h2>
            <span class="text-stone-400 text-sm font-semibold bg-white/5 px-4 py-1.5 rounded-full border border-white/10">
                <?= count($reviews) ?> Reviews
            </span>
        </div>

        <?php if (!empty($reviews)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($reviews as $index => $review): ?>
                    <div class="testimonial-card fade-in-up" style="transition-delay: <?= ($index % 9) * 100 ?>ms">
                        <div class="flex items-center justify-between mb-4">
                            <?= renderStars((int)$review['rating']) ?>
                            <span class="text-stone-500 text-[10px] font-medium tracking-wide uppercase">
                                <?= date('M d, Y', strtotime($review['created_at'])) ?>
                            </span>
                        </div>
                        
                        <p class="text-stone-300 text-sm leading-relaxed mb-6 italic min-h-[60px]">
                            "<?= e($review['message']) ?>"
                        </p>
                        
                        <div class="flex items-center gap-3 pt-4 border-t border-white/5 mt-auto">
                            <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center text-red-400 font-bold text-sm">
                                <?= strtoupper(substr($review['name'], 0, 1)) ?>
                            </div>
                            <div>
                                <div class="text-white text-sm font-bold"><?= e($review['name']) ?></div>
                                <div class="text-stone-500 text-[10px] font-medium flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check text-green-500/70"></i> Verified Customer
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-20 glass-card">
                <i class="fa-regular fa-comments text-red-500/30 text-5xl mb-4"></i>
                <h3 class="text-white font-bold text-lg mb-2">No reviews yet</h3>
                <p class="text-stone-400 text-sm">Be the first to leave a review and share your experience!</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
