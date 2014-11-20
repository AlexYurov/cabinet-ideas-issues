<?php
/*
add_action('init','CheckAllow');
function CheckAllow() {
 
    //$current_path = empty( $_SERVER["REQUEST_URI"] ) ? home_url() : $_SERVER["REQUEST_URI"];
    $current_path = '';
	
    if (! is_user_logged_in() && ! is_login() ){
        wp_redirect( wp_login_url($current_path) );
        exit;
    }
}
 
function is_login() {
    return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
}
*/

/*--------------------------------------------------------------------------*/
/*	Регистрация меню (WP3.0+)
/*--------------------------------------------------------------------------*/

register_nav_menus( 
	array(
		'top'		=> __( 'Верхнее меню' ),
	)
);

/*-----------------------------------------------------------------------------------*/
/*	WP2.9+ Подключение поддержки миниатюр
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size('300x300', 300, 300, true);	// Archive - Blog

}

/*-----------------------------------------------------------------------------------*/
/*	Подключение ВИДЖЕТ панели
/*-----------------------------------------------------------------------------------*/

function myTHEME_widgets_init() {
	register_sidebar(array(
		'name' => __('БЛОГ', 'myTHEME'),
		'id' => 'widget-area-blog',
		'description' => __('виджет - блок', 'myTHEME'),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
}
add_action('widgets_init', 'myTHEME_widgets_init'); 


/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Хлебные крошки
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function bshepelev_breadcrumbs() {
	$delimiter = ''; 
	$home = 'Главная'; 
	$before = '<li><span class="current">';
	$after = '</span></li>';
	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<div class="block" id="crumbs"><div class="center"><ul>';
		global $post;
		$homeLink = get_bloginfo('url');
		echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo ( get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) {
			echo $before . 'Результаты поиска по запросу "' . get_search_query() . '"' . $after;
		} elseif ( is_tag() ) {
			echo $before . '' . single_tag_title('', false) . '' . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . 'Статьи автора ' . $userdata->display_name . $after;
		} elseif ( is_404() ) {
			echo $before . 'Страница не найдена (Ошибка 404)' . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
		}
    echo '</ul></div></div>';
	}
} 

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Навигация (1,2,3... )
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

if (! function_exists('max_pagination')):
	function max_pagination($pages = '', $range = 4) {
		$showitems = ($range * 2)+1; 
		global $paged;
		if(empty($paged)) $paged = 1;
		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages) { $pages = 1; }
		}  
		if(1 != $pages) {
			echo "<ul id='navigation'>";
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; ".__('Next')."</a>";
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".__('Previous')."</a>";
				for ($i=1; $i <= $pages; $i++) {
					if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
						echo ($paged == $i)? "<li class=\"current\">".$i."</li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
					}
				}
			if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">".__('Next')." &rsaquo;</a></li>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last')." &raquo;</a>";
			echo "</ul>";
		}
	}
endif;

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Навигация (1,2,3... ) Вариант 2
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

if (! function_exists('wp_corenavi')):
	function wp_corenavi() {
		global $wp_query, $wp_rewrite;
		$pages = '';
		$max = $wp_query->max_num_pages;
		if (!$current = get_query_var('paged')) $current = 1;
		$a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
		if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
		$a['total'] = $max;
		$a['current'] = $current;

		$total = 0; 					//1 - выводить текст "Страница N из N", 0 - не выводить
		$a['mid_size'] = 5; 			//сколько ссылок показывать слева и справа от текущей
		$a['end_size'] = 1; 			//сколько ссылок показывать в начале и в конце
		$a['prev_text'] = '&laquo;'; 	//текст ссылки "Предыдущая страница"
		$a['next_text'] = '&raquo;'; 	//текст ссылки "Следующая страница"

		if ($max > 1) echo '<div id="navigation">';
		if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
		echo $pages . paginate_links($a);
		if ($max > 1) echo '</div>';
	}
