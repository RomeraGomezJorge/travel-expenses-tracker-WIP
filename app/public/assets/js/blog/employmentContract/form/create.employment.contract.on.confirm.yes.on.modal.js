$(document).ready(function () {

    const createEmploymentContractForm = $("form#create-employment-contract-form");

    createEmploymentContractForm.validate({
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

            submitsEmploymentContractFormViaAjaxWhenIsValid(createEmploymentContractForm);
        }
    });

});

function submitsEmploymentContractFormViaAjaxWhenIsValid(createEmploymentContractForm) {

    const errorDetails = Translator.trans('Failed to create new item, if the problem continues, please contact support.');

    const createEmploymentContractModalSelector = '#create-employment-contract-modal';

    if (createEmploymentContractForm.data('isRequestRunning')) {
        return;
    }

    hideElementsCanCloseModal(
        '#close-create-employment-contract-modal-on-click-button-cancel',
        '#close-create-employment-contract-modal-on-click-top-cross'
    );

    createEmploymentContractForm.data('isRequestRunning', true);

    disableCloseModalWhenClickOutside(createEmploymentContractModalSelector);

    replaceSubmitButtonWithLoadingSpinner('#create-author-submit');

    const id = $(createEmploymentContractModalSelector + ' input[name="id"]').val();

    const name = $(createEmploymentContractModalSelector + ' input[name="name"]').val();

    const isSelectThisEmploymentContractChecked = $('input[name="select_this_employment_contract_on_save"]').is(':checked');

    $.ajax({
        url: createEmploymentContractForm.attr('action'),
        type: "POST",
        data: createEmploymentContractForm.serialize(),
        cache: false,
        success: function (response) {

            const successMessage = Translator.trans('The employment contract has successfully created!');

            createEmploymentContractForm.data('isRequestRunning', false);

            if (response.status !== 'success') {

                $(createEmploymentContractModalSelector).html(response.html);

                return false;
            }

            replaceModalContentBySuccessMessage(createEmploymentContractModalSelector, successMessage);

            enableCloseModalWhenClickOutside(createEmploymentContractModalSelector);

            const checked = isSelectThisEmploymentContractChecked ? 'checked' : '';

            $('<br>' +
                '<label class="form-radio-label">' +
                '<input class="form-radio-input" type="radio" name="employment_contract_id" value="' + id + '" ' + checked + ' >' +
                '<span class="form-radio-sign">' + name + '</span>' +
                '</label>').insertAfter('#employmentContracts label:first');
        },
        error: function () {
            replaceModalContentByFailMessage(createEmploymentContractModalSelector, errorDetails);
            createEmploymentContractForm.data('isRequestRunning', false);
        },
        complete: function () {
            createEmploymentContractForm.data('isRequestRunning', false);
        }
    });
}
