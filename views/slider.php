<style>
  #slidee-<?= $slider->id; ?> {
    height: <?= $slider->settings['height']; ?>px;
  }

  <?php if ((int)$slider->settings['overlay_enable'] === 1) { ?>
    #slidee-<?= $slider->id; ?> .slidee-overlay {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: <?= $slider->settings['overlay_color']; ?>;
      opacity: <?= (float)$slider->settings['overlay_opacity']; ?>;
      pointer-events: none;
      z-index: 1;
    }
  <?php } ?>

  .slidee__track {
    height: 100%;
  }

  .slidee-slide {
    position: relative;
    width: 100%;
    height: <?= $slider->settings['height']; ?>px;
  }

  .slidee-slide__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .slidee-slide__content {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
  }
  <?php if ($slider->settings['custom_css']) { ?>
    <?= $slider->settings['custom_css']; ?>
  <?php } ?>
</style>

<div id="slidee-<?= $slider->id; ?>" class="slidee">
  <?php if ($slider->slides) { ?>
    <?php foreach ($slider->slides as $slide) { ?>
      <div class="slidee-slide">
        <?php if ((int)$slider->settings['overlay_enable'] === 1) { ?>
          <div class="slidee-overlay"></div>
        <?php } ?>
        <img src="<?= $slide['image']; ?>" class="slidee-slide__img" />
        <div class="slidee-slide__content"><?= $slide['content']; ?></div>
      </div>
    <?php } ?>
  <?php } ?>
</div>

<script>
  (function () {

    document.addEventListener('DOMContentLoaded', function () {
      new Slidee({
        el: document.getElementById('slidee-<?= $slider->id; ?>'),
        animationDuration: <?= $slider->settings['change_speed']; ?>,
        changeDelay: <?= $slider->settings['change_delay']; ?>
      });
    });

  })();
</script>