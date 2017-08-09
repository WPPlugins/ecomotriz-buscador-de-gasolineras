<?php
/*
Plugin Name: Ecomotriz buscador de gasolineras
Plugin URI: http://www.ecomotriz.com
Description: Buscador de gasolineras y puntos de recarga eléctrica
Version: 0.9.3
Author: Ecomotriz
Author URI: http://www.ecomotriz.com
License: GPL2
*/
?>
<?php
/*  Copyright 2012  HÉCTOR LINARES  (email : linares@ecomotriz.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
    // Main class 
    if (!class_exists("EcomotrizBuscador")) 
    {        
        class EcomotrizBuscador 
        {
            // Width, height and checked/unchecked value of the electro-only-searcher mode :D
            private static $w = null;
            private static $h = null;
            private static $c = null;
            
            // Constructor
            function EcomotrizBuscador() 
            {
                // Create option values
                add_option("ecomotriz_widget_width", "95%");                
                add_option("ecomotriz_widget_height", "360px");
                add_option("ecomotriz_widget_check_pre", "0");
                add_option("ecomotriz_widget_check_pre_gas", "0");
                add_option("ecomotriz_widget_address", "");
                add_option("ecomotriz_widget_title", "");
            }
            
            // Sidebar registerer
            function sidebar_widget_register() 
            {
               if (!function_exists('register_sidebar_widget')) {		        
                     return;
               }

               register_sidebar_widget(__('Ecomotriz buscador de gasolineras', 'ecomotriz-buscador-de-gasolineras'),array(&$this, 'sidebar_widget_content_gen'));
            }
            
            
            // Main function
            function sidebar_widget_content_gen($args) 
            {    
                 $title = __('Ecomotriz buscador de gasolineras', 'ecomotriz-buscador-de-gasolineras');
                 $widget_content = __('Buscador de gasolineras y puntos de recarga eléctrica', 'ecomotriz-buscador-de-gasolineras');
                 
                 $w = get_option('ecomotriz_widget_width');
                 /*
                 // Lets check the settings saved
                 if(is_numeric($w))
                 {
                     // If numeric, check for a valid number and add 'px' termination
                    if($w < 0 || $w > 1024)
                        $w = "100%";
                    else
                        $w = $w . "px";
                 }
                 else
                 {
                    // Maybe 'px' or '%' termination included, lets see
                    $len = strlen($w);
                    if(substr($w, $len-2, 1) == '%')
                    {
                        $w2 = substr($w, 0, $len - 1);
                        if (!is_numeric($w2)) $w = "100%";
                        else
                            if($w2 > 100 || $w2 < 0) $w = "100%";
                    }
                    else
                    if(substr($w, $len-3, 2) == 'px')
                    {
                        $w2 = substr($w, 0, $len - 2);
                        if (!is_numeric($w2)) $w = "100%";
                        else
                            if($w2 > 1024) $w = "100%";
                    }       
                    
                 }
                   */     
                 // Set the option for PRE
                 global $eco_only_PRE;
                 if(get_option('ecomotriz_widget_check_pre') == "1")
                    $eco_only_PRE = true;
                 else
                    $eco_only_PRE = false; 
                    
                 if(get_option('ecomotriz_widget_check_pre_gas') == "1")
                    $eco_only_PRE_gas = true;
                 else
                    $eco_only_PRE_gas = false;
                    
                 $ciudad = get_option('ecomotriz_widget_address');
                 
                 $eco_title = get_option('ecomotriz_widget_title');
                                  
                 extract($args);
                 echo $before_widget;
                 
                 
                 // The widget runs mainly in a external server, via iframe
                 
                 // Draw the title
                 if(!empty($eco_title))
                 {
                     echo $before_title; echo $eco_title; echo $after_title;
                 }
                 else
                     if($eco_only_PRE)
                     {
                        echo $before_title; _e('Buscar electrolineras', 'ecomotriz-buscador-de-gasolineras'); echo $after_title;
                     }
                     else
                     {
                        echo $before_title; _e('Buscar gasolineras', 'ecomotriz-buscador-de-gasolineras'); echo $after_title;
                     }
                 
                 // Init iframe text
                 echo('<iframe src="http://www.ecomotriz.com/embed/search_wp.php?');
                 
                 // Eco the options
                 // PRE ONLY
                 if($eco_only_PRE)
                    echo('PRE=true&');
                 
                 // ADDRESS   
                 if(!empty($ciudad))
                    echo('ciudad='.$ciudad.'&');
                 
                 // PRE and gas stations
                 if($eco_only_PRE_gas)
                    echo('PRE_GAS=true&');
                       
                 echo('" style="width: '.$w.'; height: '.get_option('ecomotriz_widget_height').'; border: none" ></iframe>');                 
                 
                
                 // Next print logo and link to developer
                 ?>    
                    <div style="float: right; text-align: right; vertical-align: middle; margin-right: 20px;">
                        Tecnología de <a href="http://www.ecomotriz.com" target="_blank"><img src="http://www.ecomotriz.com/embed/eco_logo.png" style="height: 20px;  margin: 0px 0 -5px 0;"/></a><br/>
                    </div>
                <?php
                echo $after_widget;
            }
            
            // Admin opts, hooked 
            function admin_options()            
            {                
                add_options_page("Buscador de gasolineras y electrolineras by Ecomotriz - Opciones", "Ecomotriz", "manage_options", "ecomotriz_plugin_admin_id", array(&$this, 'admin_options_HTML'));
            }
            
            // Show the HTML of Admin Opts
            function admin_options_HTML()
            {
                // Update the checkbox value
                update_option($ecomotriz_widget_check_pre, true);
                ?>  
                    <div class="wrap">
                    <div id="icon-tools" class="icon32"><br></div><h2><?php _e('Ecomotriz buscador de gasolineras y puntos de recarga eléctrica - Opciones', 'ecomotriz-buscador-de-gasolineras'); ?></h2>
                    <div style="clear: both"></div>
                    <form method="post" action="options.php">
                        <?php settings_fields( 'ecomotriz_sidebar_widget_opts' ); ?>
                        
                        <label for="ecomotriz_widget_width"><?php _e('Ancho del widget (width):', 'ecomotriz-buscador-de-gasolineras') ?></label>
                        <input type="text" name="ecomotriz_widget_width" id="ecomotriz_widget_width" size="5" value="<?php echo get_option('ecomotriz_widget_width'); ?>" /><br/>
                        <label for="ecomotriz_widget_height"><?php _e('Alto del widget (height):', 'ecomotriz-buscador-de-gasolineras') ?></label>
                        <input type="text" name="ecomotriz_widget_height" id="ecomotriz_widget_height" size="5" value="<?php echo get_option('ecomotriz_widget_height'); ?>" />                        
                        <br/>
                        <br/>
                        <label for="ecomotriz_widget_title"><?php _e('Título del widget:', 'ecomotriz-buscador-de-gasolineras') ?></label>
                        <input type="text" name="ecomotriz_widget_title" id="ecomotriz_widget_title" size="25" value="<?php echo get_option('ecomotriz_widget_title'); ?>" /><br/>
                        <?php _e('title_info', 'ecomotriz-buscador-de-gasolineras') ?>
                        <br/>
                        <br/>
                        <label for="ecomotriz_widget_address"><?php _e('Dirección por defecto:', 'ecomotriz-buscador-de-gasolineras') ?></label>
                        <input type="text" name="ecomotriz_widget_address" id="ecomotriz_widget_address" size="25" value="<?php echo get_option('ecomotriz_widget_address'); ?>" />
                        <br/>
                        <br/>
                        <input type="checkbox" value="1" name="ecomotriz_widget_check_pre" id="ecomotriz_widget_check_pre" /><label for="ecomotriz_widget_check_pre"><?php _e('Activar sólo la búsqueda de puntos de recarga eléctrica', 'ecomotriz-buscador-de-gasolineras') ?></label>
                        <?php 
                        // CHECKBOX for electric vehicle mode
                        if(get_option('ecomotriz_widget_check_pre') == "1")
                        {
                        ?>
                        <script type="text/javascript">                        
                            document.getElementById("ecomotriz_widget_check_pre").checked = true;
                        </script>
                        <?php
                        }
                        ?>
                        <br/>
                        <input type="checkbox" value="1" name="ecomotriz_widget_check_pre_gas" id="ecomotriz_widget_check_pre_gas" /><label for="ecomotriz_widget_check_pre_gas"><?php _e('Activar búsqueda de puntos de recarga eléctrica, pero dejar la opción de buscar gasolineras al usuario', 'ecomotriz-buscador-de-gasolineras') ?></label>
                        <?php 
                        // CHECKBOX for MIX mode, with electric preference
                        if(get_option('ecomotriz_widget_check_pre_gas') == "1")
                        {
                        ?>
                        <script type="text/javascript">                        
                            document.getElementById("ecomotriz_widget_check_pre_gas").checked = true;
                        </script>
                        <?php
                        }
                        ?>
                        <br/>
                        <br/>
                        <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes', 'ecomotriz-buscador-de-gasolineras') ?>" /></p>
                    </form>
                    </div>
                <?php
            }
            
            // Register widget settings in DB
            function register_settings()
            {
                register_setting( 'ecomotriz_sidebar_widget_opts', 'ecomotriz_widget_width' );
                register_setting( 'ecomotriz_sidebar_widget_opts', 'ecomotriz_widget_height' );
                register_setting( 'ecomotriz_sidebar_widget_opts', 'ecomotriz_widget_check_pre' );
                register_setting( 'ecomotriz_sidebar_widget_opts', 'ecomotriz_widget_check_pre_gas' );
                register_setting( 'ecomotriz_sidebar_widget_opts', 'ecomotriz_widget_address' );
                register_setting( 'ecomotriz_sidebar_widget_opts', 'ecomotriz_widget_title' );
            }
       
        }
     
    }
    
    
    // Create a new instance of the main class
    if (class_exists("EcomotrizBuscador")) 
    {
        $eco = new EcomotrizBuscador();
    }

    // Load the plugin
    if (isset($eco)) 
    {
        if ( is_admin() )
        { 
            // admin actions
            add_action('admin_menu', array(&$eco, 'admin_options'));
            add_action( 'admin_init', array(&$eco, 'register_settings'));
        } 
        else 
        {
            // Non admin
            
        } 
        $plugin_dir = basename(dirname(__FILE__));
        $lang_dir = $plugin_dir . "lang/";
        load_plugin_textdomain( 'ecomotriz-buscador-de-gasolineras', false, $plugin_dir );

        add_action('plugins_loaded', array(&$eco, 'sidebar_widget_register'));     
        
    }

?>
