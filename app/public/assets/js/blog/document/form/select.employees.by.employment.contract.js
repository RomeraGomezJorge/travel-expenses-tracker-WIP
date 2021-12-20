$(document).ready(function () {

    $("[name='employees[]']").select2({closeOnSelect: false,placeholder: '- '+ Translator.trans('Optional')+ ' -'});

    $('.select-employee-by-employment-contract').click(function () {

        const employment_contract_name = $(this).data('employment_contract_name');

        const optgroup = $("[name='employees[]']").find("optgroup[label='" + employment_contract_name + "']");

        if (!optgroup.length > 0) {
            return;
        }

        let employees = [];

        optgroup.find('option').each(function () {
            employees.push($(this).val());
        });

        const previous_values = $("[name='employees[]']").val();

        previous_values.forEach(function (item) {
            employees.push(item);
        });

        employees.push(previous_values);

        $("[name='employees[]']").val(employees).change();

    });
});
