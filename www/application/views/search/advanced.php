<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$userlogin = getUserLogin();
if (!isset($query)||($query==null)) $query='';
if (!isset($options)||($options==null)) 
            $options = array('authors',
                             'topics',
                             'keywords',
                             'publications',
                             'publications_titles',
                             'publications_notes',
                             'publications_bibtex_id',
                             'publications_abstracts');
                             
echo "
  <div class=editform>    
    <p class=header>".__('Advanced Search')."</p>
".form_open('search/advancedresults')
 .form_hidden('formname','advancedsearch')."\n

    <p class=header2>".__('Search terms')."</p>
    <div>\n";
echo form_input(array('name' => 'searchstring', 'size' => '50','value'=>$query));

echo "
    </div>
<p/>
    <p class=header2>".__('Result types')."</p>
    ".__('Choose which types of results you want returned')."
    <div>\n"
.form_checkbox('return_authors','return_authors',in_array('authors',$options))." ".__('Return authors')."<br/>\n"
.form_checkbox('return_publications','return_publications',in_array('publications',$options))." ".__('Return publications')."<br/>\n"
//.form_checkbox('return_topics','return_topics',in_array('topics',$options))." ".__('Return topics')."<br/>\n"
//.form_checkbox('return_keywords','return_keywords',in_array('keywords',$options))." ".__('Return keywords')."<br/>\n"
."
    </div>
<p/>
    <p class=header2>".__('Publication search')."</p>
    ".__('Choose, if you are searching for publications (see above!), which fields are searched')."
    <div>\n"
.form_checkbox('search_publications_titles','search_publications_titles',in_array('publications_titles',$options))." ".__('Search publication titles')."<br/>\n"
.form_checkbox('search_publications_notes','search_publications_notes',in_array('publications_notes',$options))." ".__('Search publication notes')."<br/>\n"
//.form_checkbox('search_publications_bibtex_id','search_publications_bibtex_id',in_array('publications_bibtex_id',$options))." ".__('Search publication Citation')."<br/>\n"
//.form_checkbox('search_publications_abstracts','search_publications_abstracts',in_array('publications_abstracts',$options))." ".__('Search publication abstract')."<br/>\n"
."
    </div>
<p/>
";

echo form_submit('submit_search',  __('Search'));
echo form_close();

echo "
  </div>
";

?>