<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Dialog - Animation</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/tooltipster.css" />

  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
  <script type="text/javascript" src="./js/jquery.tooltipster.js"></script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>


<script src="./js/sorttable.js"></script>
<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster({
          
              position: 'bottom',
              interactive: true,
              theme: 'tooltipster-light'
              });

        });

  </script>
</head>
<body>
 
<!-- <div class="dialog" title="Basic dialog">
   <p>1111</p>
</div>

<button class="opener">Open Dialog</button>
<div class="dialog" title="Basic dialog">
   <p>22222</p>
</div>

<button class="opener">Open Dialog</button>
<div class="dialog" title="Basic dialog">
   <p>3333</p>
</div> -->

<!-- <button class="opener">Open Dialog</button> -->
<div class="tooltip" title="This is my div's tooltip message!"> 
    This div has a tooltip when you hover over it!
</div>
 
</body>
</html>