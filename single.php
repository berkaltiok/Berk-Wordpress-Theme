<?php get_header(); ?>
<div class="container">
  <div class="content">
    <div class="content__title">Blog.</div>
    <div class="content__desc">Saçmalardan seçmeler, yazdığım blog yazısından birisi işte.</div>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <?php the_post(); ?>
      <div class="post">
        <?php if (has_post_thumbnail()): ?>
          <div class="post__tumb">
            <div class="post__tag"><?=get_the_category()[0]->cat_name?></div>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> Tumbnail">
          </div>
        <?php endif; ?>
        <div class="post__content">
          <h3><?php the_title(); ?></h3>
          <div class="post__info">
            <time class="post__info--tag" datetime="<?=get_the_date("Y-m-d")?>"><?=get_the_date()?></time>
            <?php if (!has_post_thumbnail()): ?>
              <div class="post__info--tag"><?=get_the_category()[0]->cat_name?></div>
            <?php endif; ?>
            <div class="post__info--tag"><?php comments_number( '0', '1', '%' ); ?> Yorum</div>
          </div>
          <?=get_the_content()?>
        </div>
      </div>
      <ul class="postNav">
        <li class="postNav__item">
          <?php $prev_post = get_previous_post(); ?>
          <?php if ($prev_post): ?>
            <a href="<?=get_permalink($prev_post->ID)?>" class="postNav__link">
              <div class="postNav__tag">Önceki Yazı</div>
              <div class="postNav__title"><?=$prev_post->post_title?></div>
  					</a>
          <?php endif; ?>
        </li>
        <li class="postNav__item">
          <?php $next_post = get_next_post(); ?>
          <?php if ($next_post): ?>
            <a href="<?=get_permalink($next_post->ID)?>" class="postNav__link">
              <div class="postNav__tag">Sonraki Yazı</div>
              <div class="postNav__title"><?=$next_post->post_title?></div>
  					</a>
          <?php endif; ?>
        </li>
      </ul>
      <div id="disqus_thread"></div>
      <script>
        (function() {
        var d = document, s = d.createElement('script');
        s.src = '#'; // disqus url
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
      </script>
    </div>
    <div class="col-lg-4">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>