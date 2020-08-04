<?php
	class Berk_Search extends WP_Widget {
		function __construct() {
			parent::__construct(
				'search_widget',
				"Arama [Berk]",
				array('description' => "Arama widgeti sidebar.")
			);
		}

		public function widget($args, $instance) {
			?>
			<form role="search" id="searchform" class="searchform" action="<?=home_url('/')?>">
				<div class="search">
					<input type="search" class="search__input" placeholder="<?=$instance['title']?>" name="s" id="s" value="<?=get_search_query()?>">
					<button class="search__icon" type="submit" id="searchsubmit"><i class="fas fa-search"></i></button>
				</div>
			</form>
			<?php
		}

		public function form($instance) {
			$title = ! empty($instance['title']) ? $instance['title'] : "Arama Yap";
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Başlık:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>">
			</p>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			return $instance;
		}
	}

	function register_foo_widget() {
		register_widget('Berk_Search');
	}
	add_action('widgets_init', 'register_foo_widget');