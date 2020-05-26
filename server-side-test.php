<?php

$color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false;
if ($color_scheme === false) $color_scheme = 'light';

?><!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <?php
    if($color_scheme == 'dark') {
      ?><link rel="stylesheet" href="./dist/bootstrap-night.css"><?php
    } else {
      ?><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.css"><?php
    }
  ?>

  <title>Hello, world!</title>
</head>
<body class="container">
  <h1>Hello, world!</h1>

  <p>You are in <?= $color_scheme ?> mode.</p>

  <p><small>js.cookie &copy; Klaus Hartl, Fagner Brack, GitHub Contributors |
    Made with <span style="font-size:80%">&#10084;&#65039;</span> by Vino Rodrigues | &copy; 2020</small></p>

  <!-- Needs js.cookie -->
  <script src="https://cdn.jsdelivr.net/npm/js-cookie/dist/js.cookie.min.js"></script>
  <script>
    // code to set the `color_scheme` cookie
    var $color_scheme = Cookies.get("color_scheme");
    function get_color_scheme() {
      return (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) ? "dark" : "light";
    }
    function update_color_scheme() {
      Cookies.set("color_scheme", get_color_scheme());
    }
    // read & compare cookie `color-scheme`
    if ((typeof $color_scheme === "undefined") || (get_color_scheme() === $color_scheme)) update_color_scheme();
    // detect changes and change the cookie
    if (window.matchMedia) window.matchMedia("(prefers-color-scheme: dark)").addListener( update_color_scheme );
  </script>
</body>
</html>
