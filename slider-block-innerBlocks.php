<?php

/**
 * Plugin Name:       Slider Block InnerBlocks
 * Description:       A custom block for creating sliders with InnerBlocks.
 * Version:           1.0.0
 * Author:            Bone Kirov
 *
 * @package           slider-block-innerBlocks
 */


/**
 * Register blocks
 *
 * @return void
 */
function digicube_innerblocks_slider_register_blocks()
{
	/**
	 * We register our block's with WordPress's handy
	 * register_block_type();
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	register_block_type(__DIR__ . '/slider/');
	register_block_type(__DIR__ . '/slider-item/');
}
add_action('init', 'digicube_innerblocks_slider_register_blocks', 5);

/**
 * Check for JavaScript modules and set
 * type="module" based on the registered handle.
 *
 * @param string $tag The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 * @return string $tag The <script> tag for the enqueued script.
 */
function digicube_innerblocks_script_attrs($tag, $handle)
{
	if (str_contains($handle, 'module')) {
		$tag = str_replace('<script ', '<script type="module" ', $tag);
	}

	return $tag;
}
add_filter('script_loader_tag', 'digicube_innerblocks_script_attrs', 10, 2);

/**
 * Register Slick scripts.
 *
 * @return void
 */
function digicube_innerblocks_slider_register_scripts()
{
	wp_register_script(
		'slick',
		plugins_url('assets/slick/slick.min.js', __FILE__),
		['jquery'],
		'1.0.0',
		true
	);

	wp_register_style(
		'slick',
		plugins_url('assets/slick/slick.css', __FILE__),
		[],
		'1.0.0'
	);

	wp_register_style(
		'slick-theme',
		plugins_url('assets/slick/slick-theme.css', __FILE__),
		[],
		'1.0.0'
	);


}
add_action('enqueue_block_assets', 'digicube_innerblocks_slider_register_scripts');