if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_project',
		'title' => 'Project',
		'fields' => array (
			array (
				'key' => 'field_5314a8f629575',
				'label' => 'Gallery',
				'name' => 'gallery',
				'type' => 'gallery',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_parent',
					'operator' => '==',
					'value' => '7',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}