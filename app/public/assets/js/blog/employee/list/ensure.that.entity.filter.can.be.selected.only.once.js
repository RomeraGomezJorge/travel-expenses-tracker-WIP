function ensureThatEntityFilterCanBeSelectedOnlyOnce() {
    $("select.filter-field option[value=employmentContract]").show();
    $("select.filter-field option[value=jobDesignation]").show();
    $("select.filter-field option[value=learningSupportTeam]").show();

    $('select.filter-field').each(function (index) {

        if ($(this).val() == 'jobDesignation') {
            $("select.filter-field option[value=jobDesignation]").hide();
        }

        if ($(this).val() == 'employmentContract') {
            $("select.filter-field option[value=employmentContract]").hide();
        }

        if ($(this).val() == 'learningSupportTeam') {
            $("select.filter-field option[value=learningSupportTeam]").hide();
        }
    });
}