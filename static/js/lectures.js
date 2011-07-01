/**
 * Javascript calls for lectures screen
 */

// Start expanded
jQuery("#lectures-tree-container").bind('loaded.jstree', function() {
    jQuery("#lectures-tree-container").jstree("open_all");
});
// Load the data
jQuery("#lectures-tree-container").jstree(
    {
        "themes" : {
            "url"   : jstreeArgs.themes_path,
            "theme" : "default",
            "dots"  : true,
            "icons" : false
        },
        "html_data" : {
            "data"  : jQuery("#lectures-tree-data")
        },
        "sort"      : function( a, b ) {
            // Get the classes with order values
            var a_class = jQuery(a).attr('class').match(/[0-9]-order/g);
            var b_class = jQuery(b).attr('class').match(/[0-9]-order/g);
            // Sort those
            var arr = [a_class , b_class].sort();
            // Compare those
            return ( arr.indexOf(a_class) > arr.indexOf(b_class) ) ? 1 : -1;
        },
        "plugins"   : [ "themes", "html_data", "sort", "search" ]
    }
);
// Search for lectures
jQuery("#lectures-tree-search-submit").click( function() {
    var search_string = jQuery("#lectures-tree-search-text").val();
    jQuery("#lectures-tree-container").jstree( "search", search_string );
});
// Expand All/Collapse All Toggle
jQuery("#lectures-tree-toggle").click( function() {
    var action = jQuery("#lectures-tree-toggle").attr('rel');
    if( action === 'expand' ) {
        jQuery("#lectures-tree-container").jstree("open_all");
        jQuery("#lectures-tree-toggle").attr('rel', 'collapse');
        jQuery("#lectures-tree-toggle .expand-all").toggle();
        jQuery("#lectures-tree-toggle .collapse-all").toggle();
    } else {
        jQuery("#lectures-tree-container").jstree("close_all");
        jQuery("#lectures-tree-toggle").attr('rel', 'expand');
        jQuery("#lectures-tree-toggle .collapse-all").toggle();
        jQuery("#lectures-tree-toggle .expand-all").toggle();
    }
});