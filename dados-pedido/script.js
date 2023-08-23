function showModal(modalId, id) {
    $(modalId).modal('show');

    if(id > 0){
        $.ajax({
            TYPE: "GET",
            URL: "get_order.php",
            DATA: {id : id},
            contentType: "application/json: charset=utf-8",
            dataType: "json",
            success: {
                
            }
        })
    }
}

function showModalInformation(title, message){
    $(document).ready(function() {
        $('#title-modal').text(title);
        $('#text-modal').text(message);

        $('#modal-information').modal('show');
        setTimeout(function() {
            $('#modal-information').modal('hide');
        }, 3000);
    });
}