<?php 

//Define customizer sections
if(!function_exists('cpotheme_metadata_panels')){
	function cpotheme_metadata_panels(){
		$data = array();
		
		$data['cpotheme_layout'] = array(
		'title' => __('Layout', 'intuition'),
		'description' => __('Here you can find settings that control the structure and positioning of specific elements within your website.', 'intuition'),
		'priority' => 25);
		
		return apply_filters('cpotheme_customizer_panels', $data);
	}
}


//Define customizer sections
if(!function_exists('cpotheme_metadata_sections')){
	function cpotheme_metadata_sections(){
		$data = array();
		
		$data['cpotheme_management'] = array(
		'title' => __('General Theme Options', 'intuition'),
		'description' => __('Options that help you manage your theme better.', 'intuition'),
		'capability' => 'edit_theme_options',
		'priority' => 15);
		
		$data['cpotheme_layout_general'] = array(
		'title' => __('Site Wide Structure', 'intuition'),
		'description' => sprintf(__('Upgrade to %s to control the layout of your sidebars and other global elements.', 'intuition'), cpotheme_upgrade_link()),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 25);
		
		$data['cpotheme_layout_home'] = array(
		'title' => __('Homepage', 'intuition'),
		'description' => sprintf(__('Upgrade to %s to control the ordering of elements in the homepage as well as its behavior.', 'intuition'), cpotheme_upgrade_link()),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 50);
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
			$data['cpotheme_layout_slider'] = array(
			'title' => __('Slider', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to customize the behavior of the slider.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_TAGLINE') && CPOTHEME_USE_TAGLINE == true){
			$data['cpotheme_layout_tagline'] = array(
			'title' => __('Tagline', 'intuition'),
			'description' => __('Customize the appearance and of the homepage tagline.', 'intuition'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
			$data['cpotheme_layout_features'] = array(
			'title' => __('Features', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to customize the columns and appearance of the feature blocks.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){
			$data['cpotheme_layout_portfolio'] = array(
			'title' => __('Portfolio', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to control the number of portfolio columns, related portfolio items, and overall appearance.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
			$data['cpotheme_layout_services'] = array(
			'title' => __('Services', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to control the number of columns for services.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
			$data['cpotheme_layout_team'] = array(
			'title' => __('Team Members', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to control the number of columns of the team section.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
			$data['cpotheme_layout_testimonials'] = array(
			'title' => __('Testimonials', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to customize the appearance of testimonials.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
			$data['cpotheme_layout_clients'] = array(
			'title' => __('Clients', 'intuition'),
			'description' => sprintf(__('Upgrade to %s to customize the appearance of clients.', 'intuition'), cpotheme_upgrade_link()),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		$data['cpotheme_typography'] = array(
		'title' => __('Typography', 'intuition'),
		'description' => __('Custom typefaces for the entire site.', 'intuition'),
		'capability' => 'edit_theme_options',
		'priority' => 45);

		$data['cpotheme_layout_posts'] = array(
		'title' => __('Blog Posts', 'intuition'),
		'description' => sprintf(__('Upgrade to %s to control the appearance of specific elements in your blog posts such as dates, authors, or comments.', 'intuition'), cpotheme_upgrade_link()),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 50);
		
		$data['cpotheme_typography'] = array(
		'title' => __('Typography', 'intuition'),
		'description' => sprintf(__('Upgrade to %s to control the gain full control over the typography of your site.', 'intuition'), cpotheme_upgrade_link()),
		'capability' => 'edit_theme_options',
		'priority' => 45);
		
		return apply_filters('cpotheme_customizer_sections', $data);
	}
}


if(!function_exists('cpotheme_metadata_customizer')){
	function cpotheme_metadata_customizer($std = null){
		$data = array();
		
		$data['general_logo'] = array(
		'label' => __('Custom Logo', 'intuition'),
		'description' => __('Insert the URL of an image to be used as a custom logo.', 'intuition'),
		'section' => 'title_tagline',
		'sanitize' => 'esc_url',
		'type' => 'image');
		
		$data['general_logo_width'] = array(
		'label' => __('Logo Width (px)', 'intuition'),
		'description' => __('Forces the logo to have a specified width.', 'intuition'),
		'section' => 'title_tagline',
		'type' => 'text',
		'placeholder' => '(none)',
		'sanitize' => 'absint',
		'width' => '100px');
		
		$data['general_texttitle'] = array(
		'label' => __('Enable Text Title?', 'intuition'),
		'description' => __('Activate this to display the site title as text.', 'intuition'),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'std' => false);
		
		$data['general_editlinks'] = array(
		'label' => __('Show Edit Links', 'intuition'),
		'description' => __('Display edit links on the site layout for logged in users.', 'intuition'),
		'section' => 'cpotheme_management',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'std' => '1');
		
		//Homepage tagline
		if(defined('CPOTHEME_USE_TAGLINE') && CPOTHEME_USE_TAGLINE == true){
			$data['home_tagline'] = array(
			'label' => __('Tagline Title', 'intuition'),
			'section' => 'cpotheme_layout_tagline',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Add your custom tagline title here.', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Homepage Slider
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
			$data['slider_settings'] = array(
			'label' => __('Slider Options', 'intuition'),
			'description' => __('Customize the speed, timeout and effects of the homepage slider.', 'intuition'),
			'section' => 'cpotheme_layout_slider',
			'type' => 'label');
		}
		
		//Homepage Features
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
			$data['home_features'] = array(
			'label' => __('Features Description', 'intuition'),
			'section' => 'cpotheme_layout_features',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Our core features', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Portfolio layout
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){			
			$data['home_portfolio'] = array(
			'label' => __('Portfolio Description', 'intuition'),
			'section' => 'cpotheme_layout_portfolio',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Take a look at our work', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Services layout
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
			$data['home_services'] = array(
			'label' => __('Services Description', 'intuition'),
			'section' => 'cpotheme_layout_services',
			'empty' => true,
			'multilingual' => true,
			'default' => __('What we can offer you', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Services layout
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
			$data['home_team'] = array(
			'label' => __('Team Members Description', 'intuition'),
			'section' => 'cpotheme_layout_team',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Meet our team', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Testimonials
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
			$data['home_testimonials'] = array(
			'label' => __('Testimonials Description', 'intuition'),
			'section' => 'cpotheme_layout_testimonials',
			'empty' => true,
			'multilingual' => true,
			'default' => __('What they say about us', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Clients
		if(function_exists('ctct_setup') && defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
			$data['home_clients'] = array(
			'label' => __('Clients Description', 'intuition'),
			'section' => 'cpotheme_layout_clients',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Featured clients', 'intuition'),
			'sanitize' => 'wp_kses_post',
			'type' => 'text');
		}
		
		//Typography
		$data['type_settings'] = array(
		'label' => __('Typography Options', 'intuition'),
		'description' => __('Select custom fonts for the headings, navigation, and body text of your site.', 'intuition'),
		'section' => 'cpotheme_typography',
		'type' => 'label');
		
		//Colors		
		$data['color_settings'] = array(
		'label' => __('Color Options', 'intuition'),
		'description' => __('Customize the colors of primary and secondary elements, as well as headings, navigation, and text.', 'intuition'),
		'section' => 'colors',
		'type' => 'label');
		
		return apply_filters('cpotheme_customizer_controls', $data);
	}
}