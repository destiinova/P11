<?php get_header(); ?>

<main>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>


<!-- 
Bouton pour ouvrir la modale 
<button id="openModalBtn">Ouvrir la modale</button>

 Modale 
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Titre de la modale</h2>
    <p>Contenu de la modale...</p>
  </div>
</div> -->
