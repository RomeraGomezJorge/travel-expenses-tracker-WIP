$(document).ready(function () {
    appendRuleRequiredAuthor();

    appendRuleRequiredState();
});

function appendRuleRequiredAuthor() {
    $('input[name="employment_contract_id"]').rules("add", {required: true});
}

function appendRuleRequiredState() {
    $('input[name="shift_work"]').rules("add", {required: true});
}
