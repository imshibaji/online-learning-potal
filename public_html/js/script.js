// Geo Tracking Code
// Author: Shibaji Debnath
// Version: 1.0.0

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
    $.getJSON('https://ipapi.co/json/', function(data) {
    
      var req = {
        client_ip: data.ip || null,
        city: data.city || 'unknown',
        region: data.region || 'unknown',
        country: data.country_name || 'unknown',
        timezone: data.timezone || 'unknown',
        page_name: window.document.title,
        page_path: window.location.pathname,
        user_agent: window.navigator.userAgent,
        referer: document.referrer,
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
            console.log(err);
          }
      });
    });
  });
}

GeoTracking('/ahoy/visits', 'post', {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
})
// .then(function(res){
//   console.log(res);
  
// }).catch(function(err){
//   console.log(err);
// });

// $('#exam-tab, input').on('click', function(e){
//   console.log(e);
// });