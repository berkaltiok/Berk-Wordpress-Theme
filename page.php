<?php get_header(); ?>
<?php the_post(); ?>
<div class="container">
  <div class="content">
    <div class="content__title"><?php the_title(); ?>.</div>
    <?php if (get_post_meta(get_the_ID(), "berk_desc_text")): ?>
      <div class="content__desc"><?=get_post_meta(get_the_ID(), "berk_desc_text")[0]?></div>
    <?php endif; ?>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <div class="post">
        <?php if (has_post_thumbnail()): ?>
          <div class="post__tumb">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> Tumbnail">
          </div>
        <?php endif; ?>
        <div class="post__content">
          <?=get_the_content()?>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>