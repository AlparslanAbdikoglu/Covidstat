<?php
  ini_set("allow_url_fopen", 1);
  header("Access-Control-Allow-Origin: *");

  /* fetch historical API data */
  $json = file_get_contents('https://disease.sh/v3/covid-19/countries/Hungary');
  $obj = json_decode($json);
?>

<!doctype html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <title>KoronaVírus Statisztika</title>
  <meta name="description" content="Kövesd a covid 19 járványhelyzetet hazai, világ statisztikák, hírek intézkedések">

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
              </div><div class="fb-share-button" data-href="http://koronainfok.com/" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fkoronainfok.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Megosztás</a></div>
          </nav>
          <article class="cf">
        <header class="header mw5 mw7-ns tl pa3">
          <div class="fl w-50-ns pa2">
          <h1 class="mt0">👑Koronavírus<img class="theme-icon" src="assets/img/coronavirus.svg">Statisztika</h1> 
          <p class="lh-copy measure black-60">
             Covid-19 Világ és Hazai statisztikák, hírek intézkedések.</p>
           </div>
        <!-- FB SHARE HERE sdk-->
        <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v8.0&appId=715011399363581&autoLogAppEvents=1" nonce="Nqn3gqHw"></script>
        </header>
        <style>h1 {text-align: center;}</style>
        <br><h1 class="mt0">🇭🇺<img class="theme-icon" src="assets/img/coronavirus.svg">Statisztika</h1>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="50" height="50"
