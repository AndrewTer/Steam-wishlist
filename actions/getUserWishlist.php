<?php
  $return_array = [];

  if (isset($_POST["steamID"]))
  {
    $url = "https://store.steampowered.com/wishlist/profiles/".$_POST["steamID"]."/wishlistdata";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array("Accept: application/json");

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $resp = curl_exec($curl);
    curl_close($curl);
    $appsObj = (array)json_decode($resp, true);
    $appsIDArray = array_keys($appsObj);

    if (count($appsIDArray) > 0)
    {
      $return_array['data'] =
        '<table id="wishlistTable" class="table">
          <thead>
            <tr>
              <th scope="col" class="w-10">AppID</th>
              <th scope="col" class="w-80">Info</th>
              <th scope="col" class="w-10">Demo</th>
            </tr>
          </thead>
          <tbody id="wishlistTableBody">';

      foreach ($appsIDArray as $value) {
        $return_array['data'] .=
          '<tr data-appID="'.$value.'">
            <th scope="row" class="w-10">'.$value.'</th>
            <td class="app-info d-flex flex-wrap"></td>
            <td class="app-demo w-10 text-center"></td>
          </tr>';
      }
      
      $return_array['data'] .= '</tbody></table>';
    }
  }

  echo json_encode($return_array);
  return;
?>