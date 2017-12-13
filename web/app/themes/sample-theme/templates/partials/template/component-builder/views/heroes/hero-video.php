<?php
/**
 * Component Name:      Hero
 * Sub Component Name:  Image
 *
 */

global $text;

$video_mp4 = get_sub_field('video_mp4');
$video_webm = get_sub_field('video_webm');
?>

  <div  class="o-hero-video">
    <div class="c-hero">
      <div class="c-video c-video--hero">
        <video  class=""
                poster="<?=get_sub_field('poster_image')['url'] ?>"
                width="1920"
                height="1080"
                autoplay
                loop
                muted>
          <?php if ($video_mp4) : ?><source src="<?= $video_mp4['url'] ?>" type="video/mp4"><?php endif; ?>
          <?php if ($video_webm) : ?><source src="<?= $video_webm['url'] ?>" type="video/webm"><?php endif; ?>
        </video>
      </div>
      <div class="c-hero__overlay">
        <div class="c-hero__container">
          <h1 class="c-panel__title c-panel__heading t-text--white t-text--bold">
            <?= $text['headline'] ?>
          </h1>
          <?php if ($text['tagline']) : ?>
          <p class="c-panel__text t-text--white t-font--medium">
            <?= $text['tagline'] ?>
          </p>
          <?php endif; ?>
          <a  class="c-button c-button--yellow js-modal-trigger--tryit"
              href="/try-it"
              rel="nofollow">
            <?= $text['button'] ?>
          </a>
        </div>
      </div>
    </div>
  </div>
