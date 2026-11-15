<?php
/*
 * Footer Section
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Footer', 'archub' ),
	'icon'   => 'fa fa-folder',
	'fields' => array(
		array(
			'id'       => 'footer-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable footer', 'archub' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'archub' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'archub' ),
				'off' => esc_html__( 'Off', 'archub' ),
			)
		),
		array(
 			'id'=>'footer-template',
 			'type' => 'select',
 			'title' => esc_html__('Footer template', 'archub'),
 			'subtitle'=> esc_html__('Select a footer template for your website.', 'archub'),
 			'data' => 'post',
			'args' => array( 'post_type' => 'liquid-footer', 'posts_per_page' => -1 )
 		),
		array(
			'id'      => 'footer-force',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Force footer template site-wide?', 'archub' ),
			'subtitle'   => esc_html__( 'Override single post/page footer settings to show the same footer template site-wide', 'archub' ),
			'options' => array(
				'off'    => esc_html__( 'No', 'archub' ),
				'on' => esc_html__( 'Yes', 'archub' ),
			),
			'default' => 'off',
			'required' => array(
                'footer-template',
                '!=',
                ''
            ),
		),
		
	)
);
