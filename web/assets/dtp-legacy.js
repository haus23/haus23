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

    // Initialize popovers
    $('#ranking [data-toggle="popover"]')
        .click(function ($ev) {
            $ev.stopPropagation();
        })
        .popover({ html: true, content: function () {
            return '<table><tbody><tr><td>Zeile 1</td></tr><tr><td>Zeile 2</td></tr><tr><td>Zeile 1</td></tr><tr><td>Zeile 1</td></tr></tbody></table>';
        }});
    $('#ranking').on('show.bs.popover', function ($ev) {
        $($ev.target).closest('tr').siblings().find('[data-toggle="popover"]').popover('hide');
    })
})();