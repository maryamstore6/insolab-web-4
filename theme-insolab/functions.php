<?php
/**
 * HTTP Security Headers — tambah melalui PHP (LiteSpeed tak baca .htaccess)
 */
add_action('send_headers', function () {
    if (headers_sent()) return;
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://fonts.googleapis.com https://www.google.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https://wa.me; frame-ancestors 'self'; base-uri 'self'; form-action 'self'");
});


/**
 * InsoLab theme — functions.
 *
 * @package InsoLab
 */

if (!defined('ABSPATH')) exit;

define('INSOLAB_VER', '2.0.0');

/* ─────────────── 1. SETUP TEMA ─────────────── */
add_action('after_setup_theme', function () {
    load_theme_textdomain('insolab', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 260,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');

    /* WooCommerce */
    add_theme_support('woocommerce', [
        'thumbnail_image_width' => 600,
        'single_image_width'    => 900,
        'product_grid'          => ['default_columns' => 3, 'default_rows' => 4],
    ]);
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus([
        'primary' => __('Menu Utama', 'insolab'),
        'footer'  => __('Menu Footer', 'insolab'),
    ]);
});

/* Saiz imej */
add_action('after_setup_theme', function () {
    add_image_size('insolab-card', 720, 540, true);
    add_image_size('insolab-hero', 1400, 1080, false);
});

/* ─────────────── 2. ENQUEUE ─────────────── */
add_action('wp_enqueue_scripts', function () {
    /* Font Poppins */
    wp_enqueue_style(
        'insolab-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap',
        [],
        null
    );
    /* Tema utama */
    wp_enqueue_style('insolab-style', get_stylesheet_uri(), ['insolab-fonts'], INSOLAB_VER);
    /* Skrip animasi */
    wp_enqueue_script('insolab-js', get_template_directory_uri() . '/assets/insolab.js', [], INSOLAB_VER, true);
}, 20);

/* Preconnect font */
add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<meta name="theme-color" content="#0B3D91">' . "\n";
}, 1);

