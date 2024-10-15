<?php

/**
 * Slider item for the slider block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values. 
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'slider-item-innerBlock';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$is_editor = isset($is_preview) && $is_preview;

$allowed_blocks = array('core/heading', 'core/paragraph', 'core/buttons');
$template = array(
    array('core/heading', array(
        'level' => 2,
        'content' => 'Please Enter Heading Text',
        'textAlign' => 'center',
        'style' => array('color' => array('text' => '#ffffff')),
        'lock' => array(
            'move'   => true,
            'remove' => true,
        ),
    )),
    array('core/paragraph', array(
        'content' => 'Please enter some text here.',
        'textAlign' => 'center',
        'style' => array('color' => array('text' => 'white')),
        'lock' => array(
            'move'   => true,
            'remove' => true,
        ),
    )),
    array('core/buttons', array(
        'lock' => array(
            'move'   => true,
            'remove' => false,
        ),
        'layout' => array(
            'type' => 'flex',
            'justifyContent' => 'center'
        )
    ), array(
        array('core/button', array(
            'text' => 'Click Here',
            'align' => 'center'
        ))
    ))
);


$backgroundimage = get_field('background_image');
if (!$backgroundimage) {
    $backgroundimage = 'https://via.placeholder.com/1920x1080';
}
?>
<div <?php echo $anchor; ?>>
    <div class="<?php echo esc_attr($class_name); ?>"
        style="background-image: url(<?php echo esc_url($backgroundimage); ?>);">
        <div class="slider-item-innerBlock-content">
            <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>"
                template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
        </div>
    </div>
</div>