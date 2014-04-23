$(document).ready(function(){
    
      $('#submit').click(function() {
          $('#submit').fadeOut('slow', function() {
              $('#shell').addClass('load');
              $('#ins').fadeIn('fast');
              
              setTimeout(p, 3500);
          });
      });
      
      function p() {
        $('#shell').removeClass('load');
            $('#ins img').fadeOut('slow');
            $('#ins p').fadeOut('slow', function(){
            $('#shell').hide();
            $('#ins p').html('<img src="../img/magic-picture-prerendered.jpg" alt="Your picture" /><br/>To save your picture, right click the photo and choose Save Image As.');
            $('#ins p').fadeIn('slow');
            });           
      }

    });