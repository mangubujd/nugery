<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Typography', 'archub' ),
	'icon'   => 'el el-text-height'
);

// Custom Fonts
$this->sections[] = array(
	'title'      => esc_html__( 'Custom fonts', 'archub' ),
	'subsection' => true,
	'fields'     => array(
		
		array(
			'id' => 'liquid_custom_fonts',
			'type' => 'repeater',
			'title'    => esc_html__( 'Add Custom Fonts', 'archub' ),
			'subtitle' => esc_html__( 'Upload custom font. All files are not necessary but are recommended for full browser support. You can upload as many custom fonts as you need. Click the "Add" button for additional upload boxes.', 'archub' ),
			'sortable' => false,
			'group_values' => false,
			'fields' => array(
				
				array(
					'id' => 'custom_font_title',
					'type' => 'text',
					'title'    => esc_html__( 'Font title', 'archub' ),
				),
				array(
					'id'    => 'custom_font_woff2',
					'type'  => 'text',	
					'title' => esc_html__( 'WOFF2', 'archub' ),
				),
				array(
					'id'    => 'custom_font_woff',
					'type'  => 'text',	
					'title' => esc_html__( 'WOFF', 'archub' ),
				),
				array(
					'id'    => 'custom_font_ttf',
					'type'  => 'text',	
					'title' => esc_html__( 'TTF', 'archub' ),
				),
				array(
					'id'    => 'custom_font_weight',
					'type'  => 'text',	
					'title' => esc_html__( 'Font Weight', 'archub' ),
				),
				
			)
		)
	)
);

// Local Fonts
$this->sections[] = array(
	'title'      => esc_html__( 'Local Fonts', 'hub' ),
	'subsection' => true,
	'fields'     => array(
		array(
            'id' => 'enable-hub-local-fonts',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Load Google Fonts on Locally', 'archub' ),
            'subtitle' => esc_html__( 'This option allows Google Fonts to be loaded through your website, which can be useful for some GDPR situations.', 'archub' ),
            'options'  => array(
                'on'   => esc_html__( 'On', 'hub' ),
                'off'  => esc_html__( 'Off', 'hub' ),
            ),
            'default' => 'off'
        ),
	)
);

