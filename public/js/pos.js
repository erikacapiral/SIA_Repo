
$(document).ready(function () {

    $('#total').hide();
    var sum = 0;

    $("#compute").on('click', function () {

 
        var adult = parseInt($('#adult').val());
        var children = parseInt($('#child').val());
        var additional = 0;

        var adultfee = adult * 100;
        var childrenfee = children * 50;

        additional =  parseInt($('#add').val());
      
        var selectedValues = [];
    
    $('input[type="checkbox"][name="cottage[]"]:checked').each(function() {
      selectedValues.push($(this).val());
    });
        
       
    
        var selectedPrices = [];

    $('input[type="checkbox"][name="cottage[]"]:checked').each(function() {
      var price = parseFloat($(this).data('price'));
      selectedPrices.push(price);
        
       
    });
        
         sum = selectedPrices.reduce(function(total, price) {
      return total + price;
        }, 0);


      if (additional === 0) {
        sum = sum + adultfee + childrenfee; 
      } else {
        sum = sum + adultfee + childrenfee + additional; 
      }
        
      sum = sum.toFixed(2);

        $('#total').text(sum);
      $('#total').show();
      
      


    });


      $('#tendered').on('input', function() {
          var newText = parseInt($(this).val());

        var change = newText - sum;
        change =  change.toFixed(2);

        $('#change').val(change);
        
         $('#totalvalue').val(sum);

   
  });

   





    


});




          