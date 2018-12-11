var token = $('meta[name=csrf-token]').attr('content');
$(document).on('change', 'input[data-method], select[data-method], textarea[data-method]', function () {
    $(this).forceSubmit();
});
$(document).on('click', 'button[data-method], a[data-method]', function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $(this).forceSubmit();
});
$.fn.forceSubmit = function () {
    if ($(this).data('confirm') && !confirm($(this).data('confirm'))) {
        return;
    }
    if ($(this).data('method')) {
        var method = $(this).data('method').toUpperCase();
        if ($(this).parents('form').length < 1) {
            $(this).wrap('<form style="display: inline"></form>');
        }
        $form = $(this).parents('form');
        if (method !== 'GET' && $form.find('input[name=_token]').length < 1) {
            $form.append('<input type="hidden" name="_token" value="' + token + '">');
        }
        if ($(this).attr('href') || $(this).data('action')) {
            var url;
            if ($(this).attr('href')) {
                url = $(this).attr('href');
            }
            if ($(this).data('action')) {
                url = $(this).data('action');
            }
            $form.attr('action', url);
        }
        if ($(this).data('appends')) {
            $.each($(this).data('appends'), function (key, value) {
                if (value) {
                    $form.append('<input type="hidden" value="' + value + '" name="' + key + '">');
                }
            })
        }
        if (method === 'GET' || method === 'POST') {
            $form.attr('method', method).submit();
        } else {
            $form.attr('method', 'POST');
            if ($form.find('input[name=_method]').length < 1) {
                $form.append('<input type="hidden" name="_method">');
            }
            $form.find('input[name=_method]').attr('value', method);
            $form.submit();
        }
    }
};