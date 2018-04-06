<?php
/**
 * Inputs rendering class
 **/
 

// constants/configs
define( 'ECHOABLE', false );

class NM_Form {
     
     
     /**
	 * the static object instace
	 */
	private static $ins = null;
	
	private $echoable;
	
	private $defaults;
	
	
     function __construct() {
         
        //  should control echo or return
        $this -> echoable = $this->get_property( 'echoable' );
        
        // control defaul settings
        $this -> defaults = $this->get_property( 'defaults' );
        
        // Local filters
        add_filter('nmform_attribute_value', array($this, 'adjust_attributes_values'), 10, 3);
     }
 
     public function Input( $args, $default_value = '' ) {
         
         $type       = $this -> get_attribute_value( 'type', $args);
         
         switch( $type ) {
             
            case 'text':
            case 'date':
            case 'daterange':
            case 'datetime-local':
            case 'email':
            case 'number':
            case 'color':
                
                $input_html = $this -> Regular( $args, $default_value );
                
            break;
            
            case 'textarea':
                $input_html = $this -> Textarea( $args, $default_value );
            break;
            
            case 'select':
                $input_html = $this -> Select( $args, $default_value );
            break;
            
            case 'timezone':
                $input_html = $this -> Timezone( $args, $default_value );
            break;
            
            case 'checkbox':
                $input_html = $this -> Checkbox( $args, $default_value );
            break;
            
            case 'radio':
                $input_html = $this -> Radio( $args, $default_value );
            break;
            
            case 'palettes':
                $input_html = $this -> Palettes( $args, $default_value );
            break;
            
            case 'image':
                $input_html = $this -> Image( $args, $default_value );
            break;
            
            case 'pricematrix':
                $input_html = $this -> Pricematrix( $args, $default_value );
            break;
            
            case 'quantities':
                $input_html = $this -> Quantities( $args, $default_value );
            break;
            
            case 'section':
                $input_html = $this -> Section( $args, $default_value );
            break;
            
            case 'audio':
                $input_html = $this -> Audio_video( $args, $default_value );
            break;
            
            case 'file':
                $input_html = $this -> File( $args, $default_value );
            break;
            
            case 'cropper':
                $input_html = $this -> Cropper( $args, $default_value );
            break;
            
            case 'fixedprice':
                $input_html = $this -> FixedPriceAddon( $args, $default_value );
            break;
            
         }
         
         if( $this -> echoable )
            echo $input_html;
        else
            return $input_html;
     }
     
    /**
     * Regular Input Field
     * 1. Text
     * 2. Date
     * 3. Email
     * 4. Number
     **/
     
