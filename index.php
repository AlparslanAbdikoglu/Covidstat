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

  <!-- Global site tag (gtag.js) - Google Analytics
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162093056-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-162093056-1');
  </script>-->

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

  <!-- Open Graph / Facebook
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://viruscovid.tech">
  <meta property="og:title" content="🦠COVID-19 Tracker">
  <meta property="og:description" content="Track the spread of the Coronavirus Covid-19 outbreak">
  <meta property="og:image" content="https://viruscovid.tech/assets/img/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">

  Twitter
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://viruscovid.tech">
  <meta property="twitter:title" content="🦠COVID-19 Tracker">
  <meta property="twitter:description" content="Track the spread of the Coronavirus Covid-19 outbreak">
  <meta property="twitter:image" content="https://viruscovid.tech/assets/img/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">
  <script type="text/javascript" src="assets/js/Chart.bundle.min.js"></script> -->

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
          <h1 class="mt0">👑Koronavírus<img class="theme-icon" src="assets/img/coronavirus.svg">Statisztika</h1> 
          <p class="lh-copy measure black-60">
             Covid-19 Világ és Hazai statisztikák, hírek intézkedések.
          </p>   
           </div>
        <!-- FB SHARE HERE-->

        </header>
        <style>h1 {text-align: center;}</style>
        <h1 class="mt0">🇭🇺<img class="theme-icon" src="assets/img/coronavirus.svg">Statisztika</h1>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
              <img src="assets/img/cases.svg">
            </span>
            <h6 class="black-40 ttu tl">Összes Fertőzött</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> cases) ?></h3>
          </div>
        </div>
        <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
              <img src="assets/img/deaths.svg">
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
              <img src="assets/img/active_cases.svg">
            </span>
            <h6 class="black-40 ttu tl">Aktív fertőzött</h6>
            <h3 class="black tl" data-plugin="counterup"><?php echo number_format($obj-> active) ?></h3>
          </div>
        </div>
      </article>
      <div class="fl w-50-ns pa2 link">
      <a href="" target="_blank" class="navlinkblock w-inline-block" style=";">
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
            <h3 class="black-40 ttu tl"> Száraz Köhögés, torok fájás</h3>
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
            <h3 class="black-40 ttu tl">az íz- és a szaglásérzékelés elvesztése</h3>
          </div>
        </div> <div class="fl w-50 tc stat-card">
          <div class="card-box tilebox-one">
            <span class="icon">
            <img src="https://img.icons8.com/cute-clipart/64/000000/fever.png"/>
            </span>
            <h3 class="black-40 ttu tl">Láz.hasmenés, légszomj.</h3>
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