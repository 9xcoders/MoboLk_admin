$(document).ready(function () {
    $('#autocomplete').autocomplete({
        minChars: 2,
        source: function (request, response) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/product/search',
                data: 'term=' + request.term,
                success: function (data) {
                    response($.map(data, function (item) {

                        if (item.is_version) {
                            return {
                                label: item.name + ' ' + item.featureNames,
                                value: item.id,
                                is_version: true
                            };
                        } else {
                            return {
                                label: item.name,
                                value: item.id,
                                is_version: false
                            };
                        }


                    }));
                }
            });
        },
        select: function (event, ui) {
            event.preventDefault();
            $("#product_id").val(ui.item.value);
            $("#is_version").val(ui.item.is_version);
        },
        focus: function (event, ui) {
            event.preventDefault();
            $("#autocomplete").val(ui.item.label);
            $("#is_version").val(ui.item.is_version);
        }
    });

});
