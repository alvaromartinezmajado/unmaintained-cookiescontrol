<?php

/*

Plugin Name: CookiesControl
Plugin URI: http://alvaro.cat/obrador/plugin-per-a-wordpress-gestio-de-cookies.html
Description: Control when your cookies are installed in users' browsers to comply with the European Union directive. Optimized for the Spanish law. 
Author: Playbrand Estratègies Crossmèdia
Version: 0.2
Author URI: http://playbrand.info

No responsability is accepted by the contributors neither for the correct use or the misuse of this plugin. Please, contact with a lawyer for legal advice. 

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License.

Based on Choc Chip EU Cookie WordPress Plugin 1.0 by Christian Senior <http://www.christiansenior.co.uk> (twitter: @senoir).
Changes:

* Added i18n features (see /mo directory)
* Added specific notes on Spanish law
* Now it works by implicit consent

*/

function cookiescontrol_i18n() {
 $plugin_dir = basename(dirname(__FILE__)).'/mo/';
 load_plugin_textdomain( 'cookiescontrol', false, $plugin_dir );
}
add_action('plugins_loaded', 'cookiescontrol_i18n');


//include admin options
require_once 'inc/cookiescontrol-options.php';

//load jquery from Google
function cookiescontrol_jquery() {
			if (!is_admin()) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2');
				wp_enqueue_script('jquery');
			}
		}
add_action('init', 'cookiescontrol_jquery');

//add the stylesheet to the site
function cookiescontrol_stylesheet() {
		echo '<link rel="stylesheet" type="text/css" media="all" href="'. plugins_url( 'css/cookiescontrol-plugin.css' , __FILE__ ) . '" />'; ?>
        
        <!--custom styling set through the admin panel-->
        <?php $cookiescontrol_appearance_settings = get_option( 'cookiescontrol_appearance', $cookiescontrol_appearance ); ?>
        <style>
        #cookie-allow {
			  background-color:<?php echo $cookiescontrol_appearance_settings['barbg']; ?>;
			  color:<?php echo $cookiescontrol_appearance_settings['textcolor']; ?>;
			  <?php if ($cookiescontrol_appearance_settings['barposition'] == "top") { 
			  			echo 'top' ;
						} else if ($cookiescontrol_appearance_settings['barposition'] == "bottom") {  
						echo 'bottom';
						} else {
						echo 'bottom';
						}?>:0;
		}
		#cookie-allow a.allow {
			  color:<?php echo $cookiescontrol_appearance_settings['acceptlinkcolor']; ?>;
		 }
		#cookie-allow a.allow {
			   background-color:<?php echo $cookiescontrol_appearance_settings['acceptbuttonbgcolor']; ?>;
			   border:solid 1px <?php echo $cookiescontrol_appearance_settings['acceptbuttonbordercolor']; ?>;
		   }
		   #cookie-allow a.cookiemore {
			   background-color:<?php echo $cookiescontrol_appearance_settings['morebuttonbgcolor']; ?>;
			   border:solid 1px <?php echo $cookiescontrol_appearance_settings['morebuttonbordercolor']; ?>;
			   
		   }
		    #cookie-allow a.cookiemore {
			  color:<?php echo $cookiescontrol_appearance_settings['morebuttonlinkcolor']; ?>;
		 }
		</style>
        
		<?php }// add stylesheet function 
