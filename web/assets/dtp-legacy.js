(function () {

    // Clickable Accordion headings
    $('.clickable-heading .panel-heading').click(function () {
        var $triggerAnchor = $('a', this);
        $('.collapse', $triggerAnchor.attr('data-parent')).collapse('hide')
        $($triggerAnchor.attr('href')).collapse('show');
    });

    // Clickable table rows
    $('.clickable-rows tr').click(function () {
        window.location = $('a',this).attr('href') || $('a', this.previousElementSibling).attr('href');
    });

    // Initialize popovers if there are some current tips (actually only with a current ranking request)
    if (currentTips !== null) {
        $('#ranking [data-toggle="popover"]')
            .click(function ($ev) {
                $ev.stopPropagation();
            })
            .popover({ html: true,
                content: function () {
                    var $content = $('<table class="table table-condensed">' +
                        '<thead>' +
                        '<tr><th>Spiel</th><th>Ergebnis</th><th>Tipp</th><th>Punkte</th></tr>' +
                        '</thead><tbody></tbody></table>');
                    var $body = $('tbody', $content);
    
                    var player = $(this).data('player-id');
                    for (id in currentTips) {
                        //noinspection JSUnfilteredForInLoop
                        var m = currentTips[id];
                        var $row = $('<tr></tr>');
                        $('<td></td>').html(m['paarung']).appendTo($row);
                        $('<td class="text-center"></td>').html(m['ergebnis']).appendTo($row);
                        var tipp = '';
                        var punkte = '';
                        var doppelt = false;
                        if (typeof m['tips'][player] !== 'undefined') {
                            tipp = m['tips'][player]['tipp'];
                            punkte = m['tips'][player]['punkte'];
    
                            if ( (m['tips'][player]['joker']
                                + m['tips'][player]['zusatzjoker']
                                + m['tips'][player]['sonder']) > 0) {
                                $row.addClass('success');
                            }
    
                        }
                        $('<td class="text-center"></td>').html(tipp).appendTo($row);
                        $('<td class="text-center"></td>').html(punkte).appendTo($row);
                        $row.appendTo($body);
                    }
                    return $content;
                },
                placement: function () {
                    if( $(window).width() < 480 ) {
                        return 'bottom';
                    } else {
                        return 'right';
                    }
                }
            });

        $('#ranking').on('show.bs.popover', function ($ev) {
            $($ev.target).closest('tr').siblings().find('[data-toggle="popover"]').popover('hide');
        });
    }

})();