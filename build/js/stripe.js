$(function() {
  var $form = $('#payment-form');
  $form.submit(function(event) {
    // Disable the submit button to prevent repeated clicks:
    $form.find('.submit').prop('disabled', true);

    // Request a token from Stripe:
    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from being submitted:
    return false;
  });
});

function stripeResponseHandler(status, response) {
  // Grab the form:
  var $form = $('#payment-form');

  if (response.error) { // Problem!

    // Show the errors on the form:
    $('.payment-errors').show();
    $('.payment-errors').html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Error </strong>" + response.error.message + "</div>");
    $(window).scrollTop($('.payment-errors').offset().top);
    $form.find('.submit').prop('disabled', false); // Re-enable submission

  } else { // Token was created!

    // Get the token ID:
    var token = response.id;

    // Insert the token ID into the form so it gets submitted to the server:
    $form.append($('<input type="hidden" name="stripeToken">').val(token));

    // Submit the form:
    $form.get(0).submit();
  }
};

$('#loadData').click(function(){
$('#loadData').hide();
$('#loading').show();

$.ajax({
    url: "./inc/ajax/subscribe.php",
    type:'POST',
    data: {'act' : 'data'},
    dataType: "JSON",
    success: function(json){
        //here inside json variable you've the json returned by your PHP
        $('#addr1').val(json.addr1);
        $('#addr2').val(json.addr2);
        $('#addr3').val(json.addr3);
        $('#town').val(json.town);
        $('#county').val(json.county);
        $('#postcode').val(json.postcode);

    }
});
  $('#loading').hide();

});

    $('#cardexp_month').focusout(function(){
      var num = $('#month').val();
      if(num < 10 && num > 0)
      {
        if(num.length < 2)
        {
        $('#month').val('0' + num);
        }
      }
    });
    $('#year').focusout(function(){
      var num = $('#year').val();
      if(num <2016 && num > 15)
      {
        $('#year').val('20' + num);
      }
    });

    $('#CardNumber').on('keypress change', function () {
  $(this).val(function (index, value) {
    return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
  });
});


