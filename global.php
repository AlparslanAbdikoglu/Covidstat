<?php
  ini_set("allow_url_fopen", 1);
  header("Access-Control-Allow-Origin: *");

  /* fetch historical API data */
  $json = file_get_contents('https://disease.sh/v3/covid-19/all');
  $obj = json_decode($json);
  $jsonHistorial = file_get_contents('https://corona.lmao.ninja/v2/historical/all?lastdays=all');
  $objHistorial = json_decode($jsonHistorial);
  $arrayHistorial = json_decode(json_encode($objHistorial), true);

  /* cases - chart[1] */
  $datesCases = array_keys($arrayHistorial['cases']);

$items = array();
  foreach ($datesCases as $key => $value) {
    $items[] = date("j M", strtotime($value))."";

  };

$datesFormattedShort = '"'.implode('","',$items).'"' ;


//print_r($datesFormattedShort);

  $datesFormatted = "".implode(",",$datesCases);

  $casesByDay = array_values($arrayHistorial['cases']);
  $casesByDayFormatted = "'".implode("','",$casesByDay)."'";

  /* deaths - chart[2] */
  $datesDeaths = array_keys($arrayHistorial['deaths']);

$itemsD = array();
$itemsDeaths = array();
  foreach ($datesDeaths as $key => $value) {
    $itemsD[] = date("j M", strtotime($value))."";

  };

