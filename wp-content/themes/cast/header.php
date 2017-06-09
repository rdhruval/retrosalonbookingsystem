<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Cast management</title>

        <style>.casteerror{color:red;}</style>        
        <!-- js-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

        
                <!-- calender -->
        <script>
            $(function () {
                $("#datepicker").datepicker();
            });
        </script>
        <!-- start auto complete -->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#searching_casts").autocomplete({
                    source: '<?php echo get_bloginfo("template_url"); ?>/suggest.php',
                    minLength: 1
                });
            });
        </script>

        <!-- end auto complete-->

        <!-- add dynamic textfield-->
        <script type="text/javascript">
            $(document).ready(function () {
                var max_fields = 3; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_button = $(".add_field_button"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function (e) { //on add input button click
                    e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div><input type="text" name="mysis[]" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
                    }
                });

                $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });

        </script>
        <!-- for brother-->
        <script type="text/javascript">
            $(document).ready(function () {
                var max_fields_bro = 3; //maximum input boxes allowed
                var wrapper_bro = $(".input_fields_wraps"); //Fields wrapper
                var add_button_bro = $(".add_field_buttons"); //Add button ID

                var y = 1; //initlal text box count
                $(add_button_bro).click(function (e) { //on add input button click
                    e.preventDefault();
                    if (y < max_fields_bro) { //max input box allowed
                        y++; //text box increment
                        $(wrapper_bro).append('<div><input type="text" name="mytexts[]" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
                    }
                });

                $(wrapper_bro).on("click", ".remove_field", function (e) { //user click on remove text
                    e.preventDefault();
                    $(this).parent('div').remove();
                    y--;
                })
            });

        </script>
        <!-- for add a child-->
        <script type="text/javascript">
            $(document).ready(function () {
                var max_fields_child = 3; //maximum input boxes allowed
                var wrapper_child = $(".input_fields_wraps_child"); //Fields wrapper
                var add_button_child = $(".add_field_button_child"); //Add button ID

                var z = 1; //initlal text box count
                $(add_button_child).click(function (e) { //on add input button click
                    e.preventDefault();
                    if (z < max_fields_child) { //max input box allowed
                        z++; //text box increment
                        $(wrapper_child).append('<div><input type="text" name="mychild[]" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
                    }
                });

                $(wrapper_child).on("click", ".remove_field", function (e) { //user click on remove text
                    e.preventDefault();
                    $(this).parent('div').remove();
                    z--;
                })
            });
            //for calender
            function mydate() {
                //alert("");
                document.getElementById("dt").hidden = false;
                document.getElementById("ndt").hidden = true;
            }

            function mydate1() {
                d = new Date(document.getElementById("dt").value);
                dt = d.getDate();
                mn = d.getMonth();
                mn++;
                yy = d.getFullYear();
                document.getElementById("ndt").value = dt + "/" + mn + "/" + yy
                document.getElementById("ndt").hidden = false;
                document.getElementById("dt").hidden = true;
            }

        </script>

        <!-- brother and sister detail -->
<!--        <script>
            $(document).ready(function () {

                $("#have_sis").click(function () {
                    $("#show_boxs").show();
                });
                
                $("#have_bro").click(function(){
                   $("#show_boxs_bro").show();
                });
            });
        </script>-->

        <!-- hide and show married and unmarried details-->
        <script>
            $(document).ready(function () {
                $("#show_unmarried").click(function () {
                    $("#show_spouse").hide();
                    $("#baby_detail").hide();
                });
                $("#show_married").click(function () {
                    $("#show_spouse").show();
                    $("#baby_detail").show();
                });

                // for brother and sister checkbox field hide and show
                $(function () {
                    $("#have_sis").on("click", function () {
                        $("#show_boxs").toggle(this.checked);
                    });
                });
                //brother
                $(function () {
                    $("#have_bro").on("click", function () {
                        $("#show_boxs_bro").toggle(this.checked);
                    });
                });
            });
        </script>
        
<!-- exercise task for post type and js-->

        <script type="text/javascript">
    function custom_post_name() {
        var post_type = $('#postss').val();
        // alert(post_type);
        $.ajax({
            type: "POST",
            url: "<?php echo home_url(); ?>/wp-admin/admin-ajax.php",
            data: {action: "custom_post_name", result: post_type},
            success: function (data)
            {
                // alert(data);
                //alert('hiii');
                $("#texonomysss").html(data);
            }
        });
    }
</script>
<script type="text/javascript">
    function texonomy_select() {
        var texonomy_type = $('#texonomysss').val();
        alert(texonomy_type);
        $.ajax({
            type: "POST",
            url: "<?php echo home_url(); ?>/wp-admin/admin-ajax.php",
            data: {action: "texonomy_select", texoresult: texonomy_type},
            success: function (data)
            {
                alert(data);
                //alert('hiii');
                $("#terms_name").html(data);
            }
        });
    }
</script>

<!-- end exercise task for post type and js-->
        <?php wp_head(); ?>
    </head>

    <body id="page-top" class="index">        
        <!--        <div id="skipnav"><a href="#maincontent">Skip to main content</a></div>-->

        <!-- Navigation -->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">

            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <!--                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                                        </button>
                                        -----------------------  for dymanic logo ------------------------------------>

                    <a class="navbar-brand" href="#page-top"><?php the_custom_logo(); ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'container_class' => 'collapse navbar-collapse',
                    ));
                    ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- Header -->
        <header>            
            <div class="container" id="maincontent" tabindex="-1">
                <div class="row">
                    <div class="col-lg-12"><h1>CAST MANAGEMENT</h1></div>
                </div>
            </div>
        </header>
