<?php
  $return_array = [];

  if (isset($_POST["appID"]))
  {
    $appID = $_POST["appID"];
    $url = "http://store.steampowered.com/api/appdetails?appids=".$appID;
    $fileContent = file_get_contents($url);
    $appInfoObj = json_decode($fileContent, true);

    $appInfoTitle = $appInfoObj[$appID]["data"]["name"];
    $appInfoDescription = $appInfoObj[$appID]["data"]["short_description"];
    $appInfoDemos = $appInfoObj[$appID]["data"]["demos"];
    $appInfoPlatforms = [];
    $appInfoCategories = [];
    $appInfoGenres = [];
    $appInfoScreenshots = [];
    $appInfoAchievementsCount = $appInfoObj[$appID]["data"]["achievements"]["total"];
    $appInfoReleaseDate = ($appInfoObj[$appID]["data"]["release_date"]["coming_soon"]) ? 'coming soon' : $appInfoObj[$appID]["data"]["release_date"]["date"];

    $return_array['data']['title'] = $appInfoTitle;
    $return_array['data']['description'] = $appInfoDescription;
    
    if (count($appInfoDemos) > 0)
      $return_array['data']['demos'] =
        '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2A8900">
          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
        </svg>
        <p class="d-none">yes</p>';
    else
      $return_array['data']['demos'] =
        '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#A90000">
          <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
        </svg>
        <p class="d-none">no</p>';

    if ($appInfoObj[$appID]["data"]["platforms"])
    {
      foreach ($appInfoObj[$appID]["data"]["platforms"] as $key => $value) {
        if ($value) array_push($appInfoPlatforms, $key);
      }
    }

    $return_array['data']['platforms'] = $appInfoPlatforms;

    if ($appInfoObj[$appID]["data"]["categories"])
    {
      foreach ($appInfoObj[$appID]["data"]["categories"] as $key => $value) {
        array_push($appInfoCategories, $value["description"]);
      }
    }

    $return_array['data']['categories'] = $appInfoCategories;

    if ($appInfoObj[$appID]["data"]["genres"])
    {
      foreach ($appInfoObj[$appID]["data"]["genres"] as $key => $value) {
        array_push($appInfoGenres, $value["description"]);
      }
    }

    $return_array['data']['genres'] = $appInfoGenres;

    if ($appInfoObj[$appID]["data"]["screenshots"])
    {
      foreach ($appInfoObj[$appID]["data"]["screenshots"] as $key => $value) {
        array_push($appInfoScreenshots, $value["path_thumbnail"]);
      }
    }

    $return_array['data']['screenshots'] = $appInfoScreenshots;
    $return_array['data']['achievements']['count'] = $appInfoAchievementsCount;
    $return_array['data']['release_date'] = $appInfoReleaseDate;
  }

  echo json_encode($return_array);
  return;
?>