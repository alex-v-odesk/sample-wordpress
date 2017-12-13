import {poll} from './poll';

function sendToMarketo(form) {
  // Process form inputs into data array
  const email = form.querySelector('input[name=emailAddress]').value;

  // Initialise data to be sent to ajax-admin to process hash value
  let data = {
    action: 'get_hash',
    async: false,
    App_Nonce: App.App_Nonce,
    dataType: 'json',
    email: email,
  };

  $.ajax({
    data: data,
    type: 'POST',
    url: App.ajaxurl,
  })
  .done(function(response) {
    sendToApi(response, form)
  });

  // Refactor
  // let data = new Object();
  // data.action = 'get_hash';
  // data.App_Nonce = App.App_Nonce;
  // data.dataType = 'json';
  // data.email = form.emailAddress;
  //
  // const hashQueryString = Object.keys(data).map(k => `${encodeURIComponent(k)}=${encodeURIComponent(data[k])}`).join('&');
  //
  // const request = new Request(App.ajaxurl, {
  //   method: 'POST',
  //   headers: new Headers({
  //     'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8',
  //   }),
  //   body: hashQueryString,
  //   credentials: 'same-origin',
  // });
  //
  // fetch(request)
  //   .then((response) => {
  //     if(response.status == 200){
  //       console.log(response.text());
  //       sendToApi(response, form)
  //     }
  //   })
  //   .catch(function(error) {
  //     console.log(JSON.stringify(error));
  //   })
  // ;

}

// Process values hidden fields originally in use for IR CRM
function processContactCode(code) {
  if (code == 'DEMO') {
    return 'Demo';
  } else if (code == 'LOCALEVAL') {
    return 'Evaluation';
  } else if (code == 'Partner') {
    return 'Partner';
  } else if (code == 'SERVICES') {
    return 'Services';
  } else {
    return 'Other';
  }
}

function sendToApi(hash, form){

  const dataObject = $(form).serializeArray().reduce(
    function(a, x) {
      a[x.name] = x.value;
      return a;
    }, {});

  // Map to Marketo SOAP API fields
  // http://developers.marketo.com/rest-api/lead-database/fields/
  // http://developers.marketo.com/rest-api/lead-database/fields/list-of-standard-fields/
  // http://developers.marketo.com/rest-api/lead-database/fields/field-types/
  // http://docs.marketo.com/display/public/DOCS/Create+a+Custom+Field+in+Marketo
  const data = {
    'Company': dataObject.company ? dataObject.company : "",
    'contactCode': processContactCode(dataObject.contactTypeCode),
    'Country': dataObject.country ? dataObject.country : "",
    'Email': dataObject.emailAddress ? dataObject.emailAddress : "",
    'FirstName': dataObject.firstName ? dataObject.firstName : "",
    'LastName': dataObject.lastName ? dataObject.lastName : "",
    'leadType': dataObject.interest ? dataObject.interest : "",
    'LeadSource': "Website",
    'Phone': dataObject.phone ? dataObject.phone : "",
    'salesforceStatus': "LeadPending",
    'tellUsMore': dataObject.contactMessage ? dataObject.contactMessage : "",
    'Title': dataObject.jobTitle ? dataObject.jobTitle : "",
  }

  // Checkboxes in Marketo for demo or evaluation requests
  if (dataObject.contactTypeCode == 'DEMO') {
    data.demoRequest = "checked";
  } else if (dataObject.contactTypeCode == 'LOCALEVAL') {
    data.evaluationRequest = "checked";
  }

  // Check MunchkinAPI is available / loaded every 30ms, then send data to API
  // After 10000ms stop polling & time out if Munchkin is not available
  poll(function() {
    return typeof Munchkin !== 'undefined';
  }, 10000, 30).then(function() {
      Munchkin.munchkinFunction('associateLead', data, hash);
  }).catch(function() {
      console.error('Munchkin API is not available.');
  });
}

export {sendToMarketo};
