<?php

/**
 * Slider section with slider and information.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values. 
// dont change this 
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'slider-innerblocks-section';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


$is_editor = isset($is_preview) && $is_preview;

$sliders_to_show = get_field('sliders_to_show') ?: 1;
$slider_to_show_tablet = get_field('slider_to_show_tablet') ?: 1;
$slider_to_show_mobile = get_field('slider_to_show_mobile') ?: 1;
$show_arrows = get_field('show_arrows') == 1 ? true : false;
$show_dots = get_field('show_dots') == 1 ? true : false;

// Add data attributes to the section
$data_attributes = sprintf(
    'data-slides-to-show="%s" data-slides-to-show-tablet="%s" data-slides-to-show-mobile="%s" data-show-arrows="%s" data-show-dots="%s"',
    esc_attr($sliders_to_show),
    esc_attr($slider_to_show_tablet),
    esc_attr($slider_to_show_mobile),
    esc_attr($show_arrows ? 'true' : 'false'),
    esc_attr($show_dots ? 'true' : 'false')
);
?>
<section <?php echo $anchor; ?>
    class="<?php echo esc_attr($class_name); ?><?php echo $is_editor ? ' is-editor' : ''; ?>"
    <?php echo $data_attributes; ?>>
    <div class="slider-innerblocks">
        <?php
    $allowed_blocks = array('acf/slideritem');
    $template = array(
        array('acf/slideritem')
    );
    echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />';
      
      ?>
    </div>
</section>
<?php 