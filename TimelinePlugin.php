<?php

namespace Timeline;

use Timeline\PostTypes\TimelineItem;
use Timeline\Shortcodes\Timeline;

class TimelinePlugin
{
    /** @var string The current version of the plugin. */
    protected $version = VERSION;

    /** @var string The url of the assets folder. */
    protected $asset_url;

    /** @var array Custom post types */
    protected $custom_posts = [];

    /** @var array Shortcodes */
    protected $shortcodes = [];

    /**
     * Define the core functionality of the plugin.
     */
    public function __construct()
    {
        $this->asset_url = plugin_dir_url(__FILE__) . 'public';

        $this->custom_posts[] = new TimelineItem();

        $this->shortcodes[] = new Timeline();
    }

    /**
     * Register the filters and actions with WordPress.
     */
    public function load()
    {
        // Load the required dependencies for this plugin.
        require_once plugin_dir_path(__FILE__) . 'includes/cmb2/init.php';

        // Register custom post types
        add_action('init', [$this, 'registerCustomPosts']);

        // Register custom fields
        add_action('cmb2_admin_init', [$this, 'registerCustomFields']);

        // Register the title field placeholder replacement function for custom post types
        add_action('enter_title_here', [$this, 'replaceEnterTitleHere']);

        // Register CSS and JS
        add_action('wp_enqueue_scripts', [$this, 'registerScripts']);

        // Register shortcodes
        add_action('init', [$this, 'registerShortcodes']);
    }

    /**
     * Register the CSS and JavaScript for the public-facing side of the site.
     */
    public function registerScripts()
    {
        // Note: timeline styles are only loaded when the shortcode is used
        wp_register_style('fontawesome_4', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], '4.7.0');
        wp_register_style('timeline_plugin_css', $this->asset_url . '/css/timeline.css', [ 'fontawesome_4'], $this->version);

        // Note: timeline scripts are only loaded when the shortcode is used
        wp_register_script('timeline_plugin_js', $this->asset_url . '/js/timeline.js', [], $this->version);
    }

    /**
     * Register Custom Post Types.
     */
    public function registerCustomPosts()
    {
        foreach ($this->custom_posts as $custom_post) {
            $custom_post->register();
        }
    }

    /**
     * Register Custom Fields.
     */
    public function registerCustomFields()
    {
        foreach ($this->custom_posts as $custom_post) {
            $custom_post->registerFields();
        }
    }

    /**
     * Register shortcodes
     */
    public function registerShortcodes()
    {
        foreach ($this->shortcodes as $shortcode) {
            $shortcode->register();
        }
    }

    /**
     * Replaces the 'Enter Title here' placeholder text in custom post type titles.
     *
     * To implement on a custom post, add an 'extras' => ['enter_title_here' => 'replacement text']
     * key to the register_post_type() options array.
     * 
     * @param  string $message : default message
     * @return string
     */
    public function replaceEnterTitleHere($message)
    {
        $screen = get_current_screen();
        $post_type_object = get_post_type_object($screen->post_type);

        if (is_object($post_type_object) && property_exists($post_type_object, 'extras')) {
            $extras = $post_type_object->extras;

            if (is_array($extras) && array_key_exists('enter_title_here', $extras)) {
                return $extras['enter_title_here'];
            }
        }

        return $message;
    }
}
