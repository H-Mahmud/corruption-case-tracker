jQuery(document).ready(function ($) {
    $("body").on("click", "#insertCsv", function (e) {
        e.preventDefault();

        var button = $(this);

        var customUploader = wp.media({
            title: "Insert CSV",
            library: { type: "text/csv" },
            button: {
                text: "Use This CSV",
            },
            multiple: false,
        })
            .on("select", function () {
                var attachment = customUploader.state().get("selection").first().toJSON();

                $(button)
                    .removeClass("button")
                    .html('<span class="dashicons dashicons-media-document"></span>')
                    .next().val(attachment.id)
                    .next().show();

                fetchCSVDataMapper(attachment.id);
            })
            .open();
    });

    // Remove CSV file
    $("body").on("click", ".remove-csv", function () {
        $(this).hide().prev().val("").prev().addClass("button").html("Upload CSV");
        return false;
    });

    /**
     * Read CSV Header
     */
    function fetchCSVDataMapper(csvId) {
        $('.import-spinner').addClass('is-active');
        $.ajax({
            type: "POST",
            url: CCT.ajaxUrl,
            data: {
                action: "fetch_csv_mapper",
                nonce: CCT.nonce,
                csvId: csvId,
            },
        }).done(function (response) {
            $('.form-table').html(response);
            $('.import-spinner').removeClass('is-active');

        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert('Something went wrong!')
            $('.import-spinner').removeClass('is-active');

        });
    }


    $("#importData").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        $('.import-spinner').addClass('is-active');
        $.ajax({
            type: "POST",
            url: CCT.ajaxUrl,
            data: {
                action: "import_csv_data",
                nonce: CCT.nonce,
                form_data: form.serialize()
            },
            success: function (data) {
                $('#importData .form-table').hide();
                $("#success-message").html(data.data);
                $('.import-spinner').removeClass('is-active');
            },
            error: function (data) {
                $("#error-message").html(data.responseJSON.data);
                $('.import-spinner').removeClass('is-active');
            }
        });

    });
});
