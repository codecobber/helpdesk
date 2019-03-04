 <?php 
 session_start();

 $userOnline = get_cookie('GS_ADMIN_USERNAME');

 $_SESSION['currentUser'] = $userOnline;

?>

<!doctype html>

<!--
=============================================
  Developed by Code Cobber for your enjoyment
  http://www.codecobber.co.uk
  Free for personal and commercial use under the CCA 4.0 license:  (see www.codecobber.co.uk/license)
=============================================
-->

<html class="no-js" lang="en">

<head>


    <meta charset=UTF-8>
    <title><?php get_page_clean_title(); ?> &mdash;  <?php get_site_name(); ?></title>
    <?php get_header(); ?>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/effects.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/push.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/app.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/myCss.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/rowData.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/animate.css" />


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Alegreya|Roboto|Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/cssFonts.css" />
    


    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">



    <!-- Javascript -->
    <script src="<?php get_theme_url(); ?>/js/vendor/jquery.js"></script>
    
    
    <?php 

   //Include javascript file if session is set

   if($_SESSION['currentUser'] != null || $_SESSION['currentUser'] != ""){?>
        <script src="<?php get_theme_url(); ?>/js/editGS.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/editGS.css" />
    
    <?php }
    
    ?>

    <script id="scrollCheck" src="<?php get_theme_url(); ?>/js/scrollCheck.js"></script>



    <!-- Google Analytics below -->
    <link rel="canonical" href="http://www.yoursite.co.uk/">


    <!-- Facebook og settings -->
    <meta property="og:title" content="title" />
    <meta property="og:url" content="http://www.yoursite.co.uk" />
    <meta property="og:image" content="http://www.yoursite.co.uk/images/logo.png" />
    <meta property="og:type" content="company" />



    <!-- twitter code below -->



</head>

