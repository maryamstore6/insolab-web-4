<?php
/**
 * 404.
 *
 * @package InsoLab
 */
get_header();
?>
<div class="wrap text-center" style="padding:110px 28px 130px">
  <div class="kicker">404</div>
  <h1><?php esc_html_e('Halaman ini tak ada', 'insolab'); ?></h1>
  <p style="max-width:520px;margin:0 auto 32px"><?php esc_html_e('Mungkin pautan sudah berubah. Cuba mula dari laman utama, atau cari insole yang anda perlukan.', 'insolab'); ?></p>
  <a class="btn" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Laman Utama', 'insolab'); ?></a>
  <a class="btn btn-ghost" href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')); ?>"><?php esc_html_e('Lihat Produk', 'insolab'); ?></a>
</div>
<?php get_footer();
