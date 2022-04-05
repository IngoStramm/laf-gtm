<?php

add_action('cmb2_admin_init', 'lg_register_plugin_options_metabox');
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function lg_register_plugin_options_metabox()
{

    /**
     * Registers options page menu item and form.
     */
    $cmb_options = new_cmb2_box(array(
        'id'           => 'lg_theme_options_page',
        'title'        => esc_html__('LAF GTM', 'cmb2'),
        'object_types' => array('options-page'),

        /*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

        'option_key'      => 'lg_theme_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'              => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
        'parent_slug'             => 'options-general.php', // Make options page a submenu item of the themes menu.
        // 'capability'              => 'manage_options', // Cap required to view options-page.
        // 'position'                => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook'         => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'priority'                => 10, // Define the page-registration admin menu hook priority.
        // 'display_cb'              => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'             => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
        // 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
        // 'message_cb'              => 'lg_options_page_message_callback',
        // 'tab_group'               => '', // Tab-group identifier, enables options page tab navigation.
        // 'tab_title'               => null, // Falls back to 'title' (above).
        // 'autoload'                => false, // Defaults to true, the options-page option will be autloaded.
    ));

    /**
     * Options fields ids only need
     * to be unique within this box.
     * Prefix is not needed.
     */
    $cmb_options->add_field(array(
        'name'    => esc_html__('Tidio Chat', 'cmb2'),
        'desc'    => esc_html__('Este plugin irá criar um botão com o ID informado abaixo. Quando o usuário clicar para abrir a janela do Tidio Chat, irá acionar este botão, que consequentemente irá acionar o evento de rastreio do GTM. ', 'cmb2'),
        'id'      => 'lg_tidio_title',
        'type'    => 'title',
    ));

    $cmb_options->add_field(array(
        'name' => esc_html__('Ativar GTM para Tidio Chat', 'cmb2'),
        'desc'    => esc_html__('Deixe marcado esta opção para ativar a o GTM para o Tidio Chat', 'cmb2'),
        'id'   => 'lg_tidio',
        'type' => 'radio',
        'options' => array(
            'on' => esc_html__('Ativado', 'lg'),
            'off' => esc_html__('Desativado', 'lg'),
        ),
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('ID do botão do WhatsApp (opcional)', 'cmb2'),
        'desc'    => __('Deixe em branco para usar <code>lg-whatsapp-btn</code>', 'cmb2'),
        'id'      => 'lg_tidio_btn_id',
        'type'    => 'text',
    ));
}

function lg_get_option($key = '', $default = false)
{
    if (function_exists('cmb2_get_option')) {
        // Use cmb2_get_option as it passes through some key filters.
        return cmb2_get_option('lg_theme_options', $key, $default);
    }

    // Fallback to get_option if CMB2 is not loaded yet.
    $opts = get_option('lg_theme_options', $default);

    $val = $default;

    if ('all' == $key) {
        $val = $opts;
    } elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[$key]) {
        $val = $opts[$key];
    }

    return $val;
}