$(document).ready(function () {
    const allowed_files = $('input[name="attachment[0][file]"]').attr('accept');
    $('input[type=file]').rules("add", {
        messages: Translator.trans('This file type is not supported.'),
        accept: allowed_files
    });
});