<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Auto Pages URI Fieldtype
*
* @package		AutoPagesURI
* @version		1.2
* @author		Laurence Cope, Amity Web Solutions Ltd
* @copyright 	Copyright (c) 2011 Amity Web Solutions Ltd <http://www.amitywebsolutions.co.uk>
*/

class Auto_pages_uri_ft extends EE_Fieldtype {

	var $info = array(
		'name'		=> 'Auto Pages URI',
		'version'	=> '1.2'
	);
	
	// --------------------------------------------------------------------

	/**
	* Display Field on Publish
	*
	* @access	public
	* @return	field html
	*
	*/
	public function display_field($data)
	{
	
		$this->EE->cp->add_to_head('
			<script type="text/javascript">
			
			$(function() {
				
				var title_field = $("input[name=title]");
				var pages__pages_uri_field = $("input[name=pages__pages_uri]");
				var url_title_field = $("input[name=url_title]");
				
				$(title_field).keyup(function() { // Maybe use blur instead??
					
					var entry_id = "' . (isset($_GET['entry_id']) ? ''.$_GET['entry_id'].'' : '') . '";
					if(!entry_id)
					{
						var page_url = ee_page_uri($(title_field));
						$(pages__pages_uri_field).val(page_url);
					}
				
				});;
				
				
				$(pages__pages_uri_field).keyup(function() { // Maybe use blur instead??
					var url_title = ee_page_uri($(pages__pages_uri_field));
					if($(url_title_field).val() != "home")
					{
						$(url_title_field).val(url_title);
					}
				});;
				
				$(url_title_field).keyup(function() { // Maybe use blur instead??
					var pages__pages_uri = ee_page_uri($(url_title_field));
					$(pages__pages_uri_field).val(pages__pages_uri);
				
				});;
				
			});

		    function ee_page_uri(title)
		    {

		            var b = EE.publish.default_entry_title ? EE.publish.default_entry_title : "",
		                c = EE.publish.word_separator ? EE.publish.word_separator : "_",
		                h = EE.publish.foreignChars ? EE.publish.foreignChars : {},
		                a = title.val() || "",
		                i = RegExp(c + "{2,}", "g"),
		                d = c !== "_" ? /\_/g : /\-/g,
		                f = "",
		                j = EE.publish.url_title_prefix ? EE.publish.url_title_prefix : "";
		            b !== "" && title.attr("id") === "title" && a.substr(0, b.length) === b && (a = a.substr(b.length));
		            a = (j + a).toLowerCase().replace(d, c);
		            for (b = 0; b < a.length; b++) d = a.charCodeAt(b), d >= 32 && d < 128 ? f += a.charAt(b) : d in h && (f += h[d]);
		            a = f.replace("/<(.*?)>/g", "");
		            a = a.replace(/\s+/g, c);
		            a = a.replace(/\//g, c);
		            a = a.replace(/[^a-z0-9\-\._]/g, "");
		            a = a.replace(/\+/g, c);
		            a = a.replace(i, c);
		            a = a.replace(/^[\-\_]|[\-\_]$/g, "");
		            a = a.replace(/\.+$/g, "");
	
					return a;
		    }
								
			</script>		
			');


		return false;
	}
	
	// --------------------------------------------------------------------
	
	/**
	* Install Fieldtype
	*
	* @access	public
	* @return	default global settings
	*
	*/
	function install()
	{
		return array(	
	);
}
	
	// --------------------------------------------------------------------
	
}

/* End of file ft.auto_pages_uri.php */
/* Location: ./system/expressionengine/third_party/pages_uri/ft.auto_pages_uri.php */
