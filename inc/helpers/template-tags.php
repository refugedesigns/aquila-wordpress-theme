<?php

function get_the_post_custom_thumbnail($post_id, $size="featured_thumbnail", $additional_attributes=[]) {
    if($post_id === null) {
        $post_id = get_the_ID();
    }

    if(has_post_thumbnail($post_id)) {

        $default_attributes = [
            'loading' => 'lazy',
        ];

        $attributes = array_merge($default_attributes, $additional_attributes);
        
        $custom_thumbnail = wp_get_attachment_image(
            get_post_thumbnail_id($post_id),
            $size,
            false,
            $attributes
        );
    }

    return $custom_thumbnail;
}

function the_post_custom_thumbnail($post_id, $size="featured_thumbnail", $additional_attributes=[]) {
    echo get_the_post_thumbnail($post_id, $size, $additional_attributes);
}


function aquila_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    //If post is modified
    if(get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s" >%4$s</time>';
    }

    $time_string = sprintf($time_string,
    esc_attr(get_the_date(DATE_W3C)),
    esc_attr(get_the_date()),
    esc_attr(get_the_modified_date(DATE_W3C)),
    esc_attr(get_the_modified_date())
);
    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'Aquila'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}