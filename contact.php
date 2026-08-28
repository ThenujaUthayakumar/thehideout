<?php
/**
 * The Hide Out Cafe — Contact Page
 */
require_once __DIR__ . '/config/functions.php';

$pageTitle = 'Contact Us';
$settings  = getSettings();
$social    = getSocialLinks();

require_once __DIR__ . '/includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
     ═══════════════════════════════════════════════════════════ -->
<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[150px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center fade-in-up">
            <span class="text-red-500 text-xs font-bold uppercase tracking-[4px]">Get in Touch</span>
            <h1 class="font-display text-4xl sm:text-5xl font-black text-white mt-3">Contact Us</h1>
            <div class="section-divider mt-4"></div>
            <p class="text-stone-400 text-sm mt-4 max-w-lg mx-auto">Have a question or want to make a large reservation? We'd love to hear from you.</p>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     CONTACT INFO CARDS
     ═══════════════════════════════════════════════════════════ -->
<section class="py-12 relative z-10 -mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="contact-card fade-in-up">
                <div class="icon-wrap"><i class="fa-solid fa-location-dot"></i></div>
                <h3 class="text-white font-bold text-base mb-2">Visit Us</h3>
                <p class="text-stone-400 text-sm leading-relaxed"><?= e($settings['cafe_address'] ?? 'No. 45 Beach Road, Colombo 03, Sri Lanka') ?></p>
            </div>

            <div class="contact-card fade-in-up" style="transition-delay: 100ms">
                <div class="icon-wrap"><i class="fa-solid fa-phone"></i></div>
                <h3 class="text-white font-bold text-base mb-2">Call Us</h3>
                <p class="text-stone-400 text-sm leading-relaxed mb-3">Reach out for quick questions or takeaway orders.</p>
                <a href="tel:<?= e($settings['cafe_phone'] ?? '') ?>" class="text-red-500 font-bold hover:text-red-400 transition-colors">
                    <?= e($settings['cafe_phone'] ?? '') ?>
                </a>
            </div>

            <div class="contact-card fade-in-up" style="transition-delay: 200ms">
                <div class="icon-wrap"><i class="fa-solid fa-envelope"></i></div>
                <h3 class="text-white font-bold text-base mb-2">Email Us</h3>
                <p class="text-stone-400 text-sm leading-relaxed mb-3">For business inquiries or large bookings.</p>
                <a href="mailto:<?= e($settings['cafe_email'] ?? '') ?>" class="text-red-500 font-bold hover:text-red-400 transition-colors">
                    <?= e($settings['cafe_email'] ?? '') ?>
                </a>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     CONTACT FORM & MAP
     ═══════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            
            <!-- Contact Form -->
            <div class="fade-in-left">
                <h2 class="font-display text-3xl font-black text-white mb-2">Send a Message</h2>
                <p class="text-stone-400 text-sm mb-8">Fill out the form below and our team will get back to you as soon as possible.</p>

                <form id="contact-form" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Your Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required class="form-input" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Email Address</label>
                            <input type="email" name="email" class="form-input" placeholder="john@example.com">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Subject</label>
                        <input type="text" name="subject" class="form-input" placeholder="How can we help?">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-400 mb-2 uppercase tracking-wide">Message <span class="text-red-500">*</span></label>
                        <textarea name="message" required class="form-input" placeholder="Write your message here..."></textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full sm:w-auto">
                        <i class="fa-solid fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Map & Socials -->
            <div class="fade-in-right flex flex-col">
                <h2 class="font-display text-3xl font-black text-white mb-2">Find Us Here</h2>
                <p class="text-stone-400 text-sm mb-6">Drop by for a coffee. We're located in the heart of Colombo.</p>
                
                <!-- Google Maps Embedded -->
                <div class="glass-card flex-1 min-h-[300px] relative overflow-hidden rounded-2xl group flex items-center justify-center mb-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.63162584852!2d79.77380235061614!3d6.921833527265787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2sus!4v1714571987515!5m2!1sen!2sus" width="100%" height="100%" style="border:0; position:absolute; top:0; left:0; width:100%; height:100%; filter: invert(90%) hue-rotate(180deg);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Connect Socials -->
                <div>
                    <h4 class="text-white font-bold text-sm mb-4 tracking-wide uppercase">Connect With Us</h4>
                    <div class="flex items-center gap-4">
                        <?php foreach ($social as $link): ?>
                            <?php if (strtolower($link['platform']) !== 'google maps'): ?>
                                <a href="<?= e($link['url']) ?>" target="_blank" rel="noopener" 
                                   class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-stone-400 hover:text-red-500 hover:border-red-500/30 hover:bg-red-500/10 transition-all text-xl"
                                   title="<?= e($link['platform']) ?>">
                                    <i class="<?= e($link['icon']) ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
