<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>


    <b>sanitize_text_field()</b>	
    <input id="title" type="text" name="title">
    <?php 
    $title=sanitize_text_field($_POST['title']); 
    update_post_meta( get_the_ID(), 'title', $title );
    ?>

    <b>sanitize_email</b>
    <input id="title" type="text" name="title">
    <?php 
    $email = sanitize_email( $_POST['email'] );
    update_post_meta( get_the_ID(), 'email', $email );
    ?>

    <b>sanitize_file_name</b>

    <input id="image" type="file" name="image">
    <?php 
    $file = sanitize_file_name( $_POST['image'] );
    ?>

    <b>sanitize_title</b>
    <?php 

    $new_url = sanitize_title('This Long Title is what My Post or Page might be');
    echo $new_url;
    ?>
    <b>sanitize_key</b>
    <?php 
    $key=sanitize_key("https://WordPress.org");	
    echo $key;
    ?>

    <b>sanitize_user</b>
    <?php 
    $username = sanitize_user( $_POST['username'] );
    if ( username_exists( $username ) ) {
        echo "Username In Use!";
    } else {
        echo "Username Not In Use!";
    }
    ?>

    <b>sanitize_html_class</b>
    <?php
    $post_class = sanitize_html_class( $post->post_title );
    echo '<div class="' . $post_class . '">';
    ?>



    <!-- ======= Escaping Functions  ======== -->

    <b>esc_html() Escaping for HTML blocks.</b>
    <?php echo esc_html($title);?>

    <b>esc_attr() Escaping for HTML attributes </b>
    <input type="text" name="myInput" value="<?php echo esc_attr($value);?>"/>

    <b>esc_js: Escape single quotes, htmlspecialchar ” &, and fix line endings.</b>
    <a href="#" onclick="<?php echo esc_js( $custom_js ); ?>">Click me</a>
    <script type="text/javascript">
        var myVar = <?php echo esc_js( $my_var ); ?>
    </script>



    <b>esc_url: Checks and cleans a URL.</b>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>

    <b>esc_textarea: Escaping for textarea values.</b>
    <textarea><?php echo esc_textarea( $text ); ?></textarea>


    <!-- ======= Translate Escaping Functions  ======== -->

    <b>esc_html__:</b>
    esc_html__: Retrieve the translation of $text and escapes it for safe use in HTML output.
    <h1><?php echo esc_html__( 'Title', 'text-domain' )?></h3>


    <b>esc_html_e:</b>
    esc_html_e: Display translated text that has been escaped for safe use in HTML output.
    <h1><?php esc_html_e( 'Title', 'text-domain' )?></h1>

    <b>esc_attr__:</b>
    esc_attr__: Retrieve the translation of $text and escapes it for safe use in an attribute.
    <h1><input title="<?php esc_attr_e( 'Read More', 'your_text_domain' ) ?>" type="submit" value="submit" /></h1>


    <!-- ====== Validation ====== -->

    <b>in_array: Checks if a value exists in an array</b> 
    <?php 

    $OS = array("Mac", "NT", "IOS", "Linux");
    if (in_array("IOS", $os)) {
        echo "Got IOS";
    }

    ?>
    <b>isset: Determine if a variable is declared and is different than NULL.</b>
    <?php 
    if (isset($var)) {
        echo "This var is set so I will print.";
    }
    ?>
    <b>empty: Determine whether a variable is empty</b>
    <?php 
     if (empty($var)) {
    echo '$var is either 0, empty, or not set at all';
     }
    ?>    
    <b>mb_strlen: Get string length</b> 
    <?php 
    mb_strlen($string, '8bit');
    ?>    

    <b>strlen() : Get string length</b>
    <?php 
    $str = 'abcdef';
    echo strlen($str);
    ?> 
    
    <b>strpos: Find the position of the first occurrence of a substring in a string</b>
    <?php 
    $mystring = 'abc';
    $findme   = 'a';
    $pos = strpos($mystring, $findme);
    ?>

    <b>preg_match: Perform a regular expression match</b>
     <?php 
    preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
    print_r($matches);
     ?>

    <b> count: Count all elements in an array, or something in an object</b>
    <?php 
        $a[0] = 1;
        $a[1] = 3;
        $a[2] = 5;
        var_dump(count($a));
    ?>


    <b> is_email: varify that an email is valid.</b>
    <?php 
    if ( is_email( 'impulse.khan@gmail.com' ) ) {
    echo 'email address is valid.';
    }
    ?>
    <b>term_exists(): checks whether a tag, category, or other taxonomy term exists. </b>
    <?php 
    $term = term_exists( 'Uncategorized', 'category' );
    if ( $term !== 0 && $term !== null ) {
        echo __( "'Uncategorized' category exists!", "textdomain" );
    }
    ?>

    <b>username_exists: Determines whether the given username exists.</b>
    <?php
    $username = sanitize_user( $_POST['username'] );
     if ( username_exists( $username ) ) {
    echo "Username In Use!";
      } else {
    echo "Username Not In Use!";
    }
    ?>
    <b>validate_file: Validates a file name and path against an allowed set of rules</b>

    <?php 
    $path = 'uploads/2012/12/my_image.jpg';
    return validate_file( $path );
    $path = '../../wp-content/uploads/2012/12/my_image.jpg';
    return validate_file( $path ); 
    ?>


    <!-- ======= Nonce Varify  ======== -->
 
   <b>Create a Nonce </b>

   <b>wp_nonce_url()</b>
   <?php 
   wp_nonce_url( $actionurl, $action, $name );

   echo wp_nonce_url( 'http://example.com/url' );

   //output: http://example.com/url?_wpnonce=1ef8422137
   ?> 

   <b>wp_nonce_field()</b>

   <?php wp_nonce_field("student_action_nonce"); ?>
   output: <input type="hidden" id="_wpnonce" name="_wpnonce" value="5284708911" />
  

   <b>wp_create_nonce()</b>
   <?php $nonce = wp_create_nonce('my-nonce'); ?>
   <a href='example.com?_wpnonce=<?php echo $nonce ?>&data=mydata'> 


   <b>wp_verify_nonce</b>
   <?php 
   wp_verify_nonce($_POST["student_name_nonce"],"student_action_nonce")
   ?>

   <b>check_ajax_referer</b>

   <?php 
   check_ajax_referer("student_action_nonce");
   ?>

   <b> check_admin_referer() </b>

   <?php
  if (check_admin_referer( 'doing_something', 'w3_nonce_field' ) ){
        // User pressed "Do Something!" button, so
        // do something interesting.
        $nonce=$_REQUEST['w3_nonce_field'];
        echo "Hey! Your Nonce is: ".$nonce,"<br>";
    }
    ?>
    <form method="post" action="<?php echo admin_url('options-general.php?page=w3_nonce_form_plugin_settings');?>">
    <!-- some inputs here ... -->
    <?php wp_nonce_field( 'doing_something', 'w3_nonce_field' ); ?>
    <input class="button button-primary" type="submit" value="Check Nonce Value" name="submit">
 </form>
 <?php

   
   

    
</body>
</html>