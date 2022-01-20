$(document).ready(function () {

    $("#form").validate({

        onfocusout: function (element) {
            if (element.tagName === "TEXTAREA" || (element.tagName === "INPUT" && element.type !== "password" && element.type !== "file")) {
                element.value = $.trim(element.value).toString();
            }

            /* remove symfony form error */
            $(element).parent().find('.invalid-feedback.d-block').remove();

            $(element).valid()

        },
        onkeyup: false,
        submitHandler: function (form) {
            /*when an valid form is submitted. Disabled submit button and set the loading icon*/
            $("#submitBtn i").removeClass('fas fa-save');
            $("#submitBtn i").addClass('fas fa-sync-alt fa-spin fa-3x fa-fw');
            $("#submitBtn ").attr("disabled", true);
            form.submit();
        },
        invalidHandler: function () {
            /*when an invalid form is submitted. Enabled submit button and set the default icon*/
            $("#submitBtn i").removeClass('fas fa-sync-alt fa-spin fa-3x fa-fw');
            $("#submitBtn i").addClass(' fas fa-save');
            $("#submitBtn ").attr("disabled", false);

        },
        highlight: function (element) {

            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            $(element).closest('.form-group, .form-check').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {

            if ($(element).hasClass('select2-hidden-accessible')){
                /* in case select2 is used  */
                error.insertAfter($(element).parent().find('span.select2'));

            }else if($(element).is(':radio')){
                error.insertAfter($(element).closest('.form-group > :last-child'));
            }else{
                error.insertAfter(element);
            }
        }
    });


});