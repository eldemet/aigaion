<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
//required parameters:
//$publications[] - array with publication objects
//
//optional parameters
//$order - Element for sub header content, defaults to 'year'
//$noBookmarkList - bool, show no bookmarking icons
//$noNotes - bool, show no notes
//

$customfieldkeys = $this->customfields_db->getCustomFieldKeys('publication');

$customfieldkeys    = $this->customfields_db->getCustomFieldKeys('publication');
/*
print_r($customfields) ;
echo "<br>----";
print_r($customfieldkeys) ;	
*/
foreach ($publications as $publication)
{
 	//Get similar_pub_id
	$customfields = $publication->getCustomFields();
	$publication->similar_pub_id = '';

	if(!empty($customfields))
	{
		foreach ($customfieldkeys as $field_id => $field_name) 
		{
/* 			print_r($customfields[$field_id]); */
			if ($field_name === 'similar_pub_id' && isset($customfields[$field_id])) 
			{
				$publication->similar_pub_id = $customfields[$field_id]['value'];

	/* 			print_r($field_id); */
	/* 			echo $publication->pub_id . ': ' . $customfields[$field_id]['value'] . "<br>"; */
			}
			if ($field_name === 'language' && isset($customfields[$field_id])) 
			{
				$publication->language = $customfields[$field_id]['value'];
			}
		}

	}
	if(!isset($publication->language))
	{
		$publication->language = 'greek';
	}
}  

