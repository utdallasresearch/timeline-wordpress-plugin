require('waypoints/lib/noframework.waypoints.min');

/**
 * Timeline plugin actions.
 * 
 * @return {Object}
 */
const timelinePlugin = (() => {

    /**
     * Animates timeline blocks on scroll.
     * 
     * @return {void}
     */
    const animateOnScroll = () => {
        const animated_blocks = document.querySelectorAll('.cd-timeline.cssanimations .cd-timeline-block:not(:first-child)');

        for (let index = 0; index < animated_blocks.length; index++) {
            const animated_block = animated_blocks[index];
            animated_block.classList.add('is-hidden');

            let waypoint = new Waypoint({
                element: animated_block,
                offset: '85%',
                handler: function (direction) {
                    if (direction === 'down') {
                        animated_block.classList.remove('is-hidden');
                        animated_block.classList.add('bounce-in');
                    }
                },
            });
        }
    }
    
    return {
        animateOnScroll: animateOnScroll,
    };

})();

// Initiate timeline actions when the DOM is loaded.
document.addEventListener("DOMContentLoaded", timelinePlugin.animateOnScroll);