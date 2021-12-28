jQuery(document).ready(function(){
 var hash = window.location.hash;
 if (hash.length > 0)
 {
 		jQuery(hash).parents('table').css('background-color', '#ffffcc');

 }

});