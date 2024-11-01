<?php

add_action('add_meta_boxes_' . SLIDEE_POST_TYPE, 'slidee_register_slider_settings_metabox');
add_action('save_post_' . SLIDEE_POST_TYPE, 'slidee_save_settings');

function slidee_register_slider_settings_metabox() {

	add_meta_box(
		'slidee-settings',
		'Опции слайдера',
		'slidee_settings_load_view',
		SLIDEE_POST_TYPE,
		'normal',
		'high'
	);

}

function slidee_settings_load_view($post) {
	$slider = new Slidee($post->ID);

	(new SlideeView('settings'))->render(['slidee' => $slider ]);
}

function slidee_save_settings($post_id) {

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if( !isset($_POST['slidee_settings']) ) {
		return $post_id;
	}

	$default = [
		'height' => 600,
		'nav' => 'true',
		'dots' => 'true',
		'autoplay' => 'true',
		'autoplay_delay' => 3000,
		'change_speed' => 1000,
		'change_delay' => 0,
		'overlay_enable' => 0,
		'overlay_color' => '#000',
		'overlay_opacity' => '0.5',
		'custom_css' => ''
	];

	$sanitizeData = [];

	foreach ($_POST['slidee_settings'] as $key => $value) {
		if ($key === 'custom_css') {
			$sanitizeData[$key] = esc_html(str_replace("\r\n", "<br/>", $value));
		}
		else {
			$sanitizeData[$key] = sanitize_text_field($value);
		}
	}

	foreach ($sanitizeData as $key => &$data) {
		if (strlen($data) === 0) {
			$data = $default[$key];
		}
	}

	update_post_meta($post_id, 'slidee_settings', json_encode($sanitizeData, JSON_UNESCAPED_UNICODE));

	if( !isset($_POST['slidee_slides']) ) {
		return $post_id;
	}

	$slides = [];
	foreach ($_POST['slidee_slides']['image'] as $index => $img) {
		if (strlen($img) > 0) {
			$slides[] = [
				'image' => esc_url_raw($img),
				'content' => wp_unslash(esc_html(
					str_replace("\r\n", "<br/>", $_POST['slidee_slides']['content'][$index])
				))
			];
		}
	}

	update_post_meta($post_id, 'slidee_slides', json_encode($slides, JSON_UNESCAPED_UNICODE));

	return $post_id;
}