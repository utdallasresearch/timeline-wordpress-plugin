<?php
/**
 * The template for a timeline block element.
 * 
 * (note: The minimal indentation is to avoid wp-autop.)
 * 
 * See Shortcodes\Timeline for attributes,
 * used as $timeline->{shortcode_attribute}.
 * 
 * See PostTypes\TimelineItem for its custom_fields,
 * used as $timeline_item->{custom_field_name}
 */
$timeline = $timeline_options['timeline'];
$timeline_item = $timeline_options['timeline_item'];
$default_colors = ['#c75b12', '#008542', 'ter_sli'];
$target = (parse_url($timeline_item->link, PHP_URL_HOST) == $_SERVER['SERVER_NAME']) ? "_self" : "_blank";
?>
<div class="cd-timeline-block">

<div class="cd-timeline-img cd-picture" style="background-color:<?= $timeline_item->color ?: $default_colors[array_rand($default_colors)] ?>">
    <i class="fa <?= $timeline_item->icon ?: 'fa-info-circle' ?>"></i>
</div>

<div class="cd-timeline-content">

    <?php if ($timeline->title) : ?>
        <h2 class="cd-timeline-title"><?php the_title() ?></h2>
    <?php endif; ?>

    <?php if ($timeline->content) : ?>
        <div class="cd-timeline-object-content"><?php the_content(); ?></div>
    <?php endif; ?>

    <?php if ($timeline->link && $timeline_item->link) : ?>
        <a href="<?= $timeline_item->link ?>" target="<?= $target ?>" class="cd-read-more">
            <?php if ($timeline->compact) : ?>
                <i class="fa fa-chevron-right cd-read-more-icon"></i>
            <?php else : ?>
                Read More
            <?php endif; ?>
        </a>
    <?php endif; ?>

    <?php if ($timeline->excerpt && has_excerpt()) : ?>
        <span class="cd-date"><?= trim(get_the_excerpt()) ?></span>
    <?php endif; ?>

</div>
</div>