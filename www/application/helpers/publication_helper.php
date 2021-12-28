<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
Aigaion - Web based document management system
Copyright (C) 2003-2007 (in alphabetical order):
Wietse Balkema, Arthur van Bunningen, Dennis Reidsma, Sebastian Schleußner

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

/*
This helper provides functions for selecting publicationtype dependent fields.
*/

function getFullFieldArray() {
    return array(
                  'title'          ,
                  'type'	       ,
                  'journal'        ,
                  'booktitle'      ,
                  'edition'        ,
                  'series'         ,
                  'volume'         ,
                  'number'         ,
                  'chapter'        ,
                  'year'           ,
                  'month'          ,
                  'firstpage'      , //DEPRECATED
                  'lastpage'       , //DEPRECATED
                  'pages'		   ,
                  'publisher'      ,
                  'location'       ,
                  'institution'    ,
                  'organization'   ,
                  'school'         ,
                  'address'        ,
                  'howpublished'   ,
                  'note'           ,
                  'keywords'       ,
                  'issn'           ,
                  'isbn'           ,
                  'url'            ,
                  'doi'            ,
                  'crossref'       ,
                  'namekey'        ,
                  'abstract'       ,
                  'userfields'     
    );
}
function getCapitalFieldArray() {
    return array(
                  'issn'           ,
                  'isbn'           ,
                  'url'            ,
                  'doi'            
    );
}

