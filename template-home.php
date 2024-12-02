<?php
/* Template Name: Home */
get_header();
?>

<div class="hero bg-light text-center py-5">
    <h1>Welcome to <?php bloginfo('name'); ?></h1>
    <p>Your success starts here.</p>
</div>

<div class="container my-5">
    <h2>Latest Posts</h2>
    <div class="row">
        <?php
        $latest_posts = new WP_Query(array('posts_per_page' => 3));
        while ($latest_posts->have_posts()) : $latest_posts->the_post();
        ?>
            <div class="col-md-4">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?>

<div class="hero-slider">
    <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/slide1.jpg" alt="Slide 1"></div>
    <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/slide2.jpg" alt="Slide 2"></div>
    <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/slide3.jpg" alt="Slide 3"></div>
</div>

