<?php
/*
 * Followig class handling select input control and their
* dependencies. Do not make changes in code
* Create on: 9 November, 2013
*/

class NM_Select_wooproduct extends PPOM_Inputs{
	
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
		
		$this -> title 		= __ ( 'Select Input', 'ppom' );
		$this -> desc		= __ ( 'regular select input', 'ppom' );
		$this -> settings	= self::get_settings();
		
	}
	
	
	
	
	private function get_settings(){
		
		return array (
						'title' => array (
								'type' => 'text',
								'title' => __ ( 'Title', 'ppom' ),
								'desc' => __ ( 'It will be shown as field label', 'ppom' ) 
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
						
						'options' => array (
								'type' => 'paired',
								'title' => __ ( 'Add options', 'ppom' ),
								'desc' => __ ( 'Type option with price (optionally)', 'ppom' )
						),
						
						/*'show_price' => array (
								'type' => 'checkbox',
								'title' => __ ( 'Show price', 'ppom' ),
								'desc' => __ ( 'Show price on front end with options', 'ppom' ) 
						),*/
						'onetime' => array (
								'type' => 'checkbox',
								'title' => __ ( 'Fixed Fee', 'ppom' ),
								'desc' => __ ( 'Add one time fee to cart total.', 'ppom' ) 
						),
						
						'onetime_taxable' => array (
								'type' => 'checkbox',
								'title' => __ ( 'Fixed Fee Taxable?', 'ppom' ),
								'desc' => __ ( 'Calculate Tax for Fixed Fee', 'ppom' ) 
						),
				
						'selected' => array (
								'type' => 'text',
								'title' => __ ( 'Selected option', 'ppom' ),
								'desc' => __ ( 'Type option name (given above) if you want already selected.', 'ppom' ) 
						),
						
						'first_option' => array (
								'type' => 'text',
								'title' => __ ( 'First option', 'ppom' ),
								'desc' => __ ( 'Just for info e.g: Select your option.', 'ppom' ) 
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
	 * @params: $options
	*/
	function render_input($args, $options="", $default=""){
		
		//nm_personalizedproduct_pa($options);
		$_html = '<select ';
		
		foreach ($args as $attr => $value){
			
			$_html .= $attr.'="'.stripslashes( $value ).'"';
		}
		
		$_html .= '>';
		
		$_html .= '<option value="">'.__('Select options', 'ppom').'</option>';
		
		foreach($options as $opt)
		{
				
			if($opt['price']){
				
				//if in percent
				if(strpos($opt['price'],'%') !== false){
					$output	= stripslashes(trim($opt['option'])) .' (+ ' . $opt['price'].')';	
				}else{
					$output	= stripslashes(trim($opt['option'])) .' (+ ' . wc_price($opt['price']).')';
				}
				
			}else{
				$output	= stripslashes(trim($opt['option']));
			}
				
			// data-value for optionprice for fixed price
			// since 6.4
			$data_value = $args['field_label'].'-'.$opt['option'];
			$_html .= '<option data-price="'.$opt['price'].'" ';
			$_html	.= 'value="'.$opt['option'].'" ';
			$_html	.= 'data-value="'.$data_value.'" ';
			$_html	.=  selected($default, $opt['option'], false).'>';
			$_html .= $output;
			$_html .= '</option>';
		}
		
		$_html .= '</select>';
		
		echo $_html;
	}
}