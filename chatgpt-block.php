<?php
/**
 * Plugin Name:       Chatgpt Block
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       chatgpt-block
 *
 * @package           create-block
 */
require_once plugin_dir_path(__FILE__) . 'settings.php';
// Create a custom settings page under the Settings menu
add_action('admin_menu', 'chatgpt_options_page');
function chatgpt_options_page() {
	add_options_page(
		'ChatGPT API Key',
		'ChatGPT API Key',
		'manage_options',
		'chatgpt-api-key',
		'chatgpt_options_page_html'
	);
}

// Display the settings page HTML
function chatgpt_options_page_html() {
	if (!current_user_can('manage_options')) {
		return;
	}

	// Handle form submission and save the API key
	if (isset($_POST['chatgpt_api_key'])) {
		update_option('chatgpt_api_key', sanitize_text_field($_POST['chatgpt_api_key']));
	}

	$chatgpt_api_key = get_option('chatgpt_api_key', '');

	?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		<form method="POST">
			<table class="form-table">
				<tr valign="top">
					<th scope="row">ChatGPT API Key</th>
					<td>
						<input type="text" name="chatgpt_api_key" value="<?php echo esc_attr($chatgpt_api_key); ?>" size="50" />
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_chatgpt_block_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_chatgpt_block_block_init' );
