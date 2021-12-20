$(document).ready(function () {

    const createForm = $("form#create-school-assisted-by-learning-support-team-form");

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

            submitsSchoolAssistedByLearningSupportTeamFormViaAjaxWhenIsValid(createForm);
        }
    });

});

function submitsSchoolAssistedByLearningSupportTeamFormViaAjaxWhenIsValid(createForm) {

    const cssModuleNameId = 'school-assisted-by-learning-support-team';

    const inputModuleName = 'school_assisted_by_learning_support_team';

    const successMessage = 'School has successfully created!';

    const errorDetails = Translator.trans('Failed to create new item, if the problem continues, please contact support.');

    const modalSelector = '#create-'+cssModuleNameId+'-modal';

    if (createForm.data('isRequestRunning')) {
        return;
    }

    hideElementsCanCloseModal(
        '#close-create-'+cssModuleNameId+'-modal-on-click-button-cancel',
        '#close-create-'+cssModuleNameId+'-on-click-top-cross'
    );

    createForm.data('isRequestRunning', true);

    disableCloseModalWhenClickOutside(modalSelector);

    replaceSubmitButtonWithLoadingSpinner('#create-'+cssModuleNameId+'-submit');

    const id = $(modalSelector + ' input[name="id"]').val();

    const name = $(modalSelector + ' input[name="name"]').val();
    
    const number = $(modalSelector + ' input[name="number"]').val();

    const isSelectThisValueChecked = $('input[name="select_this_'+inputModuleName+'_on_save"]').is(':checked');

    $.ajax({
        url: createForm.attr('action'),
        type: "POST",
        data: createForm.serialize(),
        cache: false,
        success: function (response) {

            createForm.data('isRequestRunning', false);

            if (response.status !== 'success') {

                $(modalSelector).html(response.html);

                return false;
            }

            replaceModalContentBySuccessMessage(modalSelector, successMessage);

            enableCloseModalWhenClickOutside(modalSelector);

            const checked = isSelectThisValueChecked ? 'checked' : '';

            var data = {
                id: id,
                text:  name +' '+number
            };

            var newOption = new Option(data.text, data.id, checked, checked);
            $('#ajax').append(newOption).trigger('change');

        },
        error: function () {
            replaceModalContentByFailMessage(modalSelector, errorDetails);
            createForm.data('isRequestRunning', false);
        },
        complete: function () {
            createForm.data('isRequestRunning', false);
        }
    });
}
