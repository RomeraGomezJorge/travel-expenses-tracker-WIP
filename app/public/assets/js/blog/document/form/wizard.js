$(document).ready(function () {

    var currentFieldSet, previous_fs;

    $("#goToEmployeesInTheDocument").on('click', function () {

        if (!validateGeneralInfo()) {
            return false;
        }

        $(window).scrollTop(0);

        goToNextStep("#goToEmployeesInTheDocument");
    });

    $("#goToUploadAttachments").on('click', function () {

        if (!validateEmployeesInTheDocument()) {
            return false;
        }

        $(window).scrollTop(0);

        goToNextStep("#goToUploadAttachments");
    });


    $(".prev").click(function () {
        $(window).scrollTop(0);
        currentFieldSet = $(this).parent('fieldset');
        previous_fs = $(this).parent('fieldset').prev();
        $(currentFieldSet).removeClass("show");
        $(previous_fs).addClass("show");

    });
});

function goToNextStep(selector) {

    const currentFieldSet = $(selector).parent('fieldset');

    const nextFieldSet = $(selector).parent('fieldset').next();

    $(currentFieldSet).removeClass("show");

    $(nextFieldSet).addClass("show");

}


function validateGeneralInfo() {

    const validator = $("#form").validate();

    let areTheGeneralInfoFieldsValid = true;


    if (!validator.element("input[name='name']")) {
        areTheGeneralInfoFieldsValid = false;
    }

    if (!validator.element("input[name='document_category_id']")) {
        areTheGeneralInfoFieldsValid = false;
    }


    if (!areTheGeneralInfoFieldsValid) {
        scrollToFirstErrorMessage();
    }

    return areTheGeneralInfoFieldsValid;
}


function validateEmployeesInTheDocument() {
    
    const validator = $("#form").validate();

    let areTheEmployeesInTheDocumentValid = true;

    if (!validator.element("[name='employees[]']")) {
        areTheEmployeesInTheDocumentValid = false;
    }

    if (!areTheEmployeesInTheDocumentValid) {
        scrollToFirstErrorMessage();
    }

    return areTheEmployeesInTheDocumentValid;
}


function scrollToFirstErrorMessage() {

    $('.error').each(function () {

        const error = this;

        if ($(error).html().length <= 1) {
            return true;
        }

        $('html, body').animate({
            scrollTop: ($(error).offset().top - 300)
        }, 500);

        return false

    });

}