endif;

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Навигация по комментариям (1,2,3... )
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function wp_comments_corenavi() {
	$pages = '';
	$max = get_comment_pages_count();
	$page = get_query_var('cpage');
	if (!$page) $page = 1;
	$a['current'] = $page;
	$a['echo'] = false;

	$total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
	$a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
	$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
	$a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
	$a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"

	if ($max > 1) echo '<div id="comment-navigation">';
	//if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $page . ' из ' . $max . '</span>'."\r\n";
	echo $pages . paginate_comments_links($a);
	if ($max > 1) echo '</div>';
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// В ЦИТАТА замена стандартного: [...] на ... и ссылку
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function new_excerpt_more($excerpt) {
	global $post;
	$permalink = get_permalink($post->id);
	$titles = get_the_title();
	return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Информация страницы по ID
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function page_content($pageid = null) {
	$my_query = new WP_Query('page_id=' . $pageid); 
	while ($my_query->have_posts()) : $my_query->the_post(); 
		global $more;
		$more = 0;
		the_content('');
	endwhile; 
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Ссылка со страницы по ID
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function page_link($pageid = null) {
	wp_reset_query();
	$my_query_function = new WP_Query('page_id=' . $pageid); 
	while ($my_query_function->have_posts()) : $my_query_function->the_post(); 
		return get_permalink();
	endwhile; 
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
/*	Страница персональных настроек ШАБЛОНА
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

class ControlPanel {
	var $default_settings = Array();
	var $options;
	function ControlPanel() {
		add_action('admin_menu', array($this, 'add_menu'));
		if (!is_array(get_option('options_themeadmin')))
			add_option('options_themeadmin', $this->default_settings);
		$this->options = get_option('options_themeadmin');
	}
	function add_menu() { add_menu_page('Options theme', 'Настройки', 3, "options_themeadmin", array(&$this, 'optionsmenu')); }
	function optionsmenu() {
		if ($_POST['ss_action'] == 'save') {
		
			// Контакты
			$this->options["data_01"] = $_POST['cp_data_01'];
			$this->options["data_02"] = $_POST['cp_data_02'];
			$this->options["data_03"] = $_POST['cp_data_03'];
			$this->options["data_04"] = $_POST['cp_data_04'];
			
			$this->options["data_05"] = $_POST['cp_data_05'];
			$this->options["data_06"] = $_POST['cp_data_06'];
			$this->options["data_07"] = $_POST['cp_data_07'];
			
			update_option('options_themeadmin', $this->options);
			echo '<div class="updated fade" id="message"><p>Все наcтройки <strong>успешно сохранены</strong></p></div>'; 
		}
	?>
		<style>
			#message {
				background-color: rgb(255, 251, 204); 
				width: 595px; 
				margin-top: 17px;
			}
			.form-table tr th {
				vertical-align:middle;
			}
			.form-table .widefat { 
				background:#FFF; 
				padding:3px 6px;
				font-size:12px;
				width:375px;
			}
			.form-table textarea.widefat {
				background:#FFF; 
				padding:3px 6px;
				font-size:12px;
				width:390px;
				height:150px;
			}
		</style>
		<div class="wrap">
			<div id="icon-options-general" class="icon32">
				<br/>
			</div>
			<h2>Настройки шаблона</h2>		
			<form id="myform" action="" method="post">
				<input type="hidden" id="ss_action" name="ss_action" value="save">
				<table class="form-table" style="width:600px;">
					<tbody>
						<tr>
							<th colspan="2"><h3>Контакты</h3></th>
						</tr>
						<tr>
							<th><label for="cp_data_01">Адрес</label></th>
							<td><input class="widefat" name="cp_data_01" id="cp_data_01" value="<?php echo $this->options["data_01"]; ?>" /></td>
						</tr>
						<tr>
							<th><label for="cp_data_02">Телефон</label></th>
							<td><input class="widefat" name="cp_data_02" id="cp_data_02" value="<?php echo $this->options["data_02"]; ?>" /></td>
						</tr>
						<tr>
							<th><label for="cp_data_03">E-mail</label></th>
							<td><input class="widefat" name="cp_data_03" id="cp_data_03" value="<?php echo $this->options["data_03"]; ?>" /></td>
						</tr>
						<tr>
							<th><label for="cp_data_04">Skype</label></th>
							<td><input class="widefat" name="cp_data_04" id="cp_data_04" value="<?php echo $this->options["data_04"]; ?>" /></td>
						</tr>
						<tr>
							<th colspan="2"><h3>Успешность (статистика)</h3></th>
						</tr>
						<tr>
							<th><label for="cp_data_05">Проектов</label></th>
							<td><input class="widefat" name="cp_data_05" id="cp_data_05" value="<?php echo $this->options["data_05"]; ?>" /></td>
						</tr>
						<tr>
							<th><label for="cp_data_06">Текстов</label></th>
							<td><input class="widefat" name="cp_data_06" id="cp_data_06" value="<?php echo $this->options["data_06"]; ?>" /></td>
						</tr>
						<tr>
							<th><label for="cp_data_07">Клиентов</label></th>
							<td><input class="widefat" name="cp_data_07" id="cp_data_07" value="<?php echo $this->options["data_07"]; ?>" /></td>
						</tr>
						
						
					</tbody>
				</table>
				<p class="submit">
					<input type="submit" name="cp_save" id="submit" class="button button-primary" value="Сохранить изменения"/>
				</p>
			</form>
		</div>
	<?php 
	
	} 
} 
$cpanel = new ControlPanel();
$options_theme = get_option('options_themeadmin');
	
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Портфолио
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_work() {
		$labels = array(
			'name'                => _x( 'Портфолио', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Портфолио', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Портфолио', 'bshepelev' ),
			'parent_item_colon'   => __( 'Портфолио', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть записи', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'Записи не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No work found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'work',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'work', 'bshepelev' ),
			'description'         => __( 'work information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('work', $args );
	}
	
	// Hook into the 'init' work
	add_action( 'init', 'custom_post_type_work', 0 );
	
function create_subjects() {
     register_taxonomy('subjects', 'work', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Тематики', 'taxonomy general name' ),
            'singular_name' => _x( 'Тематики', 'taxonomy singular name' ),
            'search_items' =>  __( 'Найти тематику' ),
            'all_items' => __( 'Все тематики' ),
            'parent_item' => __( 'Вид тематики' ), // родительская таксономия
            'parent_item_colon' => __( 'Вид тематики:' ),
            'edit_item' => __( 'Редактировать тематику' ),
            'update_item' => __( 'Обновить тематику' ),
            'add_new_item' => __( 'Добавить тематику' ),
            'new_item_name' => __( 'Название тематики' ),
            'menu_name' => __( 'Тематики' ),
        ),
        'rewrite' => array(
            'slug' => 'subjects',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
}
add_action( 'init', 'create_subjects', 0 );

function create_categories() {
     register_taxonomy('categories', 'work', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Категории', 'taxonomy general name' ),
            'singular_name' => _x( 'Категории', 'taxonomy singular name' ),
            'search_items' =>  __( 'Найти категории' ),
            'all_items' => __( 'Все категории' ),
            'parent_item' => __( 'Вид категории' ), // родительская таксономия
            'parent_item_colon' => __( 'Вид категории:' ),
            'edit_item' => __( 'Редактировать категорию' ),
            'update_item' => __( 'Обновить категорию' ),
            'add_new_item' => __( 'Добавить категорию' ),
            'new_item_name' => __( 'Название категории' ),
            'menu_name' => __( 'Категории' ),
        ),
        'rewrite' => array(
            'slug' => 'categories',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
}
add_action( 'init', 'create_categories', 0 );

//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_work');
function my_post_options_box_work() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_work', 'work', 'normal', 'high');
}
function custom_post_info_work() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #CCC; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Параметры работы</legend>
			<label class="labels" for="cpi_data_81">Центрирование: </label>
			<select class="inputs" name="cpi_data_81" id="cpi_data_81">
				<?php
					$array_en = array("", "normal", "importance");
					$array_ru = array("", "Обычная работа", "Избранная работа");
					for ($i = 1; $i < count($array_ru); $i++) {
						if (get_post_meta($post->ID, 'cpi_data_81', true) == $array_en[$i]) {
							echo '<option selected value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						} else {
							echo '<option value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						}
					}
				?>
			</select>
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_work');
function custom_add_save_work($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_81']) { update_custom_meta_work($postID, $_POST['cpi_data_81'], 'cpi_data_81'); }
}
function update_custom_meta_work($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Category description - ON tag
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Сотрудники
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_staff() {
		$labels = array(
			'name'                => _x( 'Сотрудники', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Сотрудники', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Сотрудники', 'bshepelev' ),
			'parent_item_colon'   => __( 'Сотрудники', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть записи', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'Записи не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No staff found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'staff',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'staff', 'bshepelev' ),
			'description'         => __( 'staff information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('staff', $args );
	}
	
	// Hook into the 'init' staff
	add_action( 'init', 'custom_post_type_staff', 0 );
	
function create_department() {
     register_taxonomy('department', 'staff', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Отдел', 'taxonomy general name' ),
            'singular_name' => _x( 'Отдел', 'taxonomy singular name' ),
            'search_items' =>  __( 'Найти отдел' ),
            'all_items' => __( 'Все отделы' ),
            'parent_item' => __( 'Вид отдела' ), // родительская таксономия
            'parent_item_colon' => __( 'Вид отдела:' ),
            'edit_item' => __( 'Редактировать отдел' ),
            'update_item' => __( 'Обновить отдел' ),
            'add_new_item' => __( 'Добавить отдел' ),
            'new_item_name' => __( 'Название отдела' ),
            'menu_name' => __( 'Отдел' ),
        ),
        'rewrite' => array(
            'slug' => 'department',
            'with_front' => false,
            'hierarchical' => true
        ),
    ));
}
add_action( 'init', 'create_department', 0 );

//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_staff');
function my_post_options_box_staff() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_staff', 'staff', 'normal', 'high');
}
function custom_post_info_staff() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #CCC; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Параметры</legend>
			<label class="labels" for="cpi_data_21">Должность: </label>
			<input name="cpi_data_21" id="cpi_data_21" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_21', true); ?>" />
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_staff');
function custom_add_save_staff($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_21']) { update_custom_meta_staff($postID, $_POST['cpi_data_21'], 'cpi_data_21'); }
}
function update_custom_meta_staff($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}	
	
	
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Наши клиенты
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_client() {
		$labels = array(
			'name'                => _x( 'Наши клиенты', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Наши клиенты', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Наши клиенты', 'bshepelev' ),
			'parent_item_colon'   => __( 'Наши клиенты', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть записи', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'Записи не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No client found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'client',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'client', 'bshepelev' ),
			'description'         => __( 'client information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail'),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('client', $args );
	}
	
	// Hook into the 'init' client
	add_action( 'init', 'custom_post_type_client', 0 );
	
//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_client');
function my_post_options_box_client() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_client', 'client', 'normal', 'high');
}
function custom_post_info_client() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #DFDFDF; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Дополнительные опции</legend>
			<label class="labels" for="cpi_data_01">Ссылка на сайт:</label>
			<input name="cpi_data_01" id="cpi_data_01" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_01', true); ?>" />
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_client');
function custom_add_save_client($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_01']) { update_custom_meta_client($postID, $_POST['cpi_data_01'], 'cpi_data_01'); }
}
function update_custom_meta_client($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}
	
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Награды
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_awards() {
		$labels = array(
			'name'                => _x( 'Награды', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Награды', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Награды', 'bshepelev' ),
			'parent_item_colon'   => __( 'Награды', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть записи', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'Записи не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No awards found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'awards',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'awards', 'bshepelev' ),
			'description'         => __( 'awards information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('awards', $args );
	}
	
	// Hook into the 'init' awards
	add_action( 'init', 'custom_post_type_awards', 0 );
	
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Звания
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_rank() {
		$labels = array(
			'name'                => _x( 'Звания', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Звания', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Звания', 'bshepelev' ),
			'parent_item_colon'   => __( 'Звания', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть записи', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'Записи не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No rank found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'rank',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'rank', 'bshepelev' ),
			'description'         => __( 'rank information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('rank', $args );
	}
	
	// Hook into the 'init' rank
	add_action( 'init', 'custom_post_type_rank', 0 );
	
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Услуги
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_service() {
		$labels = array(
			'name'                => _x( 'Услуги', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Услуги', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Услуги', 'bshepelev' ),
			'parent_item_colon'   => __( 'Услуги', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть запись', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'запись не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No record found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'service',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'service', 'bshepelev' ),
			'description'         => __( 'service information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('service', $args );
	}
	
	// Hook into the 'init' service
	add_action( 'init', 'custom_post_type_service', 0 );

//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_service');
function my_post_options_box_service() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_service', 'service', 'normal', 'high');
}
function custom_post_info_service() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #CCC; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Параметры HEADER</legend>
			<label class="labels" for="cpi_data_91">Ссылка на изображение: </label>
			<input name="cpi_data_91" id="cpi_data_91" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_91', true); ?>" />
			<label class="labels" for="cpi_data_92">Текст: </label>
			<input name="cpi_data_92" id="cpi_data_92" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_92', true); ?>" />
			<label class="labels" for="cpi_data_93">Центрирование: </label>
			<select class="inputs" name="cpi_data_93" id="cpi_data_93">
				<?php
					$array_en = array("", "left", "center", "right");
					$array_ru = array("", "Слева", "По центру", "Справа");
					for ($i = 1; $i < count($array_ru); $i++) {
						if (get_post_meta($post->ID, 'cpi_data_93', true) == $array_en[$i]) {
							echo '<option selected value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						} else {
							echo '<option value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						}
					}
				?>
			</select>
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_service');
function custom_add_save_service($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_91']) { update_custom_meta_service($postID, $_POST['cpi_data_91'], 'cpi_data_91'); }
	if ($_POST['cpi_data_92']) { update_custom_meta_service($postID, $_POST['cpi_data_92'], 'cpi_data_92'); }
	if ($_POST['cpi_data_93']) { update_custom_meta_service($postID, $_POST['cpi_data_93'], 'cpi_data_93'); }
}
function update_custom_meta_service($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}	
	
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Вакансии
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_jobs() {
		$labels = array(
			'name'                => _x( 'Вакансии', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Вакансии', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Вакансии', 'bshepelev' ),
			'parent_item_colon'   => __( 'Вакансии', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть записи', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'Записи не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No jobs found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'jobs',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'jobs', 'bshepelev' ),
			'description'         => __( 'Новости и события information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title','editor'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('jobs', $args );
	}
	
	// Hook into the 'init' jobs
	add_action( 'init', 'custom_post_type_jobs', 0 );
	
//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_jobs');
function my_post_options_box_jobs() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_jobs', 'jobs', 'side', 'high');
}
function custom_post_info_jobs() {
	global $post;
	?>
		<style>
			.fls { border:1px solid red; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Дополнительные опции</legend>
			<label class="labels" for="cpi_data_01">Статус вакансии: </label>
			<select class="inputs" name="cpi_data_01" id="cpi_data_01">
				<?php
					$array_en = array("", "none", "new", "hot");
					$array_ru = array("", "Обычная", "Новая", "Горячая");
					for ($i = 1; $i < count($array_ru); $i++) {
						if (get_post_meta($post->ID, 'cpi_data_01', true) == $array_en[$i]) {
							echo '<option selected value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						} else {
							echo '<option value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						}
					}
				?>
			</select>
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_jobs');
function custom_add_save_jobs($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_01']) { update_custom_meta_jobs($postID, $_POST['cpi_data_01'], 'cpi_data_01'); }
}
function update_custom_meta_jobs($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// 	Дополнительные поля для СТРАНИЦА
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_page');
function my_post_options_box_page() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_page', 'page', 'normal', 'high');
}
function custom_post_info_page() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #CCC; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Параметры HEADER</legend>
			<label class="labels" for="cpi_data_91">Ссылка на изображение: </label>
			<input name="cpi_data_91" id="cpi_data_91" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_91', true); ?>" />
			<label class="labels" for="cpi_data_92">Текст: </label>
			<input name="cpi_data_92" id="cpi_data_92" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_92', true); ?>" />
			<label class="labels" for="cpi_data_93">Центрирование: </label>
			<select class="inputs" name="cpi_data_93" id="cpi_data_93">
				<?php
					$array_en = array("", "left", "center", "right");
					$array_ru = array("", "Слева", "По центру", "Справа");
					for ($i = 1; $i < count($array_ru); $i++) {
						if (get_post_meta($post->ID, 'cpi_data_93', true) == $array_en[$i]) {
							echo '<option selected value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						} else {
							echo '<option value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						}
					}
				?>
			</select>
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_page');
function custom_add_save_page($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_91']) { update_custom_meta_page($postID, $_POST['cpi_data_91'], 'cpi_data_91'); }
	if ($_POST['cpi_data_92']) { update_custom_meta_page($postID, $_POST['cpi_data_92'], 'cpi_data_92'); }
	if ($_POST['cpi_data_93']) { update_custom_meta_page($postID, $_POST['cpi_data_93'], 'cpi_data_93'); }
}
function update_custom_meta_page($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// 	Дополнительные поля для ЗАПИСЬ
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_post');
function my_post_options_box_post() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_post', 'post', 'normal', 'high');
}
function custom_post_info_post() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #CCC; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Параметры HEADER</legend>
			<label class="labels" for="cpi_data_91">Ссылка на изображение: </label>
			<input name="cpi_data_91" id="cpi_data_91" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_91', true); ?>" />
			<label class="labels" for="cpi_data_92">Текст: </label>
			<input name="cpi_data_92" id="cpi_data_92" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_92', true); ?>" />
			<label class="labels" for="cpi_data_93">Центрирование: </label>
			<select class="inputs" name="cpi_data_93" id="cpi_data_93">
				<?php
					$array_en = array("", "left", "center", "right");
					$array_ru = array("", "Слева", "По центру", "Справа");
					for ($i = 1; $i < count($array_ru); $i++) {
						if (get_post_meta($post->ID, 'cpi_data_93', true) == $array_en[$i]) {
							echo '<option selected value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						} else {
							echo '<option value="'.$array_en[$i].'">'.$array_ru[$i].'</option>';
						}
					}
				?>
			</select>
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_post');
function custom_add_save_post($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_91']) { update_custom_meta_post($postID, $_POST['cpi_data_91'], 'cpi_data_91'); }
	if ($_POST['cpi_data_92']) { update_custom_meta_post($postID, $_POST['cpi_data_92'], 'cpi_data_92'); }
	if ($_POST['cpi_data_93']) { update_custom_meta_post($postID, $_POST['cpi_data_93'], 'cpi_data_93'); }
}
function update_custom_meta_post($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
//	Регистрация типа записи: Отзывы
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

	function custom_post_type_reviews() {
		$labels = array(
			'name'                => _x( 'Отзывы', 'Post Type General Name', 'bshepelev' ),
			'singular_name'       => _x( 'Отзывы', 'Post Type Singular Name', 'bshepelev' ),
			'menu_name'           => __( 'Отзывы', 'bshepelev' ),
			'parent_item_colon'   => __( 'Отзывы', 'bshepelev' ),
			'all_items'           => __( 'Все записи', 'bshepelev' ),
			'view_item'           => __( 'Смотреть запись', 'bshepelev' ),
			'add_new_item'        => __( 'Добавить запись', 'bshepelev' ),
			'add_new'             => __( 'Новая запись', 'bshepelev' ),
			'edit_item'           => __( 'Редактировать запись', 'bshepelev' ),
			'update_item'         => __( 'Обновить запись', 'bshepelev' ),
			'search_items'        => __( 'Поиск записи', 'bshepelev' ),
			'not_found'           => __( 'запись не найдена', 'bshepelev' ),
			'not_found_in_trash'  => __( 'No record found in Trash', 'bshepelev' ),
		);

		$rewrite = array(
			'slug'                => 'reviews',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);

		$args = array(
			'label'               => __( 'reviews', 'bshepelev' ),
			'description'         => __( 'reviews information pages', 'bshepelev' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);

		register_post_type('reviews', $args );
	}
	
	// Hook into the 'init' reviews
	add_action( 'init', 'custom_post_type_reviews', 0 );
	
//	Добавление полей к типу записей
add_action('admin_menu', 'my_post_options_box_reviews');
function my_post_options_box_reviews() {
	add_meta_box('post_info', 'Опции записи', 'custom_post_info_reviews', 'reviews', 'normal', 'high');
}
function custom_post_info_reviews() {
	global $post;
	?>
		<style>
			.fls { border:1px solid #CCC; padding:10px; }
			.fls legend { margin:0 3px; }
			.labels { width:100%; display:block; padding:8px 0 8px 3px; font-weight:bold; font-size:12px; }
			.inputs { width:100%; display:block; }
			textarea.inputs { height:250px; }
		</style>
		<fieldset class="fls">
			<legend>Параметры</legend>
			<label class="labels" for="cpi_data_01">ФИО: </label>
			<input name="cpi_data_01" id="cpi_data_01" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_01', true); ?>" />
			<label class="labels" for="cpi_data_02">Название компании: </label>
			<input name="cpi_data_02" id="cpi_data_02" class="widefat inputs" style="width:90%;" value="<?php echo get_post_meta($post->ID, 'cpi_data_02', true); ?>" />
		</fieldset>
	<?php 
}
add_action('save_post', 'custom_add_save_reviews');
function custom_add_save_reviews($postID){
	if($parent_id = wp_is_post_revision($postID)) { $postID = $parent_id; }
	if ($_POST['cpi_data_01']) { update_custom_meta_reviews($postID, $_POST['cpi_data_01'], 'cpi_data_01'); }
	if ($_POST['cpi_data_02']) { update_custom_meta_reviews($postID, $_POST['cpi_data_02'], 'cpi_data_02'); }
}
function update_custom_meta_reviews($postID, $newvalue, $field_name) {
	if(!get_post_meta($postID, $field_name)){ add_post_meta($postID, $field_name, $newvalue); } else { update_post_meta($postID, $field_name, $newvalue); }
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Свой логотип при заходе в админку
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

add_action("login_head", "custom_login_logo");

function custom_login_logo() {
	echo "<style>
		body.login form { margin:25px 0 0 0; }
		body.login #login h1 a {
			background: url('".get_bloginfo('template_url')."/images/logo-top.png') no-repeat 0 0;
			height: 112px;
			width: 208px;
			display:block;
			margin:5px auto 0;
			position :relative;
			left:-10px;
		}
	</style>";
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function the_url($url) { return get_bloginfo( 'url' ); }
add_filter( 'login_headerurl', 'the_url' );

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = '&copy 2012 <a target="_blank" href="http://wordpress.org">Wordpress</a>';
    return $text;
}
 
add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = '';
    return $text;
}

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// Отключаем вывод меню в админке
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function remove_menus(){  
    global $menu;  
    $restricted = array( __('Tools'), __('Links'), __('Comments'), __('Plugins'));  
    end ($menu);  
    while (prev($menu)){  
        $value = explode(' ', $menu[key($menu)][0]);  
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}  
    }  
}  
add_action('admin_menu', 'remove_menus');  

// __('Dashboard') — главная страница админки (консоль);
// __('Posts') — меню "Записи";
// __('Media') — меню "Медиафайлы" (картинки, видео и т.п.);
// __('Links') — меню "Ссылки";
// __('Pages') — меню "Страницы";
// __('Appearance') — меню "Внешний вид";
// __('Tools') — меню "инструменты" — это где всякие там: "импорт", "экспорт";
// __('Users') — пользователи;
// __('Settings') — меню "Настройки". Его очень даже можно закрыть для клиентов, а то они настроят ...;
// __('Comments') — комментарии;
// __('Plugins') — меню "Плагины".

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// ОТКЛЮЧАЕМ БЛОКИ в КОНСОЛИ
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

function clear_dash(){  
    $side = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];  
    $normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];  
  
//  unset($side['dashboard_quick_press']);		 //Быстрая публикация  
//  unset($side['dashboard_recent_drafts']);	 //Полседние черновики  
    unset($side['dashboard_primary']); 			 //Блог WordPress  
    unset($side['dashboard_secondary']); 		 //Другие Нновости WordPress  
    unset($normal['dashboard_incoming_links']);  //Входящие ссылки  
//  unset($normal['dashboard_right_now']); 		 //Прямо сейчас  
    unset($normal['dashboard_recent_comments']); //Последние комментарии  
    unset($normal['dashboard_plugins']);		 //Последние Плагины  
}  
add_action('wp_dashboard_setup', 'clear_dash' );  

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// СВОЙ БЛОК-ВИДЖЕТ в КОНСОЛИ
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

// function example_dashboard_widget_function(){  
    // echo "Привет, мир. Я — великий виджет админки, созданный великими программистами";  
// }  

// function example_add_dashboard_widgets() {  
    // wp_add_dashboard_widget('example_dashboard_widget', 'Пример виджета админки', 'example_dashboard_widget_function');  
// }  

// add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );  


/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// ОТКЛЮЧАЕМ АВТО-ОБНОВЛЕНИЕ ЯДРА
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

// # 2.3 to 2.7:
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

// # 2.8 to 3.0:
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'admin_init', '_maybe_update_core' );
add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );

// # 3.0:
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
// ОТКЛЮЧАЕМ АВТО-ОБНОВЛЕНИЕ ПЛАГИНОВ
/*-------------------------------------------------------------------------------------------------------------------------------------------------*/

// # 2.3 to 2.7:
add_action( 'admin_menu', create_function( '$a', "remove_action( 'load-plugins.php', 'wp_update_plugins' );") );
// # Why use the admin_menu hook? It's the only one available between the above hook being added and being applied
add_action( 'admin_init', create_function( '$a', "remove_action( 'admin_init', 'wp_update_plugins' );"), 2 );
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_update_plugins' );"), 2 );
add_filter( 'pre_option_update_plugins', create_function( '$a', "return null;" ) );

// # 2.8 to 3.0:
remove_action( 'load-plugins.php', 'wp_update_plugins' );
remove_action( 'load-update.php', 'wp_update_plugins' );
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
add_filter( 'pre_transient_update_plugins', create_function( '$a', "return null;" ) );

// # 3.0:
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

/*-----------------------------------------------------------------------------------*/
/*	Поиск только по продукции
/*-----------------------------------------------------------------------------------*/

function SearchFilter($query) {
  if ($query->is_search) {
    // Вставьте определенный тип записей, который нужно искать
    $query->set('post_type', array(
		'post'
	));
  }
  return $query;
}

// Данный фильтр будет встроен в цикл и будет сортировать результат поиска перед выводом
add_filter('pre_get_posts','SearchFilter');

/*-----------------------------------------------------------------------------------*/
/*	Свой шорткод
/*-----------------------------------------------------------------------------------*/

function carousel($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => '',
		"title" => ''
	), $atts));
	
	$return_ = '<div class="gallery-carousel" id="carousel-'.$id.'">';
		if (strlen($title) > 1) { $return_ = $return_ . '<h2>'.$title.'</h2>'; }
		$return_ = $return_ . '<ul>';
			global $nggdb;
			$gallery = $nggdb->get_gallery($id);
			foreach($gallery as $image) {
				$return_ = $return_ . '<li><a rel="emersion" href="'.$image->imageURL.'"><img width="221" height="170" src="'.$image->thumbURL.'" /></a></li>';
			}
		$return_ = $return_ . '</ul><div class="clear"></div>';
		$return_ = $return_ . '<a id="prev-carousel-'.$id.'" class="prev-carousel" href="#">&lt;</a>';
		$return_ = $return_ . '<a id="next-carousel-'.$id.'" class="prev-carousel" href="#">&gt;</a>';
		$return_ = $return_ . '<div id="pagercarousel-'.$id.'" class="pager-carousel"></div>';
	$return_ = $return_ . '</div>';
	$return_script = '
		<script>
			$("#carousel-'.$id.' ul").carouFredSel({
				auto: false,
				//prev: "#prev-carousel-'.$id.'",
				//next: "#next-carousel-'.$id.'",
				pagination: "#pagercarousel-'.$id.'",
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		</script>';
	$return_ = $return_ . $return_script;
	
	return $return_;
}
add_shortcode("carousel", "carousel");

function yellow($atts, $content='') {
	extract(shortcode_atts(array(), $atts));
    return '<div class="color-block  yellow"><p>'.$content.'</p></div>';
}	add_shortcode('yellow', 'yellow');

function gray($atts, $content='') {
	extract(shortcode_atts(array(), $atts));
    return '<div class="color-block  gray"><p>'.$content.'</p></div>';
}	add_shortcode('gray', 'gray');

function download($atts, $content='') {
	extract(shortcode_atts(array(
		"title" => ''
	), $atts));
	if (strlen($title) > 1) {
		return '<div class="color-block download"><a href="'.$content.'">'.$title.'</a></div>';
	} else {
		return '<div class="color-block download"><a href="'.$content.'">Загрузить</a></div>';
	}
}	add_shortcode('download', 'download');
	
?>