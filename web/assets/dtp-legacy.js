(function () {

    // Clickable Accordion headings
    $('.clickable-heading .panel-heading').click(function () {
        var $triggerAnchor = $('a', this);
        $('.collapse', $triggerAnchor.attr('data-parent')).collapse('hide')
        $($triggerAnchor.attr('href')).collapse('show');
    });

    // Clickable table rows
    $('.clickable-rows tr').click(function () {
        window.location = $('a',this).attr('href');
    });
})();