<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Aigaion: Extension of the prep_url function...
*/


/**
 * Prep URL
 *
 * Simply adds the http:// part if missing
 *
 * @access	public
 * @param	string	the URL
 * @return	string
 */
function prep_url($str = '')
{
	if ($str == 'http://' OR $str == '')
	{
		return '';
	}
	else {
	    $str = filter_var($str, FILTER_SANITIZE_URL);
	}
	
	//mod by PDM, for Aigaion 2.0
	//if (preg_match('/^[a-z]+:\/\//i', $str) == FALSE)
	//{
	//	$str = 'http://'.$str;
	//}
	if (preg_match('/^[a-z]+:/', $str) == FALSE) {
	  $str = 'http://'.$str;
    }
	
	return $str;
}
	
?>