    public function Regular( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        
        $label      = $this -> get_attribute_value('label', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $id         = $this -> get_attribute_value('id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $placeholder= $this -> get_attribute_value('placeholder', $args);
        $attributes = $this -> get_attribute_value('attributes', $args);
        
        $num_min = $this -> get_attribute_value('min', $args);
        $num_max = $this -> get_attribute_value('max', $args);
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        // ppom_pa($args);
        
        $html       .= '<input type="'.esc_attr($type).'" ';
        $html       .= 'id="'.esc_attr($id).'" ';
        $html       .= 'name="'.esc_attr($name).'" ';
        $html       .= 'class="'.esc_attr($classes).'" ';
        $html       .= 'placeholder="'.esc_attr($placeholder).'" ';
        
        // Adding min/max for number input
        if( $type == 'number' ) {
            $html       .= 'min="'.esc_attr($num_min).'" ';
            $html       .= 'max="'.esc_attr($num_max).'" ';
        }
        
        //Values
        if( $default_value != '')
        $html      .= 'value="'.esc_attr($default_value).'" ';
        
        // Attributes
        foreach($attributes as $attr => $value) {
            
            $html      .= esc_attr($attr) . '="'.esc_attr($value).'" ';
        }
        
        
        $html      .= '>';
        $html      .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    /**
     * Textarea field only
     * 
     * filter: nmforms_input_htmls
     * filter: 
     * */
    function Textarea($args, $default_value = '') {
        
        $label      = $this -> get_attribute_value('label', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $id         = $this -> get_attribute_value('id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $placeholder= $this -> get_attribute_value('placeholder', $args);
        $attributes = $this -> get_attribute_value('attributes', $args);
        $rich_editor= $this -> get_attribute_value('rich_editor', $args);
        
        // cols & rows
        $cols       = $this -> get_attribute_value( 'cols', $args );
        $rows       = $this -> get_attribute_value( 'rows', $args );
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        if( $rich_editor == 'on' ) {
						
			$wp_editor_setting = array('media_buttons'=> false,
									'textarea_rows'=> $rows,
									'editor_class' => $classes,
									'teeny'			=> true,
									'textarea_name'	=> $name	);
									
			ob_start();
            wp_editor($default_value, $id, $wp_editor_setting);
            $html .= ob_get_clean();
			
        } else {
        
            $html       .= '<textarea ';
            $html       .= 'id="'.esc_attr($id).'" ';
            $html       .= 'name="'.esc_attr($name).'" ';
            $html       .= 'class="'.esc_attr($classes).'" ';
            $html       .= 'placeholder="'.esc_attr($placeholder).'" ';
            // $html       .= 'cols="'.esc_attr($cols).'" ';
            $html       .= 'rows="'.esc_attr($rows).'" ';
            
            // Attributes
            foreach($attributes as $attr => $value) {
                
                $html      .= esc_attr($attr) . '="'.esc_attr($value).'" ';
            }
            
            $html      .= '>';  // Closing textarea
            
            //Values
            if( $default_value != '')
                $html      .= esc_html($default_value);
            
            $html      .= '</textarea>';
        }
        
        $html      .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
        
    }
    
    /**
     * Select options
     * 
     * $options: array($key => $value)
     **/
    public function Select( $args, $selected_value = '' ) {
        
        $label      = $this -> get_attribute_value('label', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $id         = $this -> get_attribute_value('id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $multiple   = $this -> get_attribute_value('multiple', $args);
        $attributes = $this -> get_attribute_value('attributes', $args);
        
        // Only title without description for price calculation etc.
        $title      = $args['title'];
        // One time fee
        $onetime    = $args['onetime'];
        $taxable	= $args['taxable'];
        
        
        // Options
        $options    = $this -> get_attribute_value('options', $args);


        if ( ! $options ) return;

        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $html       .= '<select ';
        $html       .= 'id="'.esc_attr($id).'" ';
        $html       .= 'name="'.esc_attr($name).'" ';
        $html       .= 'class="'.esc_attr($classes).'" ';
        $html       .= ($multiple) ? 'multiple' : '';
        
        // Attributes
        foreach($attributes as $attr => $value) {
            
            $html      .= esc_attr($attr) . '="'.esc_attr($value).'" ';
        }
        
        $html       .= '>';  // Closing select
        
        foreach($options as $key => $value) {
            
            // for multiple selected
            
            $option_label   = $value['label'];
            $option_price   = $value['price'];
            $raw_label      = $value['raw'];
            $without_tax    = $value['without_tax'];
            
            if( is_array($selected_value) ){
            
                foreach($selected_value as $s){
                    $html   .= '<option '.selected( $s, $key, false ).' value="'.esc_attr($key).'" ';
                    $html   .= 'data-price="'.esc_attr($option_price).'" ';
                    $html   .= 'data-label="'.esc_attr($option_label).'"';
                    $html   .= 'data-onetime="'.esc_attr($onetime).'"';
                    $html   .= '>'.$option_label.'</option>';
                }
            } else {
                $html   .= '<option '.selected( $selected_value, $key, false ).' ';
                $html   .= 'value="'.esc_attr($key).'" ';
                $html   .= 'data-price="'.esc_attr($option_price).'" ';
                $html   .= 'data-label="'.esc_attr($raw_label).'"';
                $html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
                $html   .= 'data-onetime="'.esc_attr($onetime).'"';
                $html   .= 'data-taxable="'.esc_attr($taxable).'"';
                $html   .= 'data-without_tax="'.esc_attr($without_tax).'"';
                $html   .= '>'.$option_label.'</option>';
            }
        }
        
        $html .= '</select>';
        $html      .= '</div>';    //form-group
        
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $selected_value);
    }
    
    /**
     * Timezone
     * 
     * $options: array($key => $value)
     **/
    public function Timezone( $args, $selected_value = '' ) {
        
        $label      = $this -> get_attribute_value('label', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $id         = $this -> get_attribute_value('id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $multiple   = $this -> get_attribute_value('multiple', $args);
        $attributes = $this -> get_attribute_value('attributes', $args);
        
        // Only title withou description for price calculation etc.
        $title      = $args['title'];
        
        
        // Options
        $options    = $this -> get_attribute_value('options', $args);


        if ( ! $options ) return;

        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $html       .= '<select ';
        $html       .= 'id="'.esc_attr($id).'" ';
        $html       .= 'name="'.esc_attr($name).'" ';
        $html       .= 'class="'.esc_attr($classes).'" ';
        $html       .= ($multiple) ? 'multiple' : '';
        
        // Attributes
        foreach($attributes as $attr => $value) {
            
            $html      .= esc_attr($attr) . '="'.esc_attr($value).'" ';
        }
        
        $html       .= '>';  // Closing select
        
        // ppom_pa($options);
        foreach($options as $key => $option_label) {
            
            
            if( is_array($selected_value) ){
            
                foreach($selected_value as $s){
                    $html   .= '<option '.selected( $s, $key, false ).' value="'.esc_attr($key).'" ';
                    $html   .= 'data-price="'.esc_attr($option_price).'" ';
                    $html   .= 'data-label="'.esc_attr($option_label).'"';
                    $html   .= 'data-onetime="'.esc_attr($onetime).'"';
                    $html   .= '>'.$option_label.'</option>';
                }
            } else {
                $html   .= '<option '.selected( $selected_value, $key, false ).' ';
                $html   .= 'value="'.esc_attr($key).'" ';
                $html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
                $html   .= '>'.$option_label.'</option>';
            }
        }
        
        $html .= '</select>';
        $html .= '</div>';    //form-group
        
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $selected_value);
    }
    
    
    // Checkbox
    public function Checkbox( $args, $checked_value = array() ) {
        
        $type       = $this -> get_attribute_value( 'type', $args);
        
        $label      = $this -> get_attribute_value('label', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $id         = $this -> get_attribute_value('id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        
        // Only title withou description for price calculation etc.
        $title      = $args['title'];
        // One time fee
        $onetime    = $args['onetime'];
        $taxable	= $args['taxable'];
        
        // Options
        $options    = $this -> get_attribute_value('options', $args);
        
        // Checkbox label class
        $check_wrapper_class = apply_filters('ppom_checkbox_wrapper_class','form-check-inline');
        $check_label_class = $this -> get_attribute_value('check_label_class', $args);

        if ( ! $options ) return;
        
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        // $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
        
        foreach($options as $key => $value) {
            
            $option_label = $value['label'];
            $option_price = $value['price'];
            $raw_label      = $value['raw'];
            $without_tax    = $value['without_tax'];
            
            $checked_option = '';
            if( ! empty($checked_value) && in_array($key, $checked_value)){
            
                $checked_option = checked( $key, $key, false );
            }
            
            $option_id = sanitize_key( $id."-".$key );
            
            $html       .= '<div class="'.esc_attr($check_wrapper_class).'">';
                $html       .= '<label class="'.esc_attr($check_label_class).'" for="'.esc_attr($option_id).'">';
                    $html       .= '<input type="'.esc_attr($type).'" ';
                    $html       .= 'id="'.esc_attr($option_id).'" ';
                    $html       .= 'name="'.esc_attr($name).'[]" ';
                    $html       .= 'class="'.esc_attr($classes).'" ';
                    $html       .= 'value="'.esc_attr($key).'"';
                    $html       .= 'data-price="'.esc_attr($option_price).'"';
                    $html       .= 'data-label="'.esc_attr($raw_label).'"';
                    $html       .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
                    $html       .= 'data-onetime="'.esc_attr($onetime).'"';
                    $html       .= 'data-taxable="'.esc_attr($taxable).'"';
                    $html       .= 'data-without_tax="'.esc_attr($without_tax).'"';
                    $html       .= $checked_option;
                    $html       .= '> ';  // Closing checkbox
                    $html       .= '<span class="ppom-label-checkbox">'.$option_label.'</span>';
                $html       .= '</label>';    // closing form-check
            $html       .= '</div>';    // closing form-check
        }
        
        $html      .= '</div>';    //form-group
        
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $checked_value);
    }
    
    
    // Radio
    public function Radio( $args, $checked_value = '' ) {
        
        $type       = $this -> get_attribute_value( 'type', $args);
        
        $label      = $this -> get_attribute_value('label', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $id         = $this -> get_attribute_value('id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        
        // Only title withou description for price calculation etc.
        $title      = $args['title'];
        // One time fee
        $onetime    = $args['onetime'];
        $taxable	= $args['taxable'];
        
        // Options
        $options    = $this -> get_attribute_value('options', $args);
        if ( ! $options ) return;
        
        // Radio label class
        $radio_wrapper_class = apply_filters('ppom_radio_wrapper_class','form-check');
        $radio_label_class = $this -> get_attribute_value('radio_label_class', $args);

        
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        foreach($options as $key => $value) {
            
            $option_label   = $value['label'];
            $option_price   = $value['price'];
            $raw_label      = $value['raw'];
            $without_tax    = $value['without_tax'];
            $option_id      = $value['option_id'];
            
            $checked_option = '';
            if( ! empty($checked_value) ){
            
                $checked_option = checked( $checked_value, $key, false );
            }
            
            
            $html       .= '<div class="'.esc_attr($radio_wrapper_class).'">';
                $html       .= '<label class="'.esc_attr($radio_label_class).'" for="'.esc_attr($option_id).'">';
                    $html       .= '<input type="'.esc_attr($type).'" ';
                    $html       .= 'id="'.esc_attr($option_id).'" ';
                    $html       .= 'name="'.esc_attr($name).'" ';
                    $html       .= 'class="'.esc_attr($classes).'" ';
                    $html       .= 'value="'.esc_attr($key).'"';
                    $html       .= 'data-price="'.esc_attr($option_price).'"';
                    $html       .= 'data-label="'.esc_attr($raw_label).'"';
                    $html       .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
                    $html       .= 'data-onetime="'.esc_attr($onetime).'"';
                    $html       .= 'data-taxable="'.esc_attr($taxable).'"';
                    $html       .= 'data-without_tax="'.esc_attr($without_tax).'"';
                    $html       .= $checked_option;
                    $html       .= '> ';  // Closing radio
                    $html       .= '<span class="ppom-label-radio">'.$option_label.'</span>';
                $html       .= '</label>';    // closing form-check
            $html       .= '</div>';    // closing form-check
        }
        
        $html      .= '</div>';    //form-group
        
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $checked_value);
    }
    
    // A custom input will be just some option html
    public function Palettes( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        $classes    = isset($args['classes']) ? $args['classes'] : '';
	    
	    // Only title withou description for price calculation etc.
        $title      = $args['title'];
        
        // One time fee
        $onetime    = $args['onetime'];
        $taxable	= $args['taxable'];
        
	    // Options
		$options    = isset($args['options']) ? $args['options'] : '';
		if ( ! $options ) return '';
		
// 		ppom_pa($options);

        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $html .= '<div class="ppom-palettes ppom-palettes-'.esc_attr($id).'">';
		foreach($options as $key => $value)
		{
			// First Separate color code and label
			$color_label_arr = explode('-', $key);
			$color_code = trim($color_label_arr[0]);
			$color_label = '';
			if(isset($color_label_arr[1])){
				$color_label = trim($color_label_arr[1]);
			}
			
			$option_label = $value['label'];
        	$option_price = $value['price'];
        	$raw_label      = $value['raw'];
        	$without_tax    = $value['without_tax'];

			$option_id = sanitize_key($id."-".$option_label);
			
			$checked_option = '';
			if( ! empty($default_value) ){
        
                $checked_option = checked( $default_value, $key, false );
            }
            
			
			$html .= '<label for="'.esc_attr($option_id).'"> ';
				$html .= '<input id="'.esc_attr($option_id).'" ';
				$html .= 'data-price="'.esc_attr($option_price).'" ';
				$html .= 'data-label="'.esc_attr($color_label).'"';
				$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
				$html .= 'type="radio" ';
				$html .= 'name="'.esc_attr($name).'" ';
				$html .= 'value="'.esc_attr($color_code).'" ';
				$html .= 'data-onetime="'.esc_attr($onetime).'"';
                $html .= 'data-taxable="'.esc_attr($taxable).'"';
                $html .= 'data-without_tax="'.esc_attr($without_tax).'"';
				$html .= $checked_option;
				$html .= '>';
			
				
			$html .= '<div class="ppom-single-palette" ';
			$html	.= 'title="'.esc_attr($option_label).'" data-html="true" data-toggle="tooltip"';
			$html	.= 'style="background-color:'.esc_attr($color_code).';';
			$html	.= 'width:'.esc_attr($args['color_width']).'px;';
			$html	.= 'height:'.esc_attr($args['color_height']).'px;';
			if( $args['display_circle'] ) {
			    $html	.= 'border-radius: 50%;';
			}
			$html	.= '">';    // Note '"' is to close style inline attribute
			$html	.= '';
			$html	.= '</div>';
		
			$html .= '</label>';
		}
		$html .= '</div>'; //.ppom-palettes
        
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // Image type
    public function Image( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        $classes    = isset($args['classes']) ? $args['classes'] : '';
	    
	    // Only title withou description for price calculation etc.
        $title      = $args['title'];
        
	    // Options
		$images    = isset($args['images']) ? $args['images'] : '';
		if ( ! $images ) return __("Images not selected", 'ppom');

        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        // ppom_pa($args);
        if (isset($args['legacy_view']) && $args['legacy_view'] == 'on') {
	        $html .= '<div class="ppom_upload_image_box">';
			foreach ($images as $image){
						
				$image_full   = isset($image['link']) ? $image['link'] : 0;
				$image_id   = isset($image['id']) ? $image['id'] : 0;
				$image_title= isset($image['title']) ? stripslashes($image['title']) : 0;
				$image_price= isset($image['price']) ? $image['price'] : 0;

	            // Actually image URL is link
				$image_link = isset($image['url']) ? $image['url'] : '';
				$image_url  = wp_get_attachment_thumb_url( $image_id );
				$image_title_price = $image_title . ' ' . ($image_price > 0 ? '(+'.wc_price($image_price).')' : '');
				
				$checked_option = '';
				if( ! empty($default_value) ){
	        
	                $checked = ($image['title'] == $default_selected ? 'checked = "checked"' : '' );
	                $checked_option = checked( $default_value, $key, false );
	            }
				
				$html .= '<div class="pre_upload_image">';
				
				if( !empty($image_link) ) {
				    $html .= '<a href="'.esc_url($image_link).'"><img class="img-thumbnail" src="'.esc_url($image_url).'" /></a>';
				} else {
				    $html .= '<img data-toggle="modal" class="img-thumbnail"  data-target="#modalImage'.esc_attr($image_id).'" src="'.esc_url($image_url).'" />';
				}
				
				// Loading Modals
				$modal_vars = array('image_id' => $image_id, 'image_full'=>$image_full, 'image_title'=>$image_title_price);
				ppom_load_template('v10/image-modals.php', $modal_vars);
				?>
				
				<?php
					
				$html	.= '<div class="input_image">';
				if ($args['multiple_allowed'] == 'on') {
					$html	.= '<input type="checkbox" ';
					$html   .= 'data-price="'.esc_attr($image_price).'" ';
					$html   .= 'data-label="'.esc_attr($image_title).'" ';
					$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
					$html   .= 'name="'.$args['name'].'[]" ';
					$html   .= 'value="'.esc_attr(json_encode($image)).'" />';
				}else{
					
					//default selected
					$checked = ($image['title'] == $default_value ? 'checked = "checked"' : '' );
					$html	.= '<input type="radio" ';
					$html   .= 'data-price="'.esc_attr($image_price).'"';
					$html   .= 'data-label="'.esc_attr($image_title).'" ';
					$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
					$html   .= 'data-type="'.esc_attr($type).'" name="'.$args['name'].'[]" ';
					$html   .= 'value="'.esc_attr(json_encode($image)).'" '.$checked_option.' />';
				}
					
			    $html	.= '<div class="p_u_i_name">'.$image_title_price.'</div>';
				$html	.= '</div>';	//input_image
					
					
				$html .= '</div>';  // pre_upload_image
			}
			
			$html .= '</div>'; //.ppom_upload_image_box
        	
        } else {
			$html .= '<div class="nm-boxes-outer">';
				
			$img_index = 0;
			
			if ($images) {
				
				foreach ($images as $image){

					$image_full   = isset($image['link']) ? $image['link'] : 0;
					$image_id   = isset($image['id']) ? $image['id'] : 0;
					$image_title= isset($image['title']) ? stripslashes($image['title']) : 0;
					$image_price= isset($image['price']) ? $image['price'] : 0;

		            // Actually image URL is link
					$image_link = isset($image['url']) ? $image['url'] : '';
					$image_url  = wp_get_attachment_thumb_url( $image_id );
					$image_title_price = $image_title . ' ' . ($image_price > 0 ? '(+'.wc_price($image_price).')' : '');
					
					$checked_option = '';
					if( ! empty($default_value) ){
		        
		                $checked = ($image['title'] == $default_selected ? 'checked = "checked"' : '' );
		                $checked_option = checked( $default_value, $key, false );
		            }					
						
					$html .= '<label>';
					$html .= '<div class="pre_upload_image" ';
					$html .= 'title="'.esc_attr($image_title_price).'" data-html="true" data-toggle="tooltip">';
						if ($args['multiple_allowed'] == 'on') {
							$html	.= '<input type="checkbox" ';
							$html   .= 'data-price="'.esc_attr($image_price).'" ';
							$html   .= 'data-label="'.esc_attr($image_title).'" ';
							$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
							$html   .= 'name="'.$args['name'].'[]" ';
							$html   .= 'value="'.esc_attr(json_encode($image)).'" />';
						}else{
							
							//default selected
							$checked = ($image['title'] == $default_value ? 'checked = "checked"' : '' );
							$html	.= '<input type="radio" ';
							$html   .= 'data-price="'.esc_attr($image_price).'"';
							$html   .= 'data-label="'.esc_attr($image_title).'" ';
							$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
							$html   .= 'data-type="'.esc_attr($type).'" name="'.$args['name'].'[]" ';
							$html   .= 'value="'.esc_attr(json_encode($image)).'" '.$checked_option.' />';
						}
					if($image['id'] != ''){
						if( isset($image['url']) && $image['url'] != '' ) {
							$html .= '<a href="'.$image['url'].'"><img src="'.wp_get_attachment_thumb_url( $image['id'] ).'" /></a>';
						} else {
						    
						    $image_url = wp_get_attachment_thumb_url( $image['id'] );
							$html .= '<img data-image-tooltip="'.wp_get_attachment_url($image['id']).'" class="img-thumbnail ppom-zoom" src="'.esc_url($image_url).'" />';
						}
						
					}else{
						if( isset($image['url']) && $image['url'] != '' )
							$html .= '<a href="'.$image['url'].'"><img width="150" height="150" src="'.esc_url($image['link']).'" /></a>';
						else {
							$html .= '<img class="img-thumbnail ppom-zoom" data-image-tooltip="'.esc_url($image['link']).'" src="'.esc_url($image['link']).'" />';
						}
					}
					
					$html .= '</div></label>';
						
					$img_index++;
				}
			}
			
			$html .= '<div style="clear:both"></div>';	
				
			$html .= '</div>';		//nm-boxes-outer
        }
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // A custom input will be just some option html
    public function Pricematrix( $args, $default_value = '' ) {
         
        $id         = $this -> get_attribute_value( 'id', $args);
        $type       = $this -> get_attribute_value( 'type', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        $ranges     = $args['ranges'];
        $discount   = $args['discount'];
        
        // ppom_pa($ranges);
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        foreach($ranges as $opt)
		{
			$price = isset( $opt['price'] ) ? trim($opt['price']) : 0;
			if( !empty($opt['percent']) ){
				
				$percent = $opt['percent'];
				if( $discount == 'on' ) {
				    $price = "-{$percent}";
				} else {
				    $price = "{$percent} (".wc_price( $price ).")";
				}
				
			}else {
				$price = wc_price( $price );	
			}
			
			$html .= '<div style="clear:both;border-bottom:1px #ccc dashed;">';
			$html .= '<span>'.stripslashes(trim($opt['raw'])).'</span>';
			$html .= '<span style="float:right">'.$price.'</span>';
			$html .= '</div>';
		}
		
		// Showing Range Slider
		if( isset($args['show_slider']) && $args['show_slider'] == 'on' ) {
		    $last_range = end($ranges);
			$qty_ranges = explode('-', $last_range['raw']);
			$max_quantity	= $qty_ranges[1];
			
		    $html   .= '<div class="ppom-slider-container">';
		    $html   .= '<input class="ppom-range-slide" data-slider-id="ppomSlider" ';
		    $html   .= 'type="text" data-slider-min="0" data-slider-max="'.esc_attr($max_quantity).'" data-slider-step="'.esc_attr($args['qty_step']).'" data-slider-value="0"/>';
		    $html   .= '</div>';
		}
        
        $html   .= '</div>';    //form-group
        
        $html   .= '<input name="ppom[ppom_pricematrix]" data-discount="'.esc_attr($discount).'" id="ppom_pricematrix" type="hidden" value="'.esc_attr( json_encode($ranges)).'" />';
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // Variation Quantities
    public function Quantities( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="ppom-input-quantities '.$input_wrapper_class.' table-responsive">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $template_vars = array('args' => $args);
        ob_start();
        ppom_load_template( 'v10/input/quantities.php', $template_vars);
        $html .= ob_get_clean();
        
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // HTML or Text (section)
    public function Section( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $field_html = $this -> get_attribute_value( 'html', $args);
        
        // var_dump($field_html);
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
       
        
        $html   .= stripslashes( $field_html );
        
        $html .= '<div style="clear: both"></div>';
        
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // Audio/video
    public function Audio_video( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        $classes    = isset($args['classes']) ? $args['classes'] : '';
	    
	    // Only title withou description for price calculation etc.
        $title      = $args['title'];
        
	    // Options
		$audios    = isset($args['audios']) ? $args['audios'] : '';
		if ( ! $audios ) return __("audios not selected", 'ppom');

        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        // ppom_pa($audios);
        $html .= '<div class="ppom_audio_box">';
		foreach ($audios as $audio){
					
			
			$audio_link = isset($audio['link']) ? $audio['link'] : 0;
			$audio_id   = isset($audio['id']) ? $audio['id'] : 0;
			$audio_title= isset($audio['title']) ? stripslashes($audio['title']) : 0;
			$audio_price= isset($audio['price']) ? $audio['price'] : 0;

            // Actually image URL is link
			$audio_url  = wp_get_attachment_url( $audio_id );
			$audio_title_price = $audio_title . ' ' . ($audio_price > 0 ? wc_price($audio_price) : '');
			
			$checked_option = '';
			if( ! empty($default_value) ){
        
                $checked = ($audio['title'] == $default_selected ? 'checked = "checked"' : '' );
                $checked_option = checked( $default_value, $key, false );
            }
			
			$html .= '<div class="ppom_audio">';
			
			if( !empty($audio_url) ) {
			    $html .= apply_filters( 'the_content', $audio_url );
			}
			
			?>
			
			<?php
				
			$html	.= '<div class="input_image">';
			if ($args['multiple_allowed'] == 'on') {
				$html	.= '<input type="checkbox" ';
				$html   .= 'data-price="'.esc_attr($audio_price).'" ';
				$html   .= 'data-label="'.esc_attr($audio_title).'" ';
				$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
				$html   .= 'name="'.$args['name'].'[]" ';
				$html   .= 'value="'.esc_attr(json_encode($audio)).'" />';
			}else{
				
				//default selected
				$checked = ($audio['title'] == $default_value ? 'checked = "checked"' : '' );
				$html	.= '<input type="radio" ';
				$html   .= 'data-price="'.esc_attr($audio_price).'"';
				$html   .= 'data-label="'.esc_attr($audio_title).'" ';
				$html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
				$html   .= 'data-type="'.esc_attr($type).'" name="'.$args['name'].'[]" ';
				$html   .= 'value="'.esc_attr(json_encode($audio)).'" '.$checked_option.' />';
			}
				
		    $html	.= '<div class="p_u_i_name">'.$audio_title_price.'</div>';
			$html	.= '</div>';	//input_image
				
				
			$html .= '</div>';  // pre_upload_image
		}
		
		$html .= '</div>'; //.ppom_upload_image_box
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // File Upload
    public function File( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        
        $html       = '<div id="ppom-file-container-'.esc_attr($args['id']).'" class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        

        $container_height = isset($args['dragdrop']) ? 'auto' : '30px' ;
        $html .= '<div class="ppom-file-container text-center" ';
        $html .= 'style="height: '.esc_attr($container_height).' ;">';
			$html .= '<a id="selectfiles-'.esc_attr($args['id']).'" ';
			$html .= 'href="javascript:;" ';
			$html .= 'class="btn btn-primary '.esc_attr($args['button_class']).'">';
			$html .= $args['button_label'] . '</a>';
			$html .= '<span class="ppom-dragdrop-text">'.__('Drag file(s) here', 'ppom').'</span>';
		$html .= '</div>';		//ppom-file-container

		if($args['dragdrop']){
			
			$html .= '<div class="ppom-droptext">';
				$html .= __('Drag file/directory here', 'ppom');
			$html .= '</div>';
		}
    	
    	$html .= '<div id="filelist-'.esc_attr($args['id']).'" class="filelist"></div>';
        
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // Cropper
    public function Cropper( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        
        $html       = '<div id="ppom-file-container-'.esc_attr($args['id']).'" class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $container_height = isset($args['dragdrop']) ? 'auto' : '30px' ;
        $html .= '<div class="ppom-file-container text-center" ';
        $html .= 'style="height: '.esc_attr($container_height).' ;">';
			$html .= '<a id="selectfiles-'.esc_attr($args['id']).'" ';
			$html .= 'href="javascript:;" ';
			$html .= 'class="btn btn-primary '.esc_attr($args['button_class']).'">';
			$html .= $args['button_label'] . '</a>';
			$html .= '<span class="ppom-dragdrop-text">'.__('Drag file/directory here', 'ppom').'</span>';
		$html .= '</div>';		//ppom-file-container

		if($args['dragdrop']){
			
			$html .= '<div class="ppom-droptext">';
				$html .= __('Drag file/directory here', 'ppom');
			$html .= '</div>';
		}
    	
    	$html .= '<div id="filelist-'.esc_attr($args['id']).'" class="filelist"></div>';
    	
    	$html   .= '<div class="ppom-croppie-wrapper-'.esc_attr($args['id']).' text-center">';
    	$html   .= '<div class="ppom-croppie-preview"></div>';
    	$html   .= '<a href="#" data-fileid="'.esc_attr($args['id']).'" class="btn btn-info ppom-croppie-btn">';
    	$html   .= __('Confirm and Preview', 'ppom').'</a>';
    	$html   .= '</div>'; //ppom-croppie-wrapper
    	// Loading Modals
		$modal_vars = array('file_id' => $args['id'], 'image_full'=>'', 'image_title'=>$args['label']);
		ob_start();
        ppom_load_template('v10/cropper-modals.php', $modal_vars);
        $html .= ob_get_clean();
        
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    // A custom input will be just some option html
    public function Custom( $args, $default_value = '' ) {
         
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        $html       = '<div class="'.$input_wrapper_class.'">';
        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $html   .= apply_filters('nmform_custom_input', $html, $args, $default_value);
        
        $html   .= '</div>';    //form-group
        
        // filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $default_value);
    }
    
    
    // Fixed Price Addon
    public function FixedPriceAddon( $args, $selected_value = '' ) {
        
        $type       = $this -> get_attribute_value( 'type', $args);
        $id         = $this -> get_attribute_value( 'id', $args);
        $label      = $this -> get_attribute_value( 'label', $args);
        $name       = $this -> get_attribute_value('name', $args);
        $classes    = $this -> get_attribute_value('classes', $args);
        $attributes = $this -> get_attribute_value('attributes', $args);
		
		// Only title without description for price calculation etc.
        $title      = $args['title'];
        
		// Options
		$options    = isset($args['options']) ? $args['options'] : '';
		
        if ( ! $options ) return;
       
        $input_wrapper_class = $this->get_default_setting_value('global', 'input_wrapper_class', $id);
        $input_wrapper_class = apply_filters('ppom_input_wrapper_class', $input_wrapper_class, $args);
        
        $html       = '<div class="ppom-input-fixedprice ppom-unlocked '.$input_wrapper_class.'">';
        

        if( $label ){
            $html   .= '<label class="'.$this->get_default_setting_value('global', 'label_class', $id).'" for="'.$id.'">';
            $html   .= sprintf(__("%s", "ppom"), $label) .'</label>';
        }
        
        $html       .= '<select ';
        $html       .= 'id="'.esc_attr($id).'" ';
        $html       .= 'name="'.esc_attr($name).'" ';
        $html       .= 'class="'.esc_attr($classes).'" ';
        
        // Attributes
        foreach($attributes as $attr => $value) {
            
            $html      .= esc_attr($attr) . '="'.esc_attr($value).'" ';
        }
        
        $html       .= '>';  // Closing select
        
        // ppom_pa($options);
        foreach($options as $key => $value) {
            
            // for multiple selected
            
            $option_label   = $value['label'];
            $option_price   = $value['price'];
            $raw_label      = $value['raw'];
            $unit_price     = 0;
            $fixed_qty      = 0;
            if( $value['price'] ) {
                $unit_price     = $value['price']/$value['raw'];
                $fixed_qty      = $value['raw'];
            }
            
            if( is_array($selected_value) ){
            
                foreach($selected_value as $s){
                    $html   .= '<option '.selected( $s, $key, false ).' value="'.esc_attr($key).'" ';
                    $html   .= 'data-price="'.esc_attr($option_price).'" ';
                    $html   .= 'data-label="'.esc_attr($option_label).'"';
                    $html   .= 'data-unitprice="'.esc_attr($unit_price).'"'; 
                    $html   .= 'data-qty="'.esc_attr($fixed_qty).'"';
                    $html   .= '>'.$option_label.'</option>';
                }
            } else {
                $html   .= '<option '.selected( $selected_value, $key, false ).' ';
                $html   .= 'value="'.esc_attr($key).'" ';
                $html   .= 'data-price="'.esc_attr($option_price).'" ';
                $html   .= 'data-label="'.esc_attr($raw_label).'"';
                $html   .= 'data-title="'.esc_attr($title).'"'; // Input main label/title
                $html   .= 'data-unitprice="'.esc_attr($unit_price).'"'; 
                $html   .= 'data-qty="'.esc_attr($fixed_qty).'"';
                $html   .= '>'.$option_label.'</option>';
            }
        }
        
        $html .= '</select>';
        $html      .= '</div>';    //form-group
        
    	// filter: nmforms_input_htmls
        return apply_filters("nmforms_input_html", $html, $args, $selected_value);
    }
    
    
    
    
    /**
     * this function return current or/else default attribute values
     * 
     * filter: nmform_attribute_value
     * 
     * */
    private function get_attribute_value( $attr, $args ) {
        
        $attr_value = '';
        $type       = isset($args['type']) ? $args['type'] : $this->get_default_setting_value('global', 'type');
        
        // if( $attr == 'type' ) return $type;
        
        if( isset($args[$attr]) ){
            
            $attr_value = $args[$attr];
        } else {
            
            $attr_value = $this->get_default_setting_value( $type, $attr );
        }
        
        return apply_filters('nmform_attribute_value', $attr_value, $attr, $args);
    }
    
    
    /**
     * this function return default value
     * defined in class/config
     * 
     * @params: $setting_type
     * @params: $key
     * filter: default_setting_value
     * */
    function get_default_setting_value( $setting_type, $key, $field_id = '' ){
        
        $defaults = $this -> get_property( 'defaults' );
        
        $default_value = isset( $defaults[$setting_type][$key] ) ? $defaults[$setting_type][$key] : '';
        
        return apply_filters('default_setting_value', $default_value, $setting_type, $key, $field_id);
    }
    
    
    /**
     * function return class property values/settings
     * 
     * filter: nmform_property-{$property}
     * */
    private function get_property( $property ) {
        
        $value = '';
        switch( $property ) {
            
            case 'echoable':
                    $value = ECHOABLE;
            break;
            
            case 'defaults':
                
                    $value =  array(
                                    'global'   => array('type' => 'text',
                                                        'input_wrapper_class'=>'form-group',
                                                        'label_class'   => 'form-control-label',),
                                    'text'      => array('placeholder' => "", 'attributes' => array()),
                                    'date'      => array(),
                                    'email'     => array(),
                                    'number'    => array(),
                                    'textarea'  => array('cols' => 6, 'rows' => 3),
                                    'select'    => array('multiple' => false),
                                    'checkbox'  => array('label_class' => 'form-control-label',
                                                        'check_wrapper_class' => 'form-check',
                                                        'check_label_class' => 'form-check-label',
                                                        'classes' => array('ppom-check-input')),
                                    'radio'     => array('label_class' => 'form-control-label',
                                                        'radio_wrapper_class' => 'form-check',
                                                        'radio_label_class' => 'form-check-label',
                                                        'classes' => array('ppom-check-input')),
                    );
            break;
        }
        
        return apply_filters("nmform_property-{$property}", $value);
        
    }
    
    
    /**
     * ====================== FILTERS =====================================
     * 
     * */
     
    public function adjust_attributes_values( $attr_value, $attr, $args ) {
        
        switch( $attr ) {
            
            // converting classes to string
            case 'classes':
                $attr_value = implode(" ", $attr_value);
            break;
            
            /**
             * converting name to array for multiple:select
             * */
            case 'name':
                
                $type       = $this -> get_attribute_value( 'type', $args);
                $multiple   = $this -> get_attribute_value('multiple', $args);
                if( $type == 'select' && $multiple ){
                    
                    $attr_value .= '[]';
                }
            break;
        }
        
        return $attr_value;
    }
    
    /**
     * ====================== ENDs FILTERS =====================================
     * 
     * */
    
    public static function get_instance()
	{
		// create a new object if it doesn't exist.
		is_null(self::$ins) && self::$ins = new self;
		return self::$ins;
	}
}

function NMForm(){
	return NM_Form::get_instance();
}