<?php

add_shortcode( 'slidee', 'slidee_shortcode_callback');

function slidee_shortcode_callback($atts) {

	if (empty($atts['id'])) {
		echo '<div class="slidee-error">[Slidee] unexpected param "ID" !</div>';
		return;
	}

	$slider = new Slidee($atts['id']);

	if (!$slider) {
		echo '<div class="slidee-error">[Slidee] Slidee with same ID not found!</div>';
		return;
	}

	(new SlideeView('slider'))->render(['slider' => $slider ]);
}