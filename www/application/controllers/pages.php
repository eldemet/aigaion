<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Controller {

	function __construct()
	{
		parent::Controller();	
	}

	/**  */
	function index($name = '')
	{


      $userlogin  = getUserLogin();
    	$user       = $this->user_db->getByID($userlogin->userID());
    	if (!$userlogin->hasRights('publication_edit'))
    	{
    		 redirect('', 'refresh');
    	}

	    $pages = $this->_get_all_pages();

	    //get output
	    $headerdata = array();
      $headerdata['title'] = __('Pages');
      $headerdata['javascripts'] = array('tree.js','prototype.js','scriptaculous.js','builder.js');

      $output = $this->load->view('header', $headerdata, true);

      $output .= $this->load->view('help/header',
                                      array(),  
                                      true);

			$output .= $this->load->view('pages/index',
			                              array('pages' => $pages),  
			                              true);

			$output .= $this->load->view('footer','', true);

			$this->output->set_output($output);
	}


	function show($name = '') {
			  $page = $this->_get_page($name);

				if($page == FALSE)
    		{
    			redirect('', 'refresh');
    		}

        //get output
        $headerdata = array();
        $headerdata['title'] = ucwords(str_replace('-', ' ', $page['name']));
        $headerdata['javascripts'] = array('tree.js','prototype.js','scriptaculous.js','builder.js');

        $output = $this->load->view('header', $headerdata, true);

				$userlogin  = getUserLogin();
				$user       = $this->user_db->getByID($userlogin->userID());
				if ($userlogin->hasRights('publication_edit'))
				{
						$output .= '<a style="float:none;color:red" href="'. site_url() . '/pages/edit/' . $name .'"> Edit this page </a>';
				}

        $output .= $this->load->view('help/header',
                                      array(),  
                                      true);
        $output .= $this->load->view('pages/show',
                                      array('content' => $page['content']),  
                                      true);
        $output .= $this->load->view('footer','', true);

        //set output
        $this->output->set_output($output);

	}


	function edit($name = ''){

			if($this->input->post('content'))
			{
				$this->db->where('name', $name);
				$this->db->update('pages', array('content' => $this->input->post('content') ));
				redirect('pages/show/' . $name, 'refresh');
			}
			$headerdata['title'] = 'Edit Page';
			$headerdata['javascripts'] = array('tree.js','prototype.js','scriptaculous.js','builder.js','tinymce/tiny_mce.js', 'jquery.tinymce.js');

			$output = $this->load->view('header', $headerdata, true);

			$userlogin  = getUserLogin();
    	$user       = $this->user_db->getByID($userlogin->userID());
    	if (!$userlogin->hasRights('publication_edit'))
    	{
    		redirect('pages/show/' . $name, 'refresh');
    	}

    	$page = $this->_get_page($name);

    	if($page === FALSE)
    	{
    		redirect('', 'refresh');
    	}

    	 $output .= $this->load->view('help/header',
                                      array(),  
                                      true);

			 $output .= $this->load->view('pages/edit',
                                      array('page' => $page),  
                                      true);


       $output .= $this->load->view('footer','', true);

       $this->output->set_output($output);
	}

	function _get_page($name = '')
	{
    	$this->db->where(array('name' => $name));
    	$Q = $this->db->get('pages');

    	if($Q->num_rows() > 0)
    	{	
    		$row = $Q->row_array();
    		return $row;
    	}
    	else{
    		return FALSE;
    	}
	}

	function _get_all_pages()
	{
			$Q = $this->db->get('pages');
			$data = array();
			if($Q->num_rows() > 0)
    	{	
    		foreach($Q->result_array() as $row)
    		{
    			$data[] = $row;
    		}
    		return $data;
    	}
    	else{
    		return FALSE;
    	}
	}

}
?>