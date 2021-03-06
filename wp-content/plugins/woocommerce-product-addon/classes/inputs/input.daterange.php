<?php
/*
 * Followig class handling date input control and their
* dependencies. Do not make changes in code
* Create on: 9 November, 2013
*/

class NM_Daterange_wooproduct extends PPOM_Inputs{
	
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
		
		$this -> title 		= __ ( 'DateRange Input', 'ppom' );
		$this -> desc		= __ ( '<a href="http://www.daterangepicker.com/" target="_blank">More detail</a>', 'ppom' );
		$this -> settings	= self::get_settings();
		
	}
	
	
	
	
	private function get_settings(){
		
		return array (
		'title' => array (
				'type' => 'text',
				'title' => __ ( 'Title', 'ppom' ),
				'desc' => __ ( '<a href="http://www.daterangepicker.com/" target="_blank">All about Daterangepicker</a>', 'ppom' ) 
		),
		'data_name' => array (
				'type' => 'text',
				'title' => __ ( 'Data name', 'ppom' ),
				'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'ppom' ) 
		),
		'description' => array (
				'type' => 'text',
				'title' => __ ( 'Description', 'ppom' ),
				'desc' => __ ( 'Small description, it will be diplay near name title.', 'ppom' ) 
		),
		'error_message' => array (
				'type' => 'text',
				'title' => __ ( 'Error message', 'ppom' ),
				'desc' => __ ( 'Insert the error message for validation.', 'ppom' ) 
		),
		
		'required' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Required', 'ppom' ),
				'desc' => __ ( 'Select this if it must be required.', 'ppom' ) 
		),
		'class' => array (
				'type' => 'text',
				'title' => __ ( 'Class', 'ppom' ),
				'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'ppom' ) 
		),
		'width' => array (
				'type' => 'select',
				'title' => __ ( 'Width', 'ppom' ),
				'desc' => __ ( 'Type field width in % e.g: 50%', 'ppom'),
				'options'	=> ppom_get_input_cols(),
				'default'	=> 12,
		),
		'date_formats' => array (
				'type' => 'text',
				'title' => __ ( 'Format', 'ppom' ),
				'desc' => __ ( 'e.g MM-DD-YYYY, DD-MMM-YYYY', 'ppom' ),
		),
		
		'default_value' => array (
				'type' => 'text',
				'title' => __ ( 'Default Date', 'ppom' ),
				'desc' => __ ( 'Must be same format as defined in "Format".', 'ppom' ),
		),
		'time_picker' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Show Timepicker', 'ppom' ),
				'desc' => __ ( 'Show Timepicker.', 'ppom' ) 
		),
		'tp_increment' => array (
				'type' => 'text',
				'title' => __ ( 'Timepicker increment', 'ppom' ),
				'desc' => __ ( 'e.g: 30', 'ppom' ) 
		),
		'tp_24hours' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Show Timepicker 24 Hours', 'ppom' ),
				'desc' => __ ( 'Left blank for default', 'ppom' ) 
		),
		'tp_seconds' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Show Timepicker Seconds', 'ppom' ),
				'desc' => __ ( 'Left blank for default', 'ppom' ) 
		),
		'open_style' => array (
				'type' => 'select',
				'title' => __ ( 'Open Style', 'ppom' ),
				'desc' => __ ( 'Default is down.', 'ppom' ),
				'options' => array('down'=>'Down', 'up'=>'Up'),
		),
		'drop_down' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Show Dropdown', 'ppom' ),
				'desc' => __ ( 'Left blank for default', 'ppom' ) 
		),
		'show_weeks' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Show Week Numbers', 'ppom' ),
				'desc' => __ ( 'Left blank for default.', 'ppom' ) 
		),
		'auto_apply' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Auto Apply Changes', 'ppom' ),
				'desc' => __ ( 'Hide the Apply/Cancel button.', 'ppom' ) 
		),
		'start_date' => array (
				'type' => 'text',
				'title' => __ ( 'Start Date', 'ppom' ),
				'desc' => __ ( 'Must be same format as defined in "Format"', 'ppom' ) 
		),
		'end_date' => array (
				'type' => 'text',
				'title' => __ ( 'End Date', 'ppom' ),
				'desc' => __ ( 'Must be same format as defined in "Format"', 'ppom' ) 
		),
		'min_date' => array (
				'type' => 'text',
				'title' => __ ( 'Min Date', 'ppom' ),
				'desc' => __ ( 'e.g: 2017-02-25', 'ppom' ) 
		),
		'max_date' => array (
				'type' => 'text',
				'title' => __ ( 'Max Date', 'ppom' ),
				'desc' => __ ( 'e.g: 2017-09-15', 'ppom' ) 
		),
		
		'logic' => array (
				'type' => 'checkbox',
				'title' => __ ( 'Enable Conditions', 'ppom' ),
				'desc' => __ ( 'Tick it to turn conditional logic to work below', 'ppom' )
		),
		'conditions' => array (
				'type' => 'html-conditions',
				'title' => __ ( 'Conditions', 'ppom' ),
				'desc' => __ ( 'Tick it to turn conditional logic to work below', 'ppom' )
		),
		);
	}
	
	
	/*
	 * @params: args
	*/
	function render_input($args, $content=""){
		
		$_html = '<input type="text" ';
		
		foreach ($args as $attr => $value){
			
			$_html .= $attr.'="'.stripslashes( $value ).'"';
		}
		
		if($content)
			$_html .= 'value="' . stripslashes($content	) . '"';
		
		$_html .= ' />';
		
		echo $_html;
		
		$this -> get_input_js($args);
	}
	
	/*
	 * following function is rendering JS needed for input
	*/
	function get_input_js($args){
	?>
		
				<script type="text/javascript">	
				<!--
				jQuery(function($){

					$("#<?php echo $args['id'];?>").datepicker("destroy");
					
					$("#<?php echo $args['id'];?>").datepicker({ 	
						changeMonth: true,
						changeYear: true,
						dateFormat: $("#<?php echo $args['id'];?>").attr('data-format'),
						defaultDate: "01-01-1964"
						});
				});
				
				//--></script>
				<?php
		}
}