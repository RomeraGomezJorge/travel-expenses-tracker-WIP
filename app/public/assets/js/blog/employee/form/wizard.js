$(document).ready(function () {

    var currentFieldSet, previous_fs;

    $("#goToJobInfo").on('click', function () {

        if (!validateGeneralInfo()) {
            return false;
        }

        $(window).scrollTop(0);

        goToNextStep("#goToJobInfo");
    });

    $("#goToDocuments").on('click', function () {

        if (!validateJobInfo()) {
            return false;
        }

        $(window).scrollTop(0);

        goToNextStep("#goToDocuments");
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

    $(nextFieldSet).find('input:visible:first').focus();
}


function validateGeneralInfo() {

    const validator = $("#form").validate();

    let areTheGeneralInfoFieldsValid = true;


    if (!validator.element("input[name='name']")) {
        areTheGeneralInfoFieldsValid = false;
    }

    if (!validator.element("input[name='surname']")) {
        areTheGeneralInfoFieldsValid = false;
    }


    if (!areTheGeneralInfoFieldsValid) {
        scrollToFirstErrorMessage();
    }

    return areTheGeneralInfoFieldsValid;
}


function validateJobInfo() {

    const validator = $("#form").validate();

    let areTheJobInfoFieldsValid = true;

    if (!validator.element("input[name='hire_date']")) {
        areTheJobInfoFieldsValid = false;
    }

    if (!validator.element("input[name='termination_date']")) {
        areTheJobInfoFieldsValid = false;
    }

    if (!validator.element("select[name='job_designation_id']")) {
        areTheJobInfoFieldsValid = false;
    }

    if (!validator.element("input[name='employment_contract_id']")) {
        areTheJobInfoFieldsValid = false;
    }

    if (!validator.element("input[name='shift_work']")) {
        areTheJobInfoFieldsValid = false;
    }

    if (!areTheJobInfoFieldsValid) {
        scrollToFirstErrorMessage();
    }

    return areTheJobInfoFieldsValid;
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