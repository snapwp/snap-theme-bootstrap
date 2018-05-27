<?php

return [
	/*
     * The default upload quality of image media.
     * 
     * Smaller numbers give smaller uploaded image sizes, but with reduced image quality. 
     * Setting to 100 will actually increase uploaded image size!
     */
    'default_image_quality' => 75,


    /*
     * The location of the placeholder directory relative to the current theme folder.
     *
     * Set to false to not use placeholders.
     */
	'placeholder_dir' => 'assets/dist/images/placeholders/',


	/*
	 * An array of post types to enable featured images for.
	 * Set to false or an empty array to remove thumbnail support entirely.
	 *
	 * @see  https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
	 */
	'supports_featured_images' => [
		'post',
		'page',
	],


	/*
	 * Set to true to remove all default image sizes apart from full size.
	 *
	 * We would recommend leaving this as true, and then defining your own image sizes below.
	 * This way the uploads directory clutter is reduced and the site takes up less space.
	 */
    'reset_image_sizes' => true,


    /*
     * Defines all image sizes for the site.
     *
     * The array key is the image size for use within your theme, and the value is an array which has the 
     * remaining params from @See https://developer.wordpress.org/reference/functions/add_image_size/. 
     *
     * There is an additional value which if set, will make the image size available using this text when
     * a user is inserting an image into a post - in the selection drop down.
     *
     * The drop down name can be omitted to not allow a user to insert the size directly.
     * 
     * Examples:
     * 'developer_use_only' => [100, 100, true],
     * 'size' => [99999, 99999, false, 'Massive image'],
     */
    'image_sizes' => [
    	'post_featured_image' => [730, 99999, false, 'Full width']
    ],


    /*
     * The default size selected when a user is inserting an image into a post via the editor.
     */
    'insert_image_default_size' => 'medium',    


    /*
     * Whether the full uploaded image size is available to a user when inserting an image.
     */
    'insert_image_allow_full_size' => true,
];