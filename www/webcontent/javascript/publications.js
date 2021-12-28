var msg;

function validate_submitPublicationForm(formname){
	msg = "";
   	res1 = validate_topic();
   	res2 = validate_title();
   	if(res1 && res2)
   	{
   		jQuery('#alert_msg').empty().slideUp();
   		submitPublicationForm(formname);
   	}
   	else
   	{
   		show_error(msg);
   		return false;
   	}
}

function validate_title(){
	if(jQuery('#topic option:selected').val() == '')
   	{
   		msg +=  '<div>Error: Παρακαλούμε επιλέξτε Topic.';
   		return false;
   	}
   	else{
   		return true;
   	}
}

function validate_topic(){
	$title = jQuery('#title').not(".hidden");
	$booktitle = jQuery('#booktitle').not(".hidden");
	var res = true;
	if ($title.length > 0)
	{
		if($title.val().trim() == '')
		{
			res = false;
		}
	}
	if ($booktitle.length > 0)
	{
		if($booktitle.val().trim() == '')
		{
			res = false;
		}
	}
	if (!res)
   	{
   		msg +=  '<div>Error: Παρακαλούμε εισάγετε Τίτλο.</div>';
   		return false;
   	}
   	else
   	{
   		return true;
   	}
}

jQuery(document).ready(function(){


	jQuery("#topic").change(function(){
		var topic_id = jQuery(this).val();
		jQuery("#same_with option").each(function(){
			if(jQuery(this).attr('data-topic-id') == topic_id)
			{
				jQuery(this).removeClass("hidden");
			}
			else
			{
				jQuery(this).addClass("hidden");
			}
		});
		jQuery("#same_with option#default_none").removeClass("hidden");
	});

	jQuery("#topic").trigger("change");


	jQuery("#same_with").click(function(){
		if (jQuery("#topic option:selected").val().length < 1)
		{
			jQuery("#no_topic_selected").slideDown();
		}
		else
		{
			jQuery("#no_topic_selected").slideUp();
		}
	});
	jQuery("#same_with").blur(function(){
		jQuery("#no_topic_selected").slideUp('slow');
	});

});

function show_error(msg)
{
	jQuery('#alert_msg').html(msg).slideDown();
	jQuery('html').animate({
         scrollTop: jQuery("#alert_msg").offset().top -10
  }, 1000);
}


function submitPublicationForm(formname)
{
  $('pubform_authors').value=getAuthors();
  $('pubform_editors').value=getEditors();
  $(formname).submit();
}

function submitPublicationConfirmForm(text)
{
  //document.publicationform.upd_crossref.value=text
  //document.publicationform.submit();
}

function getAuthors() 
{
  var strValues = "";
  var boxLength = $('selectedauthors').length;
  var count = 0;
  if (boxLength != 0) {
    for (i = 0; i < boxLength; i++) {
      if (count == 0) {
        strValues = $('selectedauthors').options[i].value;
      }
      else {
        strValues = strValues + "," + $('selectedauthors').options[i].value;
      }
      count++;
     }
  }
  return strValues;
}

function getEditors() {
  var strValues = "";
  var boxLength = $('selectededitors').length;
  var count = 0;
  if (boxLength != 0) {
    for (i = 0; i < boxLength; i++) {
      if (count == 0) {
        strValues = $('selectededitors').options[i].value;
      }
      else {
        strValues = strValues + "," + $('selectededitors').options[i].value;
      }
      count++;
     }
  }
  return strValues;
}

function addAuthor(text,value)
{
  //document.publicationform.authorsbox.options[document.publicationform.authorsbox.length] = new Option(text,value,false,false);
}

function addEditor(text,value)
{
  //document.publicationform.editorsbox.options[document.publicationform.editorsbox.length] = new Option(text,value,false,false);
}

function clearAuthors()
{
  //for (var i=(document.publicationform.authorsbox.length-1);i>=0;i--)
  {
    //document.publicationform.authorsbox.options[i] = null;
  }
}

function clearEditors()
{
  //for (var i=(document.publicationform.editorsbox.length-1);i>=0;i--)
  {
    //document.publicationform.editorsbox.options[i] = null;
  }
}
