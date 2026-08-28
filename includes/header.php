<?php
/**
 * The Hide Out Cafe — Website Header & Navbar
 */
$settings    = getSettings();
$cafeName    = e($settings['cafe_name'] ?? 'The Hide Out Cafe');
$statusInfo  = isOpenNow();
$socialLinks = getSocialLinks();
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($settings['cafe_tagline'] ?? 'Specialty Coffee & Artisan Kitchen') ?> — <?= $cafeName ?>">
    <meta name="theme-color" content="#0a0a0a">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' — ' : '' ?><?= $cafeName ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= baseUrl() ?>/assets/img/hideout.ico">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cafe: {
                            black: '#0a0a0a',
                            dark: '#111111',
                            card: '#161616',
                            red: '#dc2626',
                            'red-light': '#ef4444',
                            'red-dark': '#b91c1c',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= rtrim(baseUrl(), '/') ?>/assets/css/style.css">
</head>
<body class="bg-cafe-black font-sans text-white antialiased">

    <!-- ═══ Navbar ═══ -->
    <nav id="navbar" class="navbar fixed top-0 left-0 right-0 z-50 transition-all duration-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Logo / Brand -->
                <a href="<?= baseUrl() ?>/" class="flex items-center gap-3 group">
                    <img src="<?= baseUrl() ?>/assets/img/hideout.jpeg" alt="The Hide Out Cafe" class="w-12 h-12 rounded-xl object-cover transform group-hover:scale-105 transition-transform">
                    <div class="hidden sm:block">
                        <span class="text-white font-extrabold text-lg tracking-tight"><?= $cafeName ?></span>
                        <div class="text-[10px] text-stone-400 -mt-0.5 tracking-wider uppercase">Specialty Coffee & Kitchen</div>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?= baseUrl() ?>/" class="text-sm font-semibold tracking-wide transition-colors <?= activeClass('index.php') ?>">
                        Home
                    </a>
                    <a href="<?= baseUrl() ?>/menu.php" class="text-sm font-semibold tracking-wide transition-colors <?= activeClass('menu.php') ?>">
                        Menu
                    </a>
                    <a href="<?= baseUrl() ?>/about.php" class="text-sm font-semibold tracking-wide transition-colors <?= activeClass('about.php') ?>">
                        About
                    </a>
                    <a href="<?= baseUrl() ?>/contact.php" class="text-sm font-semibold tracking-wide transition-colors <?= activeClass('contact.php') ?>">
                        Contact
                    </a>
                    <a href="<?= baseUrl() ?>/feedback.php" class="text-sm font-semibold tracking-wide transition-colors <?= activeClass('feedback.php') ?>">
                        Reviews
                    </a>
                </div>

                <!-- Right Side: Status + CTA -->
                <div class="hidden md:flex items-center gap-4">
                    <?php if ($statusInfo['open']): ?>
                        <span class="badge-open">
                            <span class="pulse-dot"></span>
                            Open Now
                        </span>
                    <?php else: ?>
                        <span class="badge-closed">
                            <i class="fa-regular fa-clock text-[10px]"></i>
                            <?= e($statusInfo['message']) ?>
                        </span>
                    <?php endif; ?>

                    <a href="<?= baseUrl() ?>/menu.php" class="bg-red-600 hover:bg-red-500 text-white text-xs font-bold px-5 py-2.5 rounded-full transition-all hover:-translate-y-0.5 hover:shadow-lg hover:shadow-red-900/30">
                        View Menu
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-white text-xl p-2 hover:text-red-500 transition-colors" aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- ═══ Mobile Menu Overlay ═══ -->
    <div id="mobile-menu" class="mobile-menu">
        <button id="mobile-menu-close" class="absolute top-6 right-6 text-white text-2xl hover:text-red-500 transition-colors" aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- Status Badge Mobile -->
        <div class="mb-4">
            <?php if ($statusInfo['open']): ?>
                <span class="badge-open"><span class="pulse-dot"></span> Open Now</span>
            <?php else: ?>
                <span class="badge-closed"><i class="fa-regular fa-clock text-[10px]"></i> <?= e($statusInfo['message']) ?></span>
            <?php endif; ?>
        </div>

        <a href="<?= baseUrl() ?>/" class="<?= isActivePage('index.php') ? 'text-red-500' : '' ?>">Home</a>
        <a href="<?= baseUrl() ?>/menu.php" class="<?= isActivePage('menu.php') ? 'text-red-500' : '' ?>">Menu</a>
        <a href="<?= baseUrl() ?>/about.php" class="<?= isActivePage('about.php') ? 'text-red-500' : '' ?>">About</a>
        <a href="<?= baseUrl() ?>/contact.php" class="<?= isActivePage('contact.php') ? 'text-red-500' : '' ?>">Contact</a>
        <a href="<?= baseUrl() ?>/feedback.php" class="<?= isActivePage('feedback.php') ? 'text-red-500' : '' ?>">Reviews</a>

        <!-- Social Links Mobile -->
        <div class="flex items-center gap-5 mt-6">
            <?php foreach ($socialLinks as $link): ?>
                <?php if (strtolower($link['platform']) !== 'google maps'): ?>
                    <a href="<?= e($link['url']) ?>" target="_blank" rel="noopener" class="text-stone-400 hover:text-red-500 text-xl transition-colors" title="<?= e($link['platform']) ?>">
                        <i class="<?= e($link['icon']) ?>"></i>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
