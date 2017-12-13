
// Declare variable to hold geo location data
let getGeoData;

// Create HTTP request object
var request = new XMLHttpRequest();

// Poll IP geolocation service, note rate limits may be an issue > 15k per hour
// http://freegeoip.net
// Is synchronous an issue?
// TODO poll for result and use promises + polyfill
const server = '//freegeoip.net/json/?callback=';
request.open('GET', server, false);

request.onload = function() {
  if (request.readyState === 4) {
    if (this.status >= 200 && this.status < 400) {
      // Request successful to IP geolocation service
      return getGeoData = JSON.parse(this.response);
    } else {
      // Reached the IP geolocation service, but it returned an error
      // Perhaps we've reached our rate limit
      // TODO: Add event? Notification?
      console.error(request.statusText);
    }
  }
};

request.onerror = function() {
  // Request failed connection error of some sort
  console.error(request.statusText);
};

request.send();

export {getGeoData};
