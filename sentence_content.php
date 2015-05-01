<!DOCTYPE html>

<html>
<head>
<title>iGep Gene Co-occuring Sentences</title>
<!-- Bootstrap link -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<!-- Bootstrap link  end-->
<!-- CSS stylesheet -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<!-- CSS stylesheet end-->
<!-- Google fonts Link-->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900' rel='stylesheet' type='text/css'>
 <!--<script type="text/javascript">
  // If setting document.domain, be sure to do it *before* jQuery is loaded!
  // document.domain = document.domain.split('.').slice(-2).join('.');
 </script> -->
<script type="text/javascript" src="./js/jquery.min.js"> </script>
<script src="./js/hover_pack.js"></script>
<script src="./js/sorttable.js"></script> <!-- sorttable table js  -->
<!-- <script type="text/javascript" src="./js/jquery.ba-hashchange.js"></script> -->

<!-- <jquery link> -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<!-- <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script> -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

<!--tooltipster js and css-->
  <link rel="stylesheet" type="text/css" href="./css/tooltipster.css" />
  <script type="text/javascript" src="./js/jquery.tooltipster.js"></script>
  </head>
  <body>
<!-- Header starts here -->
    <div class="strip"> </div>
    <div class="container"></div>
    <div class="header">
        <div class="header-top">
                <div class="logo">
                    <h1><a href="index.html" target="_blank">iGep</a></h1>

                </div>
                <div class="clearfix"> </div>
        </div>
    </div>
    </div>
    <br>
<?php
$string= $_SERVER['QUERY_STRING'];  
// echo $string;
// $page=htmlentities(file_get_contents("http://biotm1.cis.udel.edu/eGIFT_APIs/form/form3/form_udid_udid_sentences.php?udid1=1&udid2=397"));
$page=file_get_contents("http://biotm1.cis.udel.edu/eGIFT_APIs/form/form3/form_udid_udid_sentences.php?$string");

$page=explode("<br>",$page);
// print_r($page); 

// echo sizeof($page)."<br>";
echo "Sentence ".$page[0]."<br>";
$table="<table class='bordered'><col width=\"15%\"><col width=\"85%\"><tr><th>PMID</th><th>Sentence</th></tr>";
for ($i=1,$size=sizeof($page);$i<$size;$i++){
    if($page[$i]){

        $line=explode("~@~",$page[$i]);
        preg_match('/^(\d+-\d+)\s(.*)/',$line[0],$matches);
        // print_r($matches);
        // echo $line[0]."<br>";
        $PMIDSent=$matches[1];
        $PMID=explode("-",$matches[1])[0];
        // echo $PMID;
        $sentence=$matches[2];

        $table.="<tr><td><a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$PMID\" target=\"_blank\">$PMIDSent</a></td><td>$sentence</td></tr>";
    }   

}    
$table.="</table>";
echo $table;

?>
</body>

</html>