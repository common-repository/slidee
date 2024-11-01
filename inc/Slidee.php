<?php

class Slidee {
	private $id;
	private $settings;
	private $slides;

	public function __construct($postID) {
		$post = get_post($postID);

		if (!$post) {
			return null;
		}

		$this->id = $postID;
		$this->init();
	}

	public function __get($name) {
		return $this->$name;
	}

	private function init() {
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

		$settings = get_post_meta($this->id, 'slidee_settings', true);
		$slides = get_post_meta($this->id, 'slidee_slides', true);

		if ($settings) {
			$this->settings = json_decode($settings, true);
			$this->settings['custom_css'] = str_replace(
				"<br/>",
				"\r\n",
				wp_specialchars_decode($this->settings['custom_css'], ENT_QUOTES)
			);
		}
		else {
			$this->settings = [];
		}

		$this->settings = array_replace_recursive($default, $this->settings);

		if ($slides) {
			$this->slides = [];
			$slides = json_decode($slides, true);

			foreach ($slides as $slide) {
				$this->slides[] = [
					'image' =>  esc_url($slide['image']),
					'content' => str_replace(
						"<br/>",
						"\r\n",
						wp_specialchars_decode($slide['content'], ENT_QUOTES)
					)
				];
			}
		}
		else {
			$this->slides = [];
		}
	}

}