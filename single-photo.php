<?php
get_header(); // Inclure l'en-tête du thème WordPress
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>

<!------------------------------------------------------ CUSTOM POST TYPE ---------------------------------------------------------->       
        <p>Type : <?php echo get_field('type'); ?></p>
        <p>Référence : <?php echo get_field('reference'); ?></p>

<!------------------------------------------------------ IMAGE DU POST ---------------------------------------------------------->       
        <p>
          <img src="<?php the_post_thumbnail_url(); ?>" alt="">
        </p>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        </article>
<!------------------------------------------------------ WP QUERY - ZONE SOUS ARTICLE PHOTO ---------------------------------------------------------->     
        <?php var_dump(get_the_ID()) ?>
            <div>
            <h2>VOUS AIMERIEZ AUSSI</h2>
            <!-- RECUPERE tous les thermes de notre catégorie
            <?php
            $categorie = array_map(function ($term){
              return $term->term_id;
            }, get_the_terms(get_post(), 'categorie'));

            $query = new WP_query([
            'post_per_page' => 2,
            'post__not_in' => [get_the_ID()],
            'post_type' => 'photo',
            'tax_query' => [
              [
                'taxonomy' => 'categorie',
                'terms' => $categorie,

              ]
            ]
            ]);
            while ($query->have_posts()) : $query->the_post();
            ?>
            <?php endwhile; wp_reset_postdata(); ?>-->
            </div>
    <?php endwhile; endif; ?>

  </main>
</div>

<?php
get_footer(); // Inclure le pied de page du thème WordPress
?>
