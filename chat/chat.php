<?php
/*
Plugin Name: OggChat Live Chat Widget
Plugin URI: http://www.oggchat.com
Description: OggChat is a unique live chat software solution that integrates directly with Gmail, Google Talk, and Google Apps and lets you interact directly with website visitors right from your preferred Instant Messenger on your desktop , iPhone, BlackBerry, or Android mobile phone.
Version: 1.2.5
Author: OggChat
Author URI: http://www.oggchat.com/
*/

$plugurldir = get_option('siteurl').'/'.PLUGINDIR.'/oggchat-live-chat-software/';
$oggchat_domain = 'OggChatLiveChat';
load_plugin_textdomain($oggchat_domain, 'wp-content/plugins/oggchat-live-chat-software');
add_action('init', 'oggchat_init');
add_action('wp_footer', 'oggchat_insert');
add_action('admin_notices', 'oggchat_notice');
add_filter('plugin_action_links', 'oggchat_plugin_actions', 10, 2);

define('OGGCHAT_DASHBOARD_URL', "https://oggchat2.icoa.com/member.jsp");
define('OGGCHAT_SMALL_LOGO',$plugurldir.'/ocsq.png');

function oggchat_init() {
    if(function_exists('current_user_can') && current_user_can('manage_options')) {
        add_action('admin_menu', 'oggchat_add_settings_page');
        add_action('admin_menu', 'oggchat_create_menu');
    }
}


function OGGCHAT_dashboard() {

    echo '<div id="dashboarddiv"><iframe id="dashboardiframe" src="'.OGGCHAT_DASHBOARD_URL.'" height=700 width=98% scrolling="yes"></iframe></div>      <a href="'.OGGCHAT_DASHBOARD_URL.'" target="_newWindow" onClick="javascript:document.getElementById(\'dashboarddiv\').innerHTML=\'\'; ">Open OggChat in a new window</a>.
      ';
}

function oggchat_insert() {
    global $current_user;

    if(get_option('oggchatID')) {
        get_currentuserinfo();
        echo("\n\n<!-- Start OggChat Button <http://www.oggchat.com/> -->\n<div id=\"oggchat\"></div><script type=\"text/javascript\" src=\"https://oggchat2.icoa.com/js/button_oggchat2.js\"></script>\n<script type=\"text/javascript\">var page ={\n\t");

        echo("'cid' : '".get_option('oggchatID')."',");
        echo("\n'bg_color' : '".get_option('oggchatTabColor')."',\n'hover_color' : '".get_option('oggchatTabHoverColor')."',\n'website' : 'wordpress',\n'top_margin' : '170px','right_margin' : '170px',\n'window_height' : '400px',\n'window_width' : '330px',\n'align' : '".get_option('oggchatLocation')."'}");

        echo("\nbutton(page);\n</script>\n<!-- End OggChat Button <http://www.oggchat.com/>-->\n\n");
    }
}

function oggchat_notice() {
    if(!get_option('oggchatID')) echo('<div class="error"><p><strong>'.sprintf(__('OggChat Live Chat is disabled. Please go to the <a href="%s">plugin settings</a> to enter a valid chat key.' ), admin_url('options-general.php?page=oggchat-live-chat')).'</strong></p></div>');
}

function oggchat_plugin_actions($links, $file) {
    static $this_plugin;
    if(!$this_plugin) $this_plugin = plugin_basename(__FILE__);
    if($file == $this_plugin && function_exists('admin_url')) {
        $settings_link = '<a href="'.admin_url('options-general.php?page=oggchat-live-chat').'">'.__('Settings', $oggchat_domain).'</a>';
        array_unshift($links, $settings_link);
    }
    return($links);
}

