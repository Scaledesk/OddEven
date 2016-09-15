<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: https://docs.reduxframework.com
     * */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'rockon_framework' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'rockon_framework' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'rockon_framework' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'rockon_framework' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'rockon_framework' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'rockon_framework' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'rockon_framework' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'rockon_framework' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'rockon_framework' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'rockon_framework' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }
				
				$this->sections[] = array(
                    'type' => 'divide',
                );
				
				$this->sections[] = array(
                    'title'  => __( 'General Settings', 'rockon_framework' ),
                    'desc'   => __( '', 'rockon_framework' ),
                    'icon'   => 'el el-wrench', // change icon class
                    'fields' => array(
						array(
							'id'        => 'rockon_landingimgswitch',
							'type'      => 'switch',
							'title'     => __('Loading Image On Home Page', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => true,
						),
						array(
							'id'        => 'rockon_landingimgurl',
							'type'      => 'media',
							'required'	=> array('rockon_landingimgswitch','=', '1'),
							'title'     => __('Select Loading Image', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework')
						),
						array(
							'id'        => 'rockon_loadin_img',
							'type'      => 'switch',
							'title'     => __('Loading Image On every Page', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => true,
						),
						 array(
							'id'        => 'rockon_faviconurl',
							'type'      => 'media',
							'preview'   => false,
							'title'     => __('Custom Favicon', 'rockon_framework'),
							'desc'      => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
						),
						array(
							'id'        => 'rockon_audiotrackswitch',
							'type'      => 'switch',
							'title'     => __('Audio Track Player ( Enable/Disable )', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => false,
						),
						array(
							'id'        => 'rockon_weblogo',
							'type'      => 'media',
							'title'     => __('Website Logo', 'rockon_framework'),
							'desc'      => __('Upload image 165px x 47px for best result.', 'rockon_framework'),
							'subtitle'  => __('Upload your Logo Image.', 'rockon_framework'),
						),
						array(
							'id'        => 'rockon_sidebarposition',
							'type'      => 'image_select',
							'compiler'  => true,
							'title'     => __('Sidebar Position', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'desc'  => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout. <br><b>Note :</b> This option will work only for posts, pages have their own sidebar settings in their edit section', 'rockon_framework'),
							'options'   => array(
								'1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
								'2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
								'3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
							),
							'default'   => '3'
						),
						array(
							'id'        => 'rockon_copyrighttext',
							'type'      => 'text',
							'title'     => __('Copyright Text', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework')
						),
						array(
							'id'        => 'rockon_event_sharing',
							'type'      => 'switch',
							'title'     => __('Social Share Icon On Event', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => true,
						),
						array(
							'id'        => 'rockon_post_sharing',
							'type'      => 'switch',
							'title'     => __('Social Share Icon On Single Post', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => true,
						),
						array(
							'id'        => 'rockon_portfolio_sharing',
							'type'      => 'switch',
							'title'     => __('Social Share Icon On Single Portfolio', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => true,
						),
						array(
                            'id'       => 'rockon_language',
                            'type'     => 'select',
                            'title'    => __( 'Select Language To Show On Event Month', 'rockon_framework' ),
                            'subtitle' => __( '', 'rockon_framework' ),
                            'options'  => array('en_CA' => 'English (Canada)','fr_FR' => 'Français','bg_BG' => 'Български','bs_BA' =>'Bosanski',	'da_DK' => 'Dansk',	'de_CH' => 'Deutsch (Schweiz)',	'de_DE' => 'Deutsch',	'en_AU' => 'English (Australia)','en_GB' => 'English (UK)',	'es_ES' => 'Español',	'es_MX' => 'Español de México',	'es_PE' => 'Español de Perú',	'es_CL' => 'Español de Chile',	'fa_IR' => 'فارسی',	'gl_ES' => 'Galego',	'he_IL' => 'עִבְרִית',	'hu_HU' => 'Magyar',	'id_ID' => 'Bahasa Indonesia',	'it_IT' => 'Italiano',	'ko_KR' => '한국어',	'lt_LT' => 'Lietuvių kalba',	'my_MM' => 'ဗမာစာ',	'nb_NO' => 'Norsk bokmål',	'nl_NL' => 'Nederlands',	'pl_PL' => 'Polski',	'pt_PT' => 'Português',	'pt_BR' => 'Português do Brasil',	'ro_RO' => 'Română',	'ru_RU' => 'Русский',	'sk_SK' => 'Slovenčina',	'sl_SI' => 'Slovenščina',	'sr_RS' =>'Српскијезик',	'sv_SE'=>'Svenska',	'tr_TR'=>'Türkçe',
							'ug_CN'=>'Uyƣurqə','zh_TW'=>'繁體中文','zh_CN'=>'简体中文'),
                            'default'  => 'en_CA',
                        ),
						array(
							'id'        => 'rockon_googleanalytics',
							'type'      => 'textarea',
							'title'     => __('Tracking Code (Google Analytics)', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'desc'      => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'rockon_framework')
						)
					)
				);
				
				$this->sections[] = array(
                    'title'  => __( 'Home Page Settings', 'rockon_framework' ),
                    'desc'   => __( '', 'rockon_framework' ),
                    'icon'   => 'el-icon-home', // change icon class
                    'fields' => array(
						array(
							'id'        => 'rockon_wel_title',
							'type'      => 'text',
							'title'     => __('Welcome Title', 'rockon_framework'),
							'subtitle'  => __('Your sites welcome title', 'rockon_framework'),
							'default'   => 'WELCOME IN ROCKON CLUB',
						),
						array(
							'id'        => 'rockon_wel_desc',
							'type'      => 'textarea',
							'title'     => __('Welcome Description', 'rockon_framework'),
							'subtitle'  => __('Welcome description for your site', 'rockon_framework'),
							'default'   => 'Mauris a massa id leo aliquam consequat porttitor vitae est. Proin ultricies velit sed porttitor viverra. Pellentesque eget tristique est. Donec volutpat, eros et bibendum lacinia, enim ipsum gravida enim, quis viverra odio elit sit amet orci. Aenean eget mi quam.',
						),
						 array(
							'id'        => 'rockon_sevices_title',
							'type'      => 'text',
							'title'     => __('Services Title', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Title for services - Leave blank if no title is required', 'rockon_framework'),
							'default'   => 'Services',
						),
						array(
							'id'        => 'rockon_sevices_post',
							'type'      => 'text',
							'title'     => __('No of Post(Services)', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Services Post on home page - Leave blank if no services posts to be shown on home page', 'rockon_framework'),
							'default'   => '3',
						),
						 array(
							'id'        => 'rockon_event_title',
							'type'      => 'text',
							'title'     => __('Event Title', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Title for Event - Leave blank if no title is required', 'rockon_framework'),
							'default'   => 'Event of the month',
						),
						array(
							'id'        => 'rockon_event_post',
							'type'      => 'text',
							'title'     => __('No of Post(Event)', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Events Post on home page - Leave blank if no Events posts to be shown on home page', 'rockon_framework'),
							'default'   => '6',
						),
						 array(
							'id'        => 'rockon_portfolio_title',
							'type'      => 'text',
							'title'     => __('Portfolio Title', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Title for Portfolio - Leave blank if no title is required', 'rockon_framework'),
							'default'   => 'Rockon Club Photos',
						),
						array(
							'id'        => 'rockon_portfolio_post',
							'type'      => 'text',
							'title'     => __('No of Post(Portfolio)', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Portfolio Post on home page - Leave blank if no Portfolio posts to be shown on home page', 'rockon_framework'),
							'default'   => '6',
						),
						array(
							'id'        => 'rockon_portfolio_row',
							'type'      => 'text',
							'title'     => __('No of Row(Portfolio)', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Row wise portfolio posts view', 'rockon_framework'),
							'default'   => '2',
						),
						array(
							'id'        => 'rockon_audiotrack_title',
							'type'      => 'text',
							'title'     => __('Audio Track Title', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Title for Audio - Leave blank if no title is required', 'rockon_framework'),
							'default'   => 'Rockon Club Track',
						),
						array(
							'id'        => 'rockon_audiotrack_post',
							'type'      => 'text',
							'title'     => __('No of Post(Audio Track)', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('Audio Posts on home page - Leave blank if no Audio posts to be shown on home page', 'rockon_framework'),
							'default'   => '4',
						),
						array(
							'id'        => 'rockon_set_homepagesection',
							'type'      => 'sorter',
							'title'     => 'Set Position',
							'subtitle'  => 'You can choose order of section.',
							'compiler'  => 'true',
							'options'   => array(
								'Show'   => array(
									'Welcome' => 'Welcome',
									'Services'=> 'Services',
									'Event' => 'Event',
									'Portfolio' => 'Portfolio',
									'Audio' => 'Audio',
									'Default'=> 'Default Content'
								),
								'Hide' => array(
								 
								)
							)
						)
					)
				);				
				
				$this->sections[] = array(
                    'title'  => __( 'Style Switcher Settings', 'rockon_framework' ),
                    'desc'   => __( '', 'rockon_framework' ),
                    'icon'   => 'el el-screen', // change icon class
                    'fields' => array(
						array(
							'id'        => 'rockon_style_switcher_A',
							'type'      => 'switch',
							'title'     => __('Enable/Disable', 'rockon_framework'),
							'subtitle'  => __('Show style switcher on frontend for admin', 'rockon_framework'),
							'default'   => true,
						),
						array(
							'id'        => 'rockon_style_switcher_U',
							'type'      => 'switch',
							'title'     => __('Enable/Disable', 'rockon_framework'),
							'subtitle'  => __('Show style switcher on frontend for all user', 'rockon_framework'),
							'default'   => true,
						),
						array(
							'id'        => 'rockon_style_switcher_color',
							'type'      => 'image_select',
							'compiler'  => true,
							'required'	=> array(
							array('rockon_style_switcher_A','=','1'),
							array('rockon_cssversion','=','dark')			
							),
							'title'     => __('Color Option', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'options'   => array(
								'dark_color1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/color.png'),
								'dark_color2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/color2.png'),
								'dark_color3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/color3.png'),
								'dark_color4' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/color4.png'),
								'dark_color5' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/color5.png'),
								'style' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/style.png'),
								'style' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/none.png'),
							),
							'default'   => 'style'
						),
						array(
							'id'        => 'rockon_style_switcher_background',
							'type'      => 'image_select',
							'compiler'  => true,
							'required'	=> array(
							array('rockon_style_switcher_A','=','1'),
							array('rockon_cssversion','=','dark')	
							),
							'title'     => __('Background Option', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'options'   => array(
								'dark_pattern1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/pattern.png'),
								'dark_pattern2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/pattern1.png'),
								'dark_pattern3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/pattern2.png'),
								'dark_pattern4' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/pattern3.png'),
								'dark_pattern5' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/pattern4.png'),
								'demo' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/none.png'),
							),
							'default'   => 'demo'
						),
						array(
							'id'        => 'rockon_style_switcher_color_l',
							'type'      => 'image_select',
							'compiler'  => true,
							'required'	=> array(
							array('rockon_style_switcher_A','=','1'),
							array('rockon_cssversion','=','light')			
							),
							'title'     => __('Color Option', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'options'   => array(
								'light_color1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/l_color.png'),
								'light_color2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/l_color2.png'),
								'light_color3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/l_color3.png'),
								'light_color4' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/l_color4.png'),
								'light_color5' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/l_color5.png'),
								'style_light_version' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/l_style.png'),
								'style_light_version' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/none.png'),
							),
							'default'   => 'style_light_version'
						),
						array(
							'id'        => 'rockon_style_switcher_background_l',
							'type'      => 'image_select',
							'compiler'  => true,
							'required'	=> array(
							array('rockon_style_switcher_A','=','1'),
							array('rockon_cssversion','=','light')	
							),
							'title'     => __('Background Option', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'options'   => array(
								'light_pattern1' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/l_pattern.png'),
								'light_pattern2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/l_pattern1.png'),
								'light_pattern3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/l_pattern2.png'),
								'light_pattern4' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/l_pattern3.png'),
								'light_pattern5' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/l_pattern4.png'),
								'demo' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/none.png'),
							),
							'default'   => 'demo'
						),
						array(
                            'id'       => 'rockon_ownthemecolor',
                            'type'     => 'color',
                            'title'    => __( 'Choose Theme Color', 'rockon_framework' ),
                            'subtitle' => __( 'Pick a color for the theme, also first set Color Option & Background Option should be none.', 'rockon_framework' ),
                            'default'  => '',
                            'validate' => 'color',
                        )
					)
				);
				
				$this->sections[] = array(
                'title'     => __('Slider Settings', 'rockon_framework'),
				'icon'   => 'el el-slideshare', // change icon class
                'fields'    => array(
						array(
							'id'        => 'rockon_sliderswitch',
							'type'      => 'switch',
							'title'     => __('Slider Enable/Disable', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => false,
						),
						/*array(
                            'id'       => 'rockon_slidertype',
                            'type'     => 'select',
							'required' => array('rockon_sliderswitch','=','1'),
                            'title'    => __( 'Choose Slider', 'rockon_framework' ),
                            'subtitle' => __( '', 'rockon_framework' ),
                            'options'  => array( 'default' => 'Use Theme Slider', 'Revolution' => 'Revolution Plugin Slider' ),
                            'default'  => 'default',
                        ),*/
						array(
							'id'        => 'rockon_sliderlogo',
							'type'      => 'media',
							'required' => array('rockon_sliderswitch','=','1'),
							'title'     => __('Upload Slider Logo', 'rockon_framework'),
							'desc'      => __('', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
						),
						array(
                            'id'          => 'rockon_sliderslides',
                            'type'        => 'slides',
							'required' => array('rockon_sliderswitch','=','1'),
                            'title'       => __( 'Set Title,Description And Upload Image', 'rockon_framework' ),
                            'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'rockon_framework' ),
                            'desc'        => __( '', 'rockon_framework' ),
                            'placeholder' => array(
                                'title'       => __( 'This is a title', 'rockon_framework' ),
                                'description' => __( 'Description Here', 'rockon_framework' ),
                                'url'         => __( 'Give us a link!', 'rockon_framework' ),
                            ),
                        ),
						array(
							'id'        => 'shortcode_Revolution',
							'type'      => 'text',
							'required' => array('rockon_sliderswitch','=','1'),
							'title'     => __('Shortcode Here', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'desc'      => __("Ex. : [use_shortcode]", 'rockon_framework')
						),
						array(
							'id'    => 'rockon_info_slidescode',
							'type'  => 'info',
							'style' => 'warning',
							'required' => array('rockon_sliderswitch','=','1'),
							'title' => __('Use Revolution Slider.', 'redux-framework-demo'),
							'desc'  => __('Use shortcode provide by plugin.', 'rockon_framework')
						)
					)
				);
		
				$this->sections[] = array(
                'icon'      => 'el-icon-user',
                'title'     => __('Flip Gallery', 'rockon_framework'),
				'icon'   => 'el el-graph-alt', // change icon class
                'fields'    => array(
						array(
                            'id'       => 'rockon_slidergallery',
                            'type'     => 'gallery',
                            'title'    => __( 'Add/Edit Gallery', 'rockon_framework' ),
                            'subtitle' => __( '', 'rockon_framework' ),
                            'desc'     => __( '', 'rockon_framework' ),
                        )
					)
				);
				
				/*$arr = array();
				$pages = get_pages();
				foreach ( $pages as $page ) {
					$arr[$page->ID] = $page->post_title;
				}
				
				$this->sections[] = array(
                    'title'  => __( 'Event Setting', 'rockon_framework' ),
                    'desc'   => __( '', 'rockon_framework' ),
                    'icon'   => 'el el-livejournal', // change icon class
                    'fields' => array(
						array(
							'id'        => 'rockon_paypalmode',
							'type'      => 'switch',
							'title'     => __('use sandbox paypal', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'default'   => true,
						),
						array(
							'id'        => 'rockon_paypalid',
							'type'      => 'text',
							'title'     => __('Paypal Email-id', 'rockon_framework'),
							'subtitle'  => __('', 'rockon_framework'),
							'desc'      => __('Enter your paypal email address for recieving payment', 'rockon_framework')
						),
						array(
                            'id'       => 'rockon_pageid',
                            'type'     => 'select',
                            'title'    => __( 'select paypal IPN page', 'rockon_framework' ),
                            'subtitle' => __( '', 'rockon_framework' ),
                            'options'  => $arr,
							'desc'      => __('Make sure this page select paypal IPN Page', 'rockon_framework')
                        )
					)
				);*/
				
				$this->sections[] = array(
                'title'     => __('Contact Setting', 'rockon_framework'),
				'icon'   => 'el el-map-marker-alt', // change icon class
                'fields'    => array(
					array(
                        'id'        => 'rockon_contactemailaddrs',
                        'type'      => 'text',
                        'title'     => __('Email Address', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('Enter your email address', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_successmessage',
                        'type'      => 'text',
                        'title'     => __('Success Message', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('Success message text after email delivered', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_contactmaponoff',
                        'type'      => 'switch',
                        'title'     => __('Enable OR Disable Contact Map', 'rockon_framework'),
                        'subtitle'  => __('Switch ON to enable contact map, Switch OFF to disable it. ;)', 'rockon_framework'),
                        //'options' => array('on', 'off'),
                        'default'   => true,
                    ),
					array(
                        'id'        => 'rockon_Latitude_Longitude',
                        'type'      => 'text',
                        'title'     => __('Google Map Latitude & Longitude ', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('Eg. : 22.962267', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_mapzoom',
                        'type'     => 'select',
						'title'    => __( 'Choose Map Zoom', 'rockon_framework' ),
						'subtitle' => __( '', 'rockon_framework' ),
						'options'  => array( '5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12' ),
						'default'  => '7',
                    ),
					array(
                        'id'        => 'rockon_maptitle',
                        'type'      => 'text',
                        'title'     => __('Map Title On Highlights', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_contactweburl',
                        'type'      => 'text',
                        'title'     => __('WebUrl', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_contactphone',
                        'type'      => 'text',
                        'title'     => __('Phone No.', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('Eg. : 61 3 8376 6284', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_contactemail',
                        'type'      => 'text',
                        'title'     => __('Email Address', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('Eg. : admin@rockonpsd.com,info@rockonpsd.com', 'rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_contactaddress',
                        'type'      => 'textarea',
                        'title'     => __('Home Address', 'rockon_framework'),
                        'subtitle'  => __('', 'rockon_framework'),
                        'desc'      => __('Eg. : 121 King St ,Melbourne VIC 3000','rockon_framework')
                    ),
					array(
                        'id'        => 'rockon_fieldsenable_disable',
                        'type'      => 'sorter',
                        'title'     => 'Form Setting',
                        'subtitle'  => 'You can choose INPUT fields.',
                        'compiler'  => 'true',
                        'options'   => array(
                            'ENABLE'   => array(
                                'NAME'    => 'NAME',
                                'PHONENUMBER'    => 'PHONE NUMBER',
                                'EMAIL'        => 'EMAIL',
                                'WEBSITE'        => 'WEBSITE',
                                'MESSAGE'    => 'MESSAGE'
                            ),
							'DISABLE' => array(
							
							)
                        )
                    ), 
					array(
                        'id'        => 'rockon_fieldsrequire',
                        'type'      => 'sorter',
                        'title'     => 'Required Field',
                        'subtitle'  => 'You can choose INPUT fields REQUIRED or NOT.',
                        'compiler'  => 'true',
                        'options'   => array(
                            'REQUIRE'   => array(
                                'NAME'    => 'NAME',
                                'PHONENUMBER'    => 'PHONE NUMBER',
                                'EMAIL'        => 'EMAIL',
                                'WEBSITE'        => 'WEBSITE',
                                'MESSAGE'    => 'MESSAGE'
                            ),
							'NOT REQUIRE' => array(
							
							)
                        )
                    )
				)
			);
			
			$this->sections[] = array(
                'title'     => __('Styling Options', 'rockon_framework'),
				'icon'   => 'el el-adjust', // change icon class
                'fields'    => array(
					array(
						'id'       => 'rockon_cssversion',
						'type'     => 'select',
						'title'    => __( 'Choose Version', 'rockon_framework' ),
						'subtitle' => __( '', 'rockon_framework' ),
						'options'  => array( 'dark' => 'Dark Version', 'light' => 'Light Version', 'nightclub' => 'Night Club Version' ),
						'default'  => 'dark',
					),
					array(
                        'id'        => 'rockon_bodybackground',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => __('Body Background', 'rockon_framework'),
                        'subtitle'  => __('Body background with image, color, etc.', 'rockon_framework'),
                        'default'   => '',
                    ),
					array(
                        'id'        => 'rockon_typographybodytext',
                        'type'      => 'typography',
						'output'    => array('body'),
                        'title'     => __('Body Font', 'rockon_framework'),
                        'subtitle'  => __('Specify the body font properties.', 'rockon_framework'),
                        'google'    => true,
                        'default'   => array(
                            'color'         => '',
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => '',
                        ),
                    ),
					array(
                        'id'        => 'rockon_typographybodyheading',
                        'type'      => 'typography',
						'output'    => array('h1,h2,h3,h4,h5,h6'),
                        'title'     => __('Body Heading H1-H6 Font', 'rockon_framework'),
                        'subtitle'  => __('Specify the Heading font properties.', 'rockon_framework'),
                        'google'    => true,
                        'default'   => array(
                            'color'         => '',
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => '',
                        ),
                    ),
					array(
                        'id'        => 'rockon_customcss',
                        'type'      => 'ace_editor',
						'mode'      => 'css',
						'theme'     => 'monokai',
                        'title'     => __('Custom CSS', 'rockon_framework'),
                        'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'rockon_framework'),
                        'desc'      => __('', 'rockon_framework'),
                        'validate'  => 'css',
						'default'   => '',
                    )
                )
            );
			
			$this->sections[] = array(
                'icon'      => 'el-icon-twitter',
                'title'     => __('Social Setting', 'rockon_framework'),
                'fields'    => array(
					array(
						'id'        => 'rockon_stayconnect',
						'type'      => 'text',
						'title'     => __('Left Text Footer', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Ex. : Stay Connected With Us Rockon.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_fbapi',
						'type'      => 'text',
						'title'     => __('Facebook Api Id', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Ex. : 1055386267820317', 'rockon_framework'),
						'default' 	=> ''
					),
					array(
						'id'        => 'rockon_singlesharepost',
						'type'      => 'text',
						'title'     => __('Single Post Share Text', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Ex. : Share it on', 'rockon_framework'),
						'default' 	=> 'Share it on -'
					),
					array(
						'id'        => 'rockon_facebookurl',
						'type'      => 'text',
						'title'     => __('Facebook', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Facebook Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_twitterurl',
						'type'      => 'text',
						'title'     => __('Twitter', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Twitter Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_linkedinurl',
						'type'      => 'text',
						'title'     => __('Linkedin', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Linkedin Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_flickrurl',
						'type'      => 'text',
						'title'     => __('Flickr', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Flickr Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_youtubeurl',
						'type'      => 'text',
						'title'     => __('Youtube', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Youtube Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_dribbbleurl',
						'type'      => 'text',
						'title'     => __('Dribbble', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Dribbble Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_gpurl',
						'type'      => 'text',
						'title'     => __('Google Plus', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Google Plus Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_skypeurl',
						'type'      => 'text',
						'title'     => __('Skype', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Skype Url.', 'rockon_framework')
					),
					array(
						'id'        => 'rockon_pinteresturl',
						'type'      => 'text',
						'title'     => __('Pinterest', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('Enter Pinterest Url.', 'rockon_framework')
					),
					array(
                        'id'        => 'rockon_displaysocial',
                        'type'      => 'sorter',
                        'title'     => 'Show Social Icon In Footer',
                        'subtitle'  => 'You can choose ICON display or NOT.',
                        'compiler'  => 'true',
                        'options'   => array(
                            'SHOW'   => array(
                                'Facebook'    => 'Facebook',
                                'Twitter'    => 'Twitter',
                                'Linkedin'        => 'Linkedin',
                                'Flickr'        => 'Flickr',
                                'Youtube'    => 'Youtube',
                                'Dribbble'    => 'Dribbble',
                                'Google'    => 'Google',
                                'Skype'    => 'Skype',
                                'Pinterest'    => 'Pinterest'
                            ),
							'NOT SHOW' => array(
							
							)
                        )
                    )
				)
			);	
			
			$this->sections[] = array(
                'icon'      => 'el el-network',
                'title'     => __('Woocommerce Setting', 'rockon_framework'),
                'fields'    => array(
					array(
						'id'        => 'woo_rockon_sidebarposition',
						'type'      => 'image_select',
						'compiler'  => true,
						'title'     => __('Woocommerce Sidebar Position', 'rockon_framework'),
						'subtitle'  => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout. <br>*This option will work only for posts, pages have their own sidebar settings in their edit section', 'rockon_framework'),
						'options'   => array(
							'full' => array('alt' => '1 Column',       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
							'left' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
							'right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
						),
						'default'   => 'right'
					),	
					array(
						'id'        => 'rockon_woo_product',
						'type'      => 'switch',
						'title'     => __('Social Share Icon On Single woocommerce product', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'default'   => true,
					),
					array(
						'id'        => 'woo_rockon_relatedproduct',
						'type'      => 'switch',
						'title'     => __('Show/Hide Related Product On Single Product', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'default'   => true,
					),
					array(
						'id'        => 'woo_rockon_no_relatedproduct',
						'type'      => 'text',
						'title'     => __('No. Of Related Product On Single Product', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'desc'      => __('', 'rockon_framework'),
						'default'   => '4',
					),
					array(
						'id'        => 'woo_rockon_cart',
						'type'      => 'switch',
						'title'     => __('Show/Hide Cart Icon on navigation menu.', 'rockon_framework'),
						'subtitle'  => __('', 'rockon_framework'),
						'default'   => false,
					),
				)
			);

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'rockon_framework' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'rockon_framework' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'rockon_import_export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );
                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', 'rockon_framework' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'rockon_framework' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );
				$this->sections[] = array(
                    'type' => 'divide',
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el-icon-book',
                        'title'   => __( 'Documentation', 'rockon_framework' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'rockon_framework' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'rockon_framework' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'rockon_framework' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'rockon_framework' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'rockon_framework' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'rockon_data',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => false,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Rockon Options', 'rockon_framework' ),
                    'page_title'           => __( 'Rockon Options', 'rockon_framework' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => ROCKON_PATH.'/admin/assets/img/rockon_option.svg',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'rockon_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => 'http://docs.reduxframework.com/',
                    'title' => __( 'Documentation', 'rockon_framework' ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => 'https://github.com/ReduxFramework/redux-framework/issues',
                    'title' => __( 'Support', 'rockon_framework' ),
                );

                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-extensions',
                    'href'   => 'reduxframework.com/extensions',
                    'title' => __( 'Extensions', 'rockon_framework' ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el-icon-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://twitter.com/',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'http://www.linkedin.com/',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el-icon-linkedin'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( __( '', 'rockon_framework' ), $v );
                } else {
                    $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'rockon_framework' );
                }

                // Add content after the form.
                $this->args['footer_text'] = __( '<p>This is footer text for ROCKON editable.</p>', 'rockon_framework' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