/* ─────────────── 3. WIDGET AREA ─────────────── */
add_action('widgets_init', function () {
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar([
            'name'          => sprintf(__('Footer %d', 'insolab'), $i),
            'id'            => 'footer-' . $i,
            'before_widget' => '<div class="fwidget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ]);
    }
});

/* ─────────────── 4. HELPER ─────────────── */
/** Nombor WhatsApp (customizer) */
function insolab_wa() {
    $n = get_theme_mod('insolab_whatsapp', '60176055349');
    return preg_replace('/[^0-9]/', '', $n);
}

/** URL WhatsApp dengan mesej */
function insolab_wa_url($msg = '') {
    $msg = $msg ?: 'Hi InsoLab, saya berminat untuk dapatkan custom insole.';
    return 'https://wa.me/' . insolab_wa() . '?text=' . rawurlencode($msg);
}

/** Slogan */
function insolab_slogan() {
    return get_theme_mod('insolab_slogan', 'Custom Insoles, Just For You.');
}

/** Ikon SVG inline */
function insolab_icon($name, $class = '') {
    $paths = [
        'foot'    => '<path d="M12 3c-2.2 0-3.4 1.6-3.4 3.6 0 1.5.7 2.6.7 4.1 0 1.3-.9 2-2 3.4-1.2 1.5-1.6 3-1.6 4.6 0 2.4 1.8 3.7 4.2 3.7 2.1 0 3.3-1 5-1 1.8 0 2.9 1 4.4 1 1.6 0 2.7-1 2.7-2.6 0-2-1.5-3.2-2.9-4.6-1.4-1.3-2.4-2.6-2.4-4.6 0-1.6.5-2.6.5-4C17.2 4.4 16 3 13.6 3c-.6 0-1 .3-1.6.3S12.6 3 12 3z"/>',
        'scan'    => '<path d="M3 7V5a2 2 0 0 1 2-2h2M17 3h2a2 2 0 0 1 2 2v2M21 17v2a2 2 0 0 1-2 2h-2M7 21H5a2 2 0 0 1-2-2v-2"/><path d="M3 12h18"/>',
        'layers'  => '<path d="m12 2 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5"/><path d="m3 17 9 5 9-5"/>',
        'check'   => '<path d="M20 6 9 17l-5-5"/>',
        'shield'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/>',
        'truck'   => '<path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
        'award'   => '<circle cx="12" cy="8" r="6"/><path d="M15.5 13.5 17 22l-5-3-5 3 1.5-8.5"/>',
        'motion'  => '<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z"/>',
        'cart'    => '<circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2 3h3l2.7 12.1a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L22 7H6"/>',
        'store'   => '<path d="M3 9h18v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9Z"/><path d="M2 9l2-5h16l2 5"/><path d="M9 21v-6h6v6"/>',
        'wa'      => '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>',
        'star'    => '<path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2z"/>',
        'close'   => '<path d="M18 6 6 18M6 6l12 12"/>',
        'phone'   => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/>',
    ];
    $d = $paths[$name] ?? '';
    if (!$d) return '';

    /* Ikon solid (fill) vs ikon garis (stroke) */
    $solid = ['wa', 'star', 'foot'];

    if ($class === '') {
        $class = in_array($name, $solid, true) ? 'ico-' . $name : 'ico-line';
    }
    $class .= in_array($name, $solid, true) ? ' is-solid' : ' is-line';

    return '<svg class="' . esc_attr(trim($class)) . '" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $d . '</svg>';
}

/* ─────────────── 5. CUSTOMIZER ─────────────── */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('insolab_brand', [
        'title'    => __('InsoLab — Tetapan', 'insolab'),
        'priority' => 28,
    ]);

    $fields = [
        'insolab_whatsapp' => ['WhatsApp (cth 60176055349)', '60176055349'],
        'insolab_email'    => ['Email', 'hello@insolab.my'],
        'insolab_address'  => ['Alamat / Lokasi', 'Melaka, Malaysia'],
        'insolab_hours'    => ['Waktu Operasi', 'Isn–Sab, 9am–6pm'],
        'insolab_slogan'   => ['Slogan footer', 'Custom Insoles, Just For You.'],
    ];
    foreach ($fields as $id => $cfg) {
        $wp_customize->add_setting($id, ['default' => $cfg[1], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control($id, ['label' => $cfg[0], 'section' => 'insolab_brand', 'type' => 'text']);
    }

    /* Warna brand */
    $colors = [
        'insolab_navy' => ['Navy', '#0B3D91'],
        'insolab_teal' => ['Teal', '#00B3B3'],
    ];
    foreach ($colors as $id => $cfg) {
        $wp_customize->add_setting($id, ['default' => $cfg[1], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control($id, [
            'label' => $cfg[0], 'section' => 'colors', 'type' => 'color',
        ]);
    }
});

/* Warna dari customizer → CSS */
add_action('wp_head', function () {
    $navy = get_theme_mod('insolab_navy', '#0B3D91');
    $teal = get_theme_mod('insolab_teal', '#00B3B3');
    if ($navy === '#0B3D91' && $teal === '#00B3B3') return;
    echo "<style>:root{--navy:{$navy};--teal:{$teal}}</style>\n";
}, 20);

/* ─────────────── 6. WOOCOMMERCE TWEAK ─────────────── */
/* Bilangan produk setiap baris */
add_filter('loop_shop_columns', fn() => 3);

/* Butang WhatsApp di halaman produk */
add_action('woocommerce_after_add_to_cart_form', function () {
    if (!is_product()) return;
    global $product;
    $msg = 'Hi InsoLab, saya berminat dengan ' . get_the_title() . '. Boleh saya tahu lebih lanjut?';
    echo '<a class="btn btn-wa btn-block" style="margin-top:14px" target="_blank" rel="noopener" href="' . esc_url(insolab_wa_url($msg)) . '">'
        . insolab_icon('wa', 'ico-wa') . ' Tanya di WhatsApp</a>';
});

/* Trust badge di halaman produk */
add_action('woocommerce_single_product_summary', function () {
    echo '<div class="hero-meta" style="margin:22px 0 0">'
        . '<div><b>180 hari</b> jaminan wang kembali</div>'
        . '<div><b>Percuma</b> penghantaran seluruh Malaysia</div>'
        . '<div><b>16–20 hari</b> siap</div>'
        . '</div>';
}, 35);

/* Bilangan item cart (untuk header) */
function insolab_cart_count() {
    if (!function_exists('WC') || !WC()->cart) return 0;
    return WC()->cart->get_cart_contents_count();
}
function insolab_cart_url() {
    return function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
}



/* ═══════════════ 9. HARGA BUNDLE (gaya Upstep) ═══════════════ */
/**
 * Harga sepasang mengikut jumlah pasang dalam troli.
 * 1 pasang = RM399 · 2 pasang = RM329/pasang · 3+ = RM299/pasang
 */
function insolab_tier_price($qty) {
    if ($qty >= 3) return 299.0;
    if ($qty === 2) return 329.0;
    return 399.0;
}

/** Kira jumlah pasang dalam troli (produk InsoLab sahaja) */
function insolab_cart_pairs() {
    if (!function_exists('WC') || !WC()->cart) return 0;
    $q = 0;
    foreach (WC()->cart->get_cart() as $item) {
        $q += (int) $item['quantity'];
    }
    return $q;
}

/** Kunci harga ikut kuantiti */
add_action('woocommerce_before_calculate_totals', function ($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;
    if (!$cart || $cart->is_empty()) return;

    $q = 0;
    foreach ($cart->get_cart() as $item) { $q += (int) $item['quantity']; }
    $tier = insolab_tier_price($q);
    if ($tier >= 399) return;

    foreach ($cart->get_cart() as $item) {
        $item['data']->set_price($tier);
    }
}, 20);

/** Jadual harga di halaman produk + notis**
 *  Dipapar betul-betul di bawah harga
 */
add_action('woocommerce_single_product_summary', 'insolab_price_table', 11);
function insolab_price_table() {
    $tiers = [
        ['1 pasang', 'RM399', 'Harga biasa', false],
        ['2 pasang', 'RM329 / pasang', 'Jimat RM140', true],
        ['3 pasang', 'RM299 / pasang', 'Jimat RM300', true],
    ];
    echo '<div class="price-tier">';
    foreach ($tiers as $t) {
        echo '<div class="pt-row' . ($t[3] ? ' is-best' : '') . '">'
           . '<span class="pt-q">' . esc_html($t[0]) . '</span>'
           . '<span class="pt-p">' . esc_html($t[1]) . '</span>'
           . '<span class="pt-s">' . esc_html($t[2]) . '</span>'
           . '</div>';
    }
    echo '</div>';
    echo '<p class="pt-note"><strong>' . esc_html__('Cara ia berfungsi:', 'insolab') . '</strong> ' . esc_html__('tambah pasang kedua atau ketiga dalam troli — diskaun dikira automatik. Tiada kod diperlukan.', 'insolab') . '</p>';
}

/** Notis penjimatan dalam troli */
add_action('woocommerce_before_cart_table', function () {
    $q = insolab_cart_pairs();
    if ($q < 1) return;
    $now = insolab_tier_price($q);
    $full = 399 * $q;
    $saved = $full - ($now * $q);
    if ($saved > 0) {
        echo '<div class="woocommerce-message" style="margin-bottom:22px">Anda jimat <strong>RM' . esc_html(number_format($saved, 0)) . '</strong> dengan harga bundle ' . esc_html($q) . ' pasang.</div>';
    } else {
        echo '<div class="woocommerce-info" style="margin-bottom:22px">Tambah <strong>1 pasang lagi</strong> dan harga turun ke <strong>RM329</strong> sepasang — jimat RM140.</div>';
    }
});

/** Label harga bundle pada kad produk */
add_filter('woocommerce_get_price_html', function ($price, $product) {
    if (is_admin() || !$product) return $price;
    if (!is_shop() && !is_product_category() && !is_front_page()) return $price;
    return $price . '<span class="pt-from">Harga turun bila beli 2+</span>';
}, 20, 2);



/* ═══════════════ 10. BLOK HALAMAN PRODUK (struktur gaya Upstep) ═══════════════ */
add_action('woocommerce_after_single_product_summary', 'insolab_product_blocks', 5);
function insolab_product_blocks() {
    ?>
    <div class="prod-blocks">

      <!-- Cara guna -->
      <div class="prod-block">
        <h2><?php esc_html_e('Cara ia berfungsi', 'insolab'); ?></h2>
        <ol class="prod-steps">
          <li><strong><?php esc_html_e('Pesan & kit tiba', 'insolab'); ?></strong><br><?php esc_html_e('Kit acuan dihantar dalam 2–3 hari bekerja, lengkap dengan panduan bergambar.', 'insolab'); ?></li>
          <li><strong><?php esc_html_e('Buat acuan di rumah', 'insolab'); ?></strong><br><?php esc_html_e('Tekan kaki ke dalam busa acuan — lima minit. Orang dewasa boleh berdiri terus; kanak-kanak dibantu.', 'insolab'); ?></li>
          <li><strong><?php esc_html_e('Pos balik percuma', 'insolab'); ?></strong><br><?php esc_html_e('Guna label prabayar yang kami sediakan. Tiada kos penghantaran.', 'insolab'); ?></li>
          <li><strong><?php esc_html_e('Insole siap dihantar', 'insolab'); ?></strong><br><?php esc_html_e('Dibuat mengikut acuan anda dalam 16–20 hari di Makmal InsoLab, terus ke pintu rumah.', 'insolab'); ?></li>
        </ol>
      </div>

      <!-- Penjagaan -->
      <div class="prod-block">
        <h2><?php esc_html_e('Penjagaan & pemakaian', 'insolab'); ?></h2>
        <div class="prod-cols">
          <div>
            <h3><?php esc_html_e('Hari pertama', 'insolab'); ?></h3>
            <ul>
              <li><?php esc_html_e('Mulakan 1–2 jam sehari untuk kaki biasa.', 'insolab'); ?></li>
              <li><?php esc_html_e('Tambah masa secara beransur — kira-kira sejam setiap hari.', 'insolab'); ?></li>
              <li><?php esc_html_e('Selesema kaki atau tekanan ringan pada awalnya adalah normal.', 'insolab'); ?></li>
            </ul>
          </div>
          <div>
            <h3><?php esc_html_e('Jaga insole anda', 'insolab'); ?></h3>
            <ul>
              <li><?php esc_html_e('Keluarkan dari kasut selepas dipakai, biar kering.', 'insolab'); ?></li>
              <li><?php esc_html_e('Cuci dengan kain lembap — jangan rendam dalam air.', 'insolab'); ?></li>
              <li><?php esc_html_e('Elak letak dekat haba kuat atau cahaya matahari terus.', 'insolab'); ?></li>
            </ul>
          </div>
        </div>
        <p class="prod-note"><?php esc_html_e('Insole ini direka untuk keselesaan dan sokongan harian. Ia bukan peranti perubatan dan tidak menggantikan nasihat doktor atau ahli fisioterapi.', 'insolab'); ?></p>
      </div>

      <!-- Kenapa InsoLab -->
      <div class="prod-block">
        <h2><?php esc_html_e('Kenapa InsoLab?', 'insolab'); ?></h2>
        <div class="prod-cols">
          <div>
            <ul>
              <li><strong><?php esc_html_e('Dibuat dari acuan anda', 'insolab'); ?></strong> — bukan dipilih ikut saiz rak.</li>
              <li><strong><?php esc_html_e('Sokongan lengkung', 'insolab'); ?></strong> — mengikut bentuk kaki anda sendiri.</li>
            </ul>
          </div>
          <div>
            <ul>
              <li><strong><?php esc_html_e('Jaminan 180 hari', 'insolab'); ?></strong> — cuba cukup lama untuk biasa.</li>
              <li><strong><?php esc_html_e('Hantar percuma', 'insolab'); ?></strong> — seluruh Malaysia, termasuk Sabah &amp; Sarawak.</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
    <?php
}



/* ═══════════════ 12. HALAMAN TROLI (cart klasik) ═══════════════ */
/** Troli kosong — beri arah & CTA jelas */
add_action('woocommerce_cart_is_empty', function () {
    $shop = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
    ?>
    <div class="cart-empty-cta">
      <div class="ce-ico"><?php echo insolab_icon('cart'); ?></div>
      <h2><?php esc_html_e('Troli anda masih kosong', 'insolab'); ?></h2>
      <p><?php esc_html_e('Belum pick insole anda? Lihat dua pilihan kami — Everyday untuk hari yang panjang, Sport untuk langkah yang laju.', 'insolab'); ?></p>
      <div class="ce-btns">
        <a class="btn" href="<?php echo esc_url($shop); ?>"><?php esc_html_e('Lihat Insole Kami', 'insolab'); ?> &rarr;</a>
        <a class="btn btn-wa" target="_blank" rel="noopener" href="<?php echo esc_url(insolab_wa_url('Hi InsoLab, saya nak tanya tentang insole sebelum order.')); ?>"><?php echo insolab_icon('wa'); ?> <?php esc_html_e('Tanya Dulu', 'insolab'); ?></a>
      </div>
      <p class="ce-note"><?php esc_html_e('Jaminan 180 hari', 'insolab'); ?> · <?php esc_html_e('Pos percuma', 'insolab'); ?> · <?php esc_html_e('Kit Acuan RM20', 'insolab'); ?></p>
    </div>
    <?php
});

/** Selepas tambah ke troli: terus ke troli? (elak keliru) — biar default WooCommerce */
add_filter('woocommerce_add_to_cart_redirect', function ($url) {
    return $url;
});

/**
 * Teks butang tambah-ke-troli — guna MANFAAT, bukan "Add to cart" generik.
 * Dua konteks berbeza: halaman produk (panjang) vs kad senarai (ringkas).
 */
add_filter('woocommerce_product_single_add_to_cart_text', function () {
    return __('Pesan Sekarang — Pos Percuma', 'insolab');
});
add_filter('woocommerce_product_add_to_cart_text', function ($text, $product = null) {
    // Kad senarai (shop, berkaitan, laman utama) — ringkas
    if ($product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock()) {
        return __('Pesan', 'insolab');
    }
    return $text;
}, 10, 2);

/** Semak: butang "Baca lagi" / "Ketahui lebih" untuk produk tak boleh beli */
add_filter('woocommerce_product_add_to_cart_text', function ($text, $product = null) {
    if ($product && (!$product->is_in_stock() || !$product->is_purchasable())) {
        return __('Lihat Butiran', 'insolab');
    }
    return $text;
}, 20, 2);

/** aria-label butang — kekal deskriptif untuk pembaca skrin (WCAG) */
add_filter('woocommerce_product_add_to_cart_description', function ($text, $product = null) {
    if ($product && $product->is_in_stock() && $product->is_purchasable()) {
        return sprintf(__('Pesan %s — pos percuma', 'insolab'), $product->get_name());
    }
    return $text;
}, 10, 2);



/** Tajuk halaman Melayu (Troli, Checkout, Akaun Saya) */
/**
 * Tajuk halaman produk — sebut MASALAH pelanggan (CRO).
 * Nama produk asal KEKAL untuk SEO, schema & URL.
 */
add_filter('the_title', function ($title, $id = 0) {
    if (is_admin() || !is_product() || !in_the_loop()) return $title;
    $map = [
        'Everyday Custom Insoles' => __('Untuk yang berdiri lama — sokongan sepanjang hari', 'insolab'),
        'Sport Custom Insoles'    => __('Untuk yang aktif bersukan — sokongan setiap langkah', 'insolab'),
    ];
    return $map[$title] ?? $title;
}, 30, 2);

add_filter('the_title', function ($title, $id = 0) {
    if (is_admin() || !in_the_loop() || !is_page()) return $title;
    $map = [
        'cart'      => __('Troli', 'insolab'),
        'checkout'  => __('Checkout', 'insolab'),
        'my-account' => __('Akaun Saya', 'insolab'),
        'shop'      => __('Insole Kami', 'insolab'),
    ];
    $slug = get_post_field('post_name', $id);
    return isset($map[$slug]) ? $map[$slug] : $title;
}, 10, 2);



/* ═══════════════ 13. HALAMAN PRODUK — GAYA UPSTEP ═══════════════ */
/** Rating bintang (dummy) bawah tajuk produk */
add_action('woocommerce_single_product_summary', 'insolab_rating_row', 7);
function insolab_rating_row() {
    $rating  = get_option('insolab_demo_rating', '4.9');
    $reviews = get_option('insolab_demo_reviews', '1,240');
    $stars   = (int) round((float) $rating);
    echo '<div class="p-rating">';
    echo '<span class="p-stars">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<svg viewBox="0 0 24 24" class="st' . ($i <= $stars ? ' on' : '') . '" aria-hidden="true"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2z"/></svg>';
    }
    echo '</span>';
    echo '<span class="p-rat-txt"><strong>' . esc_html($rating) . '</strong> &middot; ' . esc_html($reviews) . ' ' . esc_html__('ulasan', 'insolab') . '</span>';
    echo '<span class="p-rat-tag">' . esc_html__('Pelanggan Malaysia', 'insolab') . '</span>';
    echo '</div>';
}

/** Bar promosi (gaya "UP TO 70% OFF") */
add_action('woocommerce_single_product_summary', 'insolab_promo_bar', 6);
function insolab_promo_bar() {
    echo '<div class="p-promo">' . esc_html__('Diskaun bundle — jimat sehingga RM300', 'insolab') . '</div>';
}

/** Pilihan warna (paparan) */
add_action('woocommerce_before_add_to_cart_form', 'insolab_color_row', 5);
function insolab_color_row() {
    $colors = [
        ['#1b1b1b', 'Hitam', true],
        ['#0B3D91', 'Navy', false],
    ];
    echo '<div class="p-opt">';
    echo '<span class="p-opt-lbl">' . esc_html__('Warna', 'insolab') . ' &middot; <b>' . esc_html__('Hitam', 'insolab') . '</b></span>';
    echo '<div class="p-colors">';
    foreach ($colors as $c) {
        echo '<span class="p-color' . ($c[2] ? ' on' : '') . '" title="' . esc_attr($c[1]) . '" aria-label="' . esc_attr($c[1]) . '" style="background:' . esc_attr($c[0]) . '"></span>';
    }
    echo '</div></div>';
}

/** Butang "Cari Insole Sesuai" (kuiz) selepas add-to-cart */
add_action('woocommerce_after_add_to_cart_form', 'insolab_quiz_btn', 6);
function insolab_quiz_btn() {
    echo '<a class="btn btn-quiz btn-block" href="' . esc_url(home_url('/#pilih')) . '">'
       . esc_html__('Cari Insole Sesuai', 'insolab') . ' <span class="arw">&rarr;</span></a>';
}

/** Banner gelap (gaya "Use Your FSA/HSA Dollars") */
add_action('woocommerce_after_add_to_cart_form', 'insolab_dark_banner', 20);
function insolab_dark_banner() {
    echo '<div class="p-banner"><strong>' . esc_html__('Pos percuma + Jaminan 180 Hari', 'insolab') . '</strong>'
       . '<span>' . esc_html__('Cuba di rumah. Kalau tidak selesa, kami pulangkan wang anda.', 'insolab') . '</span></div>';
}

/** Rating bintang pada kad produk (shop & berkaitan) */
add_action('woocommerce_after_shop_loop_item_title', function () {
    $rating = get_option('insolab_demo_rating', '4.9');
    $stars  = (int) round((float) $rating);
    echo '<div class="card-rating"><span class="p-stars">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<svg viewBox="0 0 24 24" class="st' . ($i <= $stars ? ' on' : '') . '" aria-hidden="true"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2z"/></svg>';
    }
    echo '</span><span class="card-rat-txt">' . esc_html($rating) . '</span></div>';
}, 9);



/** Elak duplikasi rating: sembunyi rating WooCommerce asli di halaman produk */
add_action('init', function () {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
});



/* ═══════════════ 14. ULASAN & BORANG (gaya Upstep) ═══════════════ */
/** Buang tab "Reviews" WooCommerce — kita ada seksyen sendiri */
add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['reviews']);
    if (isset($tabs['description'])) $tabs['description']['title'] = __('Butiran Produk', 'insolab');
    if (isset($tabs['additional_information'])) $tabs['additional_information']['title'] = __('Maklumat Tambahan', 'insolab');
    return $tabs;
}, 98);

