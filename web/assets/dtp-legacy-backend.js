(function () {

    $('[data-dtp-dialog]').click(function () {
        var dialogUrl = $(this).data('url') || $(this).attr('href');
        $.get(dialogUrl).then(function (dialog) {
            var $dialog = $(dialog);
            $('form', $dialog).submit(function () {
                $.post(dialogUrl, $(this).serialize()).then(function (response) {
                    $dialog.modal('hide');
                    if (typeof response.redirect !== 'undefined') {
                        window.location.href = response.redirect;
                    } else if (typeof response.msg !== 'undefined') {
                        toastr.success(response.msg);
                    }
                });
                return false;
            });
            $dialog.appendTo(document.body).modal('show');
        });
        return false;
    });
    
    for (var type in flashMessages) {
        flashMessages[type].forEach(function (msg) {
           toastr[type](msg);
        });
    }

})();