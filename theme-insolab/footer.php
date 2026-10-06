<?php
/**
 * Footer tema InsoLab.
 *
 * @package InsoLab
 */
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
?>
</main>

<footer class="site-footer" id="hubungi">
  <div class="wrap">
    <div class="fgrid">

      <div>
        <div class="fbrand">Inso<span>Lab</span></div>
        <p class="fabout"><?php esc_html_e('Custom insole yang dibina dari acuan kaki anda sendiri — dihantar ke rumah, untuk keselesaan harian dan sukan.', 'insolab'); ?></p>
        <div class="fslogan"><?php echo esc_html(insolab_slogan()); ?></div>
      </div>

      <div>
        <h4><?php esc_html_e('Kedai', 'insolab'); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Semua Insole', 'insolab'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/#video')); ?>"><?php esc_html_e('Cara Guna Kit', 'insolab'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/#proses')); ?>"><?php esc_html_e('Proses', 'insolab'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/#faq')); ?>">FAQ</a></li>
        </ul>
      </div>

      <div>
        <h4><?php esc_html_e('Bantuan', 'insolab'); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url(insolab_cart_url()); ?>"><?php esc_html_e('Troli', 'insolab'); ?></a></li>
          <li><a href="<?php echo esc_url(function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/')); ?>"><?php esc_html_e('Checkout', 'insolab'); ?></a></li>
          <?php if (function_exists('wc_get_page_permalink')) : ?>
          <li><a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Akaun Saya', 'insolab'); ?></a></li>
          <?php endif; ?>
          <li><a href="<?php echo esc_url(home_url('/refund-policy/')); ?>"><?php esc_html_e('Jaminan 180 Hari', 'insolab'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/penghantaran/')); ?>"><?php esc_html_e('Penghantaran', 'insolab'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/privasi/')); ?>"><?php esc_html_e('Polisi Privasi', 'insolab'); ?></a></li>
        </ul>
      </div>

      <div>
        <h4><?php esc_html_e('Hubungi', 'insolab'); ?></h4>
        <ul>
          <li><?php echo esc_html(get_theme_mod('insolab_address', 'Melaka, Malaysia')); ?></li>
          <li><?php echo esc_html(get_theme_mod('insolab_hours', 'Isn–Sab, 9am–6pm')); ?></li>
          <li><a href="mailto:<?php echo esc_attr(get_theme_mod('insolab_email', 'hello@insolab.my')); ?>"><?php echo esc_html(get_theme_mod('insolab_email', 'hello@insolab.my')); ?></a></li>
        </ul>
        <a class="fwa" href="<?php echo esc_url(insolab_wa_url()); ?>" target="_blank" rel="noopener">
          <?php echo insolab_icon('wa'); ?> WhatsApp <?php esc_html_e('Kami', 'insolab'); ?>
        </a>
      </div>

    </div>

    <div class="fbottom">
      <div>&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Hak cipta terpelihara.', 'insolab'); ?></div>
      <div>
        <a href="<?php echo esc_url(home_url('/refund-policy/')); ?>"><?php esc_html_e('Jaminan', 'insolab'); ?></a>
        &middot; <a href="<?php echo esc_url(home_url('/penghantaran/')); ?>"><?php esc_html_e('Penghantaran', 'insolab'); ?></a>
        &middot; <a href="<?php echo esc_url(home_url('/privasi/')); ?>"><?php esc_html_e('Privasi', 'insolab'); ?></a>
        <br><span style="opacity:.75"><?php esc_html_e('InsoLab adalah produk untuk keselesaan harian dan sukan, bukan peranti perubatan, dan tidak menggantikan nasihat pakar perubatan.', 'insolab'); ?></span>
      </div>
    </div>
  </div>
</footer>

<?php
/** Sticky bottom CTA — mobile sahaja. Sentiasa nampak tanpa scroll. */
if (is_product()) : ?>
<div class="sticky-cta" id="stickyCta">
  <div class="sticky-cta-info">
    <span class="sticky-cta-price"><?php echo wc_price(WC()->cart->get_cart_contents_total() > 0 ? WC()->cart->get_cart_contents_total() : 399); ?></span>
    <span class="sticky-cta-note"><?php esc_html_e('Pos percuma · Jaminan 180 hari', 'insolab'); ?></span>
  </div>
  <a class="sticky-cta-wa" href="<?php echo esc_url(insolab_wa_url('Hi InsoLab, saya ingin bertanya tentang custom insole.')); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Tanya di WhatsApp', 'insolab'); ?>">
    <?php echo insolab_icon('wa', 'ico-wa'); ?>
  </a>
  <a class="sticky-cta-btn" href="#pilih"><?php esc_html_e('Pesan Sekarang', 'insolab'); ?></a>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
