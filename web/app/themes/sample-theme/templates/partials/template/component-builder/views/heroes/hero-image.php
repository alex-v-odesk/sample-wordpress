<?php
/**
 * Component Name:      Hero
 * Sub Component Name:  Image
 *
 */

global $text;

?>

  <div  class="o-hero-image c-billboard c-billboard--hero"
        style="background-image: url('<?=get_sub_field('image')['url'] ?>');">
    <div class="l-container">
      <div class="c-panel c-panel--hero">
        <div class="c-panel__container">
          <?php if ($text['headline']) : ?>
          <h1 class="c-panel__title c-panel__heading t-text--white t-text--bold">
            <?= $text['headline'] ?>
          </h1>
          <?php endif; ?>
          <?php if ($text['tagline']) : ?>
          <p class="c-panel__text t-text--white t-font--medium">
            <?= $text['tagline'] ?>
          </p>
          <?php endif; ?>
          <a  class="c-button c-button--yellow js-modal-tryit"
              href="/try-it"
              rel="nofollow">
            <?= $text['button'] ?>
          </a>
        </div>
      </div>
    </div>
  </div>
