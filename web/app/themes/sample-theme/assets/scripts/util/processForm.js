function formStartedProcessing (form, modal=false) {
  if (!modal) {
    form.classList.add('h-hidden');
    const parentPanel = form.parentNode;
    if (parentPanel.closest('.has-form').querySelector('.o-text') !== null) {
      parentPanel.closest('.has-form').querySelector('.o-text').classList.add('h-hidden');
    }
    const validationContainer = parentPanel.querySelector('.c-form-validation');
    validationContainer.classList.remove('h-hidden');
    validationContainer.querySelector('.c-form-validation__processing').classList.remove('h-hidden');
  } else {
    const modal = form.parentNode.parentNode;
    modal.querySelector('.c-modal__header').classList.add('h-hidden');
    const formContainer = form.parentNode;
    form.classList.add('h-hidden');
    formContainer.querySelector('.c-form-validation').classList.remove('h-hidden');
    formContainer.querySelector('.c-form-validation__processing').classList.remove('h-hidden');
  }
}

function formCompletedProcessing (form, modal=false) {
  if (!modal) {
  const parentPanel = form.parentNode;
  const validationContainer = parentPanel.querySelector('.c-form-validation');
  validationContainer.querySelector('.c-form-validation__processing').classList.add('h-hidden');
  validationContainer.querySelector('.c-form-validation__success').classList.remove('h-hidden');
  } else {
    const formContainer = form.parentNode;
    formContainer.querySelector('.c-form-validation__processing').classList.add('h-hidden');
    formContainer.querySelector('.c-form-validation__success').classList.remove('h-hidden');
  }
}

function formErrorProcessing() {
  console.log('Errors :(');
}

// function formSerialize (form) {
//   const s = [];
//   let i = 0, j = 0, field = null;
//   if (typeof form == 'object' && form.nodeName == "FORM") {
//       var len = form.elements.length;
//       for (i=0; i<len; i++) {
//           field = form.elements[i];
//           if (field.name && !field.disabled && field.type != 'file' && field.type != 'reset' && field.type != 'submit' && field.type != 'button') {
//               if (field.type == 'select-multiple') {
//                   for (j=form.elements[i].options.length-1; j>=0; j--) {
//                       if(field.options[j].selected)
//                           s[s.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[j].value);
//                   }
//               } else if ((field.type != 'checkbox' && field.type != 'radio') || field.checked) {
//                   s[s.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value);
//               }
//           }
//       }
//   }
//   return s.join('&').replace(/%20/g, '+');
// }

function processForm(form, modal=false, country=null) {

  // Hide form and show processing state
  formStartedProcessing(form, modal);

  // Process form inputs into data array
  const data = $(form).serializeArray().reduce(
    function(a, x) {
      a[x.name] = x.value;
      return a;
    }, {});
  // Non-jQuery needs FormData polyfill or use above formSerialize()
  // const data = Array.from(new FormData(form).entries(), e => e.map(encodeURIComponent).join('=')).join('&');

  data.country = country;

  // Add WP ajax parameters
  data.action = 'process_form';
  data.App_Nonce = App.App_Nonce;

  // Format data as query string
  const formQueryString = Object.keys(data).map(k => `${encodeURIComponent(k)}=${encodeURIComponent(data[k])}`).join('&');

  const request = new Request(App.ajaxurl, {
    method: 'POST',
    headers: new Headers({
      'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8',
    }),
    body: formQueryString,
    credentials: 'same-origin',
  });

  fetch(request)
    .then((response) => {
      if(response.status == 200){
        formCompletedProcessing(form, modal=false);
        console.log('Ok. Thanks from the FQ!');
      }
    })
    .catch(function(error) {
      formErrorProcessing();
      console.log(JSON.stringify(error));
    })
  ;

}

export {processForm};
