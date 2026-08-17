// File: gush-ai-ecommerce-chatbot.php
<?php
/**
 * Plugin Name: Gush AI E-commerce Chatbot
 * Plugin URI: https://github.com/gush-ai/gush-ai-ecommerce-chatbot
 * Description: Advanced AI shopping assistant for WooCommerce with multi-model support and product knowledge integration.
 * Version: 2.0.0
 * Author: Gush AI
 * Author URI: https://ai.sstore.ng/
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Requires Plugins: woocommerce
 * Text Domain: gush-ai-ecommerce-chatbot
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) exit;

define('GUSH_AI_ECOMMERCE_VERSION', '2.0.0');
define('GUSH_AI_ECOMMERCE_DIR', plugin_dir_path(__FILE__));
define('GUSH_AI_ECOMMERCE_URL', plugin_dir_url(__FILE__));

// Include core files
require_once GUSH_AI_ECOMMERCE_DIR . 'includes/class-gush-ai-ecommerce.php';
require_once GUSH_AI_ECOMMERCE_DIR . 'includes/class-gush-ai-ecommerce-admin.php';
require_once GUSH_AI_ECOMMERCE_DIR . 'includes/class-gush-ai-ecommerce-api.php';
require_once GUSH_AI_ECOMMERCE_DIR . 'includes/class-gush-ai-ecommerce-chat.php';
require_once GUSH_AI_ECOMMERCE_DIR . 'includes/class-gush-ai-ecommerce-knowledge.php';

// Activation/Deactivation hooks
register_activation_hook(__FILE__, array('Gush_AI_Ecommerce', 'activate'));
register_deactivation_hook(__FILE__, array('Gush_AI_Ecommerce', 'deactivate'));

// Initialize plugin
function gush_ai_ecommerce_init() {
    $plugin = new Gush_AI_Ecommerce();
    $plugin->run();
}
add_action('plugins_loaded', 'gush_ai_ecommerce_init');