viewBox="0 0 172 172"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><circle cx="14" cy="29" transform="scale(1.72,1.72)" r="2" fill="#ee3e54"></circle><circle cx="78" cy="13" transform="scale(1.72,1.72)" r="1" fill="#e74c3c"></circle><circle cx="51" cy="50" transform="scale(1.72,1.72)" r="37" fill="#fce0a2"></circle><circle cx="84" cy="15" transform="scale(1.72,1.72)" r="4" fill="#e74c3c"></circle><circle cx="88" cy="24" transform="scale(1.72,1.72)" r="2" fill="#ee3e54"></circle><circle cx="82" cy="76" transform="scale(1.72,1.72)" r="2" fill="#e74c3c"></circle><circle cx="21" cy="72" transform="scale(1.72,1.72)" r="4" fill="#e74c3c"></circle><circle cx="26" cy="87" transform="scale(1.72,1.72)" r="2" fill="#ee3e54"></circle><circle cx="22.5" cy="61.5" transform="scale(1.72,1.72)" r="2.5" fill="#ffffff"></circle><circle cx="29" cy="76" transform="scale(1.72,1.72)" r="1" fill="#e74c3c"></circle><circle cx="81" cy="34" transform="scale(1.72,1.72)" r="1" fill="#ffffff"></circle><path d="M95.46,45.58c0,-1.42588 -3.4658,-2.58 -7.74,-2.58c-4.2742,0 -7.74,1.15412 -7.74,2.58c0,1.12144 1.72,2.58 5.16,2.42176v8.75824h5.16v-8.75824c3.44,0.15824 5.16,-1.30032 5.16,-2.42176z" fill="#00ca51"></path><path d="M90.3,57.62h-5.16c-0.47472,0 -0.86,-0.38528 -0.86,-0.86v-7.89308c-1.8232,-0.06192 -3.35744,-0.58308 -4.2914,-1.47404c-0.559,-0.53492 -0.8686,-1.17992 -0.8686,-1.81288c0,-2.36328 4.45824,-3.44 8.6,-3.44c4.14176,0 8.6,1.07672 8.6,3.44c0,0.63296 -0.3096,1.27796 -0.8686,1.81288c-0.93396,0.89096 -2.4682,1.41212 -4.2914,1.47404v7.89308c0,0.47472 -0.38528,0.86 -0.86,0.86zM86,55.9h3.44v-7.89824c0,-0.23392 0.09632,-0.45924 0.2666,-0.62264c0.17028,-0.16168 0.4042,-0.24596 0.63296,-0.23736c2.55592,0.11524 3.64812,-0.731 3.92332,-0.99416c0.24768,-0.23564 0.33712,-0.44892 0.33712,-0.5676c0,-0.44204 -2.365,-1.72 -6.88,-1.72c-4.515,0 -6.88,1.27796 -6.88,1.72c0,0.11868 0.08944,0.33196 0.33712,0.56932c0.2752,0.26316 1.39148,1.11284 3.92332,0.99416c0.2322,-0.0086 0.46268,0.07396 0.63296,0.23736c0.17028,0.16168 0.2666,0.387 0.2666,0.62092z" fill="#000000"></path><path d="M90.3,125.71824v-8.75824h-5.16v8.75824c-3.44,-0.15824 -5.16,1.30032 -5.16,2.42176c0,1.42416 3.4658,2.58 7.74,2.58c4.2742,0 7.74,-1.15584 7.74,-2.58c0,-1.12144 -1.72,-2.58 -5.16,-2.42176z" fill="#00ca51"></path><path d="M87.72,131.58c-4.14176,0 -8.6,-1.07672 -8.6,-3.44c0,-0.63296 0.3096,-1.27624 0.8686,-1.81288c0.93396,-0.89268 2.4682,-1.41212 4.2914,-1.47404v-7.89308c0,-0.47472 0.38528,-0.86 0.86,-0.86h5.16c0.47472,0 0.86,0.38528 0.86,0.86v7.89308c1.8232,0.06192 3.35744,0.58308 4.2914,1.47404c0.559,0.53492 0.8686,1.17992 0.8686,1.81288c0,2.36328 -4.45824,3.44 -8.6,3.44zM84.62916,126.5662c-2.21708,0 -3.19404,0.75852 -3.45032,1.00448c-0.2494,0.23736 -0.33884,0.45064 -0.33884,0.56932c0,0.44204 2.365,1.72 6.88,1.72c4.515,0 6.88,-1.27796 6.88,-1.72c0,-0.11868 -0.08944,-0.33196 -0.33712,-0.56932c-0.2752,-0.26316 -1.38288,-1.10596 -3.92332,-0.99416c-0.2322,0.00516 -0.4644,-0.07396 -0.63296,-0.23736c-0.17028,-0.16168 -0.2666,-0.387 -0.2666,-0.62092v-7.89824h-3.44v7.89824c0,0.23392 -0.09632,0.45924 -0.2666,0.62264c-0.17028,0.16168 -0.39732,0.24252 -0.63296,0.23736c-0.1634,-0.0086 -0.31992,-0.01204 -0.47128,-0.01204z" fill="#000000"></path><path d="M129,79.12c-1.12144,0 -2.06744,2.16032 -2.42176,5.16h-8.75824v5.16h8.75824c0.35604,2.99968 1.30032,5.16 2.42176,5.16c1.42416,0 2.58,-3.4658 2.58,-7.74c0,-4.2742 -1.15584,-7.74 -2.58,-7.74z" fill="#00ca51"></path><path d="M129,95.46c-1.49984,0 -2.66256,-1.91264 -3.17168,-5.16h-8.00832c-0.47472,0 -0.86,-0.38528 -0.86,-0.86v-5.16c0,-0.47472 0.38528,-0.86 0.86,-0.86h8.00832c0.50912,-3.24736 1.67356,-5.16 3.17168,-5.16c2.36328,0 3.44,4.45824 3.44,8.6c0,4.14176 -1.07672,8.6 -3.44,8.6zM118.68,88.58h7.89824c0.43516,0 0.80324,0.32508 0.85484,0.75852c0.38872,3.30068 1.34504,4.40148 1.56692,4.40148c0.44204,0 1.72,-2.365 1.72,-6.88c0,-4.515 -1.27796,-6.88 -1.72,-6.88c-0.22188,0 -1.1782,1.1008 -1.56864,4.40148c-0.0516,0.43344 -0.41796,0.75852 -0.85484,0.75852h-7.89652z" fill="#000000"></path><path d="M57.62,84.28h-8.75824c-0.35604,-2.99968 -1.30032,-5.16 -2.42176,-5.16c-1.42416,0 -2.58,3.4658 -2.58,7.74c0,4.2742 1.15584,7.74 2.58,7.74c1.12144,0 2.06744,-2.16032 2.42176,-5.16h8.75824z" fill="#00ca51"></path><path d="M46.44,95.46c-2.36328,0 -3.44,-4.45824 -3.44,-8.6c0,-4.14176 1.07672,-8.6 3.44,-8.6c1.49984,0 2.66256,1.91264 3.17168,5.16h8.00832c0.47472,0 0.86,0.38528 0.86,0.86v5.16c0,0.47472 -0.38528,0.86 -0.86,0.86h-8.00832c-0.50912,3.24736 -1.67184,5.16 -3.17168,5.16zM46.44,79.98c-0.44204,0 -1.72,2.365 -1.72,6.88c0,4.515 1.27796,6.88 1.72,6.88c0.22188,0 1.1782,-1.1008 1.56864,-4.40148c0.0516,-0.43344 0.41796,-0.75852 0.85484,-0.75852h7.89652v-3.44h-7.89824c-0.43516,0 -0.80324,-0.32508 -0.85484,-0.75852c-0.38872,-3.30068 -1.34504,-4.40148 -1.56692,-4.40148z" fill="#000000"></path><circle cx="51" cy="50.5" transform="scale(1.72,1.72)" r="19.5" fill="#00ca51"></circle><path d="M87.72,121.26c-18.96816,0 -34.4,-15.43184 -34.4,-34.4c0,-18.96816 15.43184,-34.4 34.4,-34.4c18.96816,0 34.4,15.43184 34.4,34.4c0,18.96816 -15.43184,34.4 -34.4,34.4zM87.72,54.18c-18.02044,0 -32.68,14.65956 -32.68,32.68c0,18.02044 14.65956,32.68 32.68,32.68c18.02044,0 32.68,-14.65956 32.68,-32.68c0,-18.02044 -14.65956,-32.68 -32.68,-32.68z" fill="#000000"></path><path d="M118.73332,55.84668c-3.02204,-3.02204 -6.29004,-4.65604 -7.29796,-3.64812c-0.79292,0.79292 0.06708,2.98936 1.93672,5.36124l-6.192,6.19372l3.64812,3.64812l6.192,-6.192c2.37188,1.86964 4.56832,2.72792 5.36124,1.935c1.00792,-1.00964 -0.62436,-4.27592 -3.64812,-7.29796z" fill="#00ca51"></path><path d="M110.8282,68.25992c-0.22016,0 -0.44032,-0.08428 -0.60888,-0.25112c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604l6.19372,-6.192c0.30788,-0.3096 0.79636,-0.33712 1.14036,-0.06708c2.61268,2.05884 4.06264,2.16032 4.22088,2.0038c0.31304,-0.31304 -0.4558,-2.8896 -3.64812,-6.08192c-3.19404,-3.19404 -5.76888,-3.95772 -6.08192,-3.64812c-0.15652,0.15652 -0.05332,1.60992 2.0038,4.22088c0.27004,0.34228 0.2408,0.83248 -0.06708,1.14036l-6.19372,6.19372c-0.3354,0.3354 -0.88064,0.3354 -1.21604,0c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604l5.66224,-5.66224c-1.935,-2.65568 -2.46476,-4.83148 -1.40524,-5.891c1.67012,-1.67184 5.58484,0.71896 8.514,3.64812c2.92916,2.92916 5.31996,6.84216 3.64812,8.514c-1.0578,1.05952 -3.2336,0.53148 -5.891,-1.40524l-5.66224,5.66224c-0.16856,0.1634 -0.38872,0.24768 -0.60888,0.24768z" fill="#000000"></path><path d="M68.25992,109.9682l-3.64812,-3.64812l-6.19372,6.192c-2.37188,-1.86964 -4.56832,-2.72964 -5.36124,-1.935c-1.00792,1.00792 0.62608,4.2742 3.64812,7.29796c3.02204,3.02204 6.29004,4.65604 7.29796,3.64812c0.79292,-0.79292 -0.06708,-2.98936 -1.93672,-5.36124z" fill="#00ca51"></path><path d="M63.15496,122.68244c-1.95048,0 -4.79708,-1.94016 -7.05716,-4.20024c-2.92916,-2.92916 -5.31996,-6.84216 -3.64812,-8.514c1.0578,-1.05952 3.23532,-0.53148 5.891,1.40524l5.66224,-5.66224c0.3354,-0.3354 0.88064,-0.3354 1.21604,0c0.3354,0.3354 0.3354,0.88064 0,1.21604l-6.19372,6.192c-0.3096,0.30788 -0.7998,0.33712 -1.14036,0.06708c-2.61268,-2.05884 -4.06092,-2.1586 -4.22088,-2.0038c-0.31304,0.31304 0.4558,2.8896 3.64812,6.08192c3.1906,3.19232 5.76372,3.95944 6.08192,3.64812c0.15652,-0.15652 0.05504,-1.60992 -2.0038,-4.22088c-0.27004,-0.34228 -0.2408,-0.83248 0.06708,-1.14036l6.19372,-6.19372c0.3354,-0.3354 0.88064,-0.3354 1.21604,0c0.3354,0.3354 0.3354,0.88064 0,1.21604l-5.66224,5.66224c1.935,2.65568 2.46648,4.83148 1.40524,5.89272c-0.38012,0.38356 -0.87892,0.55384 -1.45512,0.55384z" fill="#000000"></path><g fill="#00ca51"><path d="M68.25992,63.7518l-6.192,-6.19372c1.86964,-2.37188 2.72964,-4.56832 1.93672,-5.36124c-1.00792,-1.00792 -4.2742,0.62608 -7.29796,3.64812c-3.02204,3.02204 -4.65604,6.29004 -3.64812,7.29796c0.79292,0.79292 2.98936,-0.06708 5.36124,-1.935l6.19372,6.192z"></path></g><g fill="#00ca51"><path d="M122.38316,110.57536c-0.79292,-0.79292 -2.98936,0.06708 -5.36124,1.935l-6.192,-6.192l-3.64812,3.64812l6.192,6.19372c-1.86964,2.37188 -2.72964,4.56832 -1.93672,5.36124c1.00792,1.00792 4.2742,-0.62608 7.29796,-3.64812c3.02204,-3.02204 4.65432,-6.29004 3.64812,-7.29796z"></path></g><g><ellipse cx="51.5" cy="38" transform="scale(1.72,1.72)" rx="4" ry="3" fill="#666666"></ellipse><path d="M88.58,71.38c-4.26732,0 -7.74,-2.7004 -7.74,-6.02c0,-3.3196 3.47268,-6.02 7.74,-6.02c4.26732,0 7.74,2.7004 7.74,6.02c0,3.3196 -3.47268,6.02 -7.74,6.02zM88.58,61.06c-3.3196,0 -6.02,1.92984 -6.02,4.3c0,2.37016 2.7004,4.3 6.02,4.3c3.3196,0 6.02,-1.92984 6.02,-4.3c0,-2.37016 -2.7004,-4.3 -6.02,-4.3z" fill="#000000"></path></g><g><ellipse cx="51.5" cy="64" transform="scale(1.72,1.72)" rx="4" ry="3" fill="#666666"></ellipse><path d="M88.58,116.1c-4.26732,0 -7.74,-2.7004 -7.74,-6.02c0,-3.3196 3.47268,-6.02 7.74,-6.02c4.26732,0 7.74,2.7004 7.74,6.02c0,3.3196 -3.47268,6.02 -7.74,6.02zM88.58,105.78c-3.3196,0 -6.02,1.92984 -6.02,4.3c0,2.37016 2.7004,4.3 6.02,4.3c3.3196,0 6.02,-1.92984 6.02,-4.3c0,-2.37016 -2.7004,-4.3 -6.02,-4.3z" fill="#000000"></path></g><g><ellipse cx="-36.01713" cy="76.8991" transform="rotate(-75.072) scale(1.72,1.72)" rx="4" ry="3" fill="#666666"></ellipse><path d="M111.0776,101.56256c-0.40936,0 -0.81872,-0.0516 -1.22464,-0.15996v0c-3.2078,-0.85484 -4.92264,-4.90544 -3.82356,-9.03c1.09908,-4.12456 4.601,-6.78196 7.81224,-5.92884c3.20608,0.85484 4.92092,4.90716 3.82184,9.03c-0.95976,3.6034 -3.75648,6.0888 -6.58588,6.0888zM110.29672,99.74108c2.28932,0.6106 4.8504,-1.50156 5.70524,-4.70936c0.85484,-3.2078 -0.31476,-6.31412 -2.60408,-6.92472c-2.29276,-0.6106 -4.8504,1.50156 -5.70696,4.70936c-0.85312,3.20608 0.31476,6.3124 2.6058,6.92472z" fill="#000000"></path></g><g fill="#666666"><circle cx="42.5" cy="45" transform="scale(1.72,1.72)" r="4"></circle></g><g fill="#666666"><circle cx="59.5" cy="45" transform="scale(1.72,1.72)" r="4"></circle></g><g fill="#666666"><circle cx="51.5" cy="53" transform="scale(1.72,1.72)" r="4"></circle></g><g fill="#000000"><path d="M64.6118,68.25992c-0.22016,0 -0.44032,-0.08428 -0.60888,-0.25112l-5.66224,-5.66224c-2.65568,1.93672 -4.8332,2.46476 -5.891,1.40524c-1.67184,-1.67184 0.71896,-5.58484 3.64812,-8.514c2.92916,-2.92916 6.84388,-5.31996 8.514,-3.64812c1.06124,1.05952 0.53148,3.23532 -1.40524,5.891l5.66224,5.66224c0.3354,0.3354 0.3354,0.88064 0,1.21604c-0.3354,0.3354 -0.88064,0.3354 -1.21604,0l-6.19372,-6.19372c-0.30788,-0.30788 -0.33712,-0.79808 -0.06708,-1.14036c2.05712,-2.61096 2.16032,-4.06264 2.0038,-4.21916c-0.31132,-0.31304 -2.88788,0.45408 -6.08192,3.64812c-3.19232,3.19232 -3.96116,5.76888 -3.64812,6.08192c0.15996,0.15824 1.6082,0.05676 4.22088,-2.0038c0.34228,-0.27004 0.83248,-0.2408 1.14036,0.06708l6.19372,6.192c0.3354,0.3354 0.3354,0.88064 0,1.21604c-0.16856,0.16856 -0.38872,0.25284 -0.60888,0.25284z"></path></g><g fill="#000000"><path d="M112.28504,122.68244c-0.5762,0 -1.075,-0.17028 -1.45684,-0.55212c-1.05952,-1.05952 -0.53148,-3.23532 1.40524,-5.891l-5.66224,-5.66224c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604c0.3354,-0.3354 0.88064,-0.3354 1.21604,0l6.19372,6.19372c0.30788,0.30788 0.33712,0.79808 0.06708,1.14036c-2.05712,2.60924 -2.1586,4.06436 -2.0038,4.22088c0.31992,0.31304 2.8896,-0.4558 6.08192,-3.64812c3.19232,-3.19232 3.96116,-5.76888 3.64812,-6.08192c-0.15652,-0.15652 -1.6082,-0.05504 -4.22088,2.0038c-0.34228,0.27004 -0.83076,0.24252 -1.14036,-0.06708l-6.19372,-6.192c-0.3354,-0.3354 -0.3354,-0.88064 0,-1.21604c0.3354,-0.3354 0.88064,-0.3354 1.21604,0l5.66224,5.66224c2.65396,-1.93672 4.8332,-2.46648 5.891,-1.40524c1.67184,1.67184 -0.71896,5.58484 -3.64812,8.514c-2.25836,2.25664 -5.10496,4.19508 -7.05544,4.1968z"></path></g><g><ellipse cx="16.56537" cy="65.71899" transform="rotate(-20.339) scale(1.72,1.72)" rx="3" ry="4" fill="#666666"></ellipse><path d="M66.99916,103.64892c-1.06468,0 -2.15688,-0.34056 -3.19232,-1.00792c-1.52048,-0.9804 -2.74512,-2.5628 -3.4486,-4.45996c-1.48436,-4.00072 -0.15824,-8.1958 2.95324,-9.34992c1.55144,-0.57448 3.28864,-0.32508 4.88652,0.7052c1.52048,0.9804 2.74512,2.56452 3.4486,4.45996c0.70348,1.89544 0.80668,3.8958 0.2924,5.62956c-0.54008,1.8232 -1.6942,3.14416 -3.24564,3.71864c-0.54868,0.20468 -1.11628,0.30444 -1.6942,0.30444zM64.9988,90.25184c-0.37668,0 -0.74304,0.06364 -1.09048,0.19264c-2.22224,0.82388 -3.09256,4.02652 -1.93844,7.13972c0.57448,1.54972 1.5566,2.83284 2.76748,3.612c1.13348,0.72928 2.32716,0.9202 3.35744,0.53836v0c1.032,-0.38184 1.81116,-1.30548 2.19472,-2.59548c0.40936,-1.37944 0.3182,-2.9928 -0.25628,-4.54252c-0.57448,-1.54972 -1.5566,-2.83284 -2.76748,-3.612c-0.75164,-0.48676 -1.52736,-0.73272 -2.26696,-0.73272z" fill="#000000"></path></g><g fill="#000000"><path d="M84.48296,97.54808c-0.17888,0 -0.35776,-0.05504 -0.51084,-0.17028c-1.9608,-1.45512 -3.13212,-3.77884 -3.13212,-6.2178c0,-0.97524 0.17888,-1.92812 0.5332,-2.8294c0.17372,-0.44204 0.67424,-0.65876 1.11456,-0.48504c0.44204,0.17372 0.66048,0.67252 0.48676,1.11456c-0.2752,0.70004 -0.41452,1.43964 -0.41452,2.19988c0,1.92468 0.88924,3.6894 2.43724,4.83836c0.38184,0.2838 0.46096,0.82216 0.17888,1.20228c-0.17028,0.22704 -0.43,0.34744 -0.69316,0.34744z"></path></g><g fill="#000000"><path d="M88.58,98.9c-0.47472,0 -0.86,-0.38528 -0.86,-0.86c0,-0.47472 0.38528,-0.86 0.86,-0.86c3.3196,0 6.02,-2.7004 6.02,-6.02c0,-3.3196 -2.7004,-6.02 -6.02,-6.02c-1.032,0 -2.04852,0.26488 -2.94292,0.76712c-0.41108,0.2322 -0.9374,0.086 -1.17132,-0.32852c-0.2322,-0.41452 -0.086,-0.93912 0.32852,-1.17132c1.14896,-0.645 2.45788,-0.98728 3.784,-0.98728c4.26732,0 7.74,3.47268 7.74,7.74c0,4.26732 -3.47096,7.74 -7.73828,7.74z"></path></g><g fill="#000000"><path d="M102.34,85.14c-4.26732,0 -7.74,-3.47268 -7.74,-7.74c0,-2.33748 1.03888,-4.5236 2.85176,-6.00108c0.3698,-0.301 0.9116,-0.24424 1.21088,0.12384c0.29928,0.36808 0.24424,0.90988 -0.12384,1.21088c-1.4104,1.14724 -2.2188,2.84832 -2.2188,4.66636c0,3.3196 2.7004,6.02 6.02,6.02c3.3196,0 6.02,-2.7004 6.02,-6.02c0,-3.3196 -2.7004,-6.02 -6.02,-6.02c-0.47472,0 -0.86,-0.38528 -0.86,-0.86c0,-0.47472 0.38528,-0.86 0.86,-0.86c4.26732,0 7.74,3.47268 7.74,7.74c0,4.26732 -3.47268,7.74 -7.74,7.74z"></path></g><g fill="#000000"><path d="M73.1,85.14c-4.26732,0 -7.74,-3.47268 -7.74,-7.74c0,-0.47472 0.38528,-0.86 0.86,-0.86c0.47472,0 0.86,0.38528 0.86,0.86c0,3.3196 2.7004,6.02 6.02,6.02c3.3196,0 6.02,-2.7004 6.02,-6.02c0,-3.3196 -2.7004,-6.02 -6.02,-6.02c-1.8318,0 -3.5432,0.82044 -4.69388,2.24976c-0.29756,0.3698 -0.83764,0.43 -1.20916,0.13072c-0.3698,-0.29756 -0.42828,-0.83936 -0.13072,-1.20916c1.4792,-1.83696 3.67908,-2.89132 6.03376,-2.89132c4.26732,0 7.74,3.47268 7.74,7.74c0,4.26732 -3.47268,7.74 -7.74,7.74z"></path></g></g></g></svg>
            </span>
            <h6 class="black-40 ttu tl">Összes Fertőzött</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> cases) ?></h3>
          </div>
        </div>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/cotton/64/000000/headstone--v2.png"/>
            </span>
            <h6 class="black-40 ttu tl">Összesen Elhunyt</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> deaths) ?></h3>
          </div>
        </div>
      </article>
      <article class="cf">
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon"><img src="assets/img/recoveries.svg"></span>
            <h6 class="black-40 ttu tl">Összesen felépült</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> recovered) ?></h3>
          </div>
        </div>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/bubbles/50/000000/protection-mask.png"/>
            </span>
            <h6 class="black-40 ttu tl">Aktív fertőzött</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> active) ?></h3>
          </div>
        </div>
      </article>
      <div class="fl w-50-ns pa2 link">
      <a href="/global.php" target="_blank" class="navlinkblock w-inline-block" style=";">
                <div class="navbuttoniconwrapper coffee"></div>
                <div class="phbuttontextcontainer">
                    <div class="navlinktext phcopy" style="">Világ Statisztika</div>
                    <div class="navlinktext phcopy" style="">adatait itt olvashatod le.</div>
                </div>
            </a>
            </div>
            <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="Alparslan" data-color="#000000" data-emoji=""  data-font="Cookie" data-text="Hívj meg egy Kávéra" data-outline-color="#fff" data-font-color="#fff" data-coffee-color="#fd0" ></script>
      <br>
      <br>
      <style>p{text-align: center;}</style>
      <br><p class="lh-copy measure black-60">
      Az adatok hitelességét a Worldometers és a Johns Hopkins University biztosítja.</p></br>
      <br>
      <style>h1 {text-align: center;}</style>
        <h1 class="mt0">🦠Tünetek Jellemzői</h1>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/cotton/64/000000/pain-points.png"/>
            </span>
            <h3 class="black-40 ttu tl">izomfájdalom, orrdugulás</h3>
          </div>
        </div>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/cute-clipart/64/000000/coughing.png"/>
            </span>
            <h3 class="black-40 ttu tl"> Száraz Köhögés, torokfájás</h3>
          </div>
        </div>
      </article>
      <article class="cf">
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="48" height="48"
viewBox="0 0 172 172"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M164.83333,82.41667h-39.41667v-7.16667h39.41667c1.978,0 3.58333,1.60533 3.58333,3.58333v0c0,1.978 -1.60533,3.58333 -3.58333,3.58333z" fill="#666666"></path><path d="M141.9645,71.66667h12.11883c1.978,0 3.58333,1.60533 3.58333,3.58333v21.5h-25.08333v-9.05867c0,-1.11083 0.258,-2.21092 0.75608,-3.2035l5.418,-10.83958c0.60917,-1.21475 1.849,-1.98158 3.20708,-1.98158z" fill="#ffb74d"></path><path d="M78.83333,118.25l-32.25,-3.58333l5.04892,-43.26517l27.20108,3.8485z" fill="#ff9800"></path><path d="M102.0175,135.7725l-1.68417,-6.7725h3.58333c3.58333,-32.25 -53.75,-43 -53.75,-43c0,0 -10.75,13.975 -10.75,43v28.66667h68.08333l-2.07833,-8.31333z" fill="#4fc3f7"></path><path d="M105.42167,149.35333l-37.33833,-20.35333l33.93417,6.7725z" fill="#039be5"></path><path d="M72.52667,133.71925c0,0 67.24842,13.27625 70.80667,13.19025c3.97033,-0.09675 5.05967,-8.38142 5.77633,-12.43058l0.35117,-1.99233c1.19683,-6.77608 -3.98825,-9.56392 -13.12933,-11.58492l-58.88133,-15.08942c-10.56008,-2.27183 -18.41833,0.86358 -20.03442,10.03333l-0.49092,2.79142c-0.0645,6.56467 6.74742,13.51992 15.60183,15.08225z" fill="#4fc3f7"></path><path d="M103.91667,68.08333h-10.75c0,0 0,7.16667 7.16667,10.75c-3.58333,7.16667 -9.17333,9.46 -15.1575,10.965c-15.12167,3.7625 -31.10333,-10.2125 -34.86583,-21.53583c-0.03583,-0.1075 -0.07167,-0.17917 -0.1075,-0.28667l-4.15667,-16.73417c-3.51167,-14.0825 44.57667,-34.615 53.75,-16.62667c0.43,0.82417 0.7525,1.72 1.00333,2.72333l0.44433,2.32917c1.77733,9.36683 2.67317,18.88058 2.67317,28.41583z" fill="#ffb74d"></path><path d="M96.76792,48.04892c-6.65425,-3.62275 -11.49175,0.28308 -13.27267,2.9885c-0.61992,0.91375 -0.34758,1.89917 0.65933,2.42592c0.9675,0.52675 2.04967,0.31533 2.63017,-0.59842c0.42642,-0.59842 3.32892,-4.36092 7.97292,-1.79525c1.00692,0.52675 2.04967,0.28308 2.66958,-0.63425c0.5805,-0.87433 0.30817,-1.85975 -0.65933,-2.3865zM90.48633,16.899c-17.7375,-9.0085 -39.3235,-8.97267 -44.47992,5.84442c-1.30792,3.57258 -4.96292,5.80858 -6.53958,8.33842c-9.19483,14.81708 0.96033,29.40842 9.58183,39.27333c0.11467,0.1505 0.22933,0.26158 0.34758,0.4085c2.193,2.97775 8.65733,-2.38292 8.65733,-2.38292c0,0 -7.88692,-14.63075 -0.72025,-21.79742c7.16667,-7.16667 7.14158,10.78225 9.29517,11.59925c2.193,0.82058 4.69417,-0.29742 4.69417,-0.29742c0,0 2.96342,-13.47692 2.3865,-21.2205c9.62125,-3.19992 21.66125,-1.46558 26.62417,-0.83133c0.54108,0.05375 3.62633,-1.83467 3.58333,-4.91633c-0.05017,-3.49375 -2.78783,-8.52117 -13.43033,-14.018z" fill="#795548"></path><path d="M122.42458,86h2.40083c4.28567,0 7.75792,-3.47225 7.75792,-7.75792v-2.99208h-17.91667v2.99208c0,4.28567 3.47225,7.75792 7.75792,7.75792z" fill="#666666"></path><path d="M125.41667,68.08333h-3.58333c-3.95958,0 -7.16667,3.20708 -7.16667,7.16667v0h17.91667v0c0,-3.95958 -3.20708,-7.16667 -7.16667,-7.16667z" fill="#ffab40"></path><path d="M157.66667,96.15158v40.60992c0,6.09167 -7.88333,10.15158 -14.33333,10.15158c-6.45,0 -10.75,-4.05992 -10.75,-10.15158v-40.60992c0,-6.09167 3.58333,-10.15158 14.33333,-10.15158c3.58333,0 11.10833,3.72308 10.75,10.15158z" fill="#4fc3f7"></path></g></g></svg></span>
            <h3 class="black-40 ttu tl">az íz- és a szaglásérzék elvesztése</h3>
          </div>
        </div> <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/cute-clipart/64/000000/fever.png"/>
            </span>
            <h3 class="black-40 ttu tl">Láz, hasmenés, légszomj</h3>
          </div>
        </div>
      </article>
      <div class="fl w-50-ns pa2 link">
      <a href="https://koronavirus.gov.hu/hirek" target="_blank" class="navlinkblock w-inline-block" style=";">
                <div class="navbuttoniconwrapper coffee"></div>
                <div class="phbuttontextcontainer">
                    <div class="navlinktext phcopy" style=""> Covid 19 Hírek.</div>
                    <div class="navlinktext phcopy" style="">Itt olvashatod el.</div>
                </div>
            </a>
            </div>
            <div class="fl w-50-ns pa2 link">
      <a href="https://koronavirus.gov.hu/intezkedesek" target="_blank" class="navlinkblock w-inline-block" style=";">
                <div class="navbuttoniconwrapper coffee"></div>
                <div class="phbuttontextcontainer">
                    <div class="navlinktext phcopy" style="">A hazai Intézkedéseket.</div>
                    <div class="navlinktext phcopy" style="">Itt olvashatod el.</div>
                </div>
            </a>
            </div>
        <br>
            </br>
      <footer class="">

<div class="mt1">
  <a href="https://portfolio-olive-one.vercel.app/" target="blank" title="Alparslan Abdikoglu" class="f4 dib pr2 mid-gray dim">Made by Alparslan Abdikoglu</a>
  <a href="https://disease.sh/" target="blank" title="Data Source" class="f4 dib pr2 mid-gray dim">DATA Backed by Disease API</a>
</div>
</footer>
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