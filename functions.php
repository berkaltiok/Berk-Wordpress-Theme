<?php
  /**
   * Yazı Kısaltma
   * @author Berk Altıok
   */
  function content_limit($content, $ilimit = false) { 
    $limit = ($ilimit) ? $ilimit : 270;
    $pad = "";
    $content = strip_tags($content); 
    if (strlen($content) > $ilimit) {
      $pad="..."; 
      $content = mb_substr($content, 0, $ilimit, "UTF-8");
    }
    echo $content.$pad;
  }

  // Sayfalama
  function get_pagination($pages = '', $range = 3) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged)) $paged = 1;
    if ($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if (!$pages) {
        $pages = 1;
      }
    }

    if (1 != $pages) {
      echo "<nav><ul class='pagination'>";
      // if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link(1) . "'>İlk</a>";
      if ($paged > 1) echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged - 1)."'>Geri</a></li>";
      for ($i = 1; $i <= $pages; $i++) {
        if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
          $active = ($paged == $i) ? "active disabled":"";
          echo "<li class='page-item {$active}'><a class='page-link' href='".get_pagenum_link($i)."'>{$i}</a></li>";
        }
      }

      if ($paged < $pages) echo "<li class='page-item'><a class='page-link' href='".get_pagenum_link($paged + 1)."'>İleri</a></li>";
      // if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($pages) . "'>Son</a>";
      echo "</ul></nav>";
    }
  }

  // Menu
  function theme_menus() {
    register_nav_menus(array(
      'header-menu' => __('NavBar Menü')
    ));
  }
  
  // Sidebar
  function theme_sidebars() {
    register_sidebar(array (
      'name' => __('Genel Sidebar', 'berk'),
      'id' => 'genel-sidebar',
      'description' => __('Yazılarda ve anasayfada bulunacak sidebar.', 'berk'),
      'before_widget' => '',
      'after_widget' => '',
    ));
  }
  
  // Meta Box
  abstract class Page_Desc {
    public static function add(){
      $screens = ["page"];
      foreach ($screens as $screen) {
        add_meta_box(
          'sayfa_aciklama',
          'Sayfa Açıklaması',
          [self::class, 'html'],
          $screen
        );
      }
    }
   
    public static function save($post_id) {
      if (array_key_exists('page_desc_berk', $_POST)) {
        update_post_meta(
          $post_id,
          'berk_desc_text',
          $_POST['page_desc_berk']
        );
      }
    }
   
    public static function html($post) {
      $value = get_post_meta($post->ID, 'berk_desc_text', true);
      ?>
        <label for="page_desc_berk">Sayfa açıklaması yazınız.</label><br><br>
        <textarea name="page_desc_berk" id="page_desc_berk" class="components-text-control__input" row="3"></textarea>
      <?php
    }
  }
  
  // Sabitler
  add_action('init', 'theme_menus');
  add_action('widgets_init', 'theme_sidebars');
  add_action('add_meta_boxes', ['Page_Desc', 'add']);
  add_action('save_post', ['Page_Desc', 'save']);
  add_theme_support("post-thumbnails");
  add_filter('show_admin_bar', '__return_false');
  
  // Widgets
	require_once "widget/search.php";
	require_once "widget/last_post.php";