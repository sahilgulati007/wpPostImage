//ajax call
wp_enqueue_script('jquery');
function addImage(){
    $n=$_POST['dno'];
    echo get_the_post_thumbnail_url($n);
    die();

}
add_action('wp_ajax_addImage', 'addImage');
add_action('wp_ajax_nopriv_addImage', 'addImage');