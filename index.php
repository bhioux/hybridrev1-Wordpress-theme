<?php get_header(); ?>
<main class="container my-5">
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
        </article>
    <?php endwhile; else : ?>
        <p><?php _e('No posts found.', 'mycustomtheme'); ?></p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
