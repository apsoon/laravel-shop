// Create the new tab
var $tabPane = $('<div />', {
    'id'   : 'control-sidebar-theme-demo-options-tab',
    'class': 'tab-pane active'
})

// Create the tab button
var $tabButton = $('<li />', { 'class': 'active' })
    .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>'
        + '<i class="fa fa-wrench"></i>'
        + '</a>')

// Add the tab button to the right sidebar tabs
$('[href="#control-sidebar-home-tab"]')
    .parent()
    .before($tabButton)