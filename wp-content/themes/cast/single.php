<?php  get_header(); ?>

<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 style="color:blue" align="center">Your search result</h5>
                </div>
                <form>
                    <div class="panel-body">
                        <?php if (have_posts()):while (have_posts()):the_post(); ?>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail">Surname : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'surname', true); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputmiddlename">Middle name : </label>
                                            <input type="text" class="form-control input-sm" value="<?php the_title(); ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputfathername">Father name : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'fathername', true) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputmothername">Mother name : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'mothername', true) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputsistername">Sister name : </label>
                                            <?php
                                            $get_sis = get_post_meta(get_the_id(), 'sister');
                                            foreach ($get_sis as $sis_names) {
                                                ?>
                                                <input type="text" class="form-control input-sm" value="<?php echo $sis_names; ?>" readonly>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputbrothername">Brother name : </label>
                                            <?php
                                            $get_bro = get_post_meta(get_the_id(), 'brother');
                                            foreach ($get_bro as $bro_names) {
                                                ?>
                                                <input type="text" class="form-control input-sm" value="<?php echo $bro_names; ?>" readonly>                       

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <?php
                                            $gen = get_post_meta(get_the_id(), 'gender', true);
                                            if ($gen == 'male') {
                                                echo '<input type="text" class="form-control input-sm" name="castradio" value="male" readonly>';
                                                //echo '<input type="radio" name="castradio" value="female" disabled>FEMALE';
                                            } else {
                                                //echo '<input type="radio" name="castradio" value="male" disabled>MALE';
                                                echo '<input type="text" class="form-control input-sm" name="castradio" value="female" readonly>';
                                            }
                                            ?> 
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputcastname">Cast : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'cast', true) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputaddressname">Address : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'address', true) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputemailname">E-MAIL : </label>
                                            <input type="email" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'email', true) ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputstausname">Status : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'status', true) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputspousename">Spouse : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'spouse', true) ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="inputoccupationname">Occupation : </label>
                                            <input type="text" class="form-control input-sm" value="<?php echo get_post_meta(get_the_id(), 'occupation', true) ?>" readonly>
                                        </div>  
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>