  <div class="c-form-validation h-hidden">
    <div class="c-form-validation__processing h-hidden">
      <div class="c-panel">
        <h1 class="c-panel__heading t-font--large">
          <?= _x('Processing!', 'Form Messages', 'sample-theme') ?>
        </h1>
        <p class="c-panel__subheading t-font--medium">
          <?= _x('Please wait. This won\'t take long.', 'Form Messages', 'sample-theme') ?>
        </p>
      </div>
    </div>
    <div class="c-form-validation__success h-hidden">
      <div class="c-panel">
        <h1 class="c-panel__heading t-font--large">
          <?= _x('Request confirmed!', 'Form Messages', 'sample-theme') ?>
        </h1>
        <img
          class=""
          src="<?= App\asset_path('images/form-success.svg') ?>"
          width="324"
          height="280"
          alt="sample-theme Business Intelligence"
          title="sample-theme Business Intelligence"
        />
        <p class="c-panel__subheading t-font--medium">
          <?= _x('We\'re tackling your request now. You should receive an email shortly!', 'Form Messages', 'sample-theme') ?>
        </p>
      </div>
    </div>
    <div class="c-form-validation__fail h-hidden">
      <div class="c-panel">
        <h1 class="c-panel__heading t-font--medium">
          <?= _x('Oh no! Something went wrong with your request. It was probably our fault...', 'Form Messages', 'sample-theme') ?>
        </h1>
        <img
          class=""
          src="<?= App\asset_path('images/form-fail.svg') ?>"
          width="324"
          height="280"
          alt="sample-theme Business Intelligence"
          title="sample-theme Business Intelligence"
        />
        <p class="c-panel__subheading t-font--medium">
          <?= _x('If you could contact <a href="mailto:support@irg.st" class="t-text--white">support@irg.st</a> with the details you just entered, our team will rescue your request.', 'Form Messages', 'sample-theme') ?>
        </p>
      </div>
    </div>
  </div>
