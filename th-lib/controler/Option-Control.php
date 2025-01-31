<?php   
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
global $th_config;
if(!class_exists('Th_OptionConfig'))
{
    class Th_OptionConfig
    {
        static $theme;
        static function _init()
        {


            //Load helper

            if(!class_exists('OT_Loader')) return;

            // Register theme options
            self::_add_themeoptions();
            add_action( 'init', array(__CLASS__,'_add_themeoptions') );
            $theme_info = wp_get_theme();
            self::$theme = wp_get_theme($theme_info['Template']);

            add_filter('ot_header_version_text',array(__CLASS__,'_ot_header_version_text'));

            add_filter('ot_theme_options_parent_slug',array(__CLASS__,'_change_parent_slug'),1);
            add_filter('ot_theme_options_menu_title',array(__CLASS__,'_change_menu_title'));
            add_filter('ot_theme_options_page_title',array(__CLASS__,'_change_menu_title'));

            add_filter('ot_theme_options_icon_url',array(__CLASS__,'_change_menu_icon'));

            add_filter('ot_theme_options_position',array(__CLASS__,'_change_menu_pos'));

            add_action('admin_menu',array(__CLASS__,'_change_admin_menu'));

            add_filter('ot_header_logo_link',array(__CLASS__,'_change_header_logo_link'));

            add_filter('ot_google_fonts_api_key', array(__CLASS__,'th_set_default_key'));

            add_filter('ot_recognized_font_families', array(__CLASS__,'th_recognized_google_font_families'));
        }

        static function _change_header_logo_link()
        {
            global $th_dir;
            return '<a ><img src="'.esc_url(get_template_directory_uri().'/assets/admin/image/thlogo.png').'"></a>';
        }

        static function _change_admin_menu()
        {

        }
        static function _change_menu_pos()
        {
            return 59;
        }
        static function _change_menu_icon()
        {
            return get_template_directory_uri().'/assets/admin/image/thlogo.png';
        }
        static function _change_parent_slug($slug)
        {
            return false;
        }

        static function _change_menu_title($title)
        {
            return esc_html__('Theme Option','autopart');
        }

        static function _add_themeoptions()
        {
            /* OptionTree is not loaded yet, or this is not an admin request */
            if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
                return false;


            $saved_settings = get_option( ot_settings_id(), array() );

            global $th_config;
            $custom_settings= $th_config['theme-option'];

            if(is_array($custom_settings) and !empty($custom_settings))
            {
                /* allow settings to be filtered before saving */
                $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

                /* settings are not the same update the DB */
                if ( $saved_settings !== $custom_settings ) {
                    update_option( ot_settings_id(), $custom_settings );
                }
            }


        }
        static function _ot_header_version_text()
        {

            $title =  esc_html(  self::$theme->display('Name') );
            $ver =  esc_html(  self::$theme->display('Version') );
            $title.=' - '. sprintf(esc_html__('Version %s', 'autopart'), $ver);

            return $title;
        }

        static function th_set_default_key($key){
            $key = 'AIzaSyBFxhycc63fWy_uk126zW8KPtkD3Bay0jI';
            return $key;
        }

        static function th_recognized_google_font_families($families)
        {
            $new_families = array();
            foreach ($families as $key => $value) {
                $key = str_replace('"', '', $value);
                $new_families[$key] = $value;
            }
            return $new_families;
        }


    }
    Th_OptionConfig::_init();
}
