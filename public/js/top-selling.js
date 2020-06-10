$(document).ready(function () {
    $('#autocomplete').autocomplete({
        // minChars: 1,
        source: function (request, response) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/product/search',
                data: 'term=' + request.term,
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item.name,
                            value: item.id
                        };
                    }));
                }
            });
        },
        select: function (event, ui) {
            $("#autocomplete").val(ui.item.label);
            $("#product_id").val(ui.item.value);
        }
    });

});
