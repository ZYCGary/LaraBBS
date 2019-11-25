<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * Identify the active category bar at the page header.
 */
function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}

/**
 * Generate the excerpt for a topic.
 * The generated excerpt will be used as the 'description' meta tag for SEO
 * 
 * @return string
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}
