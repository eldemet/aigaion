<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?><?php
  $publicationfields = getPublicationFieldArray($publication->pub_type);
  if (!isset($categorize)) $categorize= False;

//some things are dependent on user rights.
//$accessLevelEdit is set to true iff the edit access level of the publication does not make it
//inaccessible to the logged user. Note: this does NOT yet garantuee atachemtn_edit or note_ediot or publication_edit rights
$accessLevelEdit = $this->accesslevels_lib->canEditObject($publication);
$userlogin  = getUserLogin();
$user       = $this->user_db->getByID($userlogin->userID());
$this->load->helper('translation');
?>
<div class='publication'>
  <div class='optionbox'><?php
	if (    ($userlogin->hasRights('publication_edit'))
		&& ($accessLevelEdit)
        ) {
		echo "[".anchor('publications/delete/'.$publication->pub_id, __('delete'), array('title' => __('Delete this publication')))."]&nbsp;";
		echo "[".anchor('publications/edit/'.$publication->pub_id, __('edit'), array('title' => __('Edit this publication')))."]";
	}

//        if ($userlogin->hasRights('bookmarklist')) {
//          echo "&nbsp;<span id='bookmark_pub_".$publication->pub_id."'>";
//          if ($publication->isBookmarked) {
//            echo '['.$this->ajax->link_to_remote(__("UnBookmark"),
//                  array('url'     => site_url('/bookmarklist/removepublication/'.$publication->pub_id),
//                        'update'  => 'bookmark_pub_'.$publication->pub_id
//                        )
//                  ).']';
//          }
//          else {
//            echo '['.$this->ajax->link_to_remote(__("Bookmark"),
//                  array('url'     => site_url('/bookmarklist/addpublication/'.$publication->pub_id),
//                        'update'  => 'bookmark_pub_'.$publication->pub_id
//                        )
//                  ).']';
//          }
//          echo "</span>";
        if ($userlogin->hasRights('export_email')) {
    	    echo  '&nbsp;['.anchor('publications/exportEmail/'.$publication->pub_id.'/',__('E-mail'),array('title'=>__('Export by e-mail'))).']';
    	  }
        //echo  '&nbsp;['
        //   .anchor('export/publication/'.$publication->pub_id.'/bibtex',__('BibTeX'),array('target'=>'aigaion_export')).']';
        //echo  '&nbsp;['
        //   .anchor('export/publication/'.$publication->pub_id.'/ris',__('RIS'),array('target'=>'aigaion_export')).']';

        if ($userlogin->hasRights('request_copies')) {
  				$author_email = '';
  				if(count($publication->authors)>0)
  				{
  					foreach ($publication->authors as $author)
  					{
  						if($author->email != '')
  						{
	 				        $author_email = $author->email;
  							break;
  						}
  					}
  			 }
  			 if($author_email != '')
  			 {
            $this->load->helper('encode');
  					$subject=rawurlencode(sprintf(__('Request for publication: "%s"'), $publication->title));
  					$bodytext=
  				 	 rawurlencode(__('Publication').': '.$publication->title.' : '.AIGAION_ROOT_URL.'index.php/publications/show/'.$publication->pub_id)
  				 	.rawurlencode("\n\n".__("I understand that the document referenced above is subject to copyright.")." ")
  				 	.rawurlencode("".__("I hereby request a copy strictly for my personal use.")."")
  				 	.rawurlencode("\n\n".__("Name and contact details").":\n");
  				 	echo "&nbsp;[<a href='mailto:".$author->email."?Subject=".$subject."&Body=".$bodytext."' title='".__("Request publication by e-mail")."'>".__("Request")."</a>]";
  			} else 
        {
  				echo '<span title="'.__('No e-mail address available for neither of the authors').'">&nbsp;['.__('Request').']</span>';
  			}
  		}
      if ($userlogin->hasRights('bookmarklist')) 
      {
        echo "&nbsp;<span id='bookmark_pub_".$publication->pub_id."'>";
        if ($publication->isBookmarked) 
        {
          echo '<span title="'.__('Click to UnBookmark publication').'">'
                .$this->ajax->link_to_remote("<img class='large_icon' src='".getIconUrl('bookmarked.gif')." ' alt='bookmarked' />",
                array('url'     => site_url('/bookmarklist/removepublication/'.$publication->pub_id),
                      'update'  => 'bookmark_pub_'.$publication->pub_id
                     )
                ).'</span>';
        } 
        else 
        {
          echo '<span title="'.__('Click to Bookmark publication').'">'
               .$this->ajax->link_to_remote("<img class='large_icon' src='".getIconUrl('nonbookmarked.gif')."' alt='nonbookmarked' />",
                array('url'     => site_url('/bookmarklist/addpublication/'.$publication->pub_id),
                      'update'  => 'bookmark_pub_'.$publication->pub_id
                      )
                ).'</span>';
        }
        echo "</span>";
      }

