<?php
get_header(); // Inclure l'en-tête du thème WordPress
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2><?php the_title(); ?></h2>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        
        <p>Type : <?php echo get_field('type'); ?></p>
        <p>Référence : <?php echo get_field('reference'); ?></p>
      </article>

    <?php endwhile; endif; ?>

  </main>
</div>

<?php
get_footer(); // Inclure le pied de page du thème WordPress
?>
