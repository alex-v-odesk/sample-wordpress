// Polyfill our ridiculous IE friend
import {ArrayFrom} from './polyfills';
if (!Array.from) {
  Array.from = new ArrayFrom();
}

// Look up geolocation data from user IP address
import {getGeoData} from './ipAddressGeoLocate';
let user = getGeoData;

// Check if user has visited and left a "cookie"
function hasUser() {
  if(localStorage.getItem('user')) {
    return true;
  } else {
    return false;
  }
}

const USER_EXISTS = hasUser();

function setUserID() {
  // Random string + timestamp to minimise likelihood of collision
  return '_' + Math.random().toString(36).substr(2, 9) + Date.now();
}

function getUserID() {
  return JSON.parse(localStorage.getItem('user'))['userID'];
}

// If user has not visited then generate new "cookie" otherwise use existing
let USER_ID;
if (USER_EXISTS) {
  USER_ID = getUserID();
} else {
  USER_ID = setUserID();
  const user = {
    userID: USER_ID,
    date: Date.now(),
  };
  localStorage.setItem('user', JSON.stringify(user));
}

// Event type code for CRM
function eventType(type) {
  if (type == 'click') {
    return 'CONTENTMANAGEMENT';
  } else if (type == 'request') {
    return 'REQUEST';
  } else {
    return 'CONTENTACTION';
  }
}

// Event code for CRM
function eventCode(code) {
  if (code == 'click') {
    return 'READITEM';
  } else if (code == 'demo' || code == 'DEMO') {
    return 'DEMO';
  } else if (code == 'eval') {
    return 'EVAL';
  } else if (code == 'video') {
    return 'VIDEO';
  } else if (code == 'contact') {
    return 'CONTACT';
  } else if (code == 'sample-theme') {
    return 'sample-theme';
  } else if (code == 'sample-themedemo') {
    return 'sample-themeDEMO';
  } else {
    return null;
  }
}

// Get video URL set in data-src attribute
function videoUrl(element) {
  let SRC = element.currentTarget.closest('.c-media').querySelector('iframe').getAttribute('data-src');
  return SRC;
}

// Don't pass element for all events
function processEvent(type, code=null, element=null, form=null) {

  if (code==null) {
    code = type;
  }

  // Initialise data to be sent to events MQ
  let eventData = new Object();
  eventData.action = 'process_event';
  eventData.App_Nonce = App.App_Nonce;
  eventData.browser = navigator.userAgent;
  eventData.dataType = 'json';
  eventData.eventCode = eventCode(code);
  eventData.eventTypeCode = eventType(type);
  eventData.ipAddress = user.ip;
  eventData.locale = navigator.language;
  eventData.referrer = document.referrer;
  eventData.slug = window.location.pathname.substr(1);
  eventData.userID = USER_ID;

  // Add video event data (for iframe only currently)
  if (code === 'video'){
    eventData.video = videoUrl(element);
  }

  // Add form data (note only contactType and email for demo request )
  if (form !== null){
    eventData.contactType = form.contactType;
    eventData.company = form.company;
    eventData.country = form.country;
    eventData.email = form.email;
    eventData.firstName = form.firstName;
    eventData.lastName = form.lastName;
    eventData.phone = form.phone;
  }

  const eventQueryString = Object.keys(eventData).map(k => `${encodeURIComponent(k)}=${encodeURIComponent(eventData[k])}`).join('&');

  const request = new Request(App.ajaxurl, {
    method: 'POST',
    headers: new Headers({
      'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8',
    }),
    body: eventQueryString,
    credentials: 'same-origin',
  });

  fetch(request)
    .then((response) => {
      if(response.status == 200){
        console.log('Ok. Thanks from the EQ!');
      }
    })
    .catch(function(error) {
      console.log(JSON.stringify(error));
    })
  ;
}

// User navigates to a page
(function () {
  window.addEventListener('load', () => {
    processEvent('click');
  });
})();

// User clicks on modal video
(function () {
  Array.from(document.querySelectorAll('.js-modal-video'),
    video => {
      video.addEventListener('click', (element) => {
        processEvent('video', null, element);
      });
    });
})();

// User submits contact form
(function () {
  Array.from(document.querySelectorAll('.c-form.o-form-contact'),
    form => {
      form.addEventListener('submit', () => {
        processEvent('eval');
        processEvent('request', 'contact', null, true);
      });
    });
})();

// User submits try it / evaluation form
(function () {
  Array.from(document.querySelectorAll('.c-form.c-form-tryit'),
    form => {
      form.addEventListener('submit', () => {
        processEvent('eval');
        processEvent('request', 'sample-theme', null, true);
      });
    });
})();

// User submits demo form
(function () {
  Array.from(document.querySelectorAll('.c-form.c-form--demo'),
    form => {
      form.addEventListener('submit', () => {
        processEvent('demo');
        processEvent('request', 'sample-themedemo', null, true );
      });
    });
})();

export {processEvent};
