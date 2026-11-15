<?php
/*
 * Api keys Section
*/
//APP Api Keys
$this->sections[] = array(
	'title'      => esc_html__( 'API Keys', 'archub' ),
	'icon'   => 'el el-key',
	'fields'     => array(
		array(
			'id'       => 'google-api-key',
			'type'     => 'text',
			'title'    => esc_html__( 'Google Maps API Key', 'archub' ),
			'desc'     => wp_kses( __( 'Follow the steps in <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key#key">the Google docs</a> to get the API key. This key applies to the google map element.', 'archub' ), 'a' )
		),
		array(
			'id'       => 'mailchimp-api-key',
			'type'     => 'text',
			'title'    => esc_html__( 'Mailchimp API Key', 'archub' ),
			'desc'     => wp_kses( __( 'Follow the steps <a href="https://mailchimp.com/help/about-api-keys/">MailChimp</a> to get the API key. This key applies to the newsletter element.', 'archub' ), 'a' ), 
		),
		array(
			'id'       => 'liquid_mailchimp_text__missing_api',
			'type'     => 'text',
			'title'    => esc_html__( 'Mailchimp Missing API Text', 'archub' ),
			'default'  => esc_html__( 'Please, input the MailChimp Api Key in Theme Options Panel', 'archub' ),
			'desc'     => esc_html__( 'Please, input the MailChimp Api Key in Theme Options Panel', 'archub' ),
			'required' => array(
				'mailchimp-api-key',
				'!=',
				''
			)
		),
		array(
			'id'       => 'liquid_mailchimp_text__missing_list',
			'type'     => 'text',
			'title'    => esc_html__( 'Mailchimp Missing List Text', 'archub' ),
			'default'  => esc_html__( 'Wrong List ID, please select a real one', 'archub' ),
			'desc'     => esc_html__( 'Wrong List ID, please select a real one', 'archub' ),
			'required' => array(
				'mailchimp-api-key',
				'!=',
				''
			)
		),
		array(
			'id'       => 'liquid_mailchimp_text__thanks',
			'type'     => 'text',
			'title'    => esc_html__( 'Mailchimp Thank you Text', 'archub' ),
			'default'  => esc_html__( 'Thank you, you have been added to our mailing list.', 'archub' ),
			'desc'     => esc_html__( 'Thank you, you have been added to our mailing list.', 'archub' ),
			'required' => array(
				'mailchimp-api-key',
				'!=',
				''
			)
		),
		array(
			'id'       => 'liquid_mailchimp_text__member_exists',
			'type'     => 'text',
			'title'    => esc_html__( 'Mailchimp Member Exists', 'archub' ),
			'default'  => esc_html__( '[email] is already a list member. Use PUT to insert or update list members.', 'archub' ),
			'desc'     => esc_html__( '[email] is already a list member. Use PUT to insert or update list members.', 'archub' ),
			'required' => array(
				'mailchimp-api-key',
				'!=',
				''
			)
		),
	)
);
