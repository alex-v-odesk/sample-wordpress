// Update price text dynamically with select
// Temp - make these programmatically bound
// Temp - get the value in text area on submit not on select here

function pricingDropdowns() {
  // Update price text dynamically with select
  // Temp - make these programmatically bound
  // Temp - get the value in text area on submit not on select here
  $('.is-dropdown--dynamic-price.is-professional').dropdown({
    onChange: (value, text) => {
      $('.is-price.is-professional').text(value);
      $('.js-form-modal--tryit-professional').find('input[name=contactMessage]').val('Evaluation Request | Professional Tier | ' + text);
      $('.js-form-modal--buyit-professional').find('input[name=contactMessage]').val('Purchase Request | Professional Tier | ' + text);
    },
  });
  $('.is-dropdown--dynamic-price.is-enterprise').dropdown({
    onChange: (value, text) => {
      $('.is-price.is-enterprise').text(value);
      $('.js-form-modal--tryit-enterprise').find('input[name=contactMessage]').val('Evaluation Request | Enterprise Tier | ' + text);
      $('.js-form-modal--buyit-enterprise').find('input[name=contactMessage]').val('Purchase Request | Enterprise Tier | ' + text);
    },
  });
}

export {pricingDropdowns};
