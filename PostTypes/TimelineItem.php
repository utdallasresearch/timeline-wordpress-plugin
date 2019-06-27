<?php

namespace Timeline\PostTypes;

class TimelineItem extends CustomPost
{
    /** @var string Internal Name. */
    public $name = 'timelineitem';

    /** @var string Singular name. */
    public $singular = 'Timeline Item';

    /** @var array WordPress custom post type settings */
    public $settings = [
        'description' => 'Items for use in timelines',
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => true,
        'rewrite' => [
            'slug' => 'timeline-item',
            'with_front' => true,
        ],
        'query_var' => true,
        'exclude_from_search' => true,
        'menu_icon' => 'dashicons-excerpt-view',
        'supports' => [
            'title',
            'editor',
            'excerpt',
            'revisions',
            'thumbnail',
            'page-attributes',
        ],
        'taxonomies' => [
            'post_tag',
        ],
        'extras' => [
            'enter_title_here'  => "Enter the timeline item name here.",
        ],
    ];

    /** @var array Custom field settings (CMB2) */
    public $custom_fields = [
        [
            'name'  => 'Link',
            'desc'  => 'Add a link (internal or external) for the item.',
            'id'    => '_timeline_item_link',
            'type'  => 'text_url',
            'protocols' => ['http', 'https', 'mailto'],
        ],
        [
            'name'  => 'Icon',
            'desc'  => 'FontAwesome 4 icon class to be used where applicable.',
            'id'    => '_timeline_item_icon',
            'type'  => 'text',
        ],
        [
            'name'  => 'Accent color',
            'desc'  => 'Color to be used as the item accent.',
            'id'    => '_timeline_item_color',
            'type'  => 'colorpicker',
            'default' => '#c75b12',
            'options' => [
                'alpha' => true,
            ],
        ],
    ];

    /**
     * Virtual attribute $this->link
     *
     * @return string|null
     */
    public function getLinkAttribute()
    {
        return $this->_timeline_item_link;
    }

    /**
     * Virtual attribute $this->icon
     *
     * @return string|null
     */
    public function getIconAttribute()
    {
        return $this->_timeline_item_icon;
    }

    /**
     * Virtual attribute $this->color
     *
     * @return string|null
     */
    public function getColorAttribute()
    {
        return $this->_timeline_item_color;
    }

}