<?php
/**
 * Header tema InsoLab.
 *
 * @package InsoLab
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
  <div class="wrap hdr">

    <a class="hdr-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
      <?php if (has_custom_logo()) : ?>
        <?php
        $logo_id = get_theme_mod('custom_logo');
        echo wp_get_attachment_image($logo_id, 'full', false, ['alt' => get_bloginfo('name'), 'loading' => 'eager']);
        ?>
      <?php else : ?>
        <span class="logo-text">Inso<span>Lab</span></span>
      <?php endif; ?>
    </a>

    <button class="hdr-burger" id="burger" aria-label="<?php esc_attr_e('Menu', 'insolab'); ?>" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <nav class="hdr-nav" id="nav" aria-label="<?php esc_attr_e('Menu Utama', 'insolab'); ?>">
      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu([
              'theme_location' => 'primary',
              'container'      => false,
              'depth'          => 2,
              'fallback_cb'    => false,
          ]);
      } else {
          echo '<ul>';
          echo '<li><a href="' . esc_url(home_url('/#proses')) . '">' . esc_html__('Proses', 'insolab') . '</a></li>';
          echo '<li><a href="' . esc_url(home_url('/#video')) . '">' . esc_html__('Cara Guna', 'insolab') . '</a></li>';
          echo '<li><a href="' . esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')) . '">' . esc_html__('Produk', 'insolab') . '</a></li>';
          echo '<li><a href="' . esc_url(home_url('/#faq')) . '">FAQ</a></li>';
          echo '<li><a href="' . esc_url(home_url('/#hubungi')) . '">' . esc_html__('Hubungi', 'insolab') . '</a></li>';
          echo '</ul>';
      }
      ?>
    </nav>

    <div class="hdr-actions" id="hdr-actions">
      <a class="hdr-cart" href="<?php echo esc_url(insolab_cart_url()); ?>">
        <?php echo insolab_icon('cart', 'ico-cart'); ?>
        <span><?php esc_html_e('Troli', 'insolab'); ?></span>
        <span class="count"><?php echo esc_html(insolab_cart_count()); ?></span>
      </a>
      <a class="hdr-cta" href="<?php echo esc_url(insolab_wa_url()); ?>" target="_blank" rel="noopener">
        <?php esc_html_e('Pesan Kit Acuan', 'insolab'); ?>
      </a>
    </div>

  </div>
</header>

<div class="cine-progress" aria-hidden="true"><span id="cineBar"></span></div>

<main id="content" class="site-main">