$datesDeathsFormattedShort = '"'.implode('","',$itemsD).'"' ;

  $datesFormattedDeaths ="'".implode("','",$datesDeaths)."'";
  $deathsByDay = array_values($arrayHistorial['deaths']);
  $deathsByDayFormatted = "'".implode("','",$deathsByDay)."'";



  /* top card calculations */
  $yesterdayCases = end($arrayHistorial['cases']);
  $totalCases = ($obj-> cases);

  $yesterdayDeaths = end($arrayHistorial['deaths']);
  $totalDeaths = ($obj-> deaths);

  $yesterdayRecoveries = end($arrayHistorial['recovered']);
  $totalRecoveries= ($obj-> recovered);

  $activeCases = ($obj-> active);
  $activeYesterday = ($yesterdayCases - $yesterdayDeaths - $yesterdayRecoveries);

  /* calculate percentage change */
  function getPercentageChange($oldNumber, $newNumber){
    $decreaseValue = $newNumber - $oldNumber;
    $percentage = round(($decreaseValue / $oldNumber) * 100);
    $output = "";

    if ($percentage > 0) {
      $output = $percentage . "% increase";
    } elseif ($percentage < 0) {
      $output = $percentage . "% decrease";
    } else {
      $output = $percentage . "% increase";
    }

    return $output;
  }

  function getBadgeClass($percentage){
    $output = "";

    if ($percentage > 0) {
      $output = "badge-danger";
    } elseif ($percentage < 0) {
      $output = "badge-success";
    } else {
      $output = "badge-info";
    }

    return $output;
  }

  function thousandsCurrencyFormat($num) {
    if ($num > 1000) {
      $x = round($num);
      $x_number_format = number_format($x);
      $x_array = explode(',', $x_number_format);
      $x_parts = array('k', 'm', 'b', 't');
      $x_count_parts = count($x_array) - 1;
      $x_display = $x;
      $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
      $x_display .= $x_parts[$x_count_parts - 1];

      return $x_display;
    } else {
      return $num;
    }
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>COVID Tracker</title>
  <meta name="description" content="Stats for the Coronavirus Covid-19 outbreak">

  <link rel="stylesheet" href="assets/css/tachyons.min.css">
  <link rel="stylesheet" href="assets/css/site.css?v=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180533926-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-180533926-1');
</script>


  <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon//apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon//apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon//apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon//apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon//apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon//apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon//apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon//apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="assets/favicon//android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon//favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon//favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon//favicon-16x16.png">
  <link rel="manifest" href="assets/favicon//manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/favicon//ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <!-- Open Graph / Facebook-->
 <meta property="og:type" content="website">
  <meta property="og:url" content="http://koronainfok.com/">
  <meta property="og:title" content="🦠KoronaVírus Statisztika">
  <meta property="og:description" content="Covid-19 Világ és Hazai statisztikák, hírek intézkedések.
Az adatok hitelességét a Worldometers és a Johns Hopkins University biztosítja.">
  <meta property="og:image" content="http://koronainfok.com/assets/img/metafb.png">
  <meta property="fb:app_id" content="715011399363581">

  <!-- Datatables -->
  <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" />
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>
<body class="">
  <div class="h-100 midnight-blue pa3 ph0-l pv6-l">
      <div class="center mw7">
          <nav class="db dt-l w-100 border-box pa3 ">
              <div class="switch-wrapper">
                  <img class="theme-icon" src="assets/img/moon.svg">
                  <div class="theme-switch">
                      <div class="switch"></div>
                  </div>
              </div>
          </nav>
      <article class="cf">
        <header class="header mw5 mw7-ns tl pa3">
          <div class="fl w-50-ns pa2">
          <h1 class="mt0">👑COVID-19<img class="theme-icon" src="assets/img/coronavirus.svg"> Tracker</h1>
          <p class="lh-copy measure black-60">
            Track the Coronavirus Covid-19 outbreak& search countries.</p>
           </div>
            <div class="fl w-50-ns pa2 link">
            <!--FBSHARE-->
            <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v8.0&appId=715011399363581&autoLogAppEvents=1" nonce="Nqn3gqHw"></script>
            <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="Alparslan" data-color="#000000" data-emoji=""  data-font="Cookie" data-text="Buy me a coffee" data-outline-color="#fff" data-font-color="#fff" data-coffee-color="#fd0" ></script>

        </header>

        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="50" height="50"
viewBox="0 0 172 172"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><circle cx="14" cy="29" transform="scale(1.72,1.72)" r="2" fill="#ee3e54"></circle><circle cx="78" cy="13" transform="scale(1.72,1.72)" r="1" fill="#e74c3c"></circle><circle cx="51" cy="50" transform="scale(1.72,1.72)" r="37" fill="#fce0a2"></circle><circle cx="84" cy="15" transform="scale(1.72,1.72)" r="4" fill="#e74c3c"></circle><circle cx="88" cy="24" transform="scale(1.72,1.72)" r="2" fill="#ee3e54"></circle><circle cx="82" cy="76" transform="scale(1.72,1.72)" r="2" fill="#e74c3c"></circle><circle cx="21" cy="72" transform="scale(1.72,1.72)" r="4" fill="#e74c3c"></circle><circle cx="26" cy="87" transform="scale(1.72,1.72)" r="2" fill="#ee3e54"></circle><circle cx="22.5" cy="61.5" transform="scale(1.72,1.72)" r="2.5" fill="#ffffff"></circle><circle cx="29" cy="76" transform="scale(1.72,1.72)" r="1" fill="#e74c3c"></circle><circle cx="81" cy="34" transform="scale(1.72,1.72)" r="1" fill="#ffffff"></circle><path d="M95.46,45.58c0,-1.42588 -3.4658,-2.58 -7.74,-2.58c-4.2742,0 -7.74,1.15412 -7.74,2.58c0,1.12144 1.72,2.58 5.16,2.42176v8.75824h5.16v-8.75824c3.44,0.15824 5.16,-1.30032 5.16,-2.42176z" fill="#00ca51"></path><path d="M90.3,57.62h-5.16c-0.47472,0 -0.86,-0.38528 -0.86,-0.86v-7.89308c-1.8232,-0.06192 -3.35744,-0.58308 -4.2914,-1.47404c-0.559,-0.53492 -0.8686,-1.17992 -0.8686,-1.81288c0,-2.36328 4.45824,-3.44 8.6,-3.44c4.14176,0 8.6,1.07672 8.6,3.44c0,0.63296 -0.3096,1.27796 -0.8686,1.81288c-0.93396,0.89096 -2.4682,1.41212 -4.2914,1.47404v7.89308c0,0.47472 -0.38528,0.86 -0.86,0.86zM86,55.9h3.44v-7.89824c0,-0.23392 0.09632,-0.45924 0.2666,-0.62264c0.17028,-0.16168 0.4042,-0.24596 0.63296,-0.23736c2.55592,0.11524 3.64812,-0.731 3.92332,-0.99416c0.24768,-0.23564 0.33712,-0.44892 0.33712,-0.5676c0,-0.44204 -2.365,-1.72 -6.88,-1.72c-4.515,0 -6.88,1.27796 -6.88,1.72c0,0.11868 0.08944,0.33196 0.33712,0.56932c0.2752,0.26316 1.39148,1.11284 3.92332,0.99416c0.2322,-0.0086 0.46268,0.07396 0.63296,0.23736c0.17028,0.16168 0.2666,0.387 0.2666,0.62092z" fill="#000000"></path><path d="M90.3,125.71824v-8.75824h-5.16v8.75824c-3.44,-0.15824 -5.16,1.30032 -5.16,2.42176c0,1.42416 3.4658,2.58 7.74,2.58c4.2742,0 7.74,-1.15584 7.74,-2.58c0,-1.12144 -1.72,-2.58 -5.16,-2.42176z" fill="#00ca51"></path><path d="M87.72,131.58c-4.14176,0 -8.6,-1.07672 -8.6,-3.44c0,-0.63296 0.3096,-1.27624 0.8686,-1.81288c0.93396,-0.89268 2.4682,-1.41212 4.2914,-1.47404v-7.89308c0,-0.47472 0.38528,-0.86 0.86,-0.86h5.16c0.47472,0 0.86,0.38528 0.86,0.86v7.89308c1.8232,0.06192 3.35744,0.58308 4.2914,1.47404c0.559,0.53492 0.8686,1.17992 0.8686,1.81288c0,2.36328 -4.45824,3.44 -8.6,3.44zM84.62916,126.5662c-2.21708,0 -3.19404,0.75852 -3.45032,1.00448c-0.2494,0.23736 -0.33884,0.45064 -0.33884,0.56932c0,0.44204 2.365,1.72 6.88,1.72c4.515,0 6.88,-1.27796 6.88,-1.72c0,-0.11868 -0.08944,-0.33196 -0.33712,-0.56932c-0.2752,-0.26316 -1.38288,-1.10596 -3.92332,-0.99416c-0.2322,0.00516 -0.4644,-0.07396 -0.63296,-0.23736c-0.17028,-0.16168 -0.2666,-0.387 -0.2666,-0.62092v-7.89824h-3.44v7.89824c0,0.23392 -0.09632,0.45924 -0.2666,0.62264c-0.17028,0.16168 -0.39732,0.24252 -0.63296,0.23736c-0.1634,-0.0086 -0.31992,-0.01204 -0.47128,-0.01204z" fill="#000000"></path><path d="M129,79.12c-1.12144,0 -2.06744,2.16032 -2.42176,5.16h-8.75824v5.16h8.75824c0.35604,2.99968 1.30032,5.16 2.42176,5.16c1.42416,0 2.58,-3.4658 2.58,-7.74c0,-4.2742 -1.15584,-7.74 -2.58,-7.74z" fill="#00ca51"></path><path d="M129,95.46c-1.49984,0 -2.66256,-1.91264 -3.17168,-5.16h-8.00832c-0.47472,0 -0.86,-0.38528 -0.86,-0.86v-5.16c0,-0.47472 0.38528,-0.86 0.86,-0.86h8.00832c0.50912,-3.24736 1.67356,-5.16 3.17168,-5.16c2.36328,0 3.44,4.45824 3.44,8.6c0,4.14176 -1.07672,8.6 -3.44,8.6zM118.68,88.58h7.89824c0.43516,0 0.80324,0.32508 0.85484,0.75852c0.38872,3.30068 1.34504,4.40148 1.56692,4.40148c0.44204,0 1.72,-2.365 1.72,-6.88c0,-4.515 -1.27796,-6.88 -1.72,-6.88c-0.22188,0 -1.1782,1.1008 -1.56864,4.40148c-0.0516,0.43344 -0.41796,0.75852 -0.85484,0.75852h-7.89652z" fill="#000000"></path><path d="M57.62,84.28h-8.75824c-0.35604,-2.99968 -1.30032,-5.16 -2.42176,-5.16c-1.42416,0 -2.58,3.4658 -2.58,7.74c0,4.2742 1.15584,7.74 2.58,7.74c1.12144,0 2.06744,-2.16032 2.42176,-5.16h8.75824z" fill="#00ca51"></path><path d="M46.44,95.46c-2.36328,0 -3.44,-4.45824 -3.44,-8.6c0,-4.14176 1.07672,-8.6 3.44,-8.6c1.49984,0 2.66256,1.91264 3.17168,5.16h8.00832c0.47472,0 0.86,0.38528 0.86,0.86v5.16c0,0.47472 -0.38528,0.86 -0.86,0.86h-8.00832c-0.50912,3.24736 -1.67184,5.16 -3.17168,5.16zM46.44,79.98c-0.44204,0 -1.72,2.365 -1.72,6.88c0,4.515 1.27796,6.88 1.72,6.88c0.22188,0 1.1782,-1.1008 1.56864,-4.40148c0.0516,-0.43344 0.41796,-0.75852 0.85484,-0.75852h7.89652v-3.44h-7.89824c-0.43516,0 -0.80324,-0.32508 -0.85484,-0.75852c-0.38872,-3.30068 -1.34504,-4.40148 -1.56692,-4.40148z" fill="#000000"></path><circle cx="51" cy="50.5" transform="scale(1.72,1.72)" r="19.5" fill="#00ca51"></circle><path d="M87.72,121.26c-18.96816,0 -34.4,-15.43184 -34.4,-34.4c0,-18.96816 15.43184,-34.4 34.4,-34.4c18.96816,0 34.4,15.43184 34.4,34.4c0,18.96816 -15.43184,34.4 -34.4,34.4zM87.72,54.18c-18.02044,0 -32.68,14.65956 -32.68,32.68c0,18.02044 14.65956,32.68 32.68,32.68c18.02044,0 32.68,-14.65956 32.68,-32.68c0,-18.02044 -14.65956,-32.68 -32.68,-32.68z" fill="#000000"></path><path d="M118.73332,55.84668c-3.02204,-3.02204 -6.29004,-4.65604 -7.29796,-3.64812c-0.79292,0.79292 0.06708,2.98936 1.93672,5.36124l-6.192,6.19372l3.64812,3.64812l6.192,-6.192c2.37188,1.86964 4.56832,2.72792 5.36124,1.935c1.00792,-1.00964 -0.62436,-4.27592 -3.64812,-7.29796z" fill="#00ca51"></path><path d="M110.8282,68.25992c-0.22016,0 -0.44032,-0.08428 -0.60888,-0.25112c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604l6.19372,-6.192c0.30788,-0.3096 0.79636,-0.33712 1.14036,-0.06708c2.61268,2.05884 4.06264,2.16032 4.22088,2.0038c0.31304,-0.31304 -0.4558,-2.8896 -3.64812,-6.08192c-3.19404,-3.19404 -5.76888,-3.95772 -6.08192,-3.64812c-0.15652,0.15652 -0.05332,1.60992 2.0038,4.22088c0.27004,0.34228 0.2408,0.83248 -0.06708,1.14036l-6.19372,6.19372c-0.3354,0.3354 -0.88064,0.3354 -1.21604,0c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604l5.66224,-5.66224c-1.935,-2.65568 -2.46476,-4.83148 -1.40524,-5.891c1.67012,-1.67184 5.58484,0.71896 8.514,3.64812c2.92916,2.92916 5.31996,6.84216 3.64812,8.514c-1.0578,1.05952 -3.2336,0.53148 -5.891,-1.40524l-5.66224,5.66224c-0.16856,0.1634 -0.38872,0.24768 -0.60888,0.24768z" fill="#000000"></path><path d="M68.25992,109.9682l-3.64812,-3.64812l-6.19372,6.192c-2.37188,-1.86964 -4.56832,-2.72964 -5.36124,-1.935c-1.00792,1.00792 0.62608,4.2742 3.64812,7.29796c3.02204,3.02204 6.29004,4.65604 7.29796,3.64812c0.79292,-0.79292 -0.06708,-2.98936 -1.93672,-5.36124z" fill="#00ca51"></path><path d="M63.15496,122.68244c-1.95048,0 -4.79708,-1.94016 -7.05716,-4.20024c-2.92916,-2.92916 -5.31996,-6.84216 -3.64812,-8.514c1.0578,-1.05952 3.23532,-0.53148 5.891,1.40524l5.66224,-5.66224c0.3354,-0.3354 0.88064,-0.3354 1.21604,0c0.3354,0.3354 0.3354,0.88064 0,1.21604l-6.19372,6.192c-0.3096,0.30788 -0.7998,0.33712 -1.14036,0.06708c-2.61268,-2.05884 -4.06092,-2.1586 -4.22088,-2.0038c-0.31304,0.31304 0.4558,2.8896 3.64812,6.08192c3.1906,3.19232 5.76372,3.95944 6.08192,3.64812c0.15652,-0.15652 0.05504,-1.60992 -2.0038,-4.22088c-0.27004,-0.34228 -0.2408,-0.83248 0.06708,-1.14036l6.19372,-6.19372c0.3354,-0.3354 0.88064,-0.3354 1.21604,0c0.3354,0.3354 0.3354,0.88064 0,1.21604l-5.66224,5.66224c1.935,2.65568 2.46648,4.83148 1.40524,5.89272c-0.38012,0.38356 -0.87892,0.55384 -1.45512,0.55384z" fill="#000000"></path><g fill="#00ca51"><path d="M68.25992,63.7518l-6.192,-6.19372c1.86964,-2.37188 2.72964,-4.56832 1.93672,-5.36124c-1.00792,-1.00792 -4.2742,0.62608 -7.29796,3.64812c-3.02204,3.02204 -4.65604,6.29004 -3.64812,7.29796c0.79292,0.79292 2.98936,-0.06708 5.36124,-1.935l6.19372,6.192z"></path></g><g fill="#00ca51"><path d="M122.38316,110.57536c-0.79292,-0.79292 -2.98936,0.06708 -5.36124,1.935l-6.192,-6.192l-3.64812,3.64812l6.192,6.19372c-1.86964,2.37188 -2.72964,4.56832 -1.93672,5.36124c1.00792,1.00792 4.2742,-0.62608 7.29796,-3.64812c3.02204,-3.02204 4.65432,-6.29004 3.64812,-7.29796z"></path></g><g><ellipse cx="51.5" cy="38" transform="scale(1.72,1.72)" rx="4" ry="3" fill="#666666"></ellipse><path d="M88.58,71.38c-4.26732,0 -7.74,-2.7004 -7.74,-6.02c0,-3.3196 3.47268,-6.02 7.74,-6.02c4.26732,0 7.74,2.7004 7.74,6.02c0,3.3196 -3.47268,6.02 -7.74,6.02zM88.58,61.06c-3.3196,0 -6.02,1.92984 -6.02,4.3c0,2.37016 2.7004,4.3 6.02,4.3c3.3196,0 6.02,-1.92984 6.02,-4.3c0,-2.37016 -2.7004,-4.3 -6.02,-4.3z" fill="#000000"></path></g><g><ellipse cx="51.5" cy="64" transform="scale(1.72,1.72)" rx="4" ry="3" fill="#666666"></ellipse><path d="M88.58,116.1c-4.26732,0 -7.74,-2.7004 -7.74,-6.02c0,-3.3196 3.47268,-6.02 7.74,-6.02c4.26732,0 7.74,2.7004 7.74,6.02c0,3.3196 -3.47268,6.02 -7.74,6.02zM88.58,105.78c-3.3196,0 -6.02,1.92984 -6.02,4.3c0,2.37016 2.7004,4.3 6.02,4.3c3.3196,0 6.02,-1.92984 6.02,-4.3c0,-2.37016 -2.7004,-4.3 -6.02,-4.3z" fill="#000000"></path></g><g><ellipse cx="-36.01713" cy="76.8991" transform="rotate(-75.072) scale(1.72,1.72)" rx="4" ry="3" fill="#666666"></ellipse><path d="M111.0776,101.56256c-0.40936,0 -0.81872,-0.0516 -1.22464,-0.15996v0c-3.2078,-0.85484 -4.92264,-4.90544 -3.82356,-9.03c1.09908,-4.12456 4.601,-6.78196 7.81224,-5.92884c3.20608,0.85484 4.92092,4.90716 3.82184,9.03c-0.95976,3.6034 -3.75648,6.0888 -6.58588,6.0888zM110.29672,99.74108c2.28932,0.6106 4.8504,-1.50156 5.70524,-4.70936c0.85484,-3.2078 -0.31476,-6.31412 -2.60408,-6.92472c-2.29276,-0.6106 -4.8504,1.50156 -5.70696,4.70936c-0.85312,3.20608 0.31476,6.3124 2.6058,6.92472z" fill="#000000"></path></g><g fill="#666666"><circle cx="42.5" cy="45" transform="scale(1.72,1.72)" r="4"></circle></g><g fill="#666666"><circle cx="59.5" cy="45" transform="scale(1.72,1.72)" r="4"></circle></g><g fill="#666666"><circle cx="51.5" cy="53" transform="scale(1.72,1.72)" r="4"></circle></g><g fill="#000000"><path d="M64.6118,68.25992c-0.22016,0 -0.44032,-0.08428 -0.60888,-0.25112l-5.66224,-5.66224c-2.65568,1.93672 -4.8332,2.46476 -5.891,1.40524c-1.67184,-1.67184 0.71896,-5.58484 3.64812,-8.514c2.92916,-2.92916 6.84388,-5.31996 8.514,-3.64812c1.06124,1.05952 0.53148,3.23532 -1.40524,5.891l5.66224,5.66224c0.3354,0.3354 0.3354,0.88064 0,1.21604c-0.3354,0.3354 -0.88064,0.3354 -1.21604,0l-6.19372,-6.19372c-0.30788,-0.30788 -0.33712,-0.79808 -0.06708,-1.14036c2.05712,-2.61096 2.16032,-4.06264 2.0038,-4.21916c-0.31132,-0.31304 -2.88788,0.45408 -6.08192,3.64812c-3.19232,3.19232 -3.96116,5.76888 -3.64812,6.08192c0.15996,0.15824 1.6082,0.05676 4.22088,-2.0038c0.34228,-0.27004 0.83248,-0.2408 1.14036,0.06708l6.19372,6.192c0.3354,0.3354 0.3354,0.88064 0,1.21604c-0.16856,0.16856 -0.38872,0.25284 -0.60888,0.25284z"></path></g><g fill="#000000"><path d="M112.28504,122.68244c-0.5762,0 -1.075,-0.17028 -1.45684,-0.55212c-1.05952,-1.05952 -0.53148,-3.23532 1.40524,-5.891l-5.66224,-5.66224c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604c0.3354,-0.3354 0.88064,-0.3354 1.21604,0l6.19372,6.19372c0.30788,0.30788 0.33712,0.79808 0.06708,1.14036c-2.05712,2.60924 -2.1586,4.06436 -2.0038,4.22088c0.31992,0.31304 2.8896,-0.4558 6.08192,-3.64812c3.19232,-3.19232 3.96116,-5.76888 3.64812,-6.08192c-0.15652,-0.15652 -1.6082,-0.05504 -4.22088,2.0038c-0.34228,0.27004 -0.83076,0.24252 -1.14036,-0.06708l-6.19372,-6.192c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604c0.3354,-0.3354 0.88064,-0.3354 1.21604,0l5.66224,5.66224c2.65396,-1.93672 4.8332,-2.46648 5.891,-1.40524c1.67184,1.67184 -0.71896,5.58484 -3.64812,8.514c-2.25836,2.25664 -5.10496,4.19508 -7.05544,4.1968z"></path></g><g><ellipse cx="16.56537" cy="65.71899" transform="rotate(-20.339) scale(1.72,1.72)" rx="3" ry="4" fill="#666666"></ellipse><path d="M66.99916,103.64892c-1.06468,0 -2.15688,-0.34056 -3.19232,-1.00792c-1.52048,-0.9804 -2.74512,-2.5628 -3.4486,-4.45996c-1.48436,-4.00072 -0.15824,-8.1958 2.95324,-9.34992c1.55144,-0.57448 3.28864,-0.32508 4.88652,0.7052c1.52048,0.9804 2.74512,2.56452 3.4486,4.45996c0.70348,1.89544 0.80668,3.8958 0.2924,5.62956c-0.54008,1.8232 -1.6942,3.14416 -3.24564,3.71864c-0.54868,0.20468 -1.11628,0.30444 -1.6942,0.30444zM64.9988,90.25184c-0.37668,0 -0.74304,0.06364 -1.09048,0.19264c-2.22224,0.82388 -3.09256,4.02652 -1.93844,7.13972c0.57448,1.54972 1.5566,2.83284 2.76748,3.612c1.13348,0.72928 2.32716,0.9202 3.35744,0.53836v0c1.032,-0.38184 1.81116,-1.30548 2.19472,-2.59548c0.40936,-1.37944 0.3182,-2.9928 -0.25628,-4.54252c-0.57448,-1.54972 -1.5566,-2.83284 -2.76748,-3.612c-0.75164,-0.48676 -1.52736,-0.73272 -2.26696,-0.73272z" fill="#000000"></path></g><g fill="#000000"><path d="M84.48296,97.54808c-0.17888,0 -0.35776,-0.05504 -0.51084,-0.17028c-1.9608,-1.45512 -3.13212,-3.77884 -3.13212,-6.2178c0,-0.97524 0.17888,-1.92812 0.5332,-2.8294c0.17372,-0.44204 0.67424,-0.65876 1.11456,-0.48504c0.44204,0.17372 0.66048,0.67252 0.48676,1.11456c-0.2752,0.70004 -0.41452,1.43964 -0.41452,2.19988c0,1.92468 0.88924,3.6894 2.43724,4.83836c0.38184,0.2838 0.46096,0.82216 0.17888,1.20228c-0.17028,0.22704 -0.43,0.34744 -0.69316,0.34744z"></path></g><g fill="#000000"><path d="M88.58,98.9c-0.47472,0 -0.86,-0.38528 -0.86,-0.86c0,-0.47472 0.38528,-0.86 0.86,-0.86c3.3196,0 6.02,-2.7004 6.02,-6.02c0,-3.3196 -2.7004,-6.02 -6.02,-6.02c-1.032,0 -2.04852,0.26488 -2.94292,0.76712c-0.41108,0.2322 -0.9374,0.086 -1.17132,-0.32852c-0.2322,-0.41452 -0.086,-0.93912 0.32852,-1.17132c1.14896,-0.645 2.45788,-0.98728 3.784,-0.98728c4.26732,0 7.74,3.47268 7.74,7.74c0,4.26732 -3.47096,7.74 -7.73828,7.74z"></path></g><g fill="#000000"><path d="M102.34,85.14c-4.26732,0 -7.74,-3.47268 -7.74,-7.74c0,-2.33748 1.03888,-4.5236 2.85176,-6.00108c0.3698,-0.301 0.9116,-0.24424 1.21088,0.12384c0.29928,0.36808 0.24424,0.90988 -0.12384,1.21088c-1.4104,1.14724 -2.2188,2.84832 -2.2188,4.66636c0,3.3196 2.7004,6.02 6.02,6.02c3.3196,0 6.02,-2.7004 6.02,-6.02c0,-3.3196 -2.7004,-6.02 -6.02,-6.02c-0.47472,0 -0.86,-0.38528 -0.86,-0.86c0,-0.47472 0.38528,-0.86 0.86,-0.86c4.26732,0 7.74,3.47268 7.74,7.74c0,4.26732 -3.47268,7.74 -7.74,7.74z"></path></g><g fill="#000000"><path d="M73.1,85.14c-4.26732,0 -7.74,-3.47268 -7.74,-7.74c0,-0.47472 0.38528,-0.86 0.86,-0.86c0.47472,0 0.86,0.38528 0.86,0.86c0,3.3196 2.7004,6.02 6.02,6.02c3.3196,0 6.02,-2.7004 6.02,-6.02c0,-3.3196 -2.7004,-6.02 -6.02,-6.02c-1.8318,0 -3.5432,0.82044 -4.69388,2.24976c-0.29756,0.3698 -0.83764,0.43 -1.20916,0.13072c-0.3698,-0.29756 -0.42828,-0.83936 -0.13072,-1.20916c1.4792,-1.83696 3.67908,-2.89132 6.03376,-2.89132c4.26732,0 7.74,3.47268 7.74,7.74c0,4.26732 -3.47268,7.74 -7.74,7.74z"></path></g></g></g></svg>
            </span>
            <h6 class="black-40 ttu tl">Total Cases</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> cases) ?></h3>
            <div class="sub-info pt3 pb4">
              <span class="badge <?php echo getBadgeClass(getPercentageChange($yesterdayCases, $totalCases));?> mr-1"><?php echo getPercentageChange($yesterdayCases, $totalCases) ?></span>
              <span class="text-muted black-40">from yesterday (<?php echo thousandsCurrencyFormat($yesterdayCases) ?>)</span>
            </div>
          </div>
        </div>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/cotton/64/000000/headstone--v2.png"/>
            </span>
            <h6 class="black-40 ttu tl">Total Deaths</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> deaths) ?></h3>
            <div class="sub-info pt3 pb4">
              <span class="badge <?php echo getBadgeClass(getPercentageChange($yesterdayDeaths, $totalDeaths));?> mr-1"><?php echo getPercentageChange($yesterdayDeaths, $totalDeaths) ?></span>
              <span class="text-muted black-40">from yesterday (<?php echo thousandsCurrencyFormat($yesterdayDeaths) ?>)</span>
            </div>
          </div>
        </div>
      </article>
      <article class="cf">
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon"><img src="assets/img/recoveries.svg"></span>
            <h6 class="black-40 ttu tl">Total Recoveries</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> recovered) ?></h3>
            <div class="sub-info pt3 pb4">
              <span class="badge <?php echo getBadgeClass(getPercentageChange($totalRecoveries, $yesterdayRecoveries));?> mr-1"><?php echo getPercentageChange($yesterdayRecoveries, $totalRecoveries) ?></span>
              <span class="text-muted black-40">from yesterday (<?php echo thousandsCurrencyFormat($yesterdayRecoveries) ?>)</span>
            </div>
          </div>
        </div>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/bubbles/50/000000/protection-mask.png"/>
            </span>
            <h6 class="black-40 ttu tl">Active Cases</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> active) ?></h3>
            <div class="sub-info pt3 pb4">
              <span class="badge <?php echo getBadgeClass(getPercentageChange($activeYesterday, $activeCases));?> mr-1"><?php echo getPercentageChange($activeYesterday, $activeCases) ?></span>
              <span class="text-muted black-40">from yesterday (<?php echo thousandsCurrencyFormat($activeYesterday) ?>)</span>
            </div>
          </div>
        </div>
      </article>
      <br>
      <style>p{text-align: center;}</style>
      <br><p class="lh-copy measure black-60">
      Data sourced from Johns Hopkins University, WorldoMeters.</p></br>
      <section class="country-table">

        <div class="table-responsive">
          <?php
            $json = file_get_contents("https://corona.lmao.ninja/v2/countries");
            $select2Data = json_encode($json);
            $data = json_decode($json);
            $array = json_decode(json_encode($data), true);
                  echo '<h1 class="freeze">🌎 Country Breakdown</h1>';
            echo '<table id="country-table" class="table table-striped table-curved">';
            echo '<thead>
                    <tr>
                      <th class="freeze">Rank</th>
                      <th class="freeze" style="    left: 58px;">Country</th>
                      <th>Cases</th>
                      <th>Deaths</th>
                      <th>Critical</th>
                      <th>Recovered</th>
                      <th>Today\'s Cases</th>
                      <th>Today\'s Deaths</th>
                      <th>Cases Per 1M</th>
                      <th>Deaths Per 1M</th>
                    </tr>
                  </thead>';

            echo'<tbody id="tbody">';


            $totalsCases = 0;
            $totalsDeaths = 0;
            $totalsCritical = 0;
            $totalsRecovered = 0;
            $totalsTodayCases = 0;
            $totalsTodayDeaths = 0;

            foreach($array as $result) {
              $totalsCases += $result['cases'];
              $totalsDeaths += $result['deaths'];
              $totalsCritical += $result['critical'];
              $totalsRecovered += $result['recovered'];
              $totalsTodayCases += $result['todayCases'];
              $totalsTodayDeaths += $result['todayDeaths'];
            };

            function styleZeroDeaths($num) {
              if ($num > 0) {
                return " class='badge-danger'>+";
              } else {
                return ">";
              }
            };

            function styleZeroCases($num) {
              if ($num > 0) {
                return " class='badge-warning'>+";
              } else {
                return ">";
              }
            };

            echo '<tr>';
            echo '<td class="freeze">0</td>';
            echo '<td class="freeze" style=" left: 58px;">🌍<div style="padding-left: 10px;" class="country">Global</div></td>';
            echo '<td>' .number_format($totalsCases).'</td>';
            echo '<td>'.number_format($totalsDeaths).'</td>';
            echo '<td>'.number_format($totalsCritical).'</td>';
            echo '<td>'.number_format($totalsRecovered).'</td>';
            echo '<td'.styleZeroCases($totalsTodayCases).number_format($totalsTodayCases).'</td>';
            echo '<td'.styleZeroDeaths($totalsTodayDeaths).number_format($totalsTodayDeaths).'</td>';
            echo '<td>'.number_format($totalsCases/7800).'</td>';
            echo '<td>'.number_format($totalsDeaths/7800).'</td>';
            echo '</tr>';

            foreach($array as $result) {
              echo '<tr>';
              echo '<td class="freeze"></td>';
              echo '<td class="freeze" style=" left: 58px;"> <img src='.$result['countryInfo']['flag'].'><div class="country">'.$result['country'].'</div></td>';
              echo '<td>' .number_format($result['cases']).'</td>';
              echo '<td>'.number_format($result['deaths']).'</td>';
              echo '<td>'.number_format($result['critical']).'</td>';
              echo '<td>'.number_format($result['recovered']).'</td>';
              echo '<td'.styleZeroCases($result['todayCases']).number_format($result['todayCases']).'</td>';
              echo '<td'.styleZeroDeaths($result['todayDeaths']).number_format($result['todayDeaths']).'</td>';
              echo '<td>'.number_format($result['casesPerOneMillion']).'</td>';
              echo '<td>'.number_format($result['deathsPerOneMillion']).'</td>';
              echo '</tr>';
            };
            echo'</tbody>';
            echo '</table>';
          ?>
        </div>
      </section>

      <section class="country-table">
      <script>

      /* Select2 data filter */

      countryDataPHP = <?php echo $select2Data; ?>;
      objS2 = JSON.parse(countryDataPHP);

      var data = $.map(objS2, function (obj) {
  obj.id = obj.id || obj.countryInfo._id;
  obj.text = obj.text || obj.country;
  obj.flag = obj.flag || obj.countryInfo.flag

  return obj;

});

