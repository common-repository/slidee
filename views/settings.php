<?php $renderSlideTpl = function($id = 0, $image = '', $content = '') { ?>
  <div class="slidee-slide j-slide">
    <input type="hidden" name="slidee_slides[image][]" value="<?= $image; ?>" class="slidee-slide__img-id" />
    <div class="slidee-slide__img-wrap">
      <div class="slidee-slide__img"<?= $image ? ' style="background-image:url(\'' . $image . '\');"' : ''; ?>>
        <span class="slidee-slide__img-remove">Remove</span>
      </div>
      <button class="slidee-btn slidee-btn--primary slidee-slide__add-img">Add</button>
    </div>
    <div class="slidee-slide__info-wrap">
      <textarea id="slidee_slide_<?= $id; ?>" name="slidee_slides[content][]" class="j-slide-content" style="width: 100%;"><?= $content; ?></textarea>
    </div>
    <span class="slidee-slide__remove j-slide-remove">Remove</span>
  </div>
<?php }; ?>
<?php //Height ?>
<div class="slidee-form-group">
  <label for="slidee_settings_height" class="slidee-form-group__label">Slider height</label>
  <div class="slidee-form-group__value-wrap">
    <input type="number" name="slidee_settings[height]" id="slidee_settings_height" value="<?= $slidee->settings['height']; ?>" />
  </div>
</div>
<?php //Change speed ?>
<div class="slidee-form-group">
  <label for="slidee_settings_change_speed" class="slidee-form-group__label">Change speed</label>
  <div class="slidee-form-group__value-wrap">
    <input type="number" name="slidee_settings[change_speed]" id="slidee_settings_change_speed" value="<?= $slidee->settings['change_speed']; ?>" />
  </div>
</div>
<?php //Change delay ?>
<div class="slidee-form-group">
  <label for="slidee_settings_change_delay" class="slidee-form-group__label">Change delay</label>
  <div class="slidee-form-group__value-wrap">
    <input type="number" name="slidee_settings[change_delay]" id="slidee_settings_change_delay" value="<?= $slidee->settings['change_delay']; ?>" />
  </div>
</div>
<?php //Overlay enable ?>
<div class="slidee-form-group">
  <label for="slidee_settings_overlay_enable" class="slidee-form-group__label">Enable overlay</label>
  <div class="slidee-form-group__value-wrap">
    <select id="slidee_settings_overlay_enable" name="slidee_settings[overlay_enable]">
      <option value="1" <?= (int)$slidee->settings['overlay_enable'] === 1 ? 'selected' : ''; ?>>Yes</option>
      <option value="0" <?= (int)$slidee->settings['overlay_enable'] === 0 ? 'selected' : ''; ?>>No</option>
    </select>
  </div>
</div>
<?php //Overlay color ?>
<div class="slidee-form-group">
  <label class="slidee-form-group__label">Overlay color</label>
  <div class="slidee-form-group__value-wrap">
    <input type="hidden" name="slidee_settings[overlay_color]" class="j-color-picker" value="<?= $slidee->settings['overlay_color']; ?>">
  </div>
</div>
<?php //Overlay opacity ?>
<div class="slidee-form-group">
  <label for="slidee_settings_overlay_opacity" class="slidee-form-group__label">Overlay opacity</label>
  <div class="slidee-form-group__value-wrap">
    <input type="number" min="0.1" max="1" step="0.1" name="slidee_settings[overlay_opacity]" id="slidee_settings_overlay_opacity" value="<?= $slidee->settings['overlay_opacity']; ?>" />
  </div>
</div>
<?php //Custom css ?>
<div class="slidee-form-group">
  <label for="slidee_settings_custom_css" class="slidee-form-group__label">Custom CSS</label>
  <div class="slidee-form-group__value-wrap">
    <textarea name="slidee_settings[custom_css]" id="slidee_settings_custom_css" style="width: 100%; height: 200px;"><?= $slidee->settings['custom_css']; ?></textarea>
  </div>
</div>
<div id="slidee_settings_slides" class="slidee-slides">
	<?php if ($slidee->slides) { ?>
		<?php foreach ($slidee->slides as $index => $slide) { ?>
			<?php $renderSlideTpl($index, $slide['image'], $slide['content']); ?>
		<?php } ?>
	<?php } else { ?>
		<?php $renderSlideTpl(); ?>
	<?php } ?>
</div>
<button class="slidee-btn slidee-btn--primary slidee-add-slide j-slide-add">Add slide</button>
<script id="slidee_slide_tpl" type="text/html">
  {{#slides}}
  <div class="slidee-slide j-slide">
    <input type="hidden" name="slidee_slides[image][]" value="{{image_url}}" class="slidee-slide__img-id" />
    <div class="slidee-slide__img-wrap">
      <div class="slidee-slide__img" {{{image}}}>
        <span class="slidee-slide__img-remove">Remove</span>
      </div>
      <button class="slidee-btn slidee-btn--primary slidee-slide__add-img">Add</button>
    </div>
    <div class="slidee-slide__info-wrap">
      <textarea id="slidee_slide_{{id}}" name="slidee_slides[content][]" class="j-slide-content" style="width: 100%;">{{{content}}}</textarea>
    </div>
    <span class="slidee-slide__remove j-slide-remove">Remove</span>
  </div>
  {{/slides}}
</script>
