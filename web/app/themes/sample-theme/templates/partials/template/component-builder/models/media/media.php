<?php
/**
 * Model Name: Media Image / Video
 *
 */

global $content;

// Fallback hack for SVGs which don't report width / height
get_sub_field('image')['width'] == 0 ? $fallback_width = '1200' : $fallback_width = get_sub_field('image')['width'];
get_sub_field('image')['height'] == 0 ? $fallback_height = '1200' : $fallback_height = get_sub_field('image')['height'];

?>
<?php if (have_rows('media_builder')) : while (have_rows('media_builder')) : the_row();
  $size = get_sub_field('image_size');
  $columns = \Builder\get_media_size($size);
  $width = \Builder\get_media_width($size);
  if ($size !== 'full') {
      $height = get_sub_field('image')['sizes']['media-' . $size . '-height'];
      $src = get_sub_field('image')['sizes']['media-' . $size];
  } else {
      $height = $fallback_height;
      $src = get_sub_field('image')['url'];
  }
  $position = \Builder\get_media_position(get_sub_field('position'));
  $border = \Builder\get_border(get_sub_field('show_border'));
?>
  <?php if ($columns) : ?><div class="<?= $columns ?>"><?php endif ?>
    <?php if (get_row_layout() == 'image') : ?>
      <?php
        $has_custom_margin = get_sub_field('element_margin');
        $has_custom_margin != '' ? $custom_margin = 'style="margin:' . $has_custom_margin . ';"' : $custom_margin = null;
      ?>
      <div class="c-media <?= $position ?> <?= $border ?>" <?= $custom_margin ?>>
        <img  class="c-media__image"
              src="<?= $src ?>"
              srcset="<?= wp_get_attachment_image_srcset(get_sub_field('image')['ID'], 'media-'. $size) ?>"
              width="<?= $width ?>"
              height="<?= $height ?>"
              alt="<?= get_sub_field('image')['description'] ?>"
              title="<?= get_sub_field('image')['name'] ?>"
        />
      </div>
    <?php elseif (get_row_layout() == 'video') : ?>
      <?php if (get_sub_field('video_selector') == 'embed') : ?>
      <?php
        $video = get_sub_field('video_embed');
        preg_match('/src="(.+?)"/', $video, $matches);
        $src = $matches[1];
      ?>
      <div class="c-media <?= $position ?> <?= $border ?>">
        <a href="#" class="js-modal-video">
          <img  class="c-media__image c-media__image--poster"
                src="<?= get_sub_field('poster_image')['url'] ?>"
                width="<?= get_sub_field('poster_image')['width'] ?>"
                height="<?= get_sub_field('poster_image')['height'] ?>"
                alt="<?= get_sub_field('poster_image')['description'] ?>"
                title="<?= get_sub_field('poster_image')['name'] ?>"
          />
        </a>
        <div class="c-modal-video ui modal">
          <div class="c-modal__embed">
            <?php
              $video = get_sub_field('video_embed');
              preg_match('/src="(.+?)"/', $video, $matches);
              $url = $matches[1];
              preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $src);
            ?>
            <iframe
              width="1280"
              height="720"
              data-src=<?= $url ?>
              src="https://www.youtube.com/embed/<?= $src[1] ?>?rel=0&amp;controls=1&amp;showinfo=0&amp;enablejsapi=1&amp;"
              frameborder="0"
              allowfullscreen
              data-src="<?= $url ?>"
              >
            </iframe>
          </div>
        </div>
      </div>
      <?php elseif (get_sub_field('video_selector') == 'native') : ?>
        <?php
          $video = get_sub_field('video_embed');
          preg_match('/src="(.+?)"/', $video, $matches);
          $src = $matches[1];
        ?>
      <div class="c-media <?= $position ?> <?= $border ?>">
        <a href="#" class="js-modal-video">
          <img  class="c-media__image c-media__image--poster"
                src="<?= get_sub_field('poster_image')['url'] ?>"
                width="<?= get_sub_field('poster_image')['width'] ?>"
                height="<?= get_sub_field('poster_image')['height'] ?>"
                alt="<?= get_sub_field('poster_image')['description'] ?>"
                title="<?= get_sub_field('poster_image')['name'] ?>"
          />
          </a>
          <div class="c-modal-video ui modal">
            <div class="c-modal__custom">
            <video
              class=""
              width="900"
              height="507"
              data-src=<?= $src ?>
              data-setup='{ "techOrder": [ "youtube", "html5"],
                            "sources": [{  "type": "video/youtube",
                              "src": "<?= $src; ?>"}] ,
                              "poster": "<?= get_sub_field('poster_image')['url'] ?>"
                          }'
            >
            </video>
          </div>
        </div>
      </div>
      <?php elseif (get_sub_field('video_selector') == 'upload') : ?>
      <div class="c-media <?= $position ?> <?= $border ?>">
        <video  class=""
                poster="<?=get_sub_field('poster_image')['url'] ?>"
                width="1920"
                height="1080"
                autoplay
                loop
                muted>
          <source src="<?=get_sub_field('video_mp4')['url'] ?>" type="video/mp4">
          <source src="<?=get_sub_field('video_webm')['url'] ?>" type="video/webm">
        </video>
      </div>
      <?php endif ?>
    <?php endif ?>
  <?php if ($columns) : ?></div><?php endif ?>
<?php endwhile; endif ?>
