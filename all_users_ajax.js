
$(function(){
  $('#delete_button').click(function(){
    if (confirm("Are you sure you want to delete from the database?")) {
      var user_id= [];
      $(':checkbox:checked').each(function(i) {
        user_id[i]= $(this).val();
      });
      if (user_id.length===0) {
        alert("Please select a checkbox");
      } else {
        $.ajax({
          url:"delete_user_ajax.php",
          method: "POST",
          data: {user_id:user_id},
          success: function() {
            for(var i=0; i<user_id.length; i++) {
              $('tr#'+user_id[i]+'').css('background-color', 'red');
              $('tr#'+user_id[i]+'').fadeOut('slow');
            }
          }
        });
      }
    }
  });
});
