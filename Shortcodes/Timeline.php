<?php

namespace Timeline\Shortcodes;

use Timeline\PostTypes\TimelineItem;
use WP_Query;

class Timeline extends Shortcode
{
    /** @var string Shortcode name. */
    public $name = 'timeline';

    /** @var array Default shortcode attributes. */
    public $default_attributes = [
        'tag' => '',
        'animated' => true,
        'alternating' => true,
        'content' => true,
        'link' => true,
        'excerpt' => true,
        'title' => true,
        'first_arrow' => false,
        'last_arrow' => false,
        'first_step' => false,
        'last_step' => false,
    ];

    /** @var array Filters to apply to the shortcode attributes. */
    public $attribute_filters = [
        'tag' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'animated' => FILTER_VALIDATE_BOOLEAN,
        'alternating' => FILTER_VALIDATE_BOOLEAN,
        'content' => FILTER_VALIDATE_BOOLEAN,
        'link' => FILTER_VALIDATE_BOOLEAN,
        'excerpt' => FILTER_VALIDATE_BOOLEAN,
        'title' => FILTER_VALIDATE_BOOLEAN,
        'first_arrow' => FILTER_VALIDATE_BOOLEAN,
        'last_arrow' => FILTER_VALIDATE_BOOLEAN,
        'first_step' => FILTER_VALIDATE_BOOLEAN,
        'last_step' => FILTER_VALIDATE_BOOLEAN,
    ];

    /**
     * Renders the Person List.
     * 
     * @return string
     */
    public function render()
    {
        wp_enqueue_style('fontawesome_4');
        wp_enqueue_style('timeline_plugin_css');
        wp_enqueue_script('timeline_plugin_js');

        $tags = explode(',', $this->tag);
        $animated = $this->animated ? 'cssanimations' : '';
        $alternating = $this->alternating ? 'alternating' : '';
        $first_arrow = $this->first_arrow ? 'first-arrow' : '';
        $last_arrow = $this->last_arrow ? 'last-arrow' : '';
        $first_step = $this->first_step ? 'first-step' : '';
        $last_step = $this->last_step ? 'last-step' : '';
        
        // options to pass to the view, (using query_var in case it's a template-part)
        $timeline_options = [
            'timeline' => $this,
            'timeline_item' => new TimelineItem(),
        ];
        set_query_var('timeline_options', $timeline_options);

        $results[] = "<section class='cd-timeline $alternating $animated $first_arrow $last_arrow $first_step $last_step'>";
        foreach ($tags as $tag) {
            $loop = new WP_Query([
                'post_type' => (new TimelineItem())->name,
                'tag' => $tag,
                'nopaging' => true,
                'orderby' => ['menu_order' => 'ASC']
            ]);
            while ($loop->have_posts()) {
                $loop->the_post();
                ob_start();

                // If the theme has a template-parts/content-person.php file, use that to render the Person.
                // Otherwise, use the default view partial included in this theme.
                if (locate_template('template-parts/content-timeline-item.php')) {
                    get_template_part('template-parts/content', 'timeline-item');
                } else {
                    include(plugin_dir_path(dirname(__FILE__)) . 'Views/content-timeline-item.php');
                }

                $results[] = ob_get_clean();
            }
            wp_reset_query();
        }
        $results[] = "</section>";

        return implode($results);
    }
}