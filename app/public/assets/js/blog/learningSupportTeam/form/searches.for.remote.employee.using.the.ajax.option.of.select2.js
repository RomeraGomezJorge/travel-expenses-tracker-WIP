$(document).ready(function () {
    const url = $("#manager_ajax").data('url_to_search_manager');
    $("#manager_ajax").select2({
        ajax: {
            url: url,
            dataType: 'json',
            multiple: true,
            delay: 500,
            data: function (params) {
                return {
                    fullname: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        item.identity_card = item.number ??'N/A';
                        return {
                            text: item.surname+' '+item.name+' '+item.identity_card,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        },
        language: "es",
        theme: 'bootstrap4',
        placeholder: Translator.trans('Search for an employee'),
        minimumInputLength: 2,
    });

})