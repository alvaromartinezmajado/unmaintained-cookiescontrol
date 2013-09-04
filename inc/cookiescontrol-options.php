<?php
$cookiescontrol_appearance = array(
	'barbg' => '',
	'barposition' => '',
	'textcolor' => '',
	'acceptlinkcolor' => '',
	'acceptbuttonbgcolor' => '',
	'acceptbuttonbordercolor' => '',
	'morebuttonlinkcolor' => '',
	'morebuttonbgcolor' => '',
	'morebuttonbordercolor' => '',
);

$cookiescontrol_optin = array(
	'optin1' => '',
	'infolink' => '#',
	'buttonbartext' => '',
	'commentformtext' => '',
);



function cookiescontrol_appearance_settings() {
	// Register settings and call sanitation functions
	register_setting( 'cookiescontrol_appearance_theme', 'cookiescontrol_appearance', 'cookiescontrol_validate_appearance' );
	register_setting( 'cookiescontrol_optin_theme', 'cookiescontrol_optin', 'cookiescontrol_validate_optin' );
}
add_action( 'admin_init', 'cookiescontrol_appearance_settings' );

// Function to generate options page
function cookiescontrol_appearance_options() {
	global $cookiescontrol_appearance;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap" style="padding:30px">

	<h2><?php screen_icon(); echo __("Apparence", "cookiescontrol");
	// This shows the page's name and an icon if one has been provided ?></h2>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'cookiescontrol_appearance', $cookiescontrol_appearance ); ?>
	
	<?php settings_fields( 'cookiescontrol_appearance_theme' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	<style>label { font-weight:bold;}</style>
	<tr valign="top">
    	<th width="30%" scope="row" ><label for="barposition"><?php echo __("Bar position", "cookiescontrol"); ?></label>
        <p><?php echo __("Select the position for the button bar", "cookiescontrol"); ?></p>
        </th>
			<td width="70%" valign="bottom">  
            	<?php  $position = esc_attr($settings['barposition']); ?> 
				<select id="barbg" name="cookiescontrol_appearance[barposition]" >
                <option value="bottom" <?php if ($position == "bottom") { echo 'selected=selected';}?>><?php echo __("Bottom", "cookiescontrol"); ?></option>
                <option value="top" <?php if ($position == "top") { echo 'selected=selected';}?>><?php echo __("Top", "cookiescontrol"); ?></option>
                </select>
			</td>
		</tr>
        
        <tr valign="top">
    	<th width="30%" scope="row" ><label for="barbg"><?php echo __("Background colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p>
        </th>
			<td width="70%" valign="bottom">   
				<input id="barbg" name="cookiescontrol_appearance[barbg]" type="text" value="<?php  esc_attr_e($settings['barbg']); ?>" />
			</td>
		</tr>

		<tr valign="top"><th scope="row"><label for="textcolor"><?php echo __("Text Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="textcolor" name="cookiescontrol_appearance[textcolor]" type="text" value="<?php  esc_attr_e($settings['textcolor']); ?>" />
			</td>
		</tr>

	<tr valign="top"><th scope="row"><label for="acceptlinkcolor"><?php echo __("Accept Button Text Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="acceptlinkcolor" name="cookiescontrol_appearance[acceptlinkcolor]" type="text" value="<?php  esc_attr_e($settings['acceptlinkcolor']); ?>" />
			</td>
		</tr>
        
      
      <tr valign="top"><th scope="row"><label for="acceptbuttonbgcolor"><?php echo __("Accept Button Background Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="acceptbuttonbgcolor" name="cookiescontrol_appearance[acceptbuttonbgcolor]" type="text" value="<?php  esc_attr_e($settings['acceptbuttonbgcolor']); ?>" />
			</td>
		</tr>

      <tr valign="top"><th scope="row"><label for="acceptbuttonbordercolor"><?php echo __("Accept Button Border Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="acceptbuttonbordercolor" name="cookiescontrol_appearance[acceptbuttonbordercolor]" type="text" value="<?php  esc_attr_e($settings['acceptbuttonbordercolor']); ?>" />
			</td>
		</tr>
        
        <tr valign="top"><th scope="row"><label for="morebuttonlinkcolor"><?php echo __("More info Button Text Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="morebuttonlinkcolor" name="cookiescontrol_appearance[morebuttonlinkcolor]" type="text" value="<?php  esc_attr_e($settings['morebuttonlinkcolor']); ?>" />
			</td>
		</tr>

      <tr valign="top"><th scope="row"><label for="morebuttonbordercolor"><?php echo __("More info Button Border Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="morebuttonbordercolor" name="cookiescontrol_appearance[morebuttonbordercolor]" type="text" value="<?php  esc_attr_e($settings['morebuttonbordercolor']); ?>" />
			</td>
		</tr>


      <tr valign="top"><th scope="row"><label for="morebuttonbgcolor"><?php echo __("More info Button Background Colour", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter colour such as black, red, white. Or use hex values including the hash e.g. #000000", "cookiescontrol"); ?></p></th>
			<td valign="bottom">
				<input id="morebuttonbgcolor" name="cookiescontrol_appearance[morebuttonbgcolor]" type="text" value="<?php  esc_attr_e($settings['morebuttonbgcolor']); ?>" />
			</td>
		</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="<?php echo __("Save Options", "cookiescontrol"); ?>" /></p>

	</form>

	</div>

	<?php
}// ends appearance page



// Function to generate Opt in page
function cookiescontrol_optin_options() {
	global $cookiescontrol_optin;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap" style="padding:30px">

	<?php screen_icon(); echo "<h2>".  __("Options", "cookiescontrol") ."</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'cookiescontrol_optin', $cookiescontrol_optin ); ?>
	
	<?php settings_fields( 'cookiescontrol_optin_theme' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	<table class="form-table">
	<style>label { font-weight:bold;}</style>
    <tr valign="top">
    	<th width="30%" scope="row" ><label for="buttonbartext"><?php echo __("Button Bar Text", "cookiescontrol"); ?></label>
        <p><?php echo __("Enter the text that you would like to see in the button bar.", "cookiescontrol"); ?></p>
        </th>
			<td width="70%" valign="middle"> 
            
            	<input id="buttonbartext" name="cookiescontrol_optin[buttonbartext]" type="text" value="<?php esc_attr_e($settings['buttonbartext']) ?>" max="80" style="width:70%"/>
			</td>
		</tr>
        
        <tr valign="top">
    	<th width="30%" scope="row" ><label for="infolink"><?php echo __("Cookie Information Page", "cookiescontrol"); ?></label>
        <p><?php echo __("Select the page where your cookie information can be found.", "cookiescontrol"); ?></p>
        </th>
			<td width="70%" valign="middle"> 
            	<?php $setlink = esc_attr($settings['infolink']) ?>
            	<select id="infolink" name="cookiescontrol_optin[infolink]">
            	<?php 
					$pages=  get_pages(''); 
					foreach ($pages as $page) {					
						$selected = "";
						if ($setlink == $page->post_name) { $selected = 'selected="selected"';}
						$option = '<option value="' . $page->post_name .  '" ' . $selected . '>';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
					?>
                </select>
			
			</td>
		</tr>
        
	<tr valign="top">
    	<th width="30%" scope="row" ><label for="optin1"><?php echo __("Opt-in - Header Code", "cookiescontrol"); ?></label>
        <p><?php echo __("If you have custom code in the  &lt;head&gt; of your website such as Google analytics, you can make it opt-in by pasting the code in this box. The code will not be shown unless the visitor has accepted cookies.", "cookiescontrol"); ?></p>
        </th>
			<td width="70%" valign="bottom">   
				<textarea id="optin1" name="cookiescontrol_optin[optin1]" style="width:70%; min-height:300px"><?php  esc_attr_e($settings['optin1']); ?></textarea>
			</td>
		</tr>
        
        <tr valign="top">
    	<th width="30%" scope="row" ><label for="commentformtext"><?php echo __("Comment form cookie warning", "cookiescontrol"); ?></label>
        <p><?php echo __("Warn your visitors that by placing a comment on your website they are agreeing to have a cookie placed on their computer. This text will appear on the comment form.", "cookiescontrol"); ?></p>
        </th>
			<td width="70%" valign="bottom">   
				<textarea id="commentformtext" name="cookiescontrol_optin[commentformtext]" style="width:70%; min-height:300px"><?php  esc_attr_e($settings['commentformtext']); ?></textarea>
			</td>
		</tr>

	</table>

	<p class="submit"><input type="submit" class="button-primary" value="<?php echo __("Save Options", "cookiescontrol"); ?>" /></p>

	</form>

	</div>

	<?php
}

// Function to generate about page
function cookiescontrol_general() { ?>

	<div class="wrap" style="padding:30px">

	<?php screen_icon(); ?>

	<h2><?php echo __("CookiesControl (Spanish law)", "cookiescontrol"); ?></h2>
    
    <p><?php echo __("This plugin helps you to comply with the 2009/136/CE Directive, whose requirements require you to not install cookies in users' browser untill they permit so, explicitly or implicitly.", "cookiescontrol"); ?></p>
    
    <h2><?php echo __("What does this plugin do?", "cookiescontrol"); ?></h2>
    <p><?php echo __("It gives your visitors the option to opt in (or leave the webpage) any third party applications such as Google Analytics or Ad Sense. The plugin then leaves a cookie of its own to remember them next time. The cookie will expire after one year.", "cookiescontrol"); ?></p>
    
    <h2><?php echo __("Widget", "cookiescontrol"); ?></h2>
    <p><?php echo __("This plugin comes with an opt-in widget for your sidebar. Anything added to the widget is opt in. So if you insert your Adsense code here it will only show if the visitor has accepted cookies. ", "cookiescontrol"); ?></p>
    
    <h2><a href="options-general.php?page=cookiescontrol-plugin&tab=optin"><?php echo __("Options"); ?></a></h2>
    
    <h3><?php echo __("Button Bar Text", "cookiescontrol"); ?></h3>
    <p><?php echo __("Edit the warning text as shown on the button bar. The Spanish law states that this message should be written in Spanish or Catalan or Basque or Galician.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Cookie Information Page", "cookiescontrol"); ?></h3>
    <p><?php echo __("Create a page that contains your cookie information such as what cookies are and what you use them for. Select your cookie information page from the list and this will link to the 'More info' button on the button bar. The Spanish law states that this text should be written in Spanish or Catalan or Basque or Galician.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Opt in header code", "cookiescontrol"); ?></h3>
    <p><?php echo __("Third party applications such as Google Analytics leave a cookie in order to be able to track your visitors. The 2009/136/CE Directive wants you to warn people of this and even have them 'opt in' so you shouldnt track them unless they agree to it. Any text/code that you enter in the 'opt in header code' field will only be activated once the user has accepted cookies. Any text/code in this field will be placed just above the <code> &lt;/head&gt; </code> tag.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Comment Form Warning", "cookiescontrol"); ?></h3>
    <p><?php echo __("This CMS leaves a cookie when a comment is left (to save the form information so it doesnt have to be filled in next time) so using this field you can give your visitors a warning and let them whats going down. The Spanish law states that this warning should be written in Spanish or Catalan or Basque or Galician.", "cookiescontrol"); ?></p>
    
     <h2><a href="options-general.php?page=cookiescontrol-plugin&tab=appearance"><?php echo __("Appearance", "cookiescontrol"); ?></a></h2>
     
    <h3><?php echo __("Bar Position", "cookiescontrol"); ?>Bar Position</h3>
    <p><?php echo __("Select the position for your button bar.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Background Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("Change the background of your button bar by entering the name of the colour or a hex value.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Text Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("Change the main text colour on the button bar by entering the name of the colour.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Accept Button Text Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("It changes the accept button text colour.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Accept Button Background Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("Make that button stand out with a background colour.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("Accept Button Border Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("You can even change the colour of the border of the button.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("More Info Button Text Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("It changes the More Info button text colour.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("More Info Button Background Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("It changes the More Info button background colour.", "cookiescontrol"); ?></p>
    
    <h3><?php echo __("More Info Button Border Colour", "cookiescontrol"); ?></h3>
    <p><?php echo __("It changes the More Info Button Border colour.", "cookiescontrol"); ?></p>
        
    <h2><?php echo __("Disclaimer", "cookiescontrol"); ?></h2>
    <p><?php echo __("No responsability is accepted by the contributors neither for the correct use or the misuse of this plugin. Please, contact with a lawyer for legal advice.", "cookiescontrol"); ?></p>
    
	</div>
<?php } //ends about us function

function cookiescontrol_validate_appearance( $input ) {
	global $cookiescontrol_appearance;

	$settings = get_option( 'cookiescontrol_appearance', $cookiescontrol_appearance );
	
	return $input;
}

function cookiescontrol_validate_optin( $input ) {
	global $cookiescontrol_optin;

	$settings = get_option( 'cookiescontrol_optin', $cookiescontrol_optin );
	
	return $input;
}
?>