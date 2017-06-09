<?php
/*
  This is library functions file which used to manage our theme conrtols and major setting.
  like dymanic logo add css and js.
  menus and many more.

 */

function cast_setting() {
    //add menus
    register_nav_menus(array(
        'header' => __('header menu', 'cast'),
        'footer' => __('footer menu', 'cast'),
    ));
// add a custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 100,
        'flex-width' => true
    ));
}

// add hook for custom logo
add_action('after_setup_theme', 'cast_setting');

//for enable a featured image
add_theme_support('post-thumbnails');

/*
 * add css and js.
 * using wp_enqueue_style
 * it hook is wp_enqueue_scripts.
 */

function cast_styles() {
    wp_enqueue_style('cast_style', get_stylesheet_uri());
    wp_enqueue_style('cast_bootmin', get_template_directory_uri() . '/css/bootstrap.min.css', array());
    wp_enqueue_style('cast_freemin', get_template_directory_uri() . '/css/freelancer.min.css', array());
    wp_enqueue_style('cast_fontmin', get_template_directory_uri() . '/css/font-awesome.min.css', array());
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui.css', array());
    wp_enqueue_style('jquery-font-ui', get_template_directory_uri() . '/css/jquery-font-ui.css', array());


    wp_enqueue_script('cas_bootminjs', get_template_directory_uri() . '/js/bootstrap.min.js');
    wp_enqueue_script('cast_freeminjs', get_template_directory_uri() . '/js/freelancer.min.js');
    //wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.js',array(),true);
    // wp_enqueue_script('cast_min', get_template_directory_uri() . '/js/jquery.min.js',array(),true);
    //wp_enqueue_script('cast_min_ui', get_template_directory_uri() . '/js/jquery-ui.min.js',array(),true);
}

//add css and js under scripts hook
add_action('wp_enqueue_scripts', 'cast_styles');

function load_cstom_wp_admin_style() {

    wp_register_script('far_admin_ajax', plugins_url('js/far_admin.js', __FILE__), false);
    wp_enqueue_script('far_admin_ajax');

    wp_register_script('cutom_wp_admin_js', plugins_url(delete) . '/js/jquery.js');
    wp_enqueue_script('cutom_wp_admin_js');
}

add_action('admin_enqueue_scripts', 'load_cstom_wp_admin_style');
//function load_custom_wp_admin_style() {
//    wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/css/bootstrap.min.css', array());
//    wp_enqueue_style('custom_wp_admin_css');
//}
//
//add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');
//add_filter( 'login_headerurl', 'custom_loginlogo_url' );
//
//	function custom_loginlogo_url($url) {
//
//	    return 'http://www.darkghost.com';
//        }
// task by tejas change admin login url
add_filter('login_headerurl', 'xs_login_headerurl');

function xs_login_headerurl($url) {
    return esc_url('http://www.fb.com');
}

add_filter('login_headertitle', 'xs_login_headertitle');

function xs_login_headertitle($title) {
    return get_bloginfo('word') . ' – ' . get_bloginfo('on hand');
}

/*
 * add custom post type for book
 */


add_action('init', 'managepost_custompost_init');

function managepost_custompost_init() {
    $labels = array(
        'name' => _x('Books', 'post type general name', 'your-plugin-textdomain'), //name of our custom post display in top left wrapper
        'singular_name' => _x('Book', 'post type singular name', 'your-plugin-textdomain'), //like post and page
        'menu_name' => _x('Books', 'admin menu', 'your-plugin-textdomain'), //display in admin menubar name
        'name_admin_bar' => _x('Book', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'book', 'your-plugin-textdomain'), //in menubar name and also wrapper top
        'add_new_item' => __('Add New Book', 'your-plugin-textdomain'), //title display in wrapper top after click on add new
        'new_item' => __('New Book', 'your-plugin-textdomain'),
        'edit_item' => __('edit Book', 'your-plugin-textdomain'),
        'view_item' => __('View Book', 'your-plugin-textdomain'),
        'all_items' => __('All Books', 'your-plugin-textdomain'), //display in menubar
        'search_items' => __('Search', 'your-plugin-textdomain'), //display rightside serach bar
        'parent_item_colon' => __('Parent Books:', 'your-plugin-textdomain'),
        'not_found' => __('No books found.', 'your-plugin-textdomain'), //display msg if no post found on admin side
        'not_found_in_trash' => __('No books found in Trash.', 'your-plugin-textdomain')//if no book found in trash on admin side
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'your-plugin-textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'book'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields',)//add custom field bcoz add more data rather than content
    );

    register_post_type('book', $args); //in serch url post_typr="here your custom post type name"
}

