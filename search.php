<?php get_header(); ?>

<?php if (have_posts()): ?>

    <h1>Résultats de la recherche pour : <em><?php the_search_query(); ?></em></h1>

<?php
while (have_posts()):
  the_post();

  the_title(
    sprintf('<h2><a href="%s" rel="bookmark">', esc_url(get_permalink())),
    '</a></h2>'
  );

  the_excerpt();
endwhile;

the_posts_navigation();
else:?>
 <h1>Aucun résultat pour : <em><?php the_search_query(); ?></em></h1>

<?php endif; ?>

<?php get_footer(); ?>
