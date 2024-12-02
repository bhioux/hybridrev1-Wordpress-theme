<?php
// Theme Setup
require get_template_directory() . '/inc/customizer.php';

function mycustomtheme_setup() {
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Register Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mycustomtheme'),
        'footer' => __('Footer Menu', 'mycustomtheme'),
    ));

    // Register Custom Post Types
    register_post_type('portfolio', array(
        'labels' => array(
            'name' => __('Portfolio', 'mycustomtheme'),
            'singular_name' => __('Portfolio Item', 'mycustomtheme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}
add_action('after_setup_theme', 'mycustomtheme_setup');

// Enqueue Scripts and Styles
function mycustomtheme_enqueue_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('mycustomtheme-style', get_stylesheet_uri());
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mycustomtheme_enqueue_scripts');

// Register Widgets
function mycustomtheme_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'mycustomtheme'),
        'id' => 'sidebar-1',
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'mycustomtheme_widgets_init');

// Register Custom Feature Widget
function mycustomtheme_feature_widget() {
    register_widget('MyCustomTheme_Feature_Widget');
}
add_action('widgets_init', 'mycustomtheme_feature_widget');

// Define the Custom Widget Class
class MyCustomTheme_Feature_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'mycustomtheme_feature_widget',
            __('Feature Widget', 'mycustomtheme'),
            array('description' => __('Displays a feature with an icon, title, and description.', 'mycustomtheme'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <div class="feature-widget text-center">
            <?php if (!empty($instance['icon'])) : ?>
                <i class="<?php echo esc_attr($instance['icon']); ?>"></i>
            <?php endif; ?>
            <h4><?php echo esc_html($instance['title']); ?></h4>
            <p><?php echo esc_html($instance['description']); ?></p>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $icon = !empty($instance['icon']) ? $instance['icon'] : '';
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $description = !empty($instance['description']) ? $instance['description'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon Class:', 'mycustomtheme'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo esc_attr($icon); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mycustomtheme'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'mycustomtheme'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['icon'] = (!empty($new_instance['icon'])) ? strip_tags($new_instance['icon']) : '';
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';
        return $instance;
    }
}

function mycustomtheme_enqueue_slick() {
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/css/slick.css');
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), null, true);
    wp_enqueue_script('mycustomtheme-slick-init', get_template_directory_uri() . '/assets/js/slick-init.js', array('slick'), null, true);
}
add_action('wp_enqueue_scripts', 'mycustomtheme_enqueue_slick');


?>
