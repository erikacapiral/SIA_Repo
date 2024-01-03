
$(document).ready(function () {

  
    $(".edit_category").on('click', function () {

        
         $("#editModal").modal('show');

        $newtr = $(this).closest('tr');
        var data = $newtr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(data);

        $('#category_id').val(data[0]);
         $('#editModal').val(data[1]);

    
    
    });


   


});




          