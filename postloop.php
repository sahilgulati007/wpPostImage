<?php /* Template Name: PostImgPage */ ?>
<?php get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main" onload="">
                <div style="width: 50%; float: left">
                <?php
                $args = array(
                'posts_per_page' => 10
                );

                $my_query = new WP_Query($args);

                // now start your loop
                if ( $my_query->have_posts() ) :
                while ( $my_query->have_posts() ) :
                $my_query->the_post();
                // print post data, title, content .etc
                    echo "<div onclick='myAjaxFunction(".get_the_ID().")'>";
                    the_title();
                    the_excerpt();
                    //echo get_the_post_thumbnail_url();
                    //the_content();
                    echo "</div>";

                endwhile;
                endif;
                ?>
                </div>
                <div style="width: 50%; float: left" id="imgdisp"><img src="<?php echo get_the_post_thumbnail_url($_COOKIE['myJavascriptVar']); ?>" id="imgdisp1"></div>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php //get_sidebar(); ?>
    </div><!-- .wrap -->
    <?php
    function GetLastPostId()
    {
    global $wpdb;

    $query = "SELECT ID FROM $wpdb->posts ORDER BY ID DESC LIMIT 0,1";

    $result = $wpdb->get_results($query);
    $row = $result[0];
    $id = $row->ID;

        $_COOKIE['myJavascriptVar']= $id;
    }
    ?>
    <script>

        function myFunction(no) {
            document.cookie= "myJavascriptVar = " + no ;
            <?php $i=get_the_post_thumbnail_url($_COOKIE['myJavascriptVar']); ?>
            location.reload();

        }
        function myAjaxFunction(no) {
            var data={
                action: 'addImage',
                dno: no
            };
            var ajaxurl = "http://localhost/wordpresspostimg/wp-admin/admin-ajax.php";  //WHAT IS THIS?!?!
            jQuery.post(ajaxurl, data, function(response) {
                document.getElementById('imgdisp1').src = response;
            });
        }
    </script>
<?php get_footer();