/** Seksyen ulasan penuh di bawah produk */
add_action('woocommerce_after_single_product_summary', 'insolab_reviews_section', 12);
function insolab_reviews_section() {
    global $product;
    if (!$product) return;

    $avg     = get_option('insolab_demo_rating', '4.9');
    $count   = get_option('insolab_demo_reviews', '1,240');
    $qa      = get_option('insolab_demo_qa', '33');
    $stars   = (int) round((float) $avg);

    /* Ambil ulasan WooCommerce */
    $comments = get_comments([
        'post_id' => $product->get_id(),
        'status'  => 'approve',
        'type'    => 'review',
        'number'  => 6,
        'orderby' => 'comment_date_gmt',
        'order'   => 'DESC',
    ]);
    ?>
    <section class="rev-sec" id="ulasan-produk">
      <div class="rev-head">
        <div class="rev-score">
          <div class="rev-score-num"><?php echo esc_html($avg); ?></div>
          <div class="rev-score-stars">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
              <svg viewBox="0 0 24 24" class="st<?php echo $i <= $stars ? ' on' : ''; ?>" aria-hidden="true"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2z"/></svg>
            <?php endfor; ?>
          </div>
          <div class="rev-score-txt"><?php echo esc_html($count); ?> <?php esc_html_e('ulasan', 'insolab'); ?> &middot; <?php echo esc_html($qa); ?> Q&amp;A</div>
        </div>
        <div class="rev-actions">
          <a class="btn rev-btn" href="#tulis-ulasan"><?php esc_html_e('Tulis Ulasan', 'insolab'); ?></a>
          <a class="btn rev-btn rev-btn-ghost" target="_blank" rel="noopener"
             href="<?php echo esc_url(insolab_wa_url('Hi InsoLab, saya ada soalan tentang produk ini.')); ?>"><?php esc_html_e('Tanya Soalan', 'insolab'); ?></a>
        </div>
      </div>

      <div class="rev-filter">
        <span class="rev-filter-lbl"><?php esc_html_e('Tapis Ulasan', 'insolab'); ?></span>
        <div class="rev-chips">
          <span class="rev-chip on"><?php esc_html_e('Semua', 'insolab'); ?></span>
          <span class="rev-chip"><?php esc_html_e('5 bintang', 'insolab'); ?></span>
          <span class="rev-chip"><?php esc_html_e('Ada gambar', 'insolab'); ?></span>
        </div>
      </div>

      <div class="rev-list">
        <?php if ($comments) : foreach ($comments as $c) :
            $r      = (int) get_comment_meta($c->comment_ID, 'rating', true);
            $r      = $r ?: 5;
            $title  = get_comment_meta($c->comment_ID, 'review_title', true);
            $verif  = get_comment_meta($c->comment_ID, 'verified', true);
            $init   = mb_strtoupper(mb_substr($c->comment_author, 0, 1));
            ?>
          <article class="rev-card">
            <div class="rev-top">
              <span class="rev-av"><?php echo esc_html($init); ?></span>
              <div class="rev-meta">
                <div class="rev-name">
                  <?php echo esc_html($c->comment_author); ?>
                  <?php if ($verif) : ?><span class="rev-verif"><?php echo insolab_icon('check'); ?> <?php esc_html_e('Pembeli disahkan', 'insolab'); ?></span><?php endif; ?>
                </div>
                <div class="rev-stars">
                  <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <svg viewBox="0 0 24 24" class="st<?php echo $i <= $r ? ' on' : ''; ?>" aria-hidden="true"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2z"/></svg>
                  <?php endfor; ?>
                </div>
              </div>
              <time class="rev-date"><?php echo esc_html(get_comment_date('j M Y', $c)); ?></time>
            </div>
            <?php if ($title) : ?><h4 class="rev-title"><?php echo esc_html($title); ?></h4><?php endif; ?>
            <p class="rev-body"><?php echo esc_html($c->comment_content); ?></p>
          </article>
        <?php endforeach; else : ?>
          <p class="rev-none"><?php esc_html_e('Jadi yang pertama menulis ulasan untuk produk ini.', 'insolab'); ?></p>
        <?php endif; ?>
      </div>

      <!-- Borang tulis ulasan -->
      <div class="rev-form-wrap" id="tulis-ulasan">
        <h3><?php esc_html_e('Tulis Ulasan Anda', 'insolab'); ?></h3>
        <p class="rev-form-note"><?php esc_html_e('Kongsi pengalaman anda — ia membantu pelanggan lain membuat pilihan.', 'insolab'); ?></p>
        <?php
        if (comments_open($product->get_id())) {
            comment_form([
                'title_reply'          => '',
                'label_submit'         => __('Hantar Ulasan', 'insolab'),
                'class_submit'         => 'btn rev-submit',
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
                'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Ulasan anda', 'insolab') . ' <span class="req">*</span></label>'
                                        . '<textarea id="comment" name="comment" rows="5" required placeholder="' . esc_attr__('Contoh: Kaki saya rasa lebih selesa selepas seminggu pakai…', 'insolab') . '"></textarea></p>',
                'fields'               => [
                    'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Nama', 'insolab') . ' <span class="req">*</span></label><input id="author" name="author" type="text" required /></p>',
                    'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email (tidak dipaparkan)', 'insolab') . ' <span class="req">*</span></label><input id="email" name="email" type="email" required /></p>',
                ],
            ], $product->get_id());
        }
        ?>
      </div>
    </section>
    <?php
}

