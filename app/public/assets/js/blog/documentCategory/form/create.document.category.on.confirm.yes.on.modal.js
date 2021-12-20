$(document).ready(function () {

    const createForm = $("form#create-document-category-form");

    createForm.validate({
        onfocusout: false,
        onkeyup: false,
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        submitHandler: function (formA, event) {

            event.preventDefault();

            submitsJobDesignationFormViaAjaxWhenIsValid(createForm);
        }
    });

});

function submitsJobDesignationFormViaAjaxWhenIsValid(createForm) {

    const errorDetails = Translator.trans('Failed to create new item, if the problem continues, please contact support.');

    const createModalSelector = '#create-document-category-modal';

    if (createForm.data('isRequestRunning')) {
        return;
    }

    hideElementsCanCloseModal(
        '#close-create-document-category-modal-on-click-button-cancel',
        '#close-create-document-category-modal-on-click-top-cross'
    );

    createForm.data('isRequestRunning', true);

    disableCloseModalWhenClickOutside(createModalSelector);

    replaceSubmitButtonWithLoadingSpinner('#create-document-category-submit');

    const id = $(createModalSelector + ' input[name="id"]').val();

    const name = $(createModalSelector + ' input[name="name"]').val();

    const isSelectThisValueChecked = $('input[name="select_this_document_category_on_save"]').is(':checked');

    $.ajax({
        url: createForm.attr('action'),
        type: "POST",
        data: createForm.serialize(),
        cache: false,
        success: function (response) {

            const successMessage = Translator.trans('Document category has successfully created!');

            createForm.data('isRequestRunning', false);

            if (response.status !== 'success') {

                $(createModalSelector).html(response.html);

                return false;
            }

            replaceModalContentBySuccessMessage(createModalSelector, successMessage);

            enableCloseModalWhenClickOutside(createModalSelector);

            const checked = isSelectThisValueChecked ? 'checked' : '';

            $('<br>' +
                '<label class="form-radio-label">' +
                '<input class="form-radio-input" type="radio" name="document_category_id" value="' + id + '" ' + checked + ' >' +
                '<span class="form-radio-sign">' + name + '</span>' +
                '</label>').insertAfter('#container-document-category label:first');
        },
        error: function () {
            replaceModalContentByFailMessage(createModalSelector, errorDetails);
            createForm.data('isRequestRunning', false);
        },
        complete: function () {
            createForm.data('isRequestRunning', false);
        }
    });
}
