$("#getInfoBtn").on("click", function() {
  var steamIdValue = $("#steamIDInput").val();
  
  (async () => {
    try {
      await getUserWishlist(steamIdValue);
    }catch (error) {
      showStandardErrorToast();
    }
  })();
});

async function getUserWishlist(steamIdValue) {
  return await Promise.resolve(
    $.ajax({
      url: "actions/getUserWishlist.php",
      type: 'POST',
      data: {steamID: steamIdValue},
      dataType: 'JSON',
      success: function (data) {
        if (data["data"])
        {
          $("#content-section").html(data["data"]);
          $("body").removeClass('h-100');
          var appsIDArray = $('#wishlistTableBody tr').map(function() { return $(this).data('appid'); }).get();
          processArray(appsIDArray);
        }else
          showStandardErrorToast();
      },
      error: function() {
        showStandardErrorToast();
      }
    })
  );
}

async function processArray(array) {
  $('#content-section').prepend('<p class="w-100 m-0 mb-2 p-0 fz-16 fw-500 text-center" id="loading">Loading data...</p>');

  for (const item of array) {
    await getAppInfo(item);
  }

  $('#wishlistTable').dataTable();
  $('#loading').remove();
}

async function getAppInfo(appID) {
  return await Promise.resolve(
    $.ajax({
        url: "actions/getAppInfo.php",
        type: 'POST',
        data: {appID: appID},
        dataType: 'JSON',
        success: function (data) {
          if (data)
          {
            var screenshots = '';
            if (data["data"]["screenshots"].length > 0)
            {
              screenshots = '<div class="w-100 m-0 p-0 d-flex flex-wrap"><p class="m-0 mt-1 mb-1 p-0 w-100 fz-16 fw-500">Screenshots:</p>';
              data["data"]["screenshots"].forEach(function(item) {
                screenshots += '<img class="m-0 p-0" width="100%" loading="lazy" fetchpriority="low" src="' + item + '" />';
              });
              screenshots += '</div>';
            }

            $("#wishlistTable tr[data-appid=" + appID + "] .app-info").html(
              '<p class="m-0 p-0 w-100 d-flex flex-wrap"><span class="fz-16 fw-500">Name:&nbsp;</span><span class="fz-16 app-title">' + data["data"]["title"] + '</span></p>'
              + '<p class="m-0 mt-1 p-0 w-100 d-flex flex-wrap"><span class="fz-16 fw-500">Release date:&nbsp;</span><span class="fz-16">' + data["data"]["release_date"] + '</span></p>'
              + '<p class="m-0 mt-1 p-0 fz-14 d-flex flex-wrap more-info-toggle" role="button" data-toggle="collapse" href="#moreInfo' + appID + '" aria-expanded="false" aria-controls="moreInfo' + appID + '">More info</p>'
              + '<div id="moreInfo' + appID + '" class="collapse">'
              + (data["data"]["platforms"] ? '<p class="m-0 mt-1 p-0 w-100"><span class="fz-16 fw-500">Platforms:&nbsp;</span><span class="fz-16">' + data["data"]["platforms"].join(',&nbsp;') + '</span></p>' : '')
              + (data["data"]["genres"] ? '<p class="m-0 mt-1 p-0 w-100"><span class="fz-16 fw-500">Genres:&nbsp;</span><span class="fz-16">' + data["data"]["genres"].join(',&nbsp;') + '</span></p>' : '')
              + (data["data"]["categories"] ? '<p class="m-0 mt-1 p-0 w-100"><span class="fz-16 fw-500">Categories:&nbsp;</span><span class="fz-16">' + data["data"]["categories"].join(',&nbsp;') + '</span></p>' : '')
              + '<p class="m-0 mt-1 p-0 w-100"><span class="fz-16 fw-500">Achievements (count):&nbsp;</span><span class="fz-16">' + (data["data"]["achievements"]["count"] ? data["data"]["achievements"]["count"] : 0) + '</span></p>'
              + '<p class="m-0 mt-1 p-0 w-100"><span class="fz-16 fw-500">Description:&nbsp;</span><span class="fz-16">' + data["data"]["description"] + '</span></p>'
              + screenshots
              + '</div>'
            );
            $("#wishlistTable tr[data-appid=" + appID + "] .app-demo").html(data["data"]["demos"]);
          }else
            console.log("Error");
        },
        error: function() {
          console.log("Error");
        }
    })
  );
}

function showStandardErrorToast()
{
  $('.toast-body').html('Системная ошибка!');
  $('.toast').addClass('toast-error').removeClass('toast-success').toast('show');
}