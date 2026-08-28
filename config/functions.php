<?php
/**
 * The Hide Out Cafe — Website Helper Functions
 * All data-fetching functions that pull from cafe_pos_db.
 */
require_once __DIR__ . '/database.php';

// ─── Security / Formatting ──────────────────────────────────

function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

function sanitize($data) {
    if (is_array($data)) return array_map('sanitize', $data);
    return trim(strip_tags((string)$data));
}

// ─── Settings (from POS settings table) ─────────────────────

function getSettings(?string $key = null) {
    static $settings = null;
    if ($settings === null) {
        try {
            $rows = db()->fetchAll("SELECT setting_key, setting_value FROM settings");
            $settings = [];
            foreach ($rows as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        } catch (Exception $e) {
            $settings = [
                'cafe_name'      => 'The Hide Out Cafe',
                'cafe_tagline'   => 'Specialty Coffee, Fresh Bakes & Chill Vibes - Sri Lanka',
                'cafe_phone'     => '+94 77 123 4567',
                'cafe_email'     => 'hello@thehideoutcafe.lk',
                'cafe_address'   => 'No. 45 Beach Road, Colombo 03, Sri Lanka',
                'currency_symbol'=> 'Rs.',
                'currency_code'  => 'LKR',
            ];
        }
    }
    return $key !== null ? ($settings[$key] ?? null) : $settings;
}

// ─── Categories ─────────────────────────────────────────────

function getCategories(): array {
    try {
        return db()->fetchAll("SELECT * FROM categories WHERE status = 'active' ORDER BY sort_order ASC");
    } catch (Exception $e) {
        return [];
    }
}

// ─── Products ───────────────────────────────────────────────

function getActiveProducts(?int $categoryId = null): array {
    try {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug, c.icon as category_icon 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.status = 'active' AND c.status = 'active'";
        $params = [];
        if ($categoryId) {
            $sql .= " AND p.category_id = :cat_id";
            $params[':cat_id'] = $categoryId;
        }
        $sql .= " ORDER BY c.sort_order ASC, p.name ASC";
        $stmt = pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

function getFeaturedProducts(int $limit = 6): array {
    try {
        $stmt = pdo()->prepare(
            "SELECT p.*, c.name as category_name, c.icon as category_icon 
             FROM products p 
             JOIN categories c ON p.category_id = c.id 
             WHERE p.status = 'active' AND c.status = 'active' 
             ORDER BY RAND() 
             LIMIT :lim"
        );
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

function getAllProductVariants(): array {
    try {
        $rows = db()->fetchAll("SELECT * FROM product_variants ORDER BY product_id, extra_price ASC");
        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['product_id']][] = $row;
        }
        return $grouped;
    } catch (Exception $e) {
        return [];
    }
}

// ─── Opening Hours ──────────────────────────────────────────

function getOpeningHours(): array {
    try {
        return db()->fetchAll("SELECT * FROM website_hours ORDER BY day_order ASC");
    } catch (Exception $e) {
        return [];
    }
}

function isOpenNow(): array {
    $hours = getOpeningHours();
    $currentDay  = date('l');
    $currentTime = date('H:i:s');

    foreach ($hours as $h) {
        if (strcasecmp($h['day_name'], $currentDay) === 0) {
            if ($h['is_closed']) {
                return ['open' => false, 'message' => 'Closed Today'];
            }
            if ($currentTime >= $h['open_time'] && $currentTime <= $h['close_time']) {
                return [
                    'open'      => true,
                    'message'   => 'Open Now',
                    'closes_at' => date('g:i A', strtotime($h['close_time']))
                ];
            } else {
                if ($currentTime < $h['open_time']) {
                    return [
                        'open'     => false,
                        'message'  => 'Closed',
                        'opens_at' => date('g:i A', strtotime($h['open_time']))
                    ];
                }
                return ['open' => false, 'message' => 'Closed for Today'];
            }
        }
    }
    return ['open' => false, 'message' => 'Hours Unavailable'];
}

// ─── Social Links ───────────────────────────────────────────

function getSocialLinks(): array {
    try {
        return db()->fetchAll("SELECT * FROM website_social_links WHERE is_active = 1 ORDER BY sort_order ASC");
    } catch (Exception $e) {
        return [];
    }
}

// ─── Customer Feedback ──────────────────────────────────────

function getApprovedFeedback(int $limit = 50): array {
    try {
        $stmt = pdo()->prepare(
            "SELECT * FROM website_feedback 
             WHERE is_approved = 1 AND type = 'review' 
             ORDER BY created_at DESC 
             LIMIT :lim"
        );
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

function getLatestTestimonials(int $limit = 3): array {
    try {
        $stmt = pdo()->prepare(
            "SELECT * FROM website_feedback 
             WHERE is_approved = 1 AND type = 'review' AND rating >= 4
             ORDER BY created_at DESC 
             LIMIT :lim"
        );
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

// ─── Formatting Helpers ─────────────────────────────────────

function formatPrice($amount): string {
    $symbol = getSettings('currency_symbol') ?? 'Rs.';
    return $symbol . ' ' . number_format((float)$amount, 2);
}

function renderStars(int $rating): string {
    $html = '<div class="flex items-center gap-0.5">';
    for ($i = 1; $i <= 5; $i++) {
        $html .= $i <= $rating
            ? '<i class="fa-solid fa-star text-red-500 text-sm"></i>'
            : '<i class="fa-regular fa-star text-stone-600 text-sm"></i>';
    }
    $html .= '</div>';
    return $html;
}

function timeAgo(string $datetime): string {
    $now  = new DateTime();
    $ago  = new DateTime($datetime);
    $diff = $now->diff($ago);

    if ($diff->y > 0) return $diff->y . ' year'  . ($diff->y > 1 ? 's' : '') . ' ago';
    if ($diff->m > 0) return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
    if ($diff->d > 0) return $diff->d . ' day'   . ($diff->d > 1 ? 's' : '') . ' ago';
    if ($diff->h > 0) return $diff->h . ' hour'  . ($diff->h > 1 ? 's' : '') . ' ago';
    if ($diff->i > 0) return $diff->i . ' min'   . ($diff->i > 1 ? 's' : '') . ' ago';
    return 'Just now';
}

function formatTime(?string $time): string {
    if (empty($time)) return '-';
    return date('g:i A', strtotime($time));
}

// ─── Base URL detection ─────────────────────────────────────

function baseUrl(): string {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $cleanDir = preg_replace('#/(api|includes|assets)$#', '', $scriptDir);
    return rtrim($protocol . $host . $cleanDir, '/');
}

// ─── Active Page Detection ──────────────────────────────────

function isActivePage(string $page): bool {
    $currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');
    return $currentPage === $page;
}

function activeClass(string $page): string {
    return isActivePage($page) ? 'text-red-500' : 'text-white/80 hover:text-red-400';
}
