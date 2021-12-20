$(document).ready(function () {
    $(document).on('change','input[type=file]', function () {
        const isRequired = !!$(this).val();
        const attachmentDescription = $(this).closest('.file').next().find('input[name^="attachment"]');
        removeStyles(attachmentDescription,isRequired);
        resetErrorMessagesAndPPreviousRules(attachmentDescription);
        $(attachmentDescription).rules("add", {required: isRequired});
    });
});

function removeStyles(title, shouldItBeShown) {
    $(title).closest('.form-group, .form-check').removeClass('has-success').removeClass('has-error');

    if (shouldItBeShown) {
        $(title).closest('.form-group, .form-check').parent().removeClass('d-none');
    }else{
        $(title).closest('.form-group, .form-check').parent().addClass('d-none');
    }
}

function resetErrorMessagesAndPPreviousRules(title) {
    $('#form').validate().resetForm();
    $(title).rules("remove", "required");
}
