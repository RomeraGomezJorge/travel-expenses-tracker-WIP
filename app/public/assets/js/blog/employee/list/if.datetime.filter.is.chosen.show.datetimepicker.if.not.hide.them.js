function ifDatetimeFilterIsChosenShowDatetimepickerIfNotHideThem(field) {

    const operator = $(field).parent().parent().find('.filter-operator');

    const value = $(field).parent().parent().find('.filter-value-text');

    const datetimeFilters = ["hireDate", "terminationDate", "birthday"];

    const entityFilters = ["jobDesignation", "employmentContract", "learningSupportTeam"];

    if (!datetimeFilters.includes($(field).val()) && !entityFilters.includes($(field).val())) {
        showOperatorToSearchText(operator);
        value.inputmask("remove");
    }


    if (datetimeFilters.includes($(field).val()) ) {
        showOperatorToSearchDates(operator);

        value.inputmask("datetime", {
            "placeholder": "dd-mm-yyyy",
            "inputFormat": "dd-mm-yyyy",
            "hourFormat": "24",
        });
    }

}


function showOperatorToSearchText(operator) {
    operator.val('=');
    operator.children('option').show();
    operator.children('option[value="<"],option[value=">"]').hide();
}


function showOperatorToSearchDates(operator) {
    operator.val('>');
    operator.children('option').show();
    operator.children('option[value="CONTAINS"],option[value="<>"]').hide();
}