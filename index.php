<?php get_header(); ?>
<div class="container">
  <div class="content">
    <div class="content__title">Küçük Blogum.</div>
    <div class="content__desc">Saçma sapan şeyler paylaştığım, küçük ve mütevazi blogum.</div>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
          <a class="article" href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()): ?>
              <div class="article__tumb">
                <div class="article__tag"><?=get_the_category()[0]->cat_name?></div>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="Article Tumb">
              </div>
            <?php endif; ?>
            <div class="article__content">
              <time class="article__date" datetime="<?=get_the_date("Y-m-d")?>"><?=get_the_date()?></time>
              <?php if (!has_post_thumbnail()): ?>
                <div class="article__date"><?=get_the_category()[0]->cat_name?></div>
              <?php endif; ?>
              <div class="article__title"><?php the_title(); ?></div>
              <div class="article__desc">
                <?php content_limit(get_the_content(), 260); ?> 
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="alert alert-border text-center">Site sahibi yazı eklemeye üşendiğinden yazı eklemedi.</div>
      <?php endif; ?>
      <?php get_pagination(); ?>
    </div>
    <div class="col-lg-4">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>