?>
  </div>
  <div class='header'>
  <?php 
    if ($publication->title)
    {
      echo $publication->title;
      echo '<br>';
    }
    if ($publication->booktitle){
      echo $publication->booktitle;
    } 
  ?>
  </div>

  <table class='publication_details' width='100%'>
    <tr>
      <td>
      <?php
      if(translateType($publication->pub_type)=='Inbook')
      {
        echo 'Chapter';
      }else{ 
        echo translateType($publication->pub_type);
      } 
      ?></td>
    </tr>
<?php

    if ($publication->status != ''):
?>
    <tr>
      <td valign='top'><?php _e("Publication status");?>:</td>
      <td valign='top'>
<?php
        $statustypes = getPublicationStatusTypes();
        echo $statustypes[$publication->status];
?>
      </td>
    </tr>
<?php
    endif;
    
    $capitalfields = getCapitalFieldArray();
    foreach ($publicationfields as $key => $class):
      if ($publication->$key):
?>
    <tr>
      <td valign='top'><?php
        if ($key=='namekey') {
            echo __('Key').' <span title="'.__('This is the BibTeX `key` field, used to define sorting keys').'">(?)</span>'; //stored in the databse as namekey, it is actually the bibtex field 'key'
        } else {
            if (in_array($key,$capitalfields)) {
                echo utf8_strtoupper(translateField($key));
            } else  {
                echo translateField($key,true);
            }
        }
      ?>:</td>
      <td valign='top'><?php
        if ($key=='doi') {
            echo '<a href="http://dx.doi.org/'.$publication->$key.'" class="open_extern">'.$publication->$key.'</a>';
        } else if ($key=='url') {
            $this->load->helper('utf8');
            $urlname = prep_url($publication->url);
            if (utf8_strlen($urlname)>21) {
                $urlname = utf8_substr($urlname,0,30)."...";
            }
            echo "<a title='".prep_url($publication->url)."' href='".prep_url($publication->url)."' class='open_extern'>".$urlname."</a>\n";
        } else if ($key == 'month') {
          echo formatMonthText($publication->month);
        } else if ($key == 'pages') {
          echo $publication->pages;
        } elseif ($key == 'crossref') {
            $xref_pub = $this->publication_db->getByBibtexID($publication->$key);
            if ($xref_pub != null) {
                echo '<i>'.anchor('publications/show/'.$xref_pub->pub_id,$publication->$key).':</i>';
                //and then the summary of the crossreffed pub. taken from views/publications/list
                $summaryfields = getPublicationSummaryFieldArray($xref_pub->pub_type);
                echo "<div class='message'>
                      <span class='title'>".anchor('publications/show/'.$xref_pub->pub_id, $xref_pub->title, array('title' => __('View publication details')))."</span>";

                //authors of crossref
                $num_authors    = count($xref_pub->authors);
                $current_author = 1;

                foreach ($xref_pub->authors as $author)
                {
                  if (($current_author == $num_authors) & ($num_authors > 1)) {
                    echo " ".__("and")." ";
                  }
                  else {
                    echo ", ";
                  }

                  echo  "<span class='author'>".anchor('authors/show/'.$author->author_id, $author->getName('vlf'), array('title' => __('All information on').' '.$author->cleanname))."</span>";
                  $current_author++;
                }

                //editors of crossref
                $num_editors    = count($xref_pub->editors);
                $current_editor= 1;

                foreach ($xref_pub->editors as $editor)
                {
                  if (($current_editor == $num_editors) & ($num_editors > 1)) {
                    echo " ".__('and')." ";
                  }
                  else {
                    echo ", ";
                  }

                  echo  "<span class='author'>".anchor('authors/show/'.$editor->author_id, $editor->getName('vlf'), array('title' => __('All information on').' '.$editor->cleanname))."</span>";
                  $current_editor++;
                }
                if ($num_editors>1) {
                    echo ' '.__('(eds)');
                } elseif ($num_editors>0) {
                    echo ' '.__('(ed)');
                }
                foreach ($summaryfields as $key => $prefix) {
                  $val = trim($xref_pub->getFieldValue($key));
                  $postfix='';
                  if (is_array($prefix)) {
                    $postfix = $prefix[1];
                    $prefix = $prefix[0];
                  }
                  if ($val) {
                    echo $prefix.$val.$postfix;
                  }
                }
                echo "</div>"; //end of publication_summary div for crossreffed publication
            } else {
                echo $publication->$key;
            }
        }
        else {
            echo $publication->$key;
        }
      ?></td>
    </tr>
