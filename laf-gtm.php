<?php

/**
 * Plugin Name: LAF GTM
 * Plugin URI: https://agencialaf.com
 * Description: Plugin da Agência LAF, com opções para o GTM capturar lead de aplicações externas (botão do WhatsApp do RD Station e Tidio Chat).
 * Version: 0.0.2
 * Author: Ingo Stramm
 * Text Domain: lg
 * License: GPLv2
 */

defined('ABSPATH') or die('No script kiddies please!');

define('LG_DIR', plugin_dir_path(__FILE__));
define('LG_URL', plugin_dir_url(__FILE__));

function lg_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

require_once 'tgm/tgm.php';
// require_once 'classes/classes.php';
require_once 'lg-options.php';
require_once 'scripts.php';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/laf-gtm/master/info.json',
    __FILE__,
    'laf-gtm'
);
