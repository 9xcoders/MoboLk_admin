$(document).ready(function () {

    $("#btn-add-image").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click","#btn-remove-image",function(){
        $(this).parents(".control-group").remove();
    });

    let categoryId = $('#category_id').children("option:selected").val();
    if (categoryId) {
        $('#brand_id').attr('disabled', false);
    }

    $(document).on('change', '#category_id', function () {
        let categoryId = $(this).children("option:selected").val();

        if (categoryId) {
            $.ajax({
                type: 'GET',
                url: '/brand/by-category?categoryId=' + categoryId,
                success: function (response) {
                    $('#brand_id').attr('disabled', false);
                    $('#brand_id').empty();
                    let options = '<option value="">--Select a brand--</option>';
                    response.forEach(option => {
                        options += '<option value="' + option.id + '">' + option.name + '</option>';
                    })
                    $('#brand_id').append(options);
                }

            });
        } else {
            $('#brand_id').attr('disabled', true);
        }


    })


})
