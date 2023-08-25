function showModal(modalId, id) {
    $(document).ready(function() {

        if(id > 0){
            $.ajax({
                type: "GET",
                url: "http://26.155.119.91/school-bazaar/school-bazaar/get_order.php", 
                data: { id: id },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);

                    $("#cpf-edit").val(jsonResponse.cpf);
                    $("#value-edit").val(jsonResponse.value);
                    $(modalId).modal('show');
                    
                }
            });
        } else {
            $(modalId).modal('show');
        }

    });
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