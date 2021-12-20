$(document).ready(function () {

    const resetPasswordForm = $("form#reset-password-form");

    resetPasswordForm.validate({
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

            submitsFormViaAjaxWhenIsValid(resetPasswordForm);
        }
    });

});

function submitsFormViaAjaxWhenIsValid(resetPasswordForm) {

    const resetPasswordModalSelector = '#reset-password-modal';

    if (resetPasswordForm.data('isRequestRunning')) {
        return;
    }

    hideElementsCanCloseModal(
        '#close-reset-password-modal-on-click-button-cancel',
        '#close-reset-password-modal-on-click-top-cross'
    );

    resetPasswordForm.data('isRequestRunning', true);

    disableCloseModalWhenClickOutside(resetPasswordModalSelector);

    replaceSubmitButtonWithLoadingSpinner('#reset-password-submit');

    const id = $(resetPasswordModalSelector + ' input[name="id"]').val();

    const password = $(resetPasswordModalSelector + ' input[name="password"]').val();

    $.ajax({
        url: resetPasswordForm.attr('action'),
        type: "POST",
        data: resetPasswordForm.serialize(),
        cache: false,
        success: function (response) {

            const errorDetails = Translator.trans('Password reset process failed if the problem continues, please contact support.');

            const successMessage = Translator.trans('Password changed!');

            resetPasswordForm.data('isRequestRunning', false);

            if (response.status !== 'success') {

                replaceModalContentByFailMessage(resetPasswordModalSelector, errorDetails);

                return false;
            }

            replaceModalContentBySuccessMessage(resetPasswordModalSelector, successMessage);

            enableCloseModalWhenClickOutside(resetPasswordModalSelector);

        },
        error: function () {
            const errorDetails = Translator.trans('Password reset process failed if the problem continues, please contact support.')
            replaceModalContentByFailMessage(resetPasswordModalSelector, errorDetails);
            resetPasswordForm.data('isRequestRunning', false);
        },
        complete: function () {
            resetPasswordForm.data('isRequestRunning', false);
        }
    });
}
