$(document).ready(function () {

    $('#create-office-of-learning-support-in-district-modal').on('show.bs.modal', function (event) {

        const urlToGetFormHtml = $(event.relatedTarget).data("office_of_learning_support_in_district_modal_url");

        const modalSelector = '#create-office-of-learning-support-in-district-modal';

        renderFormToHandleDataInModal(event, modalSelector, urlToGetFormHtml);
    });

});