function formatState (state) {
  if (!state.id) {
    return state.flag;
  }
  var baseUrl = "https://raw.githubusercontent.com/NovelCOVID/API/master/assets/flags/";
  var $state = $(
    '<span><img src="' + state.flag + ' " class="img-flag" /> ' + state.text + '</span>'
  );
  return $state;
};




$(".js-data-example-ajax").select2({
    data: data,
    templateResult: formatState
        });

$(".deaths-select").select2({
    data: data,
    templateResult: formatState
        });



</script>
<script>

            var caseByDay = [<?php echo $casesByDayFormatted; ?>];



const newFromCumulative = starting => {
	var end = [];

	starting.forEach((val, index) => {
		if (index == 0) {
    	end.push(0);
    } else {
    	end.push(val - starting[index-1]);
    }
  });

  return end
};

var out = newFromCumulative(caseByDay);

console.log(out);



    /* Initialise chart for daily cases */
         var ctx = document.getElementById('daily-cases');
        var newCasesContainer = new Chart(ctx, {
          type: 'bar',
          responsive: true,

                              data: {
          labels:  [<?php echo $datesFormattedShort; ?>],
          datasets: [{
             data: out,
             backgroundColor: "rgba(54, 162, 235, 0.4)",
             pointBackgrondColor: "rgba(54, 162, 235, 1)",
             borderColor: "rgba(54, 162, 235, 1)",
             borderWidth: 1
          }]


          },
          options: {
              legend: {
        display: false
    },


            scales: {
               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                    ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }
                       ]}

            }
          });


        var ctx = document.getElementById('cases');
        var casesChart = new Chart(ctx, {
          type: 'line',
          responsive: true,

                              data: {
          labels:  [<?php echo $datesFormattedShort; ?>],
          datasets: [{
             data: [<?php echo $casesByDayFormatted; ?>],
             backgroundColor: "rgba(54, 162, 235, 0.4)",
             pointBackgrondColor: "rgba(54, 162, 235, 1)",
             borderColor: "rgba(54, 162, 235, 1)",
             borderWidth: 1
          }]


          },
          options: {
              legend: {
        display: false
    },


            scales: {
               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                    ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }
                       ]}

            }
          });

    $('.deaths-select').on('select2:select', function (e) {

        $('#flag').remove();

        $('#country-deaths-daily').remove();

            $('#country-deaths').remove();

          var imgurl = id_country_selected = e.params.data.flag;


            $(".select2-selection__rendered").eq(1).prepend("<img class='img-flag' src="+imgurl+">");

            $(".append-flag").eq(1).prepend("<img id='flag' class='img-flag' src="+imgurl+">");

            var id_country_selected = e.params.data.id;
          console.log(id_country_selected);
            var url = "https://corona.lmao.ninja/v2/historical/"+id_country_selected+"?lastdays=all";
            console.log(url);
              $.ajax({
        type: "POST",
        url: "getCountryData.php",
        data: {url: url},
        success: function(data){

            var split = data.split("|");
            var values = String(split[0]);
            var dates  = String(split[1]);
            var valuesDeath  = String(split[2]);
            console.log(values);
            console.log(dates);
            console.log(valuesDeath);

            var arrayValues = values.split(',');
            var arrayDates = dates.split(',');
            var valuesDeathCountry = valuesDeath.split(',');
            console.log(arrayValues);
            console.log(arrayDates);

            var out3 = newFromCumulative(valuesDeathCountry);

            console.log(out3);

            deathsChart.destroy();
            $('#deaths').remove();
            $('#deathsContainer').append('<canvas id="country-deaths"><canvas>');

             var ctx = document.getElementById('country-deaths');
        var deathsChartCountry = new Chart(ctx, {
          type: 'line',
          responsive: true,
                data: {
     labels: [<?php echo $datesDeathsFormattedShort ?>],
     datasets: [{
           data: valuesDeathCountry,
         label: 'Number of Deaths',
           backgroundColor: "rgba(255, 99, 132, 0.4)",
           pointBackgrondColor: "rgba(255, 99, 132, 1)",
           borderColor: "rgba(255, 99, 132, 1)",
           borderWidth: 1

       }]

          },
          options: {
                 legend: {
        display: false
    },
            scales: {
                               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }]
            }
          }
        });


            deathsChart2.destroy();
            $('#daily-deaths').remove(); $('#newDeathsContainer').append('<canvas id="country-deaths-daily"><canvas>');




            /* Initialise chart for daily cases */
         var ctx = document.getElementById('country-deaths-daily');
        var countryDailyDeaths = new Chart(ctx, {
          type: 'bar',
          responsive: true,

                              data: {
          labels:  [<?php echo $datesFormattedShort; ?>],
          datasets: [{
             data: out3,
             backgroundColor: "rgba(255, 99, 132, 0.4)",
             pointBackgrondColor: "rgba(255, 99, 132, 1)",
             borderColor: "rgba(255, 99, 132, 1)",
             borderWidth: 1
          }]


          },
          options: {
              legend: {
        display: false
    },


            scales: {
               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                    ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }
                       ]}

            }
          });

        }
         })

    });;



        $('.js-data-example-ajax').on('select2:select', function (e) {






            $('#flag').remove();


            $('#country-cases-daily').remove();

            $('#country-cases').remove();

            var imgurl = id_country_selected = e.params.data.flag

            $(".select2-selection__rendered").first().prepend("<img class='img-flag' src="+imgurl+">");

            $(".append-flag").first().prepend("<img  id='flag' class='img-flag' src="+imgurl+">");

            console.log(imgurl);

            var id_country_selected = e.params.data.id;
            console.log(id_country_selected);
            var url = "https://corona.lmao.ninja/v2/historical/"+id_country_selected+"?lastdays=all";
            console.log(url);
              $.ajax({
        type: "POST",
        url: "getCountryData.php",
        data: {url: url},
        success: function(data){

            var split = data.split("|");
            var values = String(split[0]);
            var dates  = String(split[1]);
            console.log(values);
            console.log(dates);

            var arrayValues = values.split(',');
            var arrayDates = dates.split(',');
            console.log(arrayValues);
            console.log(arrayDates);


            var dailyCaseso = newFromCumulative(arrayValues);




            newCasesContainer.destroy();
            $('#daily-cases').remove();
            $('#newCasesContainer').append('<canvas id="country-cases-daily"><canvas>');




            /* Initialise chart for daily cases */
         var ctx = document.getElementById('country-cases-daily');
        var countryDaily = new Chart(ctx, {
          type: 'bar',
          responsive: true,

                              data: {
          labels:  [<?php echo $datesFormattedShort; ?>],
          datasets: [{
             data: dailyCaseso,
             backgroundColor: "rgba(54, 162, 235, 0.4)",
             pointBackgrondColor: "rgba(54, 162, 235, 1)",
             borderColor: "rgba(54, 162, 235, 1)",
             borderWidth: 1
          }]


          },
          options: {
              legend: {
        display: false
    },


            scales: {
               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                    ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }
                       ]}

            }
          });



            casesChart.destroy();
            $('#cases').remove();
            $('#casesContainer').append('<canvas id="country-cases"><canvas>');


            var ctx = document.getElementById('country-cases');
        var countriesChart = new Chart(ctx, {
          type: 'line',
          responsive: true,

        data: {
          labels: arrayDates,
          datasets: [{
             data: arrayValues,
             label: 'Number of Cases',
             backgroundColor: "rgba(54, 162, 235, 0.4)",
             pointBackgrondColor: "rgba(54, 162, 235, 1)",
             borderColor: "rgba(54, 162, 235, 1)",
             borderWidth: 1
          }]


          },
          options: {
                 legend: {
        display: false
    },
            scales: {
                               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }]
            }
          }
        });
        }

    })
        });
      </script>

      <script>
                      var deathByDay = [<?php echo $deathsByDayFormatted; ?>];



