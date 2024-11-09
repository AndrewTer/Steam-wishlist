<!DOCTYPE html>
<html lang="ru" class="h-100 m-0 p-0">
  <head>
    <title>Steam wishlist</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="description" content="Steam wishlist with demos by user's SteamID">
    <meta name="Keywords" content="Steam, games, apps, wishlist">
    <meta name="application-name" content="Steam wishlist">
    <meta name="theme-color" content="">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body class="h-100 m-0 d-flex flex-column align-items-center justify-content-center">
    <p id="title" class="m-0 mb-2 p-0">Steam wishlist with demos</p>
    <section id="search-section" class="m-0 d-flex flex-wrap justify-content-between">
      <div class="input-group">
        <input type="text" id="steamIDInput" class="form-control" placeholder="Enter your SteamID" aria-label="Enter your SteamID"> 
        <button type="button" id="getInfoBtn" class="btn btn-primary">Get info</button>
      </div>
    </section>
    <section id="content-section" class="m-0 mt-10px"></section>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
  <footer>
    <div class="toast m-0 pl-2 pr-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
      <div class="toast-body"></div>
    </div>
  </footer>
</html>