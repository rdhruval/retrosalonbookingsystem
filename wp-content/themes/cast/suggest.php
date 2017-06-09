<?php

include('../../../wp-load.php');

$post_term = $_GET["term"];

$custom_posts = array(
    'post_type' => 'post', 
    "s" => $post_term             
);

$search = array();

$custom_postresult = new WP_Query($custom_posts);

if ($custom_postresult->have_posts()) {
    while ($custom_postresult->have_posts()) {
        $custom_postresult->the_post();

        $search[] = array('value' => get_the_title());
        
    } 
}
echo json_encode($search);
?>