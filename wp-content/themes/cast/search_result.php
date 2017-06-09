<?php
/*
 * template name:result 
 */
get_header();
?>
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <form class="navbar-form navbar-left" role="search" method="post" action="">
                    <div class="form-group">
                        <input type="text" name="your_search_name" class="form-control" placeholder="Search" id="searching_casts">
                    </div>
                    <input type="submit" class="btn btn-default" name="search_casts" value="search">
                </form> 

                <?php
                if (isset($_POST['search_casts'])) {

                    $result = $_POST['your_search_name'];

                    //$searchname = !empty($_POST['your_search_name']) ? $_POST['your_search_name'] : '';    

                    $post_array = array(
                        'posts_per_page' => 2,
                        'post_type' => 'post',
                        'meta_query' => array(
                            'relation' => 'or',
                            array(
                                'key' => 'fathername',
                                'value' => $result,
                                'compare' => 'like'
                            ),
                            array(
                                'key' => 'mothername',
                                'value' => $result,
                                'compare' => 'like'
                            ),
                            array(
                                'key' => 'yourname',
                                'value' => $result,
                                'compare' => 'like'
                            ),
                            array(
                                'key' => 'brother',
                                'value' => $result,
                                'compare' => 'like'
                            ),
                            array(
                                'key' => 'sister',
                                'value' => $result,
                                'compare' => 'like'
                            )
                        )
                    );
//    echo '<pre>';
//    print_r($post_array);
//    echo '</pre>';
                    ?>                
                    <h1 style="color:blue" align="center">Your search result</h1>
                    <table class="table table-striped table-bordered">
                        <?php
                        $cast_serch_result = new WP_Query($post_array);

                        if ($cast_serch_result->have_posts()):while ($cast_serch_result->have_posts()):$cast_serch_result->the_post();
                                $result_link = get_the_permalink();
                                $result_tile = get_the_title();
                                $father = get_post_meta(get_the_ID(), 'fathername', TRUE);
                                if ($result == $father) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result . "  " . 'is father of'; ?></td>
                                        <td> <a href="<?php echo $result_link; ?>"><?php echo $result_tile; ?></a> </td>
                                    </tr>

                                    <?php
                                }
                                $mother = get_post_meta(get_the_ID(), 'mothername', TRUE);
                                if ($result == $mother) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result . " " . 'is mother of'; ?></td>
                                        <td> <a href="<?php echo $result_link; ?>"><?php echo $result_tile; ?></a> </td>
                                    </tr>
                                    <?php
                                }
                                 $yourname = get_post_meta(get_the_ID(), 'yourname', TRUE);
                                if ($result == $yourname) {
                                    ?>
                                    <tr>
                                        <td colspan="2"> <a href="<?php echo $result_link; ?>"><?php echo $result_tile; ?></a> </td>
                                    </tr>

                                    <?php
                                }
                                $brother = get_post_meta(get_the_ID(), 'brother', TRUE);
                                if ($result == $brother) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result . "  " . 'is brother of'; ?></td>
                                        <td> <a href="<?php echo $result_link; ?>"><?php echo $result_tile; ?></a> </td>
                                    </tr>
                                    <?php
                                }
                                $sister = get_post_meta(get_the_ID(), 'sister', TRUE);
                                if ($result == $sister) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result . "  " . 'is sister of'; ?></td>
                                        <td> <a href="<?php echo $result_link; ?>"><?php echo $result_tile; ?></a> </td>
                                    </tr>
                                    <?php
                                }
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </table>
    <?php
}
?>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
 ?>
