function blockUser(hyperlink)  {
    $('#form')[0].reset(); // Reset form on modals.

    // AJAX load data form ajax
    $.ajax({
        url      : hyperlink,
        type     : 'GET',
        dataType : 'JSON',
        success  : function(data) {
            $('[name="userId"]').val(data.id);
            $('[name="name"]').val(data.name);

            // Trigger modal.
            $('#block_user').modal('show'); // Show bootstrap modal when complete loaded.
        },
        error    : function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}