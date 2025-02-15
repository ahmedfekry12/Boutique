$(document).ready(function () {
    $('.addInfo').submit(function(ev){
        ev.preventDefault();

        var formData = $(this).serialize();

        $.ajax({

            type:"POST",
            url:'functions/users/insertUser.php',
            data: formData,
            success: function(response){
                $('.userTable').append(response)
                $("#modal").modal("hide");
                $(".addInfo")[0].reset();
            }
        });
    });


    //delete users
    $(document).on('click' , '.deleteUser' , function(){
        var userId = $(this).data('id');
        var row = $(this).closest('tr');

        $.ajax({
            type: "POST",
            url: "functions/users/deleteUser.php",
            data: {id:userId},
            success: function(response){
                if (response.trim() === "success") {
                    row.remove();
                    $("#modal" + userId).modal("hide");
                    $('.modal-backdrop').remove();
                }
            }
        })
    })


    //edit users
    $('.editInfo').submit(function(ev){
        ev.preventDefault();
        // var modalData = $(this).serialize();

        var userId = $('#editUserId').val();
        var username = $('#editUsername').val();
        var password = $('#editPassword').val();
        var email = $('#editEmail').val();
        var address = $('#editAddress').val();
        var gender = $('input[name="gender"]:checked').val();
        var priv = $('#editPrivileges').val();
        

        $.ajax({
            type: "POST",
            url: "functions/users/updateUser.php",
            data: {
                id : userId,
                username : username,
                password : password,
                email : email,
                address : address,
                gender : gender,
                priv : priv
            },
            success: function(response){
                if (response.trim() === "success") {

                    var row = $('#userInfo_' + {userId});

                    row.find('td:nth-child(2)').text(username);
                    row.find('td:nth-child(3)').text(email);
                    row.find('td:nth-child(4)').text(address);
                    row.find('td:nth-child(5)').text(gender == 0 ? 'Male' : 'Female');
                    row.find('td:nth-child(6)').text($('#editPrivileges option:selected').text());

                    $('#editModal').modal('hide');
                }
            }
        })
    });

    $(document).on('click', '.editUser', function () {
        var userId = $(this).data('id');
        var username = $(this).data('username');
        var email = $(this).data('email');
        var address = $(this).data('address');
        var gender = $(this).data('gender');
        var priv = $(this).data('priv');

        // تعبئة النموذج بالبيانات
        $('#editUserId').val(userId);
        $('#editUsername').val(username);
        $('#editEmail').val(email);
        $('#editAddress').val(address);
        if (gender === 0) {
            $('#editGenderMale').prop('checked', true);
        } else {
            $('#editGenderFemale').prop('checked', true);
        }
        $('#editModal select[name="priv"]').val(priv);

        $('#editModal').modal('show');
    });
});