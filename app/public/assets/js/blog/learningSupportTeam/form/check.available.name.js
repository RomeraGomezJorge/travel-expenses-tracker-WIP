$(document).ready(function () {

    const inputSelector = $('input[name="name"]');

    /* disablingEnteKeyForForm() FIX: prevent an exception, because if is enabled can submit the data without validate is a name is  already in use */
    changeTheDefaultBehaviorOfTheEnterKey();

    inputSelector.on('focusout', function () {
        addUniqueNameRule(inputSelector);
    });

});


function addUniqueNameRule(inputSelector) {

    const url_action = inputSelector.data('available_name_url');

    const name_from_database = inputSelector.data('name_from_database');

    if (name_from_database === inputSelector.val().trim()) {
        inputSelector.rules("remove", "remote");
        return;
    }

    inputSelector.rules("add", {
        messages: {remote: Translator.trans("The name you entered already exists.")},
        remote: {
            async: false,
            url: url_action,
            type: "GET",
            data: {
                'name': function () {
                    return inputSelector.val().trim();
                }
            },
            dataType: 'json',
            complete: function (data) {
                const isAvailable = data.responseText;

                if (isAvailable !== 'true') {
                    inputSelector.closest('.form-group').removeClass('has-success').addClass('has-error');
                    return;
                }

                inputSelector.closest('.form-group').removeClass('has-error').addClass('has-success');


            }, error: function () {
                alert('error');
            }
        }

    });
}



