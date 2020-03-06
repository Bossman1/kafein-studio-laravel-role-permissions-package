window.App = window.App || {};

(function ($, window, App) {
    'use strict';
    App.users = {
        init: function () {
            $('#roleTable').on('click', '.deleteRole', function () {
                return confirm('Supprimer le Role ?');
            });
            $(document).on("focusout", ".role-name-selector", function () {
                let str = $.trim($(this).val());
                $.ajax({
                    method: "post",
                    url: '/administration/role/generate-slug',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        str: str
                    },
                    complete: function (res) {
                        if (res.responseText) {
                            $('.role-slug-selector').val(res.responseText);
                        }
                    },
                    error: function (res) {
                        console.log(res);
                    }
                });
            });


        },
    };
})(jQuery, window, window.App);

jQuery(document).ready(function () {
    if (jQuery('.rolePage').length)
        window.App.users.init();
});
