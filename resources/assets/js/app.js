/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

/**
 * Now we can write our custom code
 */

/**
 * Init Foundation
 */
$(document).foundation();

/**
 * Scroll Reveal
 */
sr.reveal("[data-scrollreveal]", { duration: 1000 });

/**
 * Toggle Header Search bar
 */
$(document).on("click", "[data-toggle-search-trigger]", function(e) {
    e.preventDefault();
    $("[data-toggle-search]").slideToggle();
});

/**
 * Prefetch and Transition the next page
 */
(function($) {
    // Which links should we prefetch?
    var $linkElements = $("a");

    // Prefetch on Hover
    $linkElements.on("mouseover", function() {
        var link = $(this).attr("href"),
            prerenderLink = $("#prerenderLink");
        if (prerenderLink.length) {
            if (prerenderLink.attr("href") === link) return;
            prerenderLink.attr("href", link);
        } else {
            $(
                '<link id="prerenderLink" rel="prefetch prerender" href="' +
                    link +
                    '" />'
            ).appendTo("body");
        }
    });

    // Transition out the current page
    $linkElements.on("click", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        if (link && link.length > 1) {
            $("body").addClass("fadeOut");

            setTimeout(function() {
                window.location.href = link;
            }, 150);
        }
    });
})(jQuery);
