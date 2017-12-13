<?php
/**
 * Component Template: Custom panel for pricing for business
 */

$case_study = get_sub_field('case_study');
$case_study_left = $case_study['columns'][0];
$case_study_right = $case_study['columns'][1];

// Check for custom positioning
$has_custom_position = get_sub_field('element_position');
if ($has_custom_position == 'custom') :
  $custom_position = ' t-custom-positioning';
  $get_padding = get_sub_field('element_padding');
  ($get_padding !== '' && $get_padding !== null) ? $styles[] = 'padding:'. $get_padding . ';' : $styles[] = null;
  $get_margin = get_sub_field('element_margin');
  ($get_margin !== '' && $get_margin !== null) ? $styles[] = 'margin:'. $get_margin . ';' : $styles[] = null;
else :
  $custom_position = null;
  $styles[] = null;
endif;

?>
<section class="o-panel l-container <?= $custom_position ?>" <?= \Builder\inline_styles($styles) ?>>
  <div class="o-custom o-custom__case-study h-mobile-hidden">
    <div class="c-case-study">
      <article class="l-4-of-10 l-mobile">
        <h2 class="t-text--blue t-font--medium t-align--center"><?= $case_study_left['title'] ?></h2>
        <p><?= $case_study_left['text'] ?></p>
        <div class="c-case-study-list">
          <img  class="c-case-study-list__image"
                src="<?= $case_study_left['image']['sizes']['thumbnail'] ?>"
                width="90"
                height="90"
                alt=""
                title=""
          />
          <p class="c-case-study-list__credits t-text--blue">
            <?= $case_study_left['credits'] ?>
          </p>
        </div>
      </article>
      <div class="l-2-of-10">
        <img  class="c-case-study__heart"
              src="<?php echo App\asset_path('images/icon-heart.svg'); ?>"
              width="70"
              height="70"
              alt=""
              title=""
        />
      </div>
      <article class="l-4-of-10 l-mobile">
        <h2 class="t-text--blue t-font--medium t-align--center"><?= $case_study_right['title'] ?></h2>
        <p><?= $case_study_right['text'] ?></p>
        <div class="c-case-study-list">
          <img  class="c-case-study-list__image"
                src="<?= $case_study_right['image']['sizes']['thumbnail'] ?>"
                width="90"
                height="90"
                alt=""
                title=""
          />
          <p class="c-case-study-list__credits t-text--blue">
            <?= $case_study_right['credits'] ?>
          </p>
        </div>
      </article>
    </div>
  </div>
</section>
