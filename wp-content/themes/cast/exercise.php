<?php
/*template name:Exercise 
*/
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Search</h2>  <br>
            <form method="post" action="">
                <table class="table table-striped table-bordered" width="100%">
                    <tr>
                        <th>POST TYPES</th>
                        <td>     
                            <select name="posts" id="postss" onchange="custom_post_name()">
                                <option value="" disabled selected>-- select post type -- </option>
                                <?php
                                $args = array(
                                    'public' => true,
                                    '_builtin' => false
                                );
                                // print_r($args);
                                $output = 'names'; // names or objects, note names is the default
                                $operator = 'and'; // 'and' or 'or'

                                $post_types = get_post_types($args, $output, $operator);

                                foreach ($post_types as $post_type) {
                                    //print_r($post_type)
                                    ?>
                                    <option value="<?php echo $post_type; ?>"><?php echo $post_type; ?> 
                                        <?php
                                    }
                                    ?>
                                </option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Texonomy</th>
                        <td>
                            <select name="texonomy" id="texonomysss" onchange="texonomy_select()">
                                <option value="" disabled selected> --select here--</option>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Terms</th>
                        <td>
                            <select name="terms" id="terms_name">
                                <option value="" disabled selected> --select here--</option>

                            </select>
                        </td>
                    </tr>

                    <tr align="center">
                        <td colspan="2"><input type="submit" name="search-post" value="search" class="btn btn-danger"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile = new Blob([csv], {type: "text/csv"});

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Hide download link
        downloadLink.style.display = "none";

        // Add the link to DOM
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }
// The exportTableToCSV() function creates CSV data from table HTML and download CSV data as a file by using the downloadCSV() function.

    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("#report tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
                row.push(cols[j].innerText);

            csv.push(row.join(","));
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
</script>

<!--</section>-->
<!-- About Section -->

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php
            if (isset($_POST['search-post'])) {


                $post_name = $_POST['posts'];
                $post_texonomy = $_POST['texonomy'];
                $post_terms = $_POST['terms'];

                $post_array = array(
                    'post_per_page' => 5,
                    'post_type' => $post_name
                );

                if (!empty($post_texonomy)) {
                    $post_array['tax_query'] = array(
                        array(
                            'taxonomy' => $post_texonomy,
                            'field' => 'name',
                            'terms' => $post_terms
                        ),
                    );
                    /////////
//                    $post_array = array(
//                        'tax_query' => array(
//                            array(
//                                'taxonomy' => $post_texonomy,
//                                'field' => 'slug',
//                                'terms' => $post_terms
//                            ),
//                        ),
//                        'post_type' => $post_name
//                    );
                }
                ?>
                <section id="portfolio">
                    <h1>SEARCH RESULT</h1>
                    <table  class="table table-striped table-bordered" width="100%" id="report">
                        <tr>
                            <th>TITLE</th>
                            <th>WRITER</th>
                            <th>Rating</th>
                            <th>price</th>
                        </tr>
                        <?php
                        $post_results = new WP_Query($post_array);
                        if ($post_results->have_posts()):while ($post_results->have_posts()):$post_results->the_post();
                                ?>
                                <tr>
                                    <td><a href="<?php the_permalink();?>"><?php the_title(); ?></td>
                                    <td><?php the_terms(get_the_id(), 'writer'); ?></td>
                                    <td><?php echo get_post_meta(get_the_id(), 'rating', true) ?></td>
                                    <td><?php echo get_post_meta(get_the_id(), 'price', true) ?></td>
                                </tr>
                                <?php
                            endwhile;
                            wp_reset_postdata();

                        endif;
                        ?>
                        <input type="submit" value="Genrate CSV file" name="submit" onclick="exportTableToCSV('members.csv')" class="btn btn-success">
                    </table>
                </section>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