//first we get all necessary values required for displaying
  $userlogin  = getUserLogin();

  //Switch off the bookmarklist buttons by passing the parameter $noBookmarkList=True to this view, else default from rights
  if (isset($noBookmarkList) && ($noBookmarkList == true))
    $useBookmarkList = false;
  else
    $useBookmarkList = $userlogin->hasRights('bookmarklist');
    
  //note that when 'order' is set, this view supposes that the data is actually ordered in that way!
  //use 'none' or other nonexisting fieldname for no headers.
  if (!isset($order))
    $order = 'year';
  
  if (!isset($pubCount) || ($pubCount==0))
    $pubCount = sizeof($publications);
    
  //retrieve the publication summary and list stype preferences (author first or title first etc)
  $summarystyle = $userlogin->getPreference('summarystyle');  
  $liststyle    = $userlogin->getPreference('liststyle');

  
  //this block of code is used to generate the multi-page-links. See the publications/showlist controller for how to use this - and make sure you set all parameters used there!
  $multipagelinks='';
  if (isset($multipage) && ($multipage == True))
  {
    $page = 0;
    $liststyle = $userlogin->getPreference('liststyle');
    if ($liststyle > 0) 
    {
      if (($pubCount > 0) && ($pubCount > $liststyle))
      {
        $multipagelinks.= '<div class="aligncenter">';
        while ($page*$liststyle < $pubCount) 
        {
          $multipagelinks.= ' | ';
          $linktext = ($page*$liststyle+1).'-';
          if (($page+1)*$liststyle > $pubCount) {
              $linktext .= $pubCount;
          } else {
              $linktext .= (($page+1)*$liststyle);
          }
          if ($page!=$currentpage) {
              $multipagelinks.= anchor($multipageprefix.$page,$linktext);
          } else {
              $multipagelinks.= '<b>'.$linktext.'</b>';
          }
          $page++;
        }
        $multipagelinks.= " |</div>\n<br/>\n";
      }
    }
  }
  
  //here the output starts
  echo "<div class='publication_list'>\n";
  if (isset($header) && ($header != '')) {
    echo "  <div class='header'>".$header."</div>\n";
  }
  echo $multipagelinks;
  
  $b_even = true;
  $subheader = '';
  $subsubheader = '';
  //$pubno = 0;
  foreach ($publications as $publication)
  {
    //$pubno++;
    //if (isset($multipage) && ($multipage == True)) {
    //    if (($currentpage*$liststyle > $pubno) || (($currentpage+1)*$liststyle < $pubno))
    //        continue;
    //}
if ($publication!=null) 
{    	

   // DE 11.9.2011
  	//check if (order is by author) and this publication is secondary
   $thiss_pub_id = trim($publication->similar_pub_id);
   if($order === 'author' && !empty($thiss_pub_id) && $publication->similar_pub_id !== $publication->pub_id)
   {
   		continue;
   } 
      $b_even = !$b_even;
    if ($b_even)
      $even = 'even';
    else
      $even = 'odd';
   
    //check whether we should display a new header/subheader, depending on the $order parameter
    switch ($order) {
      case 'year':
        $newsubheader = $publication->actualyear;
        if ($newsubheader!=$subheader) {
          $subheader = $newsubheader;
          echo '<div class="header">'.$subheader.'</div>';
        }
        break;
      case 'title':
        $newsubheader = "";
        if (strlen($publication->cleantitle)>0)
            $newsubheader = $publication->cleantitle[0];
        if ($newsubheader!=$subheader) {
          $subheader = $newsubheader;
          //echo '<div><br/></div><div class="header">'.strtoupper($subheader).'</div><div><br/></div>';
          echo '<div></div><div class="header">'.strtoupper($subheader).'</div><div></div>';
        }
        break;
      case 'author':
        $newsubheader = "";
        if (strlen($publication->cleanauthor)>0)
            $newsubheader = $publication->cleanauthor[0];
        if ($newsubheader!=$subheader) {
          $subheader = $newsubheader;
          //echo '<div><br/></div><div class="header">'.strtoupper($subheader).'</div><div><br/></div>';
          echo '<div></div><div class="header">'.strtoupper($subheader).'</div><div></div>';
        }
        break;
      case 'type':
        $newsubheader = $publication->pub_type;
        if ($newsubheader=='Inbook'){$newsubheader='Chapter';} //added by DE
        if ($newsubheader!=$subheader) {
          $subheader = $newsubheader;
          if ($publication->pub_type!='Article')
            //echo '<div><br/></div><div class="header">'.sprintf(__('Publications of type %s'),$subheader).'</div><div><br/></div>';
            echo '<div></div><div class="header">'.sprintf(__('Publications of type %s'),$subheader).'</div><div></div>';
        }
        if ($publication->pub_type=='Article') {
            $newsubsubheader = $publication->cleanjournal;
            if ($newsubsubheader!=$subsubheader) {
              $subsubheader = $newsubsubheader;
              //echo '<div><br/></div><div class="header">'.$publication->journal.'</div><div><br/></div>';
              echo '<div></div><div class="header">'.$publication->journal.'</div><div></div>';
            }
        } else {
            $newsubsubheader = $publication->actualyear;
            if ($newsubsubheader!=$subsubheader) {
              $subsubheader = $newsubsubheader;
              //echo '<div><br/></div><div class="header">'.$subsubheader.'</div><div><br/></div>';
              echo '<div></div><div class="header">'.$subsubheader.'</div><div></div>';
            }
        }
        break;
      case 'recent':
        break;
      default:
        break;
    }
    
  	// this function is in helpers/publication_helper.php

	output_publication($publication, $order, $even);


/*****************/

// DE 11.9.2011
// Show similar publications 

	//if this publication is PRIMARY and order is by AUTHOR
	if($publication->similar_pub_id == $publication->pub_id && $order === 'author')
	{
		$similars_array = array();

		foreach($publications as $pub)
		{
			if($pub->similar_pub_id == $publication->pub_id && $pub->pub_id != $publication->pub_id)
			{
				$similars_array[] = output_publication($pub, $order, 'even', 'secondary');
			}
		}	
		if(!empty($similars_array))
		{ 
			echo "</td></tr>";
			echo implode(', ', $similars_array) ;
		}
	}
	//if this publication is secondary and order is by TYPE or by YEAR
	/****** UNCOMMENT the following if you want to show "SAME AS" when ordering by Type/Year  **********/
	/*
	elseif($publication->similar_pub_id != $publication->pub_id && $publication->similar_pub_id != NULL )
		{
			foreach($publications as $pub)
			{
				if($pub->pub_id == $publication->similar_pub_id)
				{
					echo "</td></tr>";
					echo output_publication($pub, $order, 'even', 'secondary');
					break;
				}
			}
		}	
	*/

	echo "
    </td>
  </tr>";

	echo "
	</table>
	</div>
	"; //end of publication_summary div
}

} //////

echo $multipagelinks;
?>
</div>