/*
 * add cutom texonomy for a book.
 * and it also fire under the init hook.
 */
add_action('init', 'managepost_book_taxonomies');

function managepost_book_taxonomies() {
// Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Genres', 'taxonomy general name', 'textdomain'), //display name in wrapper rightside 
        'singular_name' => _x('Genre', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Genres', 'textdomain'), //serch bar in wrapper rightside 
        'all_items' => __('all Genres', 'textdomain'), //in rightside when add new book wrapper rightside under genr tag name.
        'parent_item' => __('Parent genre', 'textdomain'), //when add new gener it display parent genre (dropdown)
        'parent_item_colon' => __('Parent Genre:', 'textdomain'),
        'edit_item' => __('Edit Genre', 'textdomain'),
        'update_item' => __('Update Genre', 'textdomain'),
        'add_new_item' => __('Add New Genre', 'textdomain'), //display click on genre on wrapper tag 
        'new_item_name' => __('New Genre Name', 'textdomain'),
        'menu_name' => __('Genre', 'textdomain'), //in admin panel display name
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    );

    register_taxonomy('genre', array('book'), $args); //register under the custom post type book

    $labels = array(
        'name' => _x('Writers', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('writer', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search Writers', 'textdomain'),
        'popular_items' => __('Popular Writers', 'textdomain'),
        'all_items' => __('All Writers', 'textdomain'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Writer', 'textdomain'),
        'update_item' => __('Update Writer', 'textdomain'),
        'add_new_item' => __('Add New Writer', 'textdomain'),
        'new_item_name' => __('New Writer Name', 'textdomain'),
        'separate_items_with_commas' => __('Separate writers with commas', 'textdomain'),
        'add_or_remove_items' => __('Add or remove writers', 'textdomain'),
        'choose_from_most_used' => __('Choose from the most used writers', 'textdomain'),
        'not_found' => __('No writers found.', 'textdomain'),
        'menu_name' => __('Writers', 'textdomain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'writer'),
    );

    register_taxonomy('writer', 'book', $args);
}

// another custom post

add_action('init', 'custompost_init');

function custompost_init() {
    $labels = array(
        'name' => _x('movies', 'post type general name', 'your-plugin-textdomain'), //name of our custom post display in top left wrapper
        'singular_name' => _x('movie', 'post type singular name', 'your-plugin-textdomain'), //like post and page
        'menu_name' => _x('Movie', 'admin menu', 'your-plugin-textdomain'), //display in admin menubar name
        'name_admin_bar' => _x('Book', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'movie', 'your-plugin-textdomain'), //in menubar name and also wrapper top
        'add_new_item' => __('Add New movie', 'your-plugin-textdomain'), //title display in wrapper top after click on add new
        'new_item' => __('New movie', 'your-plugin-textdomain'),
        'edit_item' => __('edit movie', 'your-plugin-textdomain'),
        'view_item' => __('View movie', 'your-plugin-textdomain'),
        'all_items' => __('All movies', 'your-plugin-textdomain'), //display in menubar
        'search_items' => __('Search', 'your-plugin-textdomain'), //display rightside serach bar
        'parent_item_colon' => __('Parent movies:', 'your-plugin-textdomain'),
        'not_found' => __('No movie found.', 'your-plugin-textdomain'), //display msg if no post found on admin side
        'not_found_in_trash' => __('No books found in Trash.', 'your-plugin-textdomain')//if no book found in trash on admin side
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'your-plugin-textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'movie'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields',)//add custom field bcoz add more data rather than content
    );

    register_post_type('movie', $args); //in serch url post_typr="here your custom post type name"
}

/*
 * add cutom texonomy for a book.
 * and it also fire under the init hook.
 */
add_action('init', 'movie_taxonomies');

function movie_taxonomies() {
// Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('type', 'taxonomy general name', 'textdomain'), //display name in wrapper rightside 
        'singular_name' => _x('type', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search type', 'textdomain'), //serch bar in wrapper rightside 
        'all_items' => __('all type', 'textdomain'), //in rightside when add new book wrapper rightside under genr tag name.
        'parent_item' => __('Parent type', 'textdomain'), //when add new gener it display parent genre (dropdown)
        'parent_item_colon' => __('Parent type:', 'textdomain'),
        'edit_item' => __('Edit type', 'textdomain'),
        'update_item' => __('Update type', 'textdomain'),
        'add_new_item' => __('Add New type', 'textdomain'), //display click on genre on wrapper tag 
        'new_item_name' => __('New type Name', 'textdomain'),
        'menu_name' => __('type', 'textdomain'), //in admin panel display name
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type'),
    );

    register_taxonomy('type', array('movie'), $args); //register under the custom posttype movie

    $labels = array(
        'name' => _x('categories', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('category', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Search categories', 'textdomain'),
        'popular_items' => __('Popular categories', 'textdomain'),
        'all_items' => __('All categories', 'textdomain'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit category', 'textdomain'),
        'update_item' => __('Update category', 'textdomain'),
        'add_new_item' => __('Add New category', 'textdomain'),
        'new_item_name' => __('Newcategory Name', 'textdomain'),
        'separate_items_with_commas' => __('Separate category with commas', 'textdomain'),
        'add_or_remove_items' => __('Add or remove categories', 'textdomain'),
        'choose_from_most_used' => __('Choose from the most used categories', 'textdomain'),
        'not_found' => __('No category found.', 'textdomain'),
        'menu_name' => __('category', 'textdomain'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'category'),
    );

    register_taxonomy('category', 'movie', $args);
}

add_action('wp_ajax_custom_post_name', 'custom_post_name');
add_action('wp_ajax_nopriv_custom_post_name', 'custom_post_name');

function custom_post_name() {

    $search_post_value = $_REQUEST['result'];

    $custom_texonomy = array(
        'object_type' => array($search_post_value)
    );
//$texonomy_output = 'names'; // or objects
// $texonopmy_operator = 'and'; // 'and' or 'or'
    $taxonomies = get_taxonomies($custom_texonomy);
    echo'<option value="" disabled selected>select here</option>';
    foreach ($taxonomies as $value_texonomi) {
        ?>   
        <option value="<?php echo $value_texonomi; ?>"><?php echo $value_texonomi; ?></option>
        <?php
    }
    //die();
}
?>
<?php
add_action('wp_ajax_texonomy_select', 'texonomy_select');
add_action('wp_ajax_nopriv_texonomy_select', 'texonomy_select');

function texonomy_select() {

    $terms_value = $_REQUEST['texoresult'];

    $terms_tarray = array(
        'taxonomy' => $terms_value
    );
    // print_r($terms_tarray);
//$texonomy_output = 'names'; // or objects
// $texonopmy_operator = 'and'; // 'and' or 'or'
    $get_terms_value = get_terms($terms_tarray);
    echo'<option value="" disabled selected>select here</option>';
    foreach ($get_terms_value as $get_terms_result) {
        ?>   
        <option value="<?php echo $get_terms_result->name ?>"><?php echo $get_terms_result->name ?></option>
        <?php
    }
    die();
}