var out2 = newFromCumulative(deathByDay);

          /* Initialise death charts */
               var ctx = document.getElementById('daily-deaths');
        var deathsChart2 = new Chart(ctx, {
          type: 'bar',
          responsive: true,
                data: {
     labels: [<?php echo $datesDeathsFormattedShort ?>],
     datasets: [{
           data: out2,
         label: 'Number of Deaths',
           backgroundColor: "rgba(255, 99, 132, 0.4)",
           pointBackgrondColor: "rgba(255, 99, 132, 1)",
           borderColor: "rgba(255, 99, 132, 1)",
           borderWidth: 1

       }]

          },
          options: {
                 legend: {
        display: false
    },
            scales: {
                               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }]
            }
          }
        });


        var ctx = document.getElementById('deaths');
        var deathsChart = new Chart(ctx, {
          type: 'line',
          responsive: true,
                data: {
     labels: [<?php echo $datesDeathsFormattedShort ?>],
     datasets: [{
           data: [<?php echo $deathsByDayFormatted; ?>],
         label: 'Number of Deaths',
           backgroundColor: "rgba(255, 99, 132, 0.4)",
           pointBackgrondColor: "rgba(255, 99, 132, 1)",
           borderColor: "rgba(255, 99, 132, 1)",
           borderWidth: 1

       }]

          },
          options: {
                 legend: {
        display: false
    },
            scales: {
                               xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                      if (value >= 0 && value < 1000) return value;
                      if (value >= 1000 && value < 1000000) return (value / 1000) + "k";
                      if (value >= 1000000 && value < 1000000000) return (value / 1000000) + "m";
                      return value;
                  }
                }
              }]
            }
          }
        });
      </script>
     <footer class="">

