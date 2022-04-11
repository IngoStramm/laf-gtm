<?php

add_action('wp_enqueue_scripts', 'lg_frontend_scripts');

function lg_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('laf-gtm-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    wp_register_script('laf-gtm-script', LG_URL . 'assets/js/laf-gtm' . $min . '.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('laf-gtm-script');
    $lg_tidio = lg_get_option('lg_tidio');
    $lg_tidio_btn_id = lg_get_option('lg_tidio_btn_id');
    $lg_rd_whats = lg_get_option('lg_rd_whats');
    $lg_rd_whats_btn_id = lg_get_option('lg_rd_whats_btn_id');
    // lg_debug($lg_tidio);
    $arr_obj = array(
        'ajax_url'              => admin_url('admin-ajax.php'),
        'lg_tidio'              => $lg_tidio,
        'lg_tidio_btn_id'       => $lg_tidio_btn_id,
        'lg_rd_whats'              => $lg_rd_whats,
        'lg_rd_whats_btn_id'       => $lg_rd_whats_btn_id,
    );
    wp_localize_script('laf-gtm-script', 'lg_object', $arr_obj);
    wp_enqueue_style('laf-gtm-style', LG_URL . 'assets/css/laf-gtm.css', array(), false, 'all');
}
