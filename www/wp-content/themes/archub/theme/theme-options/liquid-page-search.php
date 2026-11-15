<?php
/*
 * Page 404
*/

$this->sections[] = array (
	'title'  => esc_html__( 'Search Page', 'archub' ),
	'icon'   => 'el el-search',
	'fields' => array(

		array(
			'id'       => 'search-header-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Search Page Header', 'archub' ),
			'subtitle' => esc_html__( 'Choose a header for search result pages.', 'archub'),
			'data'     => 'post',
			'args'     => array( 
				'post_type'      => 'liquid-header', 
				'posts_per_page' => -1 
			)
		),
		array(
			'id'       => 'search-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Search Page Title', 'archub' ),
			'subtitle' => esc_html__( 'Switch on to display the titlebar for the search result pages.', 'archub' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'archub' ),
				'off'  => esc_html__( 'Off', 'archub' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'search-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Search Page Subtitle', 'archub' ),
			'subtitle' => esc_html__( 'Define a default subtitle for the search result pages.', 'archub' )
		),
		array(
			'id'      => 'search-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'archub' ),
			'options' => array(
				'style01' => esc_html__( 'Style 1', 'archub' ),
				'style02' => esc_html__( 'Style 2', 'archub' ),
				'style03' => esc_html__( 'Style 3', 'archub' ),
				'style04' => esc_html__( 'Style 4', 'archub' ),
				'style05' => esc_html__( 'Style 5', 'archub' ),
				'style06' => esc_html__( 'Style 6', 'archub' ),
				'style07' => esc_html__( 'Style 7', 'archub' ),
				'style08' => esc_html__( 'Style 8', 'archub' ),
				'style09' => esc_html__( 'Style 9', 'archub' ),
				'style10' => esc_html__( 'Style 10', 'archub' ),
				'style11' => esc_html__( 'Style 11', 'archub' ),
				'style12' => esc_html__( 'Style 12', 'archub' ),
				'style13' => esc_html__( 'Style 13', 'archub' ),
				'style14' => esc_html__( 'Style 14', 'archub' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'archub' ),
			'default'  => 'style01'
		),
		array(
			'id'      => 'blog-search-columns',
			'type'    => 'select',
			'title'   => esc_html__( 'Columns', 'archub' ),
			'options' => array(
				'1'       => esc_html__( '1 Column', 'archub' ),
				'2'       => esc_html__( '2 Columns', 'archub' ),
				'3'       => esc_html__( '3 Columns', 'archub' ),
				'4'       => esc_html__( '4 Columns', 'archub' ),
			),
			'subtitle' => esc_html__( 'How many columns to show for your blog category page.', 'archub' ),
			'default'  => '1'
		),
		array(
			'id'    => 'search-blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Meta', 'archub' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'archub' ),
				'no' => esc_html__( 'No', 'archub' ),
			),
			'subtitle' => esc_html__( 'Manage the meta for posts', 'archub' ),
			'default'  => 'yes'
		),
		array(
			'id'    => 'search-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'archub' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'archub' ),
				'cats' => esc_html__( 'Categories', 'archub' ),
			),
			'subtitle' => esc_html__( 'Manage the meta type for posts', 'archub' ),
			'default'  => 'tags',
			'required' => array(
				'search-blog-show-meta',
				'equals',
				'yes'
			)
		),
		array(
			'id'    => 'search-blog-one-category',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Single Category', 'archub' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'archub' ),
				'no' => esc_html__( 'No', 'archub' ),
			),
			'default'  => 'yes',
			'required' => array(
				'search-blog-meta-type',
				'equals',
				'cats'
			)	
		),
		array(
			'id'       => 'search-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Default Blog Excerpt Length', 'archub' ),
			'validate' => 'numeric',
			'default'  => '20',
		),
		
	)
);
