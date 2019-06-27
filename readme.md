# UT Dallas Research Timeline WordPress Plugin

A WordPress plugin for generating a custom-post-based timeline.

## Installation

Copy into the WordPress plugins folder and activate.

## Custom Post Type: Timeline Item

- Timelines reference Timeline Items (ordered by menu order)
- Timeline Items have
    - title
    - link (custom field)
    - color (custom field)
    - icon (custom field, Font Awesome 4 classes)
    - content

## Shortcode: Timeline

- Basic use: `[timeline tag="thing1,thing2"]`
- Other options
    - `animated={true/false}` : animate the timeline on scroll, default: true
    - `alternating={true/false}` : alternate timeline items left/right of the line, default: true
    - `content={true/false}` : show each timeline item's content, default: true
    - `link={true/false}` : show each timeline item's link if set, default: true
    - `excerpt={true/false}` : show each timeline item's excerpt if set, default: true
    - `first_arrow={true/false}` : show an arrow before the timeline, default: false
    - `last_arrow={true/false}` : show an arrow after the timeline, default: false
    - `first_step={true/false}` : hide the line before the first item, default: false
    - `last_step={true/false}` : hide the line after the last item, default: false

## Customizing for Themes

- DOM: Copy the `Views/content-timeline-item.php` file into your theme's `template-parts/content-timeline-item.php`. You can then edit that file to customize the rendering of each timeline item. The plugin will look for this file and use it instead of the default if it exists.
- CSS: The timeline is contained in a `section.cd-timeline` element, and by default each timeline component has CSS classes that you can style for your theme

## Development

Final JS and CSS are compiled from source files in the `public/js/source` and `public/css/source` folders. CSS is compiled from Sass. The compilation utility is Laravel Mix, executed with npm/yarn scripts.

Requirements: npm / yarn

- Run `yarn` to install the dependencies
- Run `yarn dev` to compile changes to JS and CSS