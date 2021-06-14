$(document).ready(function(){
   $(document).on('click', '.confirm-action', function(e){
      e.preventDefault();
      if (confirm('Confirm that you want to delete: ' + $(this).data('name'))){
          location.href = $(this).attr('href');
      }
   });
});