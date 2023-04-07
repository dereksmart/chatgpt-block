<?php
function chatgpt_register_routes() {
	register_rest_route('chatgpt/v1', '/generate-content', [
		'methods' => WP_REST_Server::CREATABLE,
		'callback' => 'chatgpt_generate_content',
		'permission_callback' => '__return_true',
	]);
}

add_action('rest_api_init', 'chatgpt_register_routes');

function chatgpt_generate_content(WP_REST_Request $request) {
	$api_key    = get_option( 'chatgpt_api_key' );
	$body       = $request->get_json_params();
	$prompt     = $body['prompt'];
	$max_tokens = $body['max_tokens'];

	$api_url = 'https://api.openai.com/v1/engines/text-davinci-002/completions';

	$headers = [
		'Content-Type'  => 'application/json',
		'Authorization' => 'Bearer ' . $api_key,
	];

	$data = [
		'prompt'     => $prompt,
		'max_tokens' => $max_tokens,
	];

	$response = wp_remote_post( $api_url, [
		'headers' => $headers,
		'body'    => json_encode( $data ),
	] );

	if ( is_wp_error( $response ) ) {
		return new WP_Error( 'request_failed', __( 'ChatGPT API request failed.', 'chatgpt-block' ), [ 'status' => 500 ] );
	}

	$response_data = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( isset( $response_data['choices'][0]['text'] ) ) {
		return rest_ensure_response( [ 'content' => $response_data['choices'][0]['text'] ] );
	}

	return new WP_Error( 'api_error', __( 'ChatGPT API returned an error:', 'chatgpt-block' ) . json_encode( $response_data ), [ 'status' => 500 ] );
}
