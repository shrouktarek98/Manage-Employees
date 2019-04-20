$(document).ready(function() {

    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    });
    checkbox.click(function() {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
    $("#kk").click(function() {
        console.log("ll");
    });

});
// $(".edit").click(function() {
//     var x = $(this).attr('value');
//     console.log(x);
//     $('#formedit').attr('action', "/update/" + x + "");
// });
// $(".delete").click(function() {
//     var x = $(this).attr('value');
//     console.log(x);
//     $('#formdelete').attr('action', "/delete/" + x + "");
// });






function editfun(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('mate[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/update/" + id,
        type: "get",
        dataType: 'json',
        success: function(data) {
            $('#edit_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_email').val(data.email);
            $('#edit_Address').val(data.address);
            $('#edit_Phone').val(data.phone);
        }

    });
}

function deletefun(id) {
    $('#delete_id').val(id);
}


function show(errors) {
    if (errors == 1) {
        $('#add').click();
    }

}