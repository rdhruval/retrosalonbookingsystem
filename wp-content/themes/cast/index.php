<?php get_header(); ?>
<?php
if (isset($_POST['save'])) {
    $user_surname = $_POST['surname'];
    $user_name = $_POST['yourname'];
    $user_father = $_POST['fathername'];
    $user_mother = $_POST['mothername'];
    $user_sister = $_POST['mysis'];
    $user_brothers = $_POST['mytexts'];
    $user_gender = $_POST['castradio'];
    $user_birth = $_POST['birth'];
    $user_cast = $_POST['cast'];
    $user_address = $_POST['address'];
    $user_email = $_POST['cast_email'];
    $user_status = $_POST['status'];
    $user_spouse = $_POST['spouse'];
    $user_child = $_POST['mychild'];
    $user_occupation = $_POST['occupation'];

    if (empty($_POST['surname'])) {
        $surname_error = 'please enter surname';
    } elseif (empty($_POST['yourname'])) {
        $name_error = 'please enter name';
    } elseif (empty($_POST['fathername'])) {
        $fathername_error = 'please enter father name';
    } elseif (empty($_POST['mothername'])) {
        $mothename_error = 'please enter mother name';
    } elseif (($_POST['castradio'] == "")) {
        $radio_error = 'please select gender first';
    }

    if (!empty($user_surname) && $user_father) {
//        echo '<pre>';
//        echo print_r($user_sister);
//        echo '</pre>';
        $post_result = array(
            'post_content' => 'cast management',
            'post_title' => $user_name,
            'post_status' => 'publish',
            'post_type' => 'post',
        );
        $value_post = wp_insert_post($post_result, true);

        if (is_wp_error($value_post)) {
            
        } else {
            update_post_meta($value_post, 'surname', $user_surname);
            update_post_meta($value_post, 'yourname', $user_name);
            update_post_meta($value_post, 'fathername', $user_father);
            update_post_meta($value_post, 'mothername', $user_mother);

            foreach ($user_sister as $user_sisters) {
                add_post_meta($value_post, 'sister', $user_sisters);
            }
            foreach ($user_brothers as $user_bross) {
                add_post_meta($value_post, 'brother', $user_bross);
            }
            update_post_meta($value_post, 'gender', $user_gender);
            update_post_meta($value_post, 'cast', $user_cast);
            update_post_meta($value_post, 'birth', $user_birth);
            update_post_meta($value_post, 'address', $user_address);
            update_post_meta($value_post, 'email', $user_email);
            update_post_meta($value_post, 'status', $user_status);
            update_post_meta($value_post, 'spouse', $user_spouse);

            foreach ($user_child as $user_childs) {
                add_post_meta($value_post, 'child', $user_childs);
            }
            update_post_meta($value_post, 'occupation', $user_occupation);

            echo '<h3 class="alert alert-success" role="alert">record inserted</h1>';
            unset($user_surname, $user_name, $user_father, $user_mother);
        }
    } else {
        'something wrong?';
    }
}
?>
<!-- Portfolio Grid Section -->
<!--<section id="portfolio">-->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php if (!isset($_POST['search_casts'])) {
                ?>                
                <div class="panel panel-default">
                    <div class="panel-heading">FORM</div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>First name:</th>
                                    <td><input type="text" name="surname" placeholder="surname" value="<?php if (isset($user_surname)) echo $user_surname; ?>"><span class="casteerror">* <?php echo $surname_error; ?></span>
        <!--                            <th>middle name:</th>-->
                                        <input type="text" name="yourname" placeholder="Enter your name" id="search_surname" value="<?php if (isset($user_name)) echo $user_name; ?>"><span class="casteerror">* <?php echo $name_error; ?></span>
            <!--                            <th>Last name:</th>-->
                                        <input type="text" name="fathername" placeholder="Enter Father name" value="<?php if (isset($user_father)) echo $user_father; ?>"><span class="casteerror">* <?php echo $fathername_error; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mother name:</th>
                                    <td>
                                        <input type="text" name="mothername" placeholder="Enter mother name" value="<?php if (isset($user_mother)) echo $user_mother; ?>"><span class="casteerror">* <?php echo $mothename_error; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Family detail:</th>
                                    <td><input type="checkbox" name="detail" value="sister" id="have_sis">Have you any sister?
                                        <input type="checkbox" name="detail" value="brother" id="have_bro" align="right">Have you any BROTHER?
                                        <div class="input_fields_wrap" id="show_boxs" style="display:none">
                                            <button class="add_field_button">Add More</button>
                                            <div><input type="text" name="mysis[]" placeholder="Enter sister name"></div>
                                        </div> 
                                        <div class="input_fields_wraps" id="show_boxs_bro" style="display:none" align="center">
                                            <button class="add_field_buttons">+</button>
                                            <div><input type="text" name="mytexts[]" placeholder="Enter brother name"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>
                                        <input type="radio" name="castradio" value="male">MALE
                                        <input type="radio" name="castradio" value="female">FEMALE
                                        <span class="casteerror">* <?php echo $radio_error; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date of birth</th>
                                    <td><input type="text" id="datepicker" name="birth"></td>
                                </tr>
                                <tr>
                                    <th>Cast</th>
                                    <td><select name="cast">
                                            <option disabled selected>--select caste--</option>
                                            <option value="lohana">LOHANA</option>
                                            <option value="xriya">XTRIYA</option>
                                            <option value="braman">BRAHMAN</option>
                                            <option value="jain">JAIN</option>
                                        </select>
                                        <span class="casteerror">* <?php //echo $nameerror;                     ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><textarea cols="50" rows="2" name="address" placeholder="Enter address"></textarea></td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td><input type="email" name="cast_email" placeholder="Enter email"></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><input type="radio" name="status" value="married" id="show_married">married
                                        <input type="radio" name="status" value="unmarried" id="show_unmarried" checked>unmarried
                                        <br>
                                        <input type="text" name="spouse" id="show_spouse" placeholder="Enter spouse name" style="display: none">
                                        <div class="input_fields_wraps_child" id="baby_detail" style="display:none">
                                            <button class="add_field_button_child">Add child?</button>
                                            <div><input type="text" name="mychild[]"></div>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Occupation</th>
                                    <td>
                                        <input type="text" name="occupation" placeholder="Enter Occupation">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="submit" value="submit" name="save" class="btn btn-info">
                                        <input type="reset" value="reset" name="reset" class="btn btn-danger">
                                    </td>
                                </tr>
                            </table>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>

<?php } ?>
<!--</section>-->
<!-- About Section -->
<!--<section class="success" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>RESULT</h2>
                <hr class="star-light">
            </div>
        </div>
    </div>
</section>-->

<!-- Footer -->
<?php get_footer(); ?>