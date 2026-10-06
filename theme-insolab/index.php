<?php
/**
 * Fallback template.
 *
 * @package InsoLab
 */
get_header();
?>
<div class="wrap" style="padding:80px 28px 100px">
<?php if (have_posts()) : ?>
  <h1 class="text-center" style="margin-bottom:44px">
    <?php
    if (is_home() && !is_front_page()) {
        single_post_title();
    } elseif (is_search()) {
        printf(esc_html__('Hasil carian: %s', 'insolab'), '<em>' . get_search_query() . '</em>');
    } elseif (is_archive()) {
        the_archive_title();
    } else {
        esc_html_e('Artikel', 'insolab');
    }
    ?>
  </h1>
  <div class="posts-grid">
    <?php while (have_posts()) : the_post(); ?>
      <article class="post-card">
        <a href="<?php the_permalink(); ?>">
          <?php if (has_post_thumbnail()) { the_post_thumbnail('insolab-card'); } ?>
        </a>
        <div class="pc-body">
          <div class="entry-meta"><?php echo esc_html(get_the_date()); ?></div>
          <h3><a href="<?php the_permalink(); ?>" style="color:var(--navy)"><?php the_title(); ?></a></h3>
          <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
          <a class="btn btn-sm btn-ghost" href="<?php the_permalink(); ?>"><?php esc_html_e('Baca', 'insolab'); ?></a>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
  <div style="margin-top:44px;text-align:center"><?php the_posts_pagination(['mid_size' => 1]); ?></div>
<?php else : ?>
  <div class="text-center" style="padding:60px 0">
    <h1><?php esc_html_e('Halaman tidak dijumpai', 'insolab'); ?></h1>
    <p><?php esc_html_e('Cuba cari produk atau hubungi kami di WhatsApp.', 'insolab'); ?></p>
    <a class="btn" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Kembali ke Laman Utama', 'insolab'); ?></a>
  </div>
<?php endif; ?>
</div>
<?php get_footer();
