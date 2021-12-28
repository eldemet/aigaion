<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
	}
	
	/**  */
	function index()
	{
	    $this->viewhelp();
	}
	

	function viewhelp() {
        //get output
        $headerdata = array();
        $headerdata['title'] = __('Help');
        $headerdata['javascripts'] = array('tree.js','prototype.js','scriptaculous.js','builder.js','tiny_mce.js', 'jquery.tinymce.js');
        
        $output = $this->load->view('header', $headerdata, true);

 $userlogin  = getUserLogin();
    		 $user       = $this->user_db->getByID($userlogin->userID());
    		 if ($userlogin->hasRights('publication_edit'))
    		 {
    		 		$output .= '<a style="float:none;color:red" href="'. base_url() . 'help/edit/' . $this->uri->segment(3,'front') .'"> Edit this page... </a>';
    		 }
        
        $output .= $this->load->view('help/header',
                                      array(),  
                                      true);
        $output .= $this->load->view('help/'.$this->uri->segment(3,'front'),
                                      array(),  
                                      true);
        $output .= $this->load->view('footer','', true);

        //set output
        $this->output->set_output($output);

	}

	function edit(){

	}	
}
?>