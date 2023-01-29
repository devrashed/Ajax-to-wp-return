<?php 

// This would normally be enqueued as a file, but for the sake of ease we will just print to the footer
function add_this_script_footer(){ ?>

<script>
jQuery(document).ready(function($) {

    // This is the variable we are passing via AJAX
    var fruit = 'Banana';

    // This does the ajax request (The Call).
    $.ajax({
        url: ajaxurl, //Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
        data: {
            'action':'example_ajax_request', // This is our PHP function below
            'fruit' : fruit // This is the variable we are sending via AJAX
        },
        success:function(data) {
        // This outputs the result of the ajax request (The Callback)
            window.alert(data);
        },
        error: function(errorThrown){
            window.alert(errorThrown);
        }
    });

});
</script>
<?php }

add_action('in_admin_footer', 'add_this_script_footer');

function example_ajax_request() {

    // The $_REQUEST contains all the data sent via AJAX from the Javascript call
    if ( isset($_REQUEST) ) {

        $fruit = $_REQUEST['fruit'];

        // This bit is going to process our fruit variable into an Apple
        if ( $fruit == 'Banana' ) {
            $fruit = 'Apple';
        }

        // Now let's return the result to the Javascript function (The Callback)
        echo $fruit;
    }

    // Always die in functions echoing AJAX content
   die();
}

// This bit is a special action hook that works with the WordPress AJAX functionality.
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );

?>



<?php
/**
* WP AJAX Call Frontend
*/

//Load jQuery
wp_enqueue_script('jquery');

//Define AJAX URL
function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

//The Javascript
function add_this_script_footer(){ ?>
<script>
jQuery(document).ready(function($) {
    // This is the variable we are passing via AJAX
    var fruit = 'Banana';
    // This does the ajax request (The Call).

    $( ".banana" ).click(function() {
      $.ajax({
          url: ajaxurl, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
          data: {
              'action':'example_ajax_request', // This is our PHP function below
              'fruit' : fruit // This is the variable we are sending via AJAX
          },
          success:function(data) {
      // This outputs the result of the ajax request (The Callback)
              $(".banana").text(data);
          },
          error: function(errorThrown){
              window.alert(errorThrown);
          }
      });
    });
});
</script>
<?php }
add_action('wp_footer', 'add_this_script_footer');

//The PHP
function example_ajax_request() {
    // The $_REQUEST contains all the data sent via AJAX from the Javascript call
    if ( isset($_REQUEST) ) {
        $fruit = $_REQUEST['fruit'];
        // This bit is going to process our fruit variable into an Apple
        if ( $fruit == 'Banana' ) {
            $fruit = 'Apple';
        }
        // Now let's return the result to the Javascript function (The Callback)
        echo $fruit;
    }
    //Always die in functions echoing AJAX content
   die();
}
// This bit is a special action hook that works with the WordPress AJAX functionality.
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' );

?>

   <div><a class="banana">Banana</a></div>
