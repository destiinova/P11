<section class="section_aimerezaussi">
    <h2> Vous aimerez aussi </h2>
    <?php
    // On place les critères de la requête dans un Array
    $cats = array_map(function ($terms) {
        return $terms->term_id;
    }, get_the_terms(get_post(), 'categorie'));
    $args = array(
        'post__not_in' => [get_the_ID()],
        'order_by_rand' => 'rand',
        'post_type' => 'photo',
        'tax_query' => [
            [
                'taxonomy' => 'categorie',
                'terms' => $cats,
            ]
        ]
    );
    //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
    $query = new WP_Query($args);
    ?>
    <div class="photo_aleatoire">
        <!-- //On vérifie si le résultat de la requête contient des articles -->
        <?php if ($query->have_posts()): ?>

            <!-- //On parcourt chacun des articles résultant de la requête -->
            <?php $count = 0; ?>
            <?php while ($query->have_posts()): ?>
                <?php $count++; ?>
                <?php $query->the_post(); ?>


                <?php the_content(); ?>
                <?php if (has_post_thumbnail()): ?>

                    <div class="photo_aimerezaussi">
                        <?php the_post_thumbnail(); ?>
                        <div class="fadedbox">
                            <div class="title text">
                                <div class="titre">
                                    <p>
                                        <?php the_title(); ?>
                                    </p>
                                </div>
                                <div class="categorie">
                                    <p>
                                        <?php echo the_terms(get_the_ID(), 'categorie', false); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="divoeil">
                                <a href="<?php the_permalink(); ?>"><img
                                        src="<?php echo get_stylesheet_directory_uri(); ?>/asset/oeil.png " alt="oeil"> </a>
                            </div>
                            <div class="divfullscreen">
                            <button class="buttonlightbox buttonaimerezaussi" data-titre="<?php the_title(); ?>" data-date="<?php $post_date = get_the_date('Y');
                          echo $post_date; ?>" data-image="<?php echo esc_attr(get_the_post_thumbnail_url(get_the_ID())); ?>" data-categ="<?php
                               $categories = get_the_terms(get_the_ID(), 'categorie'); // Remplacez 'categorie' par le nom de votre taxonomie
                               if ($categories && !is_wp_error($categories)) {
                                   // Vérifie si la variable $categories existe et n'est pas une erreur de WordPress
                                   $category_names = array(); // Crée un tableau vide pour stocker les noms des catégories
                                   foreach ($categories as $category) {
                                       // Parcourt chaque terme de taxonomie dans $categories
                                       $category_names[] = $category->name;
                                       // Ajoute le nom de la catégorie courante au tableau $category_names
                                   }
                                   echo implode(', ', $category_names);
                                   // Concatène les noms des catégories avec une virgule comme séparateur
                               }
                               ?>"><img class="fullscreen"
                               src="<?php echo get_stylesheet_directory_uri(); ?> '/asset/fullscreen.png' " alt="fullscreen">"></button>
                            </div>
                        </div>
                    </div>
                    <?php if ($count == 2) {
                        break; // sortir de la boucle si deux photos ont été traitées
                    } ?>
                <?php endif; ?>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Désolé, aucun article ne correspond à cette requête</p>
    <?php endif;
        wp_reset_query();
        ?>
</section>