<div class="mt1">
  <a href="https://portfolio-olive-one.vercel.app/" target="blank" title="Alparslan Abdikoglu" class="f4 dib pr2 mid-gray dim">Made by Alparslan Abdikoglu</a>
  <a href="https://disease.sh/" target="blank" title="Data Source" class="f4 dib pr2 mid-gray dim">DATA Backed by Disease API</a>
</div>
</footer>
    </div>
  </div>
  <script>
    $(() => {
      var t = $('#country-table').DataTable({

        "columnDefs": [ {
          "searchable": false,
          "orderable": false,
          "targets": 0
        } ],
        "order": [[ 2, 'desc' ]],
        "bLengthChange": false,
      });

      t.on('order.dt search.dt', () => {
        t.column(0, {search:'applied', order:'applied'}).nodes().each((cell, i) => {
          cell.innerHTML = i+1;
        });
      }).draw();
    });
  </script>
  <script>

      function isDay() {
  const hours = (new Date()).getHours();
  return (hours >= 6 && hours < 18);
}
/* Dynamically change theme */
      // if (isDay() == false) {
      //     $("body").toggleClass("light-theme");
      // } else {
      //     $("body").toggleClass("");
      // }

      $(".theme-switch").on("click", () => {
          $("body").toggleClass("light-theme");
      });
  </script>

  <script>// Add basic styles for active tabs
$('.tabs__menu-item').on('click', function() {
  $(this).addClass('bg-white').addClass('red');
  $(this).siblings().removeClass('red');
});</script>

</body>
</html>