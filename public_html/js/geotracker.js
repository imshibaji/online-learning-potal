/*
 * Geo Tracking JS
 * Simple, powerful JavaScript analytics
 * https://github.com/ankane/ahoy.js
 * v0.0.1
 * MIT License
 */

// console.log(window.document.title);
// console.log(window.location.pathname);
// console.log(window.navigator.userAgent);

// $.getJSON('http://www.geoplugin.net/json.gp?jsoncallback=?', function(data) {
//   console.log(JSON.stringify(data, null, 2));
// });
// console.log(window);

// Geo Tracker
function GeoTracking(tracking_url, method='get', headers){
  return new Promise(function(resolve, reject){
    $.getJSON('http://www.geoplugin.net/json.gp?jsoncallback=?', function(data) {
    
      var req = {
          client_ip: data.geoplugin_request,
          city: data.geoplugin_city,
          region: data.geoplugin_region,
          country: data.geoplugin_countryName,
          timezone: data.geoplugin_timezone,
          page_name: window.document.title,
          page_path: window.location.pathname,
          user_agent: window.navigator.userAgent,
          referer: document.referrer
      }

      // Send Request to Server
      $.ajax({
          url: tracking_url,
          type: method,
          data: req,
          headers: headers,
          dataType: 'json',
          success: function (data) {
              resolve(data);
          },
          error: function(err){
            reject(err);
          }
      });
    });
  });
}

GeoTracking('/ahoy/visits', 'post', {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}).then(function(res){
  console.log(res);
  
}).catch(function(err){
  console.log(err);
});