(function () {

    $('[data-dtp-dialog]').click(function () {
        var dialogUrl = $(this).data('url');
        $.get(dialogUrl).then(function (dialog) {
            var $dialog = $(dialog);
            $('form', $dialog).submit(function () {
               $.post(dialogUrl, $(this).serialize()).then(function (response) {
                   toastr.success(response.msg);
                   $dialog.modal('hide');
               });
               return false;
            });
            $dialog.appendTo(document.body).modal('show');
        });
    });
    
    for (var type in flashMessages) {
        flashMessages[type].forEach(function (msg) {
           toastr[type](msg);
        });
    }

})();