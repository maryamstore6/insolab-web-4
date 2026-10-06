<?php
/**
 * Wrapper WooCommerce — semua halaman kedai (shop, kategori, produk, cart, checkout).
 *
 * @package InsoLab
 */
get_header();
?>
<div class="wrap wc-page">
  <?php woocommerce_content(); ?>
</div>
<?php get_footer();
