<?php

class SlideeInitializer {

	public function __construct() {
		$this->_registerSliderPostType();
		$this->_initSliderEditForm();
		$this->_registerAdminAssets();
		$this->_registerFrontAssets();
	}

	private function _registerSliderPostType() {
		add_action('init', function () {

			register_post_type(SLIDEE_POST_TYPE, array(
				'label'  => null,
				'labels' => array(
					'name'               => 'Slidee',
					'singular_name'      => 'Slider',
					'add_new'            => 'Add slider',
					'add_new_item'       => 'New slider',
					'edit_item'          => 'Edit slider',
					'new_item'           => 'New slider',
					'view_item'          => 'View slider',
					'search_items'       => 'Search slider',
					'not_found'          => 'Not found',
					'not_found_in_trash' => 'Not found',
					'parent_item_colon'  => '',
					'menu_name'          => 'Slidee',
				),
				'description'         => '',
				'public'              => true,
				'publicly_queryable'  => false,
				'exclude_from_search' => null,
				'show_ui'             => null,
				'show_in_menu'        => null,
				'show_in_admin_bar'   => null,
				'show_in_nav_menus'   => null,
				'show_in_rest'        => null,
				'rest_base'           => null,
				'menu_position'       => null,
				'menu_icon'           => null,
				'hierarchical'        => false,
				'supports'            => array('title'),
				'taxonomies'          => array(),
				'has_archive'         => false,
				'rewrite'             => true,
				'query_var'           => true,
			) );

		});
	}

	private function _initSliderEditForm() {
		add_action('edit_form_after_title', function ($post) {

			if ($post->post_type != SLIDEE_POST_TYPE) {
				return;
			}
			echo '<div style="margin-top: 15px; padding: 10px 15px; background: #ddd; font-size: 16px; font-weight: 600; color: #333; border:1px solid #ccc;">[slidee id="' . $post->ID . '"]</div>';

		});
	}

	private function _registerAdminAssets() {

		add_action('admin_enqueue_scripts', function() {
			wp_enqueue_media();
			wp_enqueue_editor();
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');

			wp_enqueue_style(
				'slidee-admin-css',
				SLIDEE_DIR_URL . 'assets/css/slidee-admin.min.css',
				[],
				filemtime( SLIDEE_PLUGIN_DIR . 'assets/css/slidee-admin.min.css' )
			);

			wp_enqueue_script(
				'slidee-admin-js',
				SLIDEE_DIR_URL . 'assets/js/admin.min.js',
				[ 'wp-color-picker' ],
				filemtime( SLIDEE_PLUGIN_DIR . 'assets/js/admin.min.js' ),
				true
			);

		}, 99 );

	}

	private function _registerFrontAssets() {

		add_action('wp_enqueue_scripts', function() {

			wp_enqueue_style(
				'slidee-front-css',
				SLIDEE_DIR_URL . 'assets/css/slidee-front.min.css',
				[],
				filemtime( SLIDEE_PLUGIN_DIR . 'assets/css/slidee-front.min.css' )
			);

			wp_enqueue_script(
				'slidee-front-js',
				SLIDEE_DIR_URL . 'assets/js/main.min.js',
				[],
				filemtime( SLIDEE_PLUGIN_DIR . 'assets/js/main.min.js' ),
				true
			);

		});

	}

}

new SlideeInitializer();