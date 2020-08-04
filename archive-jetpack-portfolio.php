<?php get_header(); ?>
<div class="container">
  <div class="content">
    <div class="content__title">Yaptıklarım.</div>
    <div class="content__desc">Referanslarım ve yaptığım projelerin bazıları.</div>
  </div>
  <?php if (have_posts()): ?>
    <div class="row">
      <?php while (have_posts()): the_post(); ?>
        <?php
          $tags = array();
          foreach (wp_get_object_terms(get_the_ID(), "jetpack-portfolio-type") as $row) {
            $tags[] = $row->name;
          }
        ?>
        <div class="col-md-4">
          <div class="work" id="post-<?php the_ID(); ?>">
            <a class="work__link" href="<?php the_permalink(); ?>">
              <div class="work__content">
                <div class="work__title"><?php the_title(); ?> <div class="work__desc"><?=implode(" / ", $tags)?></div></div>
                
                <div class="work__detail">
                  <div class="work__item"><i class="fas fa-clock"></i><div class="work__item--text"><span>16</span> Saat</div></div>
                  <div class="work__item"><i class="fas fa-coffee"></i><div class="work__item--text"><span>340</span> Kahve</div></div>
                </div>			
              </div>
              <?php if (has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> Thumbnail">
              <?php endif; ?>
            </a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-border text-center">Site sahibi pörtföyüne ekleme yapmamış.</div>
  <?php endif; ?>
</div>
<?php get_footer(); ?>