function getPublicationFieldArray($type)
{
  if (file_exists(dirname(__FILE__).'/local_override_publication_helper.php'))
  {
    require_once(dirname(__FILE__).'/local_override_publication_helper.php');
    return getLocalPublicationFieldArray($type);
  }
	$type = ucfirst(strtolower(trim($type)));
	switch ($type) {
		case "Article":
		return array( 
		              'title'	          => 'required',
                  'type'	          => 'hidden',
                  'year'            => 'optional',
                  'volume'          => 'optional',
                  'number'          => 'optional',                  
                  'journal'         => 'optional',
                  'pages'		        => 'optional',            
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'chapter'         => 'hidden',
                  'month'           => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'hidden',
                  'howpublished'    => 'hidden',
                  'note'            => 'hidden',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'hidden',
                  'namekey'         => 'hidden',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'hidden',
                  'userfields'      => 'hidden'
								);
		break;
		case "Book":
		return array( 
		              'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'required',
                  'edition'         => 'optional',
                  'series'          => 'hidden',
                  'volume'          => 'optional',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'optional',
                  'month'           => 'hidden',
                  'pages'		        => 'optional',
                  'publisher'       => 'optional',
                  'location'        => 'optional',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'hidden',
                  'howpublished'    => 'hidden',
                  'note'            => 'hidden',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'hidden',
                  'namekey'         => 'hidden',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'hidden',
                  'userfields'      => 'hidden'
								);
		break;
		case "Booklet":
		return array( 
				          'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'optional',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'optional',
                  'howpublished'    => 'optional',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Inbook":
		return array( 'title'	          => 'optional',
                  'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'optional',
                  'edition'         => 'optional',
                  'series'          => 'hidden',
                  'volume'          => 'optional',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'optional',
                  'month'           => 'hidden',
                  'pages'		        => 'optional',
                  'publisher'       => 'optional',
                  'location'        => 'optional',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'hidden',
                  'howpublished'    => 'hidden',
                  'note'            => 'hidden',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'hidden',
                  'namekey'         => 'hidden',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'hidden',
                  'userfields'      => 'hidden'
								);
		break;
		case "Incollection":
		return array( 'type'	          => 'optional',
                  'journal'         => 'hidden',
                  'booktitle'       => 'required',
                  'edition'         => 'optional',
                  'series'          => 'optional',
                  'volume'          => 'optional',
                  'number'          => 'optional',
                  'chapter'         => 'optional',
                  'year'            => 'required',
                  'month'           => 'optional',
                  'pages'		        => 'optional',
                  'publisher'       => 'required',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'optional',
                  'school'          => 'hidden',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'optional',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Inproceedings":
		return array( 'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'optional', //cannot be required, since it may have been stored in a crossref entry! (and then this field stays empty)
                  'edition'         => 'hidden',
                  'series'          => 'optional',
                  'volume'          => 'optional',
                  'number'          => 'optional',
                  'chapter'         => 'hidden',
                  'year'            => 'required',
                  'month'           => 'optional',
                  'pages'		        => 'optional',
                  'publisher'       => 'optional',
                  'location'        => 'optional',
                  'institution'     => 'hidden',
                  'organization'    => 'optional',
                  'school'          => 'hidden',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'optional',
                  'isbn'            => 'optional',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Manual":
		return array( 'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'optional',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'optional',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'optional',
                  'school'          => 'hidden',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Mastersthesis":
		return array( 'type'	          => 'optional',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'required',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'required',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Misc":
  	return array( 'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'optional',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'hidden',
                  'howpublished'    => 'optional',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Phdthesis":
		return array( 'type'	          => 'optional',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'required',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'required',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Proceedings":
		return array( 'type'	          => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'optional',
                  'edition'         => 'hidden',
                  'series'          => 'optional',
                  'volume'          => 'optional',
                  'number'          => 'optional',
                  'chapter'         => 'hidden',
                  'year'            => 'required',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'optional',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'optional',
                  'school'          => 'hidden',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'optional',
                  'isbn'            => 'optional',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Techreport":
		return array( 'type'	          => 'optional',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'optional',
                  'chapter'         => 'hidden',
                  'year'            => 'required',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'required',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'optional',
                  'howpublished'    => 'hidden',
                  'note'            => 'optional',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		case "Unpublished":
		return array( 'type'	    => 'hidden',
                  'journal'         => 'hidden',
                  'booktitle'       => 'hidden',
                  'edition'         => 'hidden',
                  'series'          => 'hidden',
                  'volume'          => 'hidden',
                  'number'          => 'hidden',
                  'chapter'         => 'hidden',
                  'year'            => 'optional',
                  'month'           => 'optional',
                  'pages'		        => 'hidden',
                  'publisher'       => 'hidden',
                  'location'        => 'hidden',
                  'institution'     => 'hidden',
                  'organization'    => 'hidden',
                  'school'          => 'hidden',
                  'address'         => 'hidden',
                  'howpublished'    => 'hidden',
                  'note'            => 'required',
                  'issn'            => 'hidden',
                  'isbn'            => 'hidden',
                  'crossref'        => 'optional',
                  'namekey'         => 'optional',
                  'url'             => 'optional',
                  'doi'             => 'optional',
                  'abstract'        => 'optional',
                  'userfields'      => 'optional'
								);
		break;
		default:
		return array();
		break;
	}
}

//note: the prefix may be an array instead of a string, in that case its (prefix,postfix)
function getPublicationSummaryFieldArray($type)
{
  if (file_exists(dirname(__FILE__).'/local_override_publication_helper.php'))
  {
    require_once(dirname(__FILE__).'/local_override_publication_helper.php');
    return getLocalOverridePublicationSummaryFieldArray($type);
  }
	$type = ucfirst(strtolower($type));
	switch ($type) {
		case "Article":
			return array( 
	                  'actualyear'    => array(' (',')'),
			              //'journal'       => ', '.__('in:').' ',
	                  'volume'        => ' ', 
	                  'number'        => array(' (',')'),
	                   'journal'       => ' ',
	                  //'number'        => ':',
	                  'pages'         => ' '
	                );
		break;
		case "Book":
			return array( 'publisher'     => ', ',
	                  'series'        => ', ',
	                  'volume'        => ', '.__('vol').' ', 
	                  'actualyear'    => ', ',
	                  'pages' => ' '
                  );
		break;
		case "Booklet":
			return array( 'howpublished'  => ', ',
			              'actualyear'    => ', ',
			            );
		break;
		case "Inbook":
			return array( 'chapter'       => ', '.__('chapter').' ', 
			              'pages'         => ', '.__('pages').' ', 
			              'publisher'     => ', ',
			              'series'        => ', ',
			              'volume'        => ', '.__('volume').' ', 
			              'actualyear'    => ', '
			            );
		break;
		case "Incollection":
			return array( 'booktitle'     => ', '.__('in:').' ', 
			              'organization'  => ', ', 
	                  'pages'         => ', '.__('pages').' ', 
	                  'publisher'     => ', ',
	                  'actualyear'    => ', '
	                );
		break;
		case "Inproceedings":
			return array( 'booktitle'     => ', '.__('in:').' ', 
	                  'organization'  => ', ', 
 	                  'location'      => ', ',
	                  'pages'         => ', '.__('pages').' ', 
	                  'publisher'     => ', ',
	                  'actualyear'    => ', '
                  );
		break;
		case "Manual":
			return array( 'edition'       => ', ',
	                  'organization'  => ', ',
	                  'actualyear'    => ', '
	                );
		break;
		case "Mastersthesis":
			return array( 'school'        => ', ' ,
	                  'year'          => ', '
                  );
		break;
		case "Misc":
			return array( 'howpublished'  => ', ',
	                  'actualyear'    => ', '
                  );
		break;
		case "Phdthesis":
			return array( 'school'        => ', ',
	                  'actualyear'    => ', '
                  );
		break;
		case "Proceedings":
			return array( 'organization'  => ', ',
			              'publisher'     => ', ',
			              'actualyear'    => ', '
			            );
		break;
		case "Techreport":
			return array( 'institution'   => ', ',
	                  'number'        => ', '.__('number').' ', 
	                  'type'          => ', ',
	                  'actualyear'    => ', '
                  );
		break;
		case "Unpublished":
			return array( 'actualyear'    => ', '
			            );
		break;
		default:
	    return array();
		break;
	}
}

function getPublicationTypes()
{
  return array("Article"        => __('Article'),
          		 "Book"           => __('Book'),
          		 "Inbook"         => __('Chapter'));
          		 //"Booklet"        => __('Booklet'),
          		 //"Inbook"         => __('Inbook'),
          		 //"Incollection"   => __('Incollection'),
          		 //"Inproceedings"  => __('Inproceedings'),
          		 //"Manual"         => __('Manual'),
          		 //"Mastersthesis"  => __('Mastersthesis'),
          		 //"Phdthesis"      => __('Phdthesis'),
          		 //"Proceedings"    => __('Proceedings'),
          		 //"Techreport"     => __('Techreport'),
          		 //"Unpublished"    => __('Unpublished'),
               //  "Misc"           => __('Misc'));
                 
}


function getPublicationStatusTypes()
{
  return array(""               => "",
               //"preparation"    => __('In preparation'),
               //"submitted"      => __('Submitted'),
               //"review"         => __('Under review'),
               //"revision"       => __('Under revision'),
               //"accepted"       => __('Accepted'),
               //"rejected"       => __('Rejected'),
               "published"      => __('Published'));
}

function output_publication($publication, $order, $even = 'even', $type = ''){
/* 	echo "similar_pub_id: " . $publication->similar_pub_id . " pub_id: " . $publication->pub_id; */
	$userlogin  = getUserLogin();
    $summarystyle = $userlogin->getPreference('summarystyle');  
    $summaryfields = getPublicationSummaryFieldArray($publication->pub_type);


    
 if($type === 'secondary') 
 {
 		echo "<tr>
    				<td class ='secondary'> Also in: ";
 }
 else
 {
 		echo "
<div class='publication_summary ".$even."' id='publicationsummary".$publication->pub_id."'>
<table width='100%'>
  <tr id='sim_id_".$publication->pub_id."'>
    <td>";
 }   				
    				
$displayTitle = $publication->title;
//remove braces in list display
if ( (strpos($displayTitle,'$')===false) 
    &&
     (strpos($displayTitle,"\\")===false)     //insert here condition that says 'no replacing if latex code' (i.e. any remaining backslash)
     ) {
  $displayTitle = str_replace(array('{','}'),'',$displayTitle);
}

$num_authors    = count($publication->authors);
$num_editors    = count($publication->editors);

if ($summarystyle == 'title') {
    echo "<span class='title'>".anchor('publications/show/'.$publication->pub_id, $displayTitle, array('title' => __('View publication details')))."</span>";
}
    
$current_author = 1;

foreach ($publication->authors as $author)
{
  if (($current_author == $num_authors) & ($num_authors > 1)) {
    echo " ".translate('and', $publication->language)." ";
  }
  else if ($current_author>1 || ($summarystyle == 'title')) {
    echo ", ";
  }

  echo  "<span class='author'>".anchor('authors/show/'.$author->author_id, $author->getName(), array('title' => sprintf(__('All information on %s'),$author->cleanname)))."</span>";
  $current_author++;
}

if ($summarystyle == 'author') {
    if ($num_authors > 0) {
        echo ', ';
    }
    
////////////////////////////////////////////////////////////////////////////////////////////
    
if ($publication->pub_type=='Article'){
        $displayJournal = $publication->journal;
        $displayVolume = $publication->volume;
        $displayNumber = $publication->number;
        $displayYear = $publication->year;
        $displayPages = $publication->pages;
        $displayURL = $publication->url;
        $displayDOI = $publication->doi;
        
        //$displayNotes = $publication->note;
    
        echo "<span class='title'>&#8216;".anchor('publications/show/'.$publication->pub_id, $displayTitle, array('title' => __('View publication details')))."&#8217;</span> ";
        if ($displayVolume!=''){
          echo "(".$displayYear.") ".$displayVolume;
        }else{
          echo "[".$displayYear."]";
        }
        if ($displayVolume!='' && $displayNumber!=''){
          echo "(".$displayNumber.")";
        }elseif($displayVolume=='' && $displayNumber!=''){
        echo " ".$displayNumber;
        } 
        if ($displayJournal!=''){
          echo " ".$displayJournal;
        }        
        if ($displayPages!=''){
          echo " ".$displayPages; //." ".str_replace('-', '–', $displayPages);
        }        

        
}elseif ($publication->pub_type=='Book'){   //demetris 21/8
        //$displayLang = $publication->language;
        $displayEdition = $publication->edition;
        $displayVolume = $publication->volume;
        $displayYear = $publication->year;
        $displayPages = $publication->pages;
        $displayPublisher = $publication->publisher;
        $displayLocation = $publication->location;
        $displayNotes = $publication->note;
        $displayBookTitle = $publication->booktitle; 
        $displayURL = $publication->url;
        $displayDOI = $publication->doi;
        
   echo "<span class='title'><i>".anchor('publications/show/'.$publication->pub_id, $displayBookTitle, array('title' => __('View publication details')))."</i></span>";
        /*if ($displayVolume!='' && $displayLang!=""){
          echo ", vol ".$displayVolume;
          }elseif($displayVolume!='' && $displayLang==""){
          echo ", τ.".$displayVolume;
        }*/
        if ($displayVolume!='' ){ echo ', '.translate('vol', $publication->language).' '.$displayVolume; } 
        
        if ($num_editors>0 || $displayNotes!='' || $displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) {
        echo " (";  
        }                                                 
        
        $current_editor = 1;
        foreach ($publication->editors as $editor)
        {
          //if ($current_editor==1) echo "";
          //if (($current_editor == $num_editors) & ($num_editors > 1)) {
          //  echo " ".translate('and', $publication->language)." ";
          //}
          //else if ($current_editor>1 || ($summarystyle == 'title')) {
          //  echo ", ";
          //}
          echo  "<span class='author'>".anchor('authors/show/'.$editor->author_id, $editor->getName(), array('title' => sprintf(__('All information on %s'),$editor->cleanname)))."</span>";
          if ($current_editor==$num_editors){
          }elseif($current_editor==$num_editors-1){
            echo " ".translate('and', $publication->language)." ";
          }else{
            echo ', ';
          }
          
          //if ($current_editor == $num_editors){
          //}elseif ($current_editor == $num_editors-1){
          //  echo " ".translate('and', $publication->language)." ";
          //}else{
          //  echo " ,";
          //}
          $current_editor++;
        }
        
if ($num_editors==1){
    echo " (".translate('ed', $publication->language).")";
}elseif($num_editors>1){
    echo " (".translate('eds', $publication->language).")";
}
        
        if ($num_editors>0 && ($displayNotes!='' || $displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='')) echo ", ";
        echo $displayNotes;
        if ($displayNotes!=''){
          echo $displayNotes;
        }
         if ($displayNotes!='' && ($displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) ){
          echo ', ';
        }
        
        if ($displayEdition!=''){
          echo $displayEdition." ".translate('edn', $publication->language);
        } 
         if ($displayEdition!='' && ($displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) ){
          echo ', ';
        }        
        if ($displayPublisher!=''){
          echo $displayPublisher;
        }
         if ($displayPublisher!='' && ($displayLocation!='' || $displayYear!='')){
          echo ', ';
        }        
        if ($displayLocation!=''){
          echo $displayLocation;
        } 
         if ($displayLocation!='' && $displayYear!=''){
          echo ', ';
        }                
        if ($displayYear!=''){
          echo $displayYear;
        }        
        if (sizeof($publication->editors)>0 || $displayNotes!='' || $displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) {
        echo ")";  
        } 
        //echo ")";
        if ($displayPages!=''){
          echo " ".$displayPages;
        }    
}elseif ($publication->pub_type=='Inbook'){   //demetris 21/8
        $displayEdition = $publication->edition;
        $displayVolume = $publication->volume;
        $displayYear = $publication->year;
        $displayPages = $publication->pages;
        $displayPublisher = $publication->publisher;
        $displayLocation = $publication->location;
        $displayNotes = $publication->note;
        $displayBookTitle = $publication->booktitle; 
        $displayURL = $publication->url;
        $displayDOI = $publication->doi;
        
   echo "<span class='title'>&#8216;".anchor('publications/show/'.$publication->pub_id, $displayTitle, array('title' => __('View publication details')))."&#8217;</span>";
   
$current_editor = 1;
foreach ($publication->editors as $editor)
{
  if ($current_editor==1) echo " ";
  if (($current_editor == $num_editors) && ($num_editors > 1)) {
    echo " ".translate('and', $publication->language)." ";
  }
  else if ($current_editor>1 || ($summarystyle == 'title')) {
    echo ", ";
  }
  echo  "<span class='author'>".anchor('authors/show/'.$editor->author_id, $editor->getName(), array('title' => sprintf(__('All information on %s'),$editor->cleanname)))."</span>";
   $current_editor++;  
}

if ($num_editors==1){
    echo " (".translate('ed', $publication->language).")";
}elseif($num_editors>1){
    echo " (".translate('eds', $publication->language).")";
}
 
   
   echo ", <i>".$displayBookTitle."</i>";
        if ($displayVolume!=''){
          echo ", ".translate('vol', $publication->language)." ".$displayVolume;
        }
        
        if ($displayNotes!='' || $displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) {
        echo " (";  
        } 
         
        //echo " (";
        echo $displayNotes;
        if ($displayNotes!=''){
          echo $displayNotes;
        }
         if ($displayNotes!='' && ($displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) ){
          echo ', ';
        }
        
        if ($displayEdition!=''){
          echo $displayEdition." ".translate('edn', $publication->language);
        } 
         if ($displayEdition!='' && ($displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) ){
          echo ', ';
        }        
        if ($displayPublisher!=''){
          echo $displayPublisher;
        }
         if ($displayPublisher!='' && ($displayLocation!='' || $displayYear!='')){
          echo ', ';
        }        
        if ($displayLocation!=''){
          echo $displayLocation;
        } 
         if ($displayLocation!='' && $displayYear!=''){
          echo ', ';
        }                
        if ($displayYear!=''){
          echo $displayYear;
        }     
        
                if ($displayNotes!='' || $displayEdition!='' || $displayPublisher!='' || $displayLocation!='' || $displayYear!='' ) {
        echo ")";  
        } 
           
        //echo ")";
        if ($displayPages!=''){
          echo " ".$displayPages;
        }  
   
}


}

/*
foreach ($summaryfields as $key => $prefix) {
  $val = utf8_trim($publication->getFieldValue($key));

  if ($key=="month")$val=formatMonthText($val);
  $postfix='';
  if (is_array($prefix)) {
    $postfix = $prefix[1];
    $prefix = $prefix[0];
  }
  if ($val) {
    echo $prefix.$val.$postfix;
  }
}
*/

if (!(isset($noNotes) && ($noNotes == true)))
{
  $notes = $publication->getNotes();
  if ($notes != null) {
  echo "<br/>
        <ul class='notelist'>";
    foreach ($notes as $note) {
      echo "
          <li>".$this->load->view('notes/summary', array('note' => $note), true)."</li>";
    }
    echo "
        </ul>";
  }
}
echo "
    </td>
    <td class='alignright aligntop fivepercentwidth'>
      <span id='bookmark_pub_".$publication->pub_id."'>";
      
/*
if ($useBookmarkList) {
  if ($publication->isBookmarked) {
    echo '<span title="'.__('Click to UnBookmark publication').'">'
         .$this->ajax->link_to_remote("<img class='large_icon' src='".getIconUrl('bookmarked.gif')." ' alt='bookmarked' />",
          array('url'     => site_url('/bookmarklist/removepublication/'.$publication->pub_id),
                'update'  => 'bookmark_pub_'.$publication->pub_id
                )
          ).'</span>';
  } 
  else {
    echo '<span title="'.__('Click to Bookmark publication').'">'
         .$this->ajax->link_to_remote("<img class='large_icon' src='".getIconUrl('nonbookmarked.gif')."' alt='nonbookmarked' />",
          array('url'     => site_url('/bookmarklist/addpublication/'.$publication->pub_id),
                'update'  => 'bookmark_pub_'.$publication->pub_id
                )
          ).'</span>';
  }
}
*/

echo "</span>";
$attachments = $publication->getAttachments();
if (count($attachments) != 0)
{
    if ($attachments[0]->isremote) {
        echo "<br/><a href='".prep_url($attachments[0]->location)."' class='open_extern'><img class='large_icon' title='".sprintf(__('Download %s'),htmlentities($attachments[0]->name,ENT_QUOTES, 'utf-8'))."' src='".getIconUrl("attachment_html.gif")."' alt='download' /></a>\n";
    } else {
        $iconUrl = getIconUrl("attachment.gif");
        //might give problems if location is something containing UFT8 higher characters! (stringfunctions)
        //however, internal file names were created using transliteration, so this is not a problem
        $extension=strtolower(substr(strrchr($attachments[0]->location,"."),1));
        if (iconExists("attachment_".$extension.".gif")) {
            $iconUrl = getIconUrl("attachment_".$extension.".gif");
        }
        $params = array('title'=>sprintf(__('Download %s'),$attachments[0]->name));
        if ($userlogin->getPreference('newwindowforatt')=='TRUE')
            $params['class'] = 'open_extern';
        echo '<br/>'.anchor('attachments/single/'.$attachments[0]->att_id,"<img class='large_icon' src='".$iconUrl."' alt='attachment' />" ,$params)."\n";
    }
}  
if (utf8_trim($publication->doi)!='') {
    echo "[<a title='".__('Click to follow Digital Object Identifier link to online publication')."' class='open_extern' href='http://dx.doi.org/".$publication->doi."'>DOI</a>]";
}
if (utf8_trim($publication->url)!='') {
    echo "[<a title='".prep_url($publication->url)."' class='open_extern' href='".prep_url($publication->url)."'>URL</a>]";
}



}



/*
|
| Language specific for publications list
|  
|  If you want to output the word "and", then write:    
|				
|				<?php echo translate('and', $publication->language);?>
|
|	 Make sure it is set in all languages (both english and greek).  
|
*/
function translate($word, $language){



	/*********** GREEK  ****************/
	$greek['and'] = 'και';
	$greek['by']	= 'από';
	$greek['vol'] 			= 'τομ';
	$greek['ed'] 			= 'επ';
	$greek['eds'] 			= 'επ';
	$greek['edn'] 			= 'εκδ';
	
	/************************************/

	/*********** ENGLISH  ****************/
	$english['and'] 		= 'and';
	$english['by'] 			= 'by';
	$english['vol'] 			= 'vol';
		$english['ed'] 			= 'ed';
	$english['eds'] 			= 'eds';
	  $english['edn'] 			= 'edn';
	/************************************/



	//return language specific value
	return $language === 'english' ? $english[$word] : $greek[$word];
	
}