/** Medan rating bintang + tajuk dalam borang ulasan */
add_action('comment_form_top', 'insolab_review_fields');
add_action('comment_form_logged_in_after', 'insolab_review_fields');
function insolab_review_fields() {
    ?>
    <div class="rev-field-row">
      <div class="rev-field">
        <label><?php esc_html_e('Penilaian anda', 'insolab'); ?> <span class="req">*</span></label>
        <div class="star-picker" id="starPicker" role="radiogroup" aria-label="<?php esc_attr_e('Penilaian', 'insolab'); ?>">
          <?php for ($i = 1; $i <= 5; $i++) : ?>
            <button type="button" class="sp on" data-v="<?php echo $i; ?>" aria-label="<?php echo $i; ?> bintang">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2z"/></svg>
            </button>
          <?php endfor; ?>
        </div>
        <input type="hidden" name="rating" id="ratingValue" value="5" />
      </div>
      <div class="rev-field">
        <label for="review_title"><?php esc_html_e('Tajuk ringkas', 'insolab'); ?> <span class="opt">(<?php esc_html_e('pilihan', 'insolab'); ?>)</span></label>
        <input id="review_title" name="review_title" type="text" placeholder="<?php esc_attr_e('Contoh: Selesa sepanjang hari', 'insolab'); ?>" />
      </div>
    </div>
    <?php
}

