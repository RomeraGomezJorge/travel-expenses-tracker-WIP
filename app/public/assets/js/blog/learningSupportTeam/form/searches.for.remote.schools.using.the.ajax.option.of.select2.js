$(document).ready(function () {
    const url = $("#ajax").data('url_to_search_school_assisted_by_learning_support_team');
    $("#ajax").select2({
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
                        item.name =  item.name ??'';
                        item.number =  item.number ??'';
                        return {
                            text: item.name+' '+item.number,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        },
        language: "es",
        theme: 'bootstrap4',
        placeholder: Translator.trans('Search for schools'),
        minimumInputLength: 2,
    });

})