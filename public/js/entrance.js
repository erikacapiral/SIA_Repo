
$(document).ready(function () {

  
    $(".editedit").on('click', function () {

 

        $newtr = $(this).closest('tr');
        var data = $newtr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(data);

           $('#type_id').val(data[0]);
        $('#type').val(data[1]);
        $('#fee').val(data[2]);
      
      

    });


    $(".officialgender1").on('click', function(){
        $('.officialgender2').prop('checked', false);
        $('#gender1').val('male');

    });

    $(".officialgender2").on('click', function(){
        $('.officialgender1').prop('checked', false);
        $('#gender1').val('female');
    });



    $(".trashtrash").on('click', function () {



        $newtr = $(this).closest('tr');
        var data = $newtr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(data);


        $('#official_id').val(data[0]);

        $('#deleteModal').modal('show');


    });



    $("#confirm").on('click', function () {

        var gender = $('input[name="officialgender_edit"]:checked').val();

        $.ajax({
            url: "update_barangay_official.php",
            method: 'post',
            data: {

                official_id: $("#official_id").val(),
                fname: $("#firstname1").val(),
                mname: $("midname1").val(),
                lname: $("lastname1").val(),
                pos: $("#pos1").val(),
                contact: $("#contact1").val(),
                address: $("#address1").val(),
                gender: gender,
                start_term1: $("#starofterm1").val(),
                end_term1: $("#endofterm1").val(),



            },
            success: function (result) {

                console.log(result);
                Swal.fire(
                    'SUCCESS!',
                    'Saved Succesfully!',
                    'success'
                )



                setTimeout(function () {
                    location.reload();
                }, 1500);

            }



        });






    });


    $("#del").on('click', function () {


        $.ajax({
            url: "delete_barangay_official.php",
            method: 'post',
            data: {
                idno: $("#official_id").val(),

            },
            success: function (result) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Deleted Succesfully',
                    showConfirmButton: false,
                    timer: 1800
                })
                setTimeout(function () {
                    location.reload();
                }, 2000);

                $('#return').modal('hide');
            }
        });






    });


});




          