<?php 

if ($_SERVER['HTTP_HOST'] != "beta.knowitbetter.fr") {
    echo '
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-GPFQ8X556E"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag("js", new Date());

    gtag("config", "G-GPFQ8X556E");
  </script>
  ';
}