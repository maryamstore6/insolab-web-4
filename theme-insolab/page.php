<?php
/**
 * Halaman biasa.
 *
 * @package InsoLab
 */
get_header();
while (have_posts()) : the_post();
?>
<article class="wrap entry-content" style="padding:76px 28px 100px;max-width:860px">
  <header class="entry-header">
    <h1><?php the_title(); ?></h1>
  </header>
  <?php the_content(); ?>
</article>
<?php
endwhile;
get_footer();