/** Simpan tajuk + rating + tanda disahkan */
add_action('comment_post', function ($id) {
    if (isset($_POST['review_title'])) update_comment_meta($id, 'review_title', sanitize_text_field(wp_unslash($_POST['review_title'])));
    if (isset($_POST['rating'])) update_comment_meta($id, 'rating', intval($_POST['rating']));
    update_comment_meta($id, 'verified', 1);
}, 10);



/** Borang ulasan: email tidak wajib, butang jelas */
add_filter('woocommerce_product_review_comment_form_args', function ($args) {
    $args['label_submit'] = __('Hantar Ulasan', 'insolab');
    $args['class_submit'] = 'btn rev-submit';
    $args['comment_notes_before'] = '';
    $args['comment_notes_after']  = '';
    $args['title_reply'] = '';
    if (isset($args['fields']['email'])) {
        $args['fields']['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__('Email (tidak dipaparkan, pilihan)', 'insolab') . '</label><input id="email" name="email" type="email" /></p>';
    }
    return $args;
}, 20);

/* ─────────────── 7. PERFORMANCE / BERSIH ─────────────── */
/* Buang emoji script */
add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
});

/* Buang blok CSS WooCommerce yang tidak perlu di luar WooCommerce */
add_action('wp_enqueue_scripts', function () {
    if (!function_exists('is_woocommerce')) return;
    if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page()) {
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('wc-blocks-vendors-style');
    }
}, 99);

/* Preload imej hero halaman depan */
add_action('wp_head', function () {
    if (!is_front_page()) return;
    $id = (int) get_theme_mod('insolab_hero_id', 0);
    if ($id) {
        $src = wp_get_attachment_image_url($id, 'insolab-hero');
        if ($src) echo '<link rel="preload" as="image" href="' . esc_url($src) . '">' . "\n";
    }
}, 2);

/* ─────────────── 8. RANGKA KANDUNGAN ─────────────── */
add_action('wp_body_open', function () { echo '<a class="skip-link" href="#content">' . esc_html__('Lompat ke kandungan', 'insolab') . '</a>'; });