add_action('wp_head', 'cookiescontrol_stylesheet');


		
//if they have not allowed cookies before show the accept button
function cookiescontrol_setcookie() { 
	
	//create unique name by using the url
	$choc_chip_cookie_name = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	$choc_chip_cookie_name = str_replace(".", "", $choc_chip_cookie_name);

	if(!isset($_COOKIE["$choc_chip_cookie_name"])) { 	
	
		 $cookiescontrol_optin = get_option( 'cookiescontrol_optin', $cookiescontrol_optin );	
?>
      
	<script type="text/javascript">
        function SetCookie(c_name,value,expiredays)
        {
        var exdate=new Date()
            exdate.setDate(exdate.getDate()+expiredays)
            document.cookie=c_name+ "=" +escape(value)+";path=/"+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
        }
    </script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php plugins_url();?>/css/" />
        <div id="cookie-allow" >
            <?php if ($cookiescontrol_optin['buttonbartext'] == "") { echo __( 'We use cookies. By continuing browsing this site you accept our cookies policy.', 'cookiescontrol'); } else { echo $cookiescontrol_optin['buttonbartext']; } ?>
            <a id="removecookie" class="allow"> <?php echo __("Close", "cookiescontrol"); ?></a>
            <a id="more" class="cookiemore" href="<?php echo $cookiescontrol_optin['infolink']; ?>" target="_blank"><?php echo __("Find out more", "cookiescontrol"); ?></a>
        </div>
    
     
    <script type="text/javascript">
        if( document.cookie.indexOf("<?php echo $choc_chip_cookie_name;?>") ===-1 ){
            $("#cookie-allow").show();
            //Expiration of cookie. Expires in a session. 
            // We set this cookie since configuration cookies are allowed without explicit confirmation
            SetCookie('<?php echo $choc_chip_cookie_name;?>','<?php echo $choc_chip_cookie_name;?>')
        }
        $("#removecookie").click(function () {
          $("#cookie-allow").remove();
		  
        });
    </script>
	<?php } //if cookie is not set ?>
<?php }//setcookie function
add_action('wp_footer', 'cookiescontrol_setcookie');



//tabbed admin section
function cookiescontrol_admin_menu() {
	add_options_page(__('CookiesControl', 'cookiescontrol'), __('CookiesControl', 'cookiescontrol'), 'manage_options', 'cookiescontrol-plugin', 'cookiescontrol_options');
}
add_action('admin_menu', 'cookiescontrol_admin_menu');

//create tabs for admin section
function cookiescontrol_admin_tabs( $current = 'general' ) {     
	$tabs = array( 'general' => __('About', 'cookiescontrol'), 'optin' => __('Options', 'cookiescontrol'), 'appearance' => __('Apparence', 'cookiescontrol') );     
	$links = array();     
	foreach( $tabs as $tab => $name ) :         
	if ( $tab == $current ) :             
	$links[] = "<a class='nav-tab' href='?page=cookiescontrol-plugin&tab=$tab'>$name</a>";         
	else :             
	$links[] = "<a class='nav-tab' href='?page=cookiescontrol-plugin&tab=$tab'>$name</a>";         
	endif;     
	endforeach;    
	echo '<h2>';     
	foreach ( $links as $link )         
	echo $link;     echo '</h2>';
}

 function cookiescontrol_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
?>
    
<div class="wrap">
<?php cookiescontrol_admin_tabs();?>    
 <?php //sets up the info to be displayed in the tab
	  
	if ( isset ( $_GET['tab'] ) ) {         
	$tab = $_GET['tab'];        
	switch ( $tab ) :         
	case 'appearance' :             
	cookiescontrol_appearance_options();  
	break;         
	case 'optin' :             
	cookiescontrol_optin_options();  
	break;         
	case 'general' :            
	cookiescontrol_general();             
	break;     
	endswitch; 
	} else {
		$tab = 'general';
		cookiescontrol_general();     
	}//if get tab is set
	?>    
    

        
    </div><!--wrap-->
   
<?php } //end options if
 
//function to allow opt in options if accept has been clicked
function cookiescontrol_show_optin_options() {
	//create unique name by using the url
	$choc_chip_cookie_name = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	$choc_chip_cookie_name = str_replace(".", "", $choc_chip_cookie_name);

	
	// leave cookies only if it is not the "more info" page
	if(isset($_COOKIE["$choc_chip_cookie_name"]) && !is_page($cookiescontrol_optin['infolink'])) { 	
		$cookiescontrol_optin = get_option( 'cookiescontrol_optin', $cookiescontrol_optin );
		// if the user clicks in "More info", do not leave cookies
			echo $cookiescontrol_optin['optin1'];
	}
}

add_action('wp_head', 'cookiescontrol_show_optin_options');

//include widget
require_once 'inc/cookiescontrol-widget.php';


//hook into the comment form text
add_action( 'comment_form_logged_in_after', 'pmg_comment_tut_fields' );
add_action( 'comment_form_after_fields', 'pmg_comment_tut_fields' );
function pmg_comment_tut_fields()
{
	$cookiescontrol_optin = get_option( 'cookiescontrol_optin', $cookiescontrol_optin );
    ?>
    	<p>
      		<?php echo $cookiescontrol_optin['commentformtext']; ?>
    	</p>
    <?php
}
?>
