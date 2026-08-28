/**
 * The Hide Out Cafe — Website JavaScript
 * Handles navbar scroll, mobile menu, category filtering,
 * star rating, feedback form, and scroll animations.
 */

document.addEventListener('DOMContentLoaded', () => {
    initNavbar();
    initMobileMenu();
    initScrollAnimations();
    initCategoryFilter();
    initStarRating();
    initFeedbackForm();
    initContactForm();
    initSmoothScroll();
});

// ─── Navbar Scroll Effect ───────────────────────────────────
function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    function handleScroll() {
        if (window.scrollY > 60) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
}

// ─── Mobile Menu Toggle ─────────────────────────────────────
function initMobileMenu() {
    const btn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');
    if (!btn || !menu) return;

    btn.addEventListener('click', () => {
        menu.classList.add('open');
        document.body.style.overflow = 'hidden';
    });

    function closeMenu() {
        menu.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (closeBtn) closeBtn.addEventListener('click', closeMenu);

    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
}

// ─── Scroll Animations (IntersectionObserver) ───────────────
function initScrollAnimations() {
    const elements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right');
    if (!elements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 80);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => observer.observe(el));
}

// ─── Menu Category Filtering ────────────────────────────────
function initCategoryFilter() {
    const pills = document.querySelectorAll('.category-pill');
    const products = document.querySelectorAll('.product-item');
    if (!pills.length || !products.length) return;

    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            const category = pill.dataset.category;

            // Update active pill
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            // Filter products
            products.forEach(product => {
                const productCat = product.dataset.category;
                if (category === 'all' || productCat === category) {
                    product.style.display = '';
                    product.style.opacity = '0';
                    product.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        product.style.opacity = '1';
                        product.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    product.style.display = 'none';
                }
            });

            // Update product count
            const countEl = document.getElementById('product-count');
            if (countEl) {
                const visible = document.querySelectorAll('.product-item[style=""], .product-item:not([style*="display: none"])').length;
                countEl.textContent = visible;
            }
        });
    });
}

// ─── Star Rating Selector ───────────────────────────────────
function initStarRating() {
    const container = document.querySelector('.star-selector');
    if (!container) return;

    const stars = container.querySelectorAll('.star');
    const input = document.getElementById('rating-input');
    let currentRating = 5;

    stars.forEach(star => {
        star.addEventListener('mouseenter', () => {
            const val = parseInt(star.dataset.value);
            stars.forEach(s => {
                const sv = parseInt(s.dataset.value);
                s.classList.toggle('hovered', sv <= val);
            });
        });

        star.addEventListener('mouseleave', () => {
            stars.forEach(s => s.classList.remove('hovered'));
        });

        star.addEventListener('click', () => {
            currentRating = parseInt(star.dataset.value);
            if (input) input.value = currentRating;
            stars.forEach(s => {
                const sv = parseInt(s.dataset.value);
                s.classList.toggle('active', sv <= currentRating);
            });
        });
    });

    // Set initial state
    stars.forEach(s => {
        s.classList.toggle('active', parseInt(s.dataset.value) <= currentRating);
    });
}

// ─── Feedback Form AJAX ─────────────────────────────────────
function initFeedbackForm() {
    const form = document.getElementById('feedback-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="spinner"></span> Submitting...';
        btn.disabled = true;

        try {
            const formData = new FormData(form);
            const response = await fetch('api/submit_feedback.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showToast('Thank you! Your review has been submitted for approval.', 'success');
                form.reset();
                // Reset stars
                document.querySelectorAll('.star-selector .star').forEach(s => {
                    s.classList.toggle('active', parseInt(s.dataset.value) <= 5);
                });
                const ratingInput = document.getElementById('rating-input');
                if (ratingInput) ratingInput.value = 5;
            } else {
                showToast(data.message || 'Something went wrong. Please try again.', 'error');
            }
        } catch (err) {
            showToast('Network error. Please check your connection.', 'error');
        }

        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

// ─── Contact Form AJAX ──────────────────────────────────────
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="spinner"></span> Sending...';
        btn.disabled = true;

        try {
            const formData = new FormData(form);
            formData.append('type', 'inquiry');
            const response = await fetch('api/submit_feedback.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showToast('Message sent! We\'ll get back to you soon.', 'success');
                form.reset();
            } else {
                showToast(data.message || 'Failed to send. Please try again.', 'error');
            }
        } catch (err) {
            showToast('Network error. Please check your connection.', 'error');
        }

        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

// ─── Toast Notifications ────────────────────────────────────
function showToast(message, type = 'success') {
    const existing = document.querySelector('.toast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.add('show');
    });

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 4000);
}

// ─── Smooth Scroll for Anchor Links ─────────────────────────
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
}
