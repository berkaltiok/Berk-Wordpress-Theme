<?php
  class Berk_Article extends WP_Widget {
    public function __construct() {
      $widget_ops = array(
        'classname'                   => 'widget_recent_entries_berk',
        'description'                 => "Son yazılan yazılar widget.",
      );
      parent::__construct('recent-posts-berk', "Son Yazılar [Berk]", $widget_ops );
      $this->alt_option_name = 'widget_recent_entries_berk';
    }

    public function widget($args, $instance) {
      if ( ! isset( $args['widget_id'] ) ) {
        $args['widget_id'] = $this->id;
      }

      $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

      /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
      $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

      $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
      if ( ! $number ) {
        $number = 5;
      }
      $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

      $r = new WP_Query(
        apply_filters(
          'widget_posts_args',
          array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
          ),
          $instance
        )
      );

      if ( ! $r->have_posts() ) {
        return;
      }
      ?>
      <div class="trend">
        <h3><?=$title?></h3>
        <ul class="trend__tabs">
          <?php $i = 1; ?>
          <?php foreach ( $r->posts as $recent_post ) : ?>
            <?php
              $post_title = get_the_title($recent_post->ID);
              $title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
              $thumbnail   = get_the_post_thumbnail_url($recent_post->ID);
            ?>
            <li>
              <a href="<?php the_permalink( $recent_post->ID ); ?>" class="trend__content <?=($i == 1)?"active":null?>" title="<?php echo $title; ?>">
                <?php if ($thumbnail): ?>
                  <img src="<?=$thumbnail?>" alt="<?php echo $title; ?> Thumbnail">
                <?php endif; ?>
                <div class="trend__text">
                  <h5><?php echo $title; ?></h5>
                  <?php if ($show_date): ?>
                    <span><?php echo get_the_date( '', $recent_post->ID ); ?></span>
                  <?php endif; ?>
                </div>
              </a>
            </li>
            <?php $i += 1; ?>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php
    }

    public function update( $new_instance, $old_instance ) {
      $instance              = $old_instance;
      $instance['title']     = sanitize_text_field( $new_instance['title'] );
      $instance['number']    = (int) $new_instance['number'];
      $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
      return $instance;
    }

    public function form( $instance ) {
      $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
      $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
      $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
      ?>
      <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

      <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
      <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

      <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
      <?php
    }
  }
  
  add_action('widgets_init', function () {
    register_widget('Berk_Article');
  });