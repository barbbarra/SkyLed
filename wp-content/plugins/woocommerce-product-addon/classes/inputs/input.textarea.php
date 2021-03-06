<?php
/*
 * Followig class handling textarea input control and their
* dependencies. Do not make changes in code
* Create on: 9 November, 2013
*/

class NM_Textarea_wooproduct extends PPOM_Inputs{
	
	/*
	 * input control settings
	 */
	var $title, $desc, $settings;
	
	/*
	 * this var is pouplated with current plugin meta
	*/
	var $plugin_meta;
	
	function __construct(){
		
		$this -> plugin_meta = ppom_get_plugin_meta();
		
		$this -> title 		= __ ( 'Textarea Input', "ppom" );
		$this -> desc		= __ ( 'regular textarea input', "ppom" );
		$this -> settings	= self::get_settings();
		
	}
	
	
	
	
	private function get_settings(){
		
		return array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', "ppom" ),
				'desc' => __ ( 'It will be shown as field label', "ppom" ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', "ppom" ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', "ppom" ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', "ppom" ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', "ppom" ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', "ppom" ),
				'desc' => __ ( 'Insert the error message for validation.', "ppom" ) 
		),
		
		'default_value' => array (
								'type' => 'text',
								'title' => __ ( 'Post ID', "ppom" ),
								'desc' => __ ( 'It will pull content from post. e.g: 22', "ppom" )
		),
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', "ppom" ),
				'desc' => __ ( 'Select this if it must be required.', "ppom" ) 
		),
		'rich_editor' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Rich Editor', "ppom" ),
				'desc' => __ ( 'Enable <a target="_blank" href="https://codex.wordpress.org/Function_Reference/wp_editor">WordPress rich editor</a>.', "ppom" ) 
		),		
		/*'cols' => array (
				'type' => 'text',
				'title' => __ ( 'Columns', "ppom" ),
				'desc' => __ ( 'e.g 10', "ppom" )
		),*/
		'rows' => array (
				'type' => 'text',
				'title' => __ ( 'Rows', "ppom" ),
				'desc' => __ ( 'e.g: 3', "ppom" )
		),
		'max_length' => array (
				'type' => 'text',
				'title' => __ ( 'Max. Length', "ppom" ),
				'desc' => __ ( 'Max. characters allowed, leave blank for default', "ppom" )
		),
		
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', "ppom" ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', "ppom" ) 
		),
		'width' => array (
								'type' => 'select',
								'title' => __ ( 'Width', 'ppom' ),
								'options'	=> ppom_get_input_cols(),
								'default'	=> 12,
						),
		'logic' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Enable Conditions', "ppom" ),
				'desc' => __ ( 'Tick it to turn conditional logic to work below', "ppom" )
		),
		'conditions' => array (
				'type' => 'html-conditions',
				'title' => __ ( 'Conditions', "ppom" ),
				'desc' => __ ( 'Tick it to turn conditional logic to work below', "ppom" )
		),
		);
	}
	
	
	/*
	 * @params: args
	*/
	function render_input($args, $content=""){
		
		$_html = '<textarea ';
		
		foreach ($args as $attr => $value){
			
			$_html .= $attr.'="'.stripslashes( $value ).'" ';
		}
		
		$_html .= '>' . stripslashes( $content ) . '</textarea>';
		
		echo $_html;
	}
}