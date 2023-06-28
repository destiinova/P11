<?php
get_header(); // Inclure l'en-tête du thème WordPress
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="description_photo">
          <div class="description">
              <h2><?php the_title(); ?></h2>
<!------------------------------------------------------ CUSTOM POST TYPE ---------------------------------------------------------->       
                <p>Référence : <?php echo get_field('reference'); ?></p>
                <p>Catégorie : <?php echo get_field('categorie'); ?></p>
                <p>Format : <?php echo get_field('format'); ?></p>
                <p>Type : <?php echo get_field('type'); ?></p>
                <p>Année : <?php echo get_field('date'); ?></p>
          </div>
<!------------------------------------------------------ IMAGE DU POST ---------------------------------------------------------->       
          <div>
              <img class="img_query" src="<?php the_post_thumbnail_url(); ?>" alt="">
          </div>
      </div>
      </article>
      <div class="border_section"></div>
      <div class="section_description">
                <p>Cette photo vous intéresse ?</p> 
                <button class="contact_photo">Contact</button>
                <?php include_once('template-parts/modal-contact.php'); ?>
                <div class="card_photo">
                    <button class="contact_photo">CARD PHOTO</button>
                </div>
      </div>   
                
      



        

<!------------------------------------------------------ WP QUERY - ZONE SOUS ARTICLE PHOTO ---------------------------------------------------------->     
            <div class="section_query">
            <h3 class="margin_text">VOUS AIMERIEZ AUSSI</h3>
            <div>
            <!-- RECUPERE tous les thermes de notre catégorie-->
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
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            <div class="photos_post">
            <button class="contact_photo">Toutes les photos</button>
            </div>
    <?php endwhile; endif; ?>

  </main>
</div>

<?php
get_footer(); // Inclure le pied de page du thème WordPress
?>