function oggchat_add_settings_page() {
    function oggchat_settings_page() {
        global $oggchat_domain, $plugurldir; ?>
<div class="wrap">
        <?php screen_icon() ?>
    <h2><?php _e('OggChat Live Chat', $oggchat_domain) ?></h2>
    <div class="metabox-holder meta-box-sortables ui-sortable pointer">
        <div class="postbox" style="float:left;width:30em;margin-right:10px">
            <h3 class="hndle"><span><?php _e('OggChat Chat Widget Settings', $oggchat_domain) ?></span></h3>
            <div class="inside" style="padding: 0 10px">
                <form method="post" action="options.php">
                    <p style="text-align:center"><?php wp_nonce_field('update-options') ?><a href="http://www.oggchat.com/" title="<?php _e('Unique live chat software that lets you chat right from Gmail, Google Talk, or your Mobile Phone', $oggchat_domain) ?>"><img src="<?php echo($plugurldir) ?>oggchat.png" height="74" width="227" alt="<?php _e('OggChat Live Chat', $oggchat_domain) ?>" /></a></p>

                    <p><label for="oggchatID"><?php printf(__('Enter your %1$sIf you don\'t have an account, click here to learn more about OggChat%2$sOggChat%3$s chat key below to activate the plugin.', $oggchat_domain), '<strong><a href="http://www.oggchat.com/" title="', '">', '</a></strong>') ?></label><br /><input type="text" name="oggchatID" id="oggchatID" value="<?php echo(get_option('oggchatID')) ?>" style="width:100%" /><small class="nonessential"><?php _e('<br>Your Chat Key is located on your OggChat Dashboard.', $oggchat_domain) ?></small></p>
                    <p>
                        <b>Customize your Chat Tab</b>
                    <table>
                        <tr>
                            <td><label for="oggchatLocation">Tab Location:</label></td>
                            <td>
                                <select name="oggchatLocation" id="oggchatLocation" style="width:150px">
                                    <option value="left" <?php if (get_option('oggchatLocation') == 'left') {printf('selected');}?> > Left </option>
                                    <option value="right" <?php if (get_option('oggchatLocation') == 'right') {printf('selected');}?> > Right </option>
                                    <option value="top" <?php if (get_option('oggchatLocation') == 'top') {printf('selected');}?> > Top </option>
                                    <option value="bottom" <?php if (get_option('oggchatLocation') == 'bottom') {printf('selected');}?> > Bottom </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tab Color:</label></td>
                            <td><input type="text" name="oggchatTabColor" id="oggChatTabColor" value="<?php if (get_option('oggchatTabColor') == '') {echo('#0066cc');} else {echo(get_option('oggChatTabColor'));} ?>"/></td>
                        </tr>
                        <tr>
                            <td><label>Tab Hover Color:</label></td>
                            <td><input type="text" name="oggchatTabHoverColor" id="oggChatTabHoverColor" value="<?php if (get_option('oggchatTabHoverColor') == '') {echo('#ff0000');} else {echo(get_option('oggChatTabHoverColor'));} ?>"/></td>
                        </td>
                        </tr>
                    </table>
                    </p>


                    <p class="submit" style="padding:0"><input type="hidden" name="action" value="update" />
                        <input type="hidden" name="page_options" value="oggchatID, oggchatLocation, oggchatTabColor, oggchatTabHoverColor" />



                        <input type="submit" name="oggchatSubmit" id="oggchatSubmit" value="<?php _e('Save Settings', $oggchat_domain) ?>" class="button-primary" /> </p>

                    <p style="font-size:smaller;color:#999239;background-color:#ffffe0;padding:0.4em 0.6em !important;border:1px solid #e6db55;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px"><?php printf(__('Don&rsquo;t have an OggChat account? %1$sRegister now for a free trial!%2$sRegister now for a Free Trial!%3$s', $oggchat_domain), '<a href="https://oggchat.icoa.com/signup.jsp" title="', '">', '</a>') ?></p>			</form>
            </div>
        </div>
        <div class="postbox" style="float:left;width:38em">
            <h3 class="hndle"><span><?php _e('Overview', $oggchat_domain) ?></span></h3>
            <div class="inside" style="padding: 0 10px">			<p><?php printf(__('<b>Why Try Oggchat?</b><br>OggChat is a unique live chat solution that supports Gmail, Google Talk, iPhone, Android, and BlackBerry.  For more information on customizing your chat widget and details on OggChat, please visit %1$sLive Chat and Live Help Software for your website%2$sOggChat.com%3$s.', $oggchat_domain), '<a href="http://www.oggchat.com/" title="', '">', '</a>') ?></p>

                <p><?php printf(__('<b>Would you like to use your own chat buttons instead of a chat tab?</b><br>Choose from our list of buttons or upload you own.  %1$sClick here for an overview of including OggChat in WordPress%2$sClick here to see how%3$s.', $oggchat_domain), '<a href="http://oggchat.com/index.php/live-chat-software-features/faqs/10-wordpress-steps-for-oggchat" title="', '">', '</a>') ?></p>
            </div>
        </div>
    </div>
</div>
    <?php }
    add_submenu_page('options-general.php', __('OggChat Settings', $oggchat_domain), __('OggChat Settings', $oggchat_domain), 'manage_options', 'oggchat-live-chat', 'oggchat_settings_page');
}

function oggchat_create_menu() {

//create new top-level menu
    add_menu_page('Account Configuration', 'OggChat', 'administrator', 'OGGCHAT_dashboard', 'OGGCHAT_dashboard', OGGCHAT_SMALL_LOGO);


    add_submenu_page('OGGCHAT_dashboard', 'Dashboard', 'Dashboard', 'administrator', 'OGGCHAT_dashboard', 'OGGCHAT_dashboard');


}

?>
