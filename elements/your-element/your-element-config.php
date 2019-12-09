<?php
/*
Element Description: Your Element Description
 */

// Element Class



class YourElement extends WPBakeryShortCode {
    public function __construct() {
        add_action('init', array($this, 'your_element_mapping'));
        add_shortcode('your_element_shortcode', array($this, 'your_element_html'));
    }

    public function your_element_mapping() {
        // Stop all if VC is not enabled
        if (!defined('WPB_VC_VERSION')) {
            return;
        }
        
        vc_map(
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'Your heading',
                'param_name' => 'your_element_param_name',
                "description" => __("Enter a description for this element"),
                "std" => "default value"
            )
        );
    }

    public function your_element_html($atts) {
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'your_element_param_name' => '',
                ),
                $atts
            )
        );

        
        
        require_once 'your-element-markup.php';
        ob_start();
        your_element_markup();
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

}









new YourElement();
