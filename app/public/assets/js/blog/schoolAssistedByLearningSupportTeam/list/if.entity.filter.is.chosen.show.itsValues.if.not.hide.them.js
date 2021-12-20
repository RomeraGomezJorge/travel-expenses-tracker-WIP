function ifEntityFilterIsChosenShowItsValuesIfNotHideThem(filterFieldSelector) {

    if ($(filterFieldSelector).val() === 'learningSupportTeam') {
        enableInput(filterFieldSelector,'.filter-value-learning-support-team');
        disableInput(filterFieldSelector,'.filter-value-text');
        return false;
    }

    enableInput(filterFieldSelector,'.filter-value-text');
    disableInput(filterFieldSelector,'.filter-value-learning-support-team');

}

function enableInput(field, value) {
    const input = $(field).parent().parent().find(value);
    const index = $(field).data('index');
    const inputValueName = 'filters['+index+'][value]';
    input.attr('required',true);
    input.removeClass('d-none').attr('name',inputValueName );
}

function disableInput(field, value){
    const input = $(field).parent().parent().find(value);
    input.attr('required',false);
    input.removeAttr('name').addClass('d-none');
}