<?php
      endif;
    endforeach;

    $customfields = $publication->getCustomFields();
    if (is_array($customfields))
    {
      foreach ($customfields as $customfield)
      {
          ?>
        <tr>
          <td valign='top'>
          <?php 
          if ($customfield['fieldname'] === 'similar_pub_id'){
            echo 'Same publications';      
          }else{
            echo ucfirst($customfield['fieldname']);
          } 
          ?>: </td>
          <td valign='top'>
          <?php 
          if ($customfield['fieldname']=='similar_pub_id')
          {
          	if ($customfield['value'] == $publication->pub_id)
          	{ //then this is the primary article
          		$CI = &get_instance();
          		$CI->db->where('pub_id', $publication->pub_id);
          		$CI->db->where('topic_id !=', 0);
          		$CI->db->where('topic_id !=', 1);
          		$res = $CI->db->get('topicpublicationlink')->row();

          		echo '<a href="http://cypriotlaw.com/index.php/topics/single/'.
          																										$res->topic_id.'/author#sim_id_'.
          																										$publication->pub_id.
          																										'"> View similar articles</a>';
          	}
          	else
          	{ //then this is a secondary article
          		//if ($customfield['value']!=""){
              echo '<a href="http://cypriotlaw.com/index.php/publications/show/'.
          																										$customfield['value'].'">'.
          																										$customfield['value']. ". " .
          						$this->publication_db->getByID($customfield['value'])->title.'</a>';
          		//}
          	} 
          }
          else
          {
            echo ucfirst($customfield['value']);
          } 

          ?> </td>
        </tr>
            <?php
      }
    }

    $keywords = $publication->getKeywords();
    if (is_array($keywords))
    {
      $keyword_string = "";
      foreach ($keywords as $keyword)
      {
        $keyword_string .= anchor('keywords/single/'.$keyword->keyword_id, $keyword->keyword).", ";
      }
      $keyword_string = substr($keyword_string, 0, -2);
?>

<?php
    }

    if (count($publication->authors) > 0):
?>
    <tr>
      <td valign='top'><?php _e("Authors");?></td>
      <td valign='top'>
        <span class='authorlist'>
<?php     foreach ($publication->authors as $author)
          {
            echo anchor('authors/show/'.$author->author_id, $author->getName('vlf'), array('title' => __('All information on').' '.$author->cleanname))."<br />\n";
          }
?>
        </span>
      </td>
    </tr>
<?php
    endif;
    if (count($publication->editors) > 0):
?>
    <tr>
      <td valign='top'><?php _e("Editors");?></td>
      <td valign='top'>
        <span class='authorlist'>
<?php     foreach ($publication->editors as $author)
          {
            echo anchor('authors/show/'.$author->author_id, $author->getName('vlf'), array('title' => __('All information on').' '.$author->cleanname))."<br />\n";
          }
?>
        </span>
      </td>
    </tr>
<?php
    endif;

    $crossrefpubs = $this->publication_db->getXRefPublicationsForPublication($publication->bibtex_id);
    if (count($crossrefpubs)>0):
?>

<?php
    endif;
?>
    <tr>
      <td valign='top'><?php //_e("Added by");?></td>
      <td valign='top'>
<?php
        //echo '<b>['.getAbbrevForUser($publication->user_id).']</b>';
?>
      </td>
    </tr>
<?php
    if ($accessLevelEdit)
    {    
      $read_icon = $this->accesslevels_lib->getReadAccessLevelIcon($publication);
      $edit_icon = $this->accesslevels_lib->getEditAccessLevelIcon($publication);

      $readrights = $this->ajax->link_to_remote($read_icon,
                  array('url'     => site_url('/accesslevels/toggle/publication/'.$publication->pub_id.'/read'),
                        'update'  => 'publication_rights_'.$publication->pub_id
                       )
                  );
      $editrights = $this->ajax->link_to_remote($edit_icon,
                  array('url'     => site_url('/accesslevels/toggle/publication/'.$publication->pub_id.'/edit'),
                        'update'  => 'publication_rights_'.$publication->pub_id
                       )
                  );
?>
    
<?php
    }
?>

    
<?php
    if ($userlogin->hasRights('note_edit')) {
      $this->load->helper('form');
?>
      
<?php
    }

    //if book covers are allowed, show the book cover of this publication
    if (getConfigurationSetting('USE_BOOK_COVERS')=='TRUE')
    {
?>

<?php
    }
?>      
  </table>
</div>