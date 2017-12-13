<?php
/**
 * View Name: Form - Evaluation - in modal window
 *
 */

?>

<div class="c-form-container l-4-of-5 l-push-1-of-10">
	<form class="c-form c-form--tryit c-form--modal js-form-modal js-form-evaluation ui">
		<input name="actionType" type="hidden" value="evaluationRequest">
		<input name="contactTypeCode" type="hidden" value="LOCALEVAL">
	  <div class="two fields">
		  <div class="c-form__field field">
        <?php \Forms\Input\Text('firstName') ?>
		  </div>
		  <div class="c-form__field field">
        <?php \Forms\Input\Text('lastName') ?>
		  </div>
	  </div>
    <div class="two fields">
      <div class="c-form__field field">
        <?php \Forms\Input\Text('emailAddress') ?>
      </div>
      <div class="c-form__field field">
        <?php \Forms\Input\Text('phone') ?>
      </div>
    </div>
    <div class="two fields">
      <div class="c-form__field field">
        <?php \Forms\Input\Text('jobTitle') ?>
      </div>
      <div class="c-form__field field">
        <?php \Forms\Input\Text('company') ?>
      </div>
    </div>
    <div class="two fields">
    <div class="c-form__field field">
      <?php \Forms\Input\Text('website') ?>
    </div>
    <div class="c-form__field field">
      <?php \Forms\Select('country') ?>
    </div>
  </div>
  <div class="two fields">
    <div class="c-form__field field">
      <?php \Forms\Select('interest', 'evaluation') ?>
    </div>
  </div>
  <div class="c-form__field field">
    <label class="c-form__label t-align--left">
      <?= _x('Tell us more', 'Form Label', 'sample-theme') ?>
    </label>
    <?php \Forms\Textarea('contact'); ?>
  </div>
  <button class="c-button c-button--yellow t-align--right js-form-submit js-validate js-approve" type="submit">
    <?= _x('Submit', 'Form Submit', 'sample-theme') ?>
  </button>
</form>
<?php get_template_part('partials/template/component-builder/views/forms/partials/messages') ?>
</div>
