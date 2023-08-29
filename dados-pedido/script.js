function showModal(modalId, id) {
    $(document).ready(function() {

        if(id > 0){
            $.ajax({
                type: "GET",
                url: "http://localhost/school-bazaar/school-bazaar/order/get_order.php", 
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

function refresh(){
    window.location.reload("index.php");
}