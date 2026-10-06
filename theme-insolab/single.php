<?php
/**
 * Pos tunggal.
 *
 * @package InsoLab
 */
get_header();
while (have_posts()) : the_post();
?>
<article class="wrap entry-content" style="padding:76px 28px 100px;max-width:800px">
  <header class="entry-header">
    <div class="entry-meta"><?php echo esc_html(get_the_date()); ?> &middot; <?php the_author(); ?></div>
    <h1><?php the_title(); ?></h1>
  </header>
  <?php if (has_post_thumbnail()) : ?>
    <div style="margin-bottom:34px"><?php the_post_thumbnail('insolab-hero', ['style' => 'border-radius:var(--r)']); ?></div>
  <?php endif; ?>
  <?php the_content(); ?>
  <div style="margin-top:44px;padding-top:26px;border-top:1px solid var(--line)">
    <a class="btn btn-ghost" href="<?php echo esc_url(home_url('/')); ?>">&larr; <?php esc_html_e('Kembali', 'insolab'); ?></a>
  </div>
</article>
<?php
endwhile;
get_footer();
