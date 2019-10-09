function format(value) {
    return value;
}

function datatable_init() {
    var table = $('.data-table').DataTable();
    
    $('.table-ajax').on('click', 'tr.details-control', function () {
        var tr = $(this);
        var row = table.row(tr);
        var tr_data = tr.data();

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('active');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: site_object.ajaxurl,
                data: {
                    action: 'ajax_format_tr',
                    data: {
                        post_id: tr_data.postId,
                        template: tr_data.template
                    },
                },

                success: function(result) {
                    row.child(format(result)).show();
                    row.child().addClass('tr-visible');
                    tr.addClass('active');
                }
            });
        }
    });
}