<body id="<?php get_page_slug(); ?>" >


    <!-- SideNav content -->

    <div id="mySidenav" class="sidenav">
        <ul>
            <?php get_navigation(return_page_slug()); ?>
            <li><a class="editme" href="#">Edit</a></li>
        </ul>
    </div>

    <div id="main" class="hide-for-medium">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
    </div>

    <!-- ==================================================================================== -->


    <!-- show for medium up -->
    <div id="greyTB" class="show-for-medium">
        <div class="row column">
            <div id="widemenu" class="top-bar">
                <div class="top-bar-left">
                    <ul class="menu">
                        <li><a class="blockSec" id="cblocks" href="<?php get_site_url(); ?>"><i class="fa fa-eye fa-2x" aria-hidden="true"></i> Business logo</a>
                        </li>
                    </ul>
                </div>
                <div class="top-bar-right">
                    <ul class="menu">
                        <?php get_navigation(return_page_slug()); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id='start'>


        <div id="bck_1" class="bck">
            <div id="block_1" class="row rowNo28">
                <div class="pageTitle large-12 columns">
                    <img class="imgPlace  thumbnail" src="<?php get_theme_url(); ?>/img/sky.jpg">
                </div>
            </div>
        </div>
        <div id="bck_2" class="bck">
            <div id="block_2" class="row column text-center rowNo13">
                <h2><?php get_page_title(); ?></h2>
                <hr>
                <p class="ea" id="ps0"><?php get_component('ps0'); ?></p>
            </div>
        </div>
        <div id="bck_3" class="bck">
            <div id="block_3" class="row rowNo34">
                <div class="small-6 medium-6 large-3 columns">
                    <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/photo-1471724638242-7800ccb10614.jpg" alt="image for article" data-pin-nopin="true" data-scroll="animated fadeInUp">
                    <h3 class="ea" id="ps1"><?php get_component('ps1'); ?></h3>
                    <p class="ea" id="ps2"><?php get_component('ps2'); ?></p>
                </div>
                <div class="small-6 medium-6 large-3 columns">
                    <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/hbyzbu1xp6s-barn-images.jpg" alt="image for article" data-pin-nopin="true" data-scroll="animated fadeInUp">
                    <h3 class="ea" id="ps3"><?php get_component('ps3'); ?></h3>
                    <p class="ea" id="ps4"><?php get_component('ps4'); ?></p>
                </div>
                <div class="small-6 medium-6 large-3 columns">
                    <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/xmcothgncqa-joshua-sortino.jpg" alt="image for article" data-pin-nopin="true" data-scroll="animated fadeInUp">
                    <h3 class="ea" id="ps5"><?php get_component('ps5'); ?></h3>
                    <p class="ea" id="ps6">Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
                </div>
                <div class="small-6 medium-6 large-3 columns">
                    <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/photo-1470329508532-be27fda94658.jpg" alt="image for article" data-pin-nopin="true" data-scroll="animated fadeInUp">
                    <h3 class="ea" id="ps7">Sit Amet</h3>
                    <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna.</p>
                </div>
            </div>
        </div>
        <div id="bck_4" class="bck">
            <div id="block_4" class="row rowNo05">

                <div class="medium-6 columns medium-push-6">
                    <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/azkwkhyr54u-matthew-wiebe.jpg" data-scroll="animated fadeInUp">
                </div>
                <div class="medium-6 columns medium-pull-6 ">
                    <h2>Our Agency, our selves.</h2>
                    <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam porttitor mauris, quis sollicitudin sapien justo in libero. Vestibulum mollis mauris enim. Morbi euismod magna ac lorem rutrum elementum. Donec viverra auctor.</p>
                </div>

            </div>
        </div>
        <div id="bck_5" class="bck">
            <div id="block_5" class="row rowNo05">

                <div class="medium-6 columns medium-push-6">
                    <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/photo-1471651648670-e943f4302ae3.jpg" data-scroll="animated fadeInUp">
                </div>
                <div class="medium-6 columns medium-pull-6 ">
                    <h2>Our Agency, our selves.</h2>
                    <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam porttitor mauris, quis sollicitudin sapien justo in libero. Vestibulum mollis mauris enim. Morbi euismod magna ac lorem rutrum elementum. Donec viverra auctor.</p>
                </div>

            </div>
        </div>
        <div id="bck_6" class="bck">
            <div id="block_6" class="row column text-center rowNo37">
                <hr>
            </div>
        </div>
        <div id="bck_7" class="bck">
            <div id="block_7" class="row rowNo17">
                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-4 columns">
                            <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/nxhchd9dqko-bob-aubel.jpg">
                        </div>
                        <div class="large-8 columns">
                            <h4>Illnesses & conditions</h4>
                            <p>Bacon ipsum dolor sit amet nulla </p>
                        </div>
                    </div>
                </div>

                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-4 columns">
                            <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/pexels-photo-145707.jpg">
                        </div>
                        <div class="large-8 columns">
                            <h4>Injuries</h4>
                            <p>Bacon ipsum dolor sit amet nulla </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="bck_8" class="bck">
            <div id="block_8" class="row rowNo17">
                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-4 columns">
                            <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/rlyscmbf6ei-grzegorz-mleczek.jpg">
                        </div>
                        <div class="large-8 columns">
                            <h4>Illnesses & conditions</h4>
                            <p>Bacon ipsum dolor sit amet nulla </p>
                        </div>
                    </div>
                </div>

                <div class="large-6 columns">
                    <div class="row">
                        <div class="large-4 columns">
                            <img class="imgPlace addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/pexels-photolady.jpg">
                        </div>
                        <div class="large-8 columns">
                            <h4>Injuries</h4>
                            <p>Bacon ipsum dolor sit amet nulla </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="bck_9" class="bck">
            <div id="block_9" class="row rowNo10">
                <div class="medium-6 columns medium-6">
                    <img class="imgPlace thumbnail addBorder addRadius divShadowBot" src="<?php get_theme_url(); ?>/img/erqpwfijcx4-blake-richard-verdoorn.jpg" data-scroll="animated fadeInUp">
                </div>
                <div class="medium-6 columns medium-6">
                    <h2>Our Agency, our selves.</h2>
                    <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam porttitor mauris, quis sollicitudin sapien justo in libero. Vestibulum mollis mauris enim. Morbi euismod magna ac lorem rutrum elementum. Donec viverra auctor.</p>
                </div>
            </div>
        </div>
        <div id="bck_10" class="bck">
            <div id="block_10" class="row rowNo10">
                <div class="medium-6 columns medium-6">
                    <img class="imgPlace thumbnail addBorder addRadius" src="<?php get_theme_url(); ?>/img/a_xa7rukzdc-benjamin-sloth.jpg" data-scroll="animated fadeInUp">
                </div>
                <div class="medium-6 columns medium-6">
                    <h2>Our Agency, our selves.</h2>
                    <p>Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla fringilla, orci ac euismod semper, magna diam porttitor mauris, quis sollicitudin sapien justo in libero. Vestibulum mollis mauris enim. Morbi euismod magna ac lorem rutrum elementum. Donec viverra auctor.</p>
                </div>
            </div>
        </div>
        <div id="bck_11" class="bck">
            <div id="block_11" class="row column text-center rowNo37">
                <hr>
            </div>
        </div>
        <div id="bck_12" class="bck">
            <div id="block_12" class="row rowNo26">
                <div class="medium-6 medium-centered columns">
                    <div class="signup-panel">
                        <p class="welcome" data-scroll="animated fadeIn"> Welcome to this awesome app!</p>
                        <form>
                            <div class="row collapse">
                                <div class="small-2  columns">
                                    <span class="prefix"><i class="fi-torso-female"></i></span>
                                </div>
                                <div class="small-10  columns">
                                    <input type="text" placeholder="username">
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-2 columns">
                                    <span class="prefix"><i class="fi-mail"></i></span>
                                </div>
                                <div class="small-10  columns">
                                    <input type="text" placeholder="email">
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="small-2 columns ">
                                    <span class="prefix"><i class="fi-lock"></i></span>
                                </div>
                                <div class="small-10 columns ">
                                    <input type="text" placeholder="password">
                                </div>
                            </div>
                        </form>
                        <a href="#" class="button ">Sign Up! </a>
                        <p>Already have an account? <a href="#">Login here »</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Partial -->

    <footer id="footer">
        <div class="row footerTop">
            <div class="small-4 text-center medium-4 large-4 columns">
                <div class="copyright">
                    &copy;<?php get_site_name(); ?><a href="<?php get_site_url(); ?>"></a>
                </div>

            </div>


            <div class="small-4 medium-4 large-4  text-center columns">
                <small><?php get_site_credits(); ?></small>
            </div>



            <div class="small-4 show-for-medium medium-4 columns">
                <ul class="icons">
                    <li><a class="blockSec" id="cblocks" href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="blockSec" id="fblocks" href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="blockSec" id="iblocks" href="#"><i class="fa fa-pinterest-p fa-lg" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
            
    </footer>
    <?php get_footer(); ?>

    <!-- Close footer partial -->



    <script src="<?php get_theme_url(); ?>/js/vendor/what-input.js"></script>
    <script src="<?php get_theme_url(); ?>/js/vendor/foundation.min.js"></script>
    <script src="<?php get_theme_url(); ?>/js/app.js"></script>
    <script src="<?php get_theme_url(); ?>/js/slidePush.js"></script>

    

</body>

</html>