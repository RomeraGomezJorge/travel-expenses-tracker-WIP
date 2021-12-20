$(document).ready(function () {

    $('#create-school-assisted-by-learning-support-team-modal').on('show.bs.modal', function (event) {

        const urlToGetFormHtml = $(event.relatedTarget).data("school_assisted_by_learning_support_team_modal_url");

        const modalSelector = '#create-school-assisted-by-learning-support-team-modal';

        renderFormToHandleDataInModal(event, modalSelector, urlToGetFormHtml);
    });

});
