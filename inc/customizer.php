<?php
function mycustomtheme_customize_register($wp_customize) {
    // Add a section for theme color
    $wp_customize->add_section('mycustomtheme_colors', array(
        'title'    => __('Theme Colors', 'mycustomtheme'),
        'priority' => 30,
    ));

    // Add setting for primary color
    $wp_customize->add_setting('mycustomtheme_primary_color', array(
        'default'   => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    // Add control for primary color
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'mycustomtheme_primary_color',
        array(
            'label'    => __('Primary Color', 'mycustomtheme'),
            'section'  => 'mycustomtheme_colors',
            'settings' => 'mycustomtheme_primary_color',
        )
    ));
}
add_action('customize_register', 'mycustomtheme_customize_register');

// Apply custom styles
function mycustomtheme_customizer_css() {
    $primary_color = get_theme_mod('mycustomtheme_primary_color', '#007bff');
    echo "<style>
        :root {
            --primary-color: {$primary_color};
        }
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        .text-primary {
            color: var(--primary-color) !important;
        }
    </style>";
}
add_action('wp_head', 'mycustomtheme_customizer_css');
