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
</body>
<?php  
$string= $_SERVER['QUERY_STRING'];  
// echo $string;
$elements=explode('&', $string);
$kinase=explode("=", $elements[0])[1];
$substrate=explode("=", $elements[1])[1];

class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('Reactome.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } 
$kinaseSQL ="select UDID from GeneIDs where EntrezID=$kinase limit 1";      

$kinaseConnect = $db->query($kinaseSQL);
if ($kinaseConnect){

    while($row = $kinaseConnect->fetchArray()){
        $kinaseUDID=$row['UDID'];
    }

}

$substrateSQL ="select UDID from GeneIDs where EntrezID=$substrate limit 1";      

$substrateConnect = $db->query($substrateSQL);
if ($substrateConnect){

    while($row = $substrateConnect->fetchArray()){
        $substrateUDID=$row['UDID'];
    }

}

// echo $kinaseUDID."<br>";
// echo $substrateUDID."<br>";
//get sentence ids of the intersection
$intersectionCommand = escapeshellcmd("python /home/annotation/htdocs/text_mining/doc/pan/path/test.py $kinaseUDID $substrateUDID");
$intersection = shell_exec($intersectionCommand);
// echo $intersection;
//get all short names for the gene pair.
$geneNamesCommandA = escapeshellcmd("python /home/annotation/htdocs/text_mining/doc/pan/path/getGeneNames.py $kinaseUDID");
$geneNamesA = shell_exec($geneNamesCommandA);
$geneNamesCommandB = escapeshellcmd("python /home/annotation/htdocs/text_mining/doc/pan/path/getGeneNames.py $substrateUDID");
$geneNamesB = shell_exec($geneNamesCommandB);

$sentenceList=explode(";", $intersection);
$geneNameListA=explode(";", $geneNamesA);
$geneNameListB=explode(";", $geneNamesB);
// print_r($geneNameListA);
// print_r($geneNameListB);
// if ((sizeof($sentenceList)==0)||(sizeof($geneNameListA)==0)||(sizeof($geneNameListB)==0)){

$sentenceDir="/homes/TextMining/eGIFTResults/PMIDSentIDs/".$kinaseUDID.".pmidsentids";
// echo $sentenceDir;
$myfile=fopen($sentenceDir,"r") or die("Unable to open file");
$table="<table class='bordered'><tr><th>PMID</th><th>Sentence</th></tr>";
while (!feof($myfile)){
    $sentence=fgets($myfile);

    for ($i=0,$size=count($sentenceList);$i<$size;$i++){
        // echo $sentenceList[$i];
        $matchString= $sentenceList[$i];
        $pattern='/('.$matchString.'\s)(.*)/';
        preg_match($pattern,$sentence,$matches);

        if (!empty($matches)){

            foreach ($geneNameListA as $a){
                foreach($geneNameListB as $b){
                    $patternA='/.*'.$a.'.*/ix';
                    // look around regex with multiple conditions ^(?=.*\bjack\b)(?=.*\bjames\b)(?=.*\bjason\b)(?=.*\bjules\b).*$
                    $patternB='/.*'.'(?=.*\b'.$a.'\b)(?=.*\b'.$b.'\b).*/ix';
                    preg_match($patternB,$matches[2],$test);
                    if (!empty($test)){
                      // echo $matches[1].$test[0]."<br>";
                      $PMID=explode("-", $matches[1])[0];
                      $table.="<tr><td><a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$PMID\" target=\"_blank\">$PMID</a></td><td>$test[0]</td></tr>";
                    }
                    unset($sentenceList[i]);
                    break;
                }
                break;

            }


            // echo $matches[1].$matches[2]."<br>";
            // unset($sentenceList[i]);

        }
    }
}
fclose($myfile);
$table.="</table>";
echo $table;
// }
// else{
//   exit();
// }

?>  