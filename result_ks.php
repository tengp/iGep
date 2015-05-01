<?php
session_start();
$enriched = $_POST['enriched'];
$_SESSION['enriched']=$enriched;
// $exRatio=$_POST["expression_ratio"];
$upRatio=$_POST["upRatio"];
$_SESSION['upRatio']=$upRatio;
$downRatio=$_POST["downRatio"];
$_SESSION['downRatio']=$downRatio;

?>
<!DOCTYPE html>
<html>
<head>
<title>iGep Result</title>
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
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script> -->

<!-- <jquery script starts here> -->

<script>
  $(document).ready(function() {

        // $( ".dialog" ).dialog({
        //   autoOpen: false,
        //   width:300,
        //   minHeight:150,
        //   modal: false,

        // });

     
        // $( ".opener" ).mouseover(function(e) {
        //     $( ".dialog" ).dialog("open").dialog({
        //     // position:{
        //     //     my:"left-15",
        //     //     at:"bottom+67",
        //     //     // of: this,
        //     //     // at: left,
        //     //     of: e.target
        //     // }


        //     });
        // });  
    // });
    // $(document).ready(function() {

        $(".show-more").bind("click",function(){
            $(this).next(".igep-hide-pmid").toggle();
            $(this).toggle();
            // $(".igep-hide-pmid").toggle();
        });
        $(".show-less").bind("click",function(){
            $(this).closest(".igep-hide-pmid").hide();
            $(this).parent().prev(".show-more").show();
        });
        $("#substrateView").bind("click",function(){
            $("#substrate_view").show();
            $("#kinase_view").hide();
            $("#summary").hide();
            $("#no_result").hide();
        });
        $("#kinaseView").bind("click",function(){
            $("#substrate_view").hide();
            $("#no_result").hide();
            $("#summary").hide();
            $("#kinase_view").show();
        });
        $("#summary").bind("click",function(){
            $("#substrate_view").hide();
            $("#no_result").hide();
            $("#summary").show();
            $("#kinase_view").hide();
        });
        $("#noresult").bind("click",function(){
            $("#substrate_view").hide();
            $("#kinase_view").hide();
            $("#summary").hide();
            $("#no_result").show();
        });
        // $("#downloadButton").bind("click",function(){
        //     $("#substrate_view").hide();
        //     $("#kinase_view").hide();
        //     $("#no_result").show();
        // });


        $('.tooltip').tooltipster({
              animation: 'fade',
              delay: 200,
              position: 'bottom',
              interactive: true,
              theme: 'tooltipster-light',
              contentAsHTML: true
        });


    });

        // $("html").on("click",".igep-show-pmid",function(){
        //     $(this).next(".igep-hide-pmid").show();
        // });
        

        // Close Pop-in If the user clicks anywhere else on the page
        // jQuery('html') //set for html for jsfiddle, but should be 'body'
        //     .bind('mouseover',function(e){
        //         if(
        //             jQuery('.dialog').dialog('isOpen')
        //                 && !jQuery(e.target).is('.ui-dialog, a')
        //                 && !jQuery(e.target).closest('.ui-dialog').length
        //         ){
        //             jQuery('.dialog').dialog('close');
        //          }
        //     });

//for the view by selection//
        var timeout=50;
        var closetimer=0;
        var ddmenuitem=0;
        function jsddm_open()
        {  jsddm_canceltimer();
           jsddm_close();
           ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

        function jsddm_close()
        {  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

        function jsddm_timer()
        {  closetimer = window.setTimeout(jsddm_close, timeout);}

        function jsddm_canceltimer()
        {  if(closetimer)
           {  window.clearTimeout(closetimer);
              closetimer = null;}}

        $(document).ready(function()
        {  $('#jsddm > li').bind('mouseover', jsddm_open)
           $('#jsddm > li').bind('mouseout',  jsddm_timer)});

        document.onclick = jsddm_close;
//hashchange//




//view by selector part ends here//



  // });
</script>
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
 <!-- <body> -->


<div class="figurelegend">
<div id="updown">
    <?php
        echo "<br><br>Up-regulated:<font color=\"#FF0000\"> &#9650;</font><br>";
    ?>
    <!-- <div style="width:30px;height:7px;border:1px solid #666666; background:#FF0000 "></div> -->
    <?php
        echo "Down-regulated:<font color=\"#088A08\"> &#9660; </font><br>";
        echo "<a href=\"http://research.bioinformatics.udel.edu/rlimsp/\" target=\"_blank\">RLIMS-P</a>: A Rule-based Literature Mining System for Protein Phosphorylation.<br>";
        echo "Please note this result is non-species-specific.";

    ?>

</div>
</div>
<br>


<div class="content">
        <div class="button">
          
            <ul id="jsddm" >
                <li><a href="#">View by &#9660;</a>
                    <ul>
                        <li><a  href="#KinaseView" id="kinaseView">Kinase</a></li>
                        <li><a  href="#SubstrateView" id="substrateView">Substrate</a></li>
<!--                         <li><a  href="#Summary" id="summary">Summary</a></li>
 -->                        <li><a  href="#NoResult" id="noresult">No Result</a></li>

                    </ul>
                </li>
                <li><a href="download.php" target="_blank" id="downloadButton" ACTION="download.php">Download</a>
                </li>
            </ul>
        </div>

<div class="table">


<?PHP
ini_set('memory_limit', '4112M');
ini_set('max_execution_time','3600');

$Enrich_array=array();// array for EntrezID to Gene short name
$Enrich_Entrez_array=array(); //array for Short name to entrez ID
$Enrich_ratio_array=array();   //array for entrezID to expression ratio
$No_array=array(); //array for genes with no result
$Enrich_UU_array=array();
$shortName2color=array(); //key: short name  value: colored triangle



$enriched = $_POST['enriched'];
// $exRatio=$_POST["expression_ratio"];
$upRatio=$_POST["upRatio"];
$downRatio=$_POST["downRatio"];

$enriched_lines = explode("\n", $enriched);
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

for ($i=0; $i<sizeof($enriched_lines); $i++){

        $data=explode("\t",$enriched_lines[$i]);
        $E=strtoupper($data[0]);
        $E=str_replace(" ", "", $E);
        $L=(float)$data[1];
        // $Enrich_array[$E]=$L;
        // $shortNameSql ="select ShortName,EntrezOrtholog,UniprotOrtholog from Orthologs where EntrezID=$E limit 1";      
        $found_row=false; //flag for check whether there is result of the query for this EntrezID
        $shortNameSql ="select ShortName,UniprotOrtholog from Orthologs where EntrezID=$E limit 1";      

        $shortName = $db->query($shortNameSql);
        if ($shortName){

            while($row = $shortName->fetchArray()){
                $found_row=true;
                if (isset($row)){
                    $ss=strtoupper($row['ShortName']);
                    $Enrich_array[$E]=$ss;
                    $Enrich_Entrez_array[$ss]=$E;
                    $Enrich_ratio_array[$E]=$L;
                    $UU=$row['UniprotOrtholog'];
                    if (!empty($UU)){

                        $UU_list=explode(",",$UU);

                        // $Enrich_UU_array=$Enrich_UU_array+$UU_list;
                        $Enrich_UU_array=array_merge($Enrich_UU_array,$UU_list);
                    }
                }
                

            }
            if($found_row==false){
                array_push($No_array, $E);
            }

        }
        

        if (is_numeric($upRatio)||is_numeric($downRatio)){
            if (!is_numeric($upRatio)){
                $upRatio=1.5;
            }
            elseif(!is_numeric($downRatio)){
                $downRatio=-1.5;
            }

            if ($L >= $upRatio){
                // $color="#FF0000";
                $color="<font color=\"#FF0000\"> &#9650;</font>";
            }
            elseif  ($L <= $downRatio){
                $color="<font color=\"#088A08\"> &#9660; </font>";
            }
            else{
                $color="";
            }
        }
        elseif(!is_numeric($upRatio)&&!is_numeric($downRatio)){

            if ($L <= (-1.5)){
                $color="<font color=\"#088A08\"> &#9660; </font>";
            }
            elseif($L>=1.5){
                $color="<font color=\"#FF0000\"> &#9650;</font>";
            }
            else{
                $color="";
            }
        }
        if (!array_key_exists($ss, $shortName2color)){

            $shortName2color[$ss]=$color;
        }
        

}
// print_r($No_array);
function getUpDown($color){
    if ($color=="<font color=\"#088A08\"> &#9660; </font>"){
        return $regulate="down-regulated";
    }
    elseif ($color==""){
        return $regulate="neutral";
    }
    else{
        return $regulate="up-regulated";
    }
}
// echo getUpDown("<font color=\"#088A08\"> &#9660; </font>");
if(sizeof($enriched_lines)==1){
    $total=0;
}
else{
    $total=sizeof($enriched_lines);

}

$p2pmid=array();//gene names that have reuslt in this analysis.
        $table_k= "<table id=\"kinase_view\" class=\"bordered\" ><col width=\"25%\"><col width=\"25%\"><col width=\"30%\"><col width=\"20%\">

        <tr> 
               <th>Kinase</th>

               <th>Substrate</th>
               <th>Kinase-Substrate Evidence</th>
               <th title='Click the links to get Co-occurred Sentences'>Co-occurring Sentences</th>

        </tr>";
        $table_s= "<table id=\"substrate_view\" class=\"bordered\" style=\"display: none\"><col width=\"25%\"><col width=\"25%\"><col width=\"30%\"><col width=\"20%\">

        <tr> 
               <th>Substrate</th>

               <th>Kinase</th>
               <th>Kinase-Substrate Evidence</th>
               <th title='Click the links to get Co-occurred Sentences'>Co-occurring Sentences</th>
        </tr>";
        $session_download="";
        // $piece_k="";
        // $piece_s="";
for ($i=0; $i<sizeof($enriched_lines); $i++){

        // $table_k.= "<tr>";
        // $table_s.= "<tr>";
        $data=explode("\t",$enriched_lines[$i]);
      ////Entrez////
        $EntrezID=strtoupper($data[0]);
        $level=$data[1];
      ////Symbol (ShortName)/////

        // $EntrezSqlQuery ="select ShortName,EntrezOrtholog,UniprotOrtholog from Orthologs where EntrezID=$EntrezID;";  
        $EntrezSqlQuery ="select ShortName,UniprotOrtholog from Orthologs where EntrezID=$EntrezID;";      
        $EntrezSql = $db->query($EntrezSqlQuery);
        if ($EntrezSql){

            $EEArray=array();
            $UUArray=array();
            while($row = $EntrezSql->fetchArray()){

                $UU=$row['UniprotOrtholog'];
                $UUArray=explode(",",$UU);
                $ShortName=$row['ShortName'];
                $ss=strtoupper($ShortName);

                if (!empty($UU)){
                    ###if from the EntrezID, UniprotID ortholog set is not empty###
                    $UUU='"'.implode('","',array_unique($UUArray)).'"'; ///  "," joined Uniprot IDs for SQL query
                    // echo "<br>".$UUU."<br>";
                    
                    $kinaseSQL ='select * from sk_new where substrate_AC in ('.$UUU.') or kinase_AC in ('.$UUU.');';
                    $kinase_e = $db->query($kinaseSQL);
                    if ($kinase_e){
                        // $kkAray=array();
                        // $ssAray=array();
                        $k_pmidArray=array();
                        $s_pmidArray=array();
                        $k2pmid=array();
                        $s2pmid=array();
                        $r_pmidArray=array();
                        while ($row=$kinase_e->fetchArray()){

                            $kk=strtoupper($row['kinase_genename']);
                            $pmid=$row['pmid'];
                            // echo $pmid;
                            $substrate=strtoupper($row['substrate_genename']);
                            $source=$row['source'];
                            $kk_AC=$row['kinase_AC'];
                            $substrate_AC=$row['substrate_AC'];
                            if (in_array($substrate_AC, $UUArray)&&($source!='psp')){
                                // echo "<br>Yoo<br>";
                                if (in_array($kk_AC, $Enrich_UU_array)){
                                    // echo "<br>hiii<br>";
                                    $ppp=explode(",",$pmid);
                 
                                    // echo $kk."<br>";
                                    if (array_key_exists($kk, $k2pmid)){
                                        $k2pmid[$kk]=array_merge($k2pmid[$kk],$ppp);
                                    }
                                    else{
                                        $k2pmid[$kk]=$ppp;

                                    }

                                }

                                array_push($kkAray,$kk);
                            }

                            foreach ($k2pmid as $key=>$value){
                                $k2pmid[$key]=array_unique($k2pmid[$key]);
                                if (!in_array($key, $p2pmid)){
                                    if (in_array($key, $Enrich_array)){
                                        array_push($p2pmid,$key);
                                    }
                                }
                            }
                            if (in_array($kk_AC, $UUArray)&&($source!='psp')){


                                if (in_array($substrate_AC, $Enrich_UU_array)){
                                    $pppp=explode(",",$pmid);
                          // for ($i=0; $i<sizeof($ppp); $i++){  
                              // $pmidArray=$pmidArray+$ppp;

                              // $k2pmid[$kk]=array_merge($ppp,$k2pmid[$kk]);

                                    if (array_key_exists($substrate, $s2pmid)){
                                        $s2pmid[$substrate]=array_merge($s2pmid[$substrate],$pppp);
                                    }
                                    else{
                                        $s2pmid[$substrate]=$pppp;

                                    }

                                }

                                // array_push($subAray,$substrate);
                            }
                            // elseif(!in_array($EntrezID, $No_array)){
                            //     array_push($No_array, $EntrezID);
                            // }             
                        
                            foreach ($s2pmid as $key=>$value){
                                $s2pmid[$key]=array_unique($s2pmid[$key]);
                                if (!in_array($key, $p2pmid)){
                                    if (in_array($key, $Enrich_array)){

                                        array_push($p2pmid,$key);
                                    }
                                }
                            }
                            if ($source=="rlim"){
                              // if (($kk==$ss)||($substrate==$ss)){
                                if (($kk==$ss&&in_array($substrate, $Enrich_array))||($substrate==$ss)&&in_array($kk, $Enrich_array)){
                                  $ppppp=explode(",",$pmid);
                                  $r_pmidArray=array_merge($ppppp,$r_pmidArray);
                                }  
                            }

                            $r_pmidArray_unique=implode(",",array_unique($r_pmidArray));

                        }
                        // print_r($s2pmid);
                        // echo "<br>";
                        // print_r($k2pmid);

                        // if (!empty($k2pmid)||!empty($s2pmid)){
                        $rowspan=count($s2pmid);
                        if (!empty($s2pmid)){

                            $colorss=$shortName2color[$ss];
                            // echo $colorss;
                            // $table_k.= "";
                            // $piece_up="";
                            // $piece_down="";
                            $piece="";
                            $piece.= "<tr><td rowspan=".$rowspan."><a class='tooltip' title='More about $ss at:   <a href=\"http://www.ncbi.nlm.nih.gov/gquery/?term=$ss\" target=\"_blank\">NCBI</a>   <a href=\"http://www.uniprot.org/uniprot/?query=name%3A$ss+OR+gene%3A$ss&sort=score\" target=\"_blank\">UniProt</a>'>$ss </a>$colorss</td>";
                            // $piece.= "<div class=\"dialog\" style=\"display:none\"><p>$ss<p></div></td>";
                            
                            foreach ($s2pmid as $key=>$value){

                                $color=$shortName2color[$key];
                                // echo $key;
                                $piece.= "<td>
                                        <a class='tooltip' title='More about $key at:   <a href=\"http://www.ncbi.nlm.nih.gov/gquery/?term=$key\" target=\"_blank\">NCBI</a>   <a href=\"http://www.uniprot.org/uniprot/?query=name%3A$key+OR+gene%3A$key&sort=score\" target=\"_blank\">UniProt</a>'>$key </a>
                                        $color
                                        </td>";
                                $piece.= "<td class=\"inside\">";
                                $session_download.=$Enrich_Entrez_array[$ss]."~#~".$ss."~#~".getUpDown($colorss)."~#~".$Enrich_Entrez_array[$key]."~#~".$key."~#~".getUpDown($color)."~#~".implode("; ",$value)."~@@~";
                                
                                if(count($value)>5){

                                
                                    foreach(array_slice($value,0,4) as $v){
                                        $piece.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                                        if (in_array($v, $r_pmidArray)){ 
                                            $piece.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                                        }
                                        else{
                                            $piece.= "<br>";
                                        }

                                    }

                                    $piece.="<span class=\"show-more\"><a>more +</a><br></span>";
                                    $piece.="<span class=\"igep-hide-pmid\" style=\"display: none\">";
                                    foreach(array_slice($value,4) as $v){
                                        $piece.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                                        if (in_array($v, $r_pmidArray)){ 
                                            $piece.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                                        }
                                        else{
                                            $piece.= "<br>";
                                        }
                                    }
                                    $piece.="<span class=\"show-less\"><a>less -</a><br></span>";
                                    $piece.="</span>";

                                }
                                else{
                                    foreach($value as $v){
                                        $piece.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                                        if (in_array($v, $r_pmidArray)){ 
                                            $piece.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                                        }
                                        else{
                                            $piece.= "<br>";
                                        }

                                    }

                                }

                                $piece.= "</td>";
                                $substrate_URL=$Enrich_Entrez_array[$key];
                                $kinase_URL=$Enrich_Entrez_array[$ss];


                                $kinaseSQL ="select UDID from GeneIDs where EntrezID=$kinase_URL limit 1";      

                                $kinaseConnect = $db->query($kinaseSQL);
                                if ($kinaseConnect){

                                    while($row = $kinaseConnect->fetchArray()){
                                        $kinaseUDID=$row['UDID'];
                                    }

                                }

                                $substrateSQL ="select UDID from GeneIDs where EntrezID=$substrate_URL limit 1";      

                                $substrateConnect = $db->query($substrateSQL);
                                if ($substrateConnect){

                                    while($row = $substrateConnect->fetchArray()){
                                        $substrateUDID=$row['UDID'];
                                    }

                                }
                                // $piece .="<td><a href=\"sentence_content.php?udid1=$kinaseUDID&udid2=$substrateUDID\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> Sentence </a></td>";
                                if ($kinaseUDID!= $substrateUDID){
                                    $page=file_get_contents("http://biotm1.cis.udel.edu/eGIFT_APIs/form/form3/form_udid_udid_sentences.php?udid1=$kinaseUDID&udid2=$substrateUDID");
                                    $page=explode("<br>",$page);
                                    $sentence=explode(": ",$page[0])[1];
                                    $piece .="<td><a href=\"sentence_content.php?udid1=$kinaseUDID&udid2=$substrateUDID\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> $sentence </a></td>";
                                }
                                else{
                                    $piece.="<td></td>";
                                    // $piece .="<td><a href=\"sentence_content.php?udid1=$kinaseUDID&udid2=$substrateUDID\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> Sentences </a></td>";

                                }

                                // $piece .="<td><a href=\"test_sentence.php?kinase=$kinase_URL&substrate=$substrate_URL\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> Sentence </a></td>";
                                if ($value!=end($s2pmid)){
                                    $piece.= "</tr><tr>";
                                }
                                else{
                                    $piece.="</tr>";
                                }
                                
                            }
                            if ($colorss=="<font color=\"#088A08\"> &#9660; </font>"){
                                    $piece_down.=$piece;                                
                            }
                            elseif($colorss==""){
                                // echo $colorss."null";
                                $piece_mid.=$piece;
                            }
                            else{
                                $piece_up.=$piece;
                            }

                        }
                        // echo "<table class='bordered'>".$piece_up."</table>";
                        // echo "<table class='bordered'>".$piece_down."</table>";
                        // $piece_k=$piece_down.$piece_up;

                        // $rowspan_s=count($k2pmid);
                        
                        // if (!empty($k2pmid)){

                        //     $colorss=$shortName2color[$ss];

                        //     // $table_k.= "<div class=\"dialog\" id=\"$ss\"><p>$ss<p></div>";
                        //     $piece_s.= "<td rowspan=".$rowspan_s.">
                        //             <a class='tooltip' title='More about $ss at:   <a href=\"http://www.ncbi.nlm.nih.gov/gquery/?term=$ss\">NCBI</a>   <a href=\"http://www.uniprot.org/uniprot/?query=name%3A$ss+OR+gene%3A$ss&sort=score\">UniProt</a>'>$ss </a>
                        //             $colorss
                        //             </td>";
                            
                        //     foreach ($k2pmid as $key=>$value){

                        //         $color=$shortName2color[$key];
                        //         // echo $key;
                        //         $piece_s.= "<td>
                        //                 <a class='tooltip' title='More about $key at:   <a href=\"http://www.ncbi.nlm.nih.gov/gquery/?term=$key\">NCBI</a>   <a href=\"http://www.uniprot.org/uniprot/?query=name%3A$key+OR+gene%3A$key&sort=score\">UniProt</a>'>$key </a>

                        //                 $color
                        //                 </td>";
                        //         $piece_s.= "<td class=\"inside\">";
                        //         if(count($value)>5){

                                
                        //             foreach(array_slice($value,0,4) as $v){
                        //                 $piece_s.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                        //                 if (in_array($v, $r_pmidArray)){ 
                        //                     $piece_s.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                        //                 }
                        //                 else{
                        //                     $piece_s.= "<br>";
                        //                 }

                        //             }

                        //             $piece_s.="<span class=\"igep-show-pmid\"><a>...</a><br></span>";
                        //             $piece_s.="<span class=\"igep-hide-pmid\" style=\"display: none\">";
                        //             foreach(array_slice($value,4) as $v){
                        //                 $piece_s.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                        //                 if (in_array($v, $r_pmidArray)){ 
                        //                     $piece_s.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                        //                 }
                        //                 else{
                        //                     $piece_s.= "<br>";
                        //                 }
                        //             }
                        //             $piece_s.="</span>";

                        //         }
                        //         else{
                        //             foreach($value as $v){
                        //                 $piece_s.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                        //                 if (in_array($v, $r_pmidArray)){ 
                        //                     $piece_s.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                        //                 }
                        //                 else{
                        //                     $piece_s.= "<br>";
                        //                 }

                        //             }

                        //         }

                        //         $piece_s.= "</td>";
                        //         if ($value!=end($k2pmid)){
                        //             $piece_s.= "</tr><tr>";
                        //         }
                        //         else{
                        //             $piece_s.="</tr>";
                        //         }

                                
                                
                        //     }
                        //     if ($colorss=="<font color=\"#088A08\"> &#9660; </font>"){
                        //             $piece_down_s.=$piece_s;                                
                        //     }
                        //     elseif($colorss==""){
                        //         // echo $colorss."null";
                        //         $piece_mid_s.=$piece_s;
                        //     }
                        //     else{
                        //         $piece_up_s.=$piece_s;
                        //     }

                        // }
                        $rowspan=count($k2pmid);
                        if (!empty($k2pmid)){

                            $colorss=$shortName2color[$ss];
                            // echo $colorss;
                            // $table_k.= "";
                            // $piece_up="";
                            // $piece_down="";
                            $piece="";
                            $piece.= "<tr><td rowspan=".$rowspan."><a class='tooltip' title='More about $ss at:   <a href=\"http://www.ncbi.nlm.nih.gov/gquery/?term=$ss\">NCBI</a>   <a href=\"http://www.uniprot.org/uniprot/?query=name%3A$ss+OR+gene%3A$ss&sort=score\">UniProt</a>'>$ss </a>$colorss</td>";
                            // $piece.= "<div class=\"dialog\" style=\"display:none\"><p>$ss<p></div></td>";
                            
                            foreach ($k2pmid as $key=>$value){

                                $color=$shortName2color[$key];
                                // echo $key;
                                $piece.= "<td>
                                        <a class='tooltip' title='More about $key at:   <a href=\"http://www.ncbi.nlm.nih.gov/gquery/?term=$key\">NCBI</a>   <a href=\"http://www.uniprot.org/uniprot/?query=name%3A$key+OR+gene%3A$key&sort=score\">UniProt</a>'>$key </a>
                                        $color
                                        </td>";
                                $piece.= "<td class=\"inside\">";
                                if(count($value)>5){

                                
                                    foreach(array_slice($value,0,4) as $v){
                                        $piece.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                                        if (in_array($v, $r_pmidArray)){ 
                                            $piece.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                                        }
                                        else{
                                            $piece.= "<br>";
                                        }

                                    }

                                    $piece.="<span class=\"show-more\"><a>more +</a><br></span>";
                                    $piece.="<span class=\"igep-hide-pmid\" style=\"display: none\">";
                                    foreach(array_slice($value,4) as $v){
                                        $piece.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                                        if (in_array($v, $r_pmidArray)){ 
                                            $piece.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                                        }
                                        else{
                                            $piece.= "<br>";
                                        }

                                    }
                                    $piece.="<span class=\"show-less\"><a>less -</a><br></span>";
                                    $piece.="</span>";

                                }
                                else{
                                    foreach($value as $v){
                                        $piece.= "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                                        if (in_array($v, $r_pmidArray)){ 
                                            $piece.= "&nbsp;<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">RLIMS-P</a>"." <br>";
                                        }
                                        else{
                                            $piece.= "<br>";
                                        }

                                    }

                                }
                                $piece.= "</td>";
                                $kinase_URL=$Enrich_Entrez_array[$key];
                                $substrate_URL=$Enrich_Entrez_array[$ss];

                                $kinaseSQL ="select UDID from GeneIDs where EntrezID=$kinase_URL limit 1";      

                                $kinaseConnect = $db->query($kinaseSQL);
                                if ($kinaseConnect){

                                    while($row = $kinaseConnect->fetchArray()){
                                        $kinaseUDID=$row['UDID'];
                                    }

                                }

                                $substrateSQL ="select UDID from GeneIDs where EntrezID=$substrate_URL limit 1";      

                                $substrateConnect = $db->query($substrateSQL);
                                if ($substrateConnect){

                                    while($row = $substrateConnect->fetchArray()){
                                        $substrateUDID=$row['UDID'];
                                    }

                                }
                                // $piece .="<td><a href=\"http://biotm1.cis.udel.edu/eGIFT_APIs/form/form3/form_udid_udid_sentences.php?udid1=$kinaseUDID&udid2=$substrateUDID\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> Sentence </a>";
                                


                                if ($kinaseUDID!= $substrateUDID){
                                    $page=file_get_contents("http://biotm1.cis.udel.edu/eGIFT_APIs/form/form3/form_udid_udid_sentences.php?udid1=$kinaseUDID&udid2=$substrateUDID");
                                    $page=explode("<br>",$page);
                                    $sentence=explode(": ",$page[0])[1];
                                    $piece .="<td><a href=\"sentence_content.php?udid1=$kinaseUDID&udid2=$substrateUDID\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> $sentence </a></td>";
                                }
                                else{
                                    $piece.="<td></td>";
                                    // $piece .="<td><a href=\"sentence_content.php?udid1=$kinaseUDID&udid2=$substrateUDID\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> Sentences </a></td>";

                                }
                                // $piece .="<a href=\"test_sentence.php?kinase=$kinase_URL&substrate=$substrate_URL\" target=\"_blank\" title='Click here to get Co-occurred Sentences for gene $ss and $key'> Sentence </a></td>";
                                if ($value!=end($s2pmid)){
                                    $piece.= "</tr><tr>";
                                }
                                else{
                                    $piece.="</tr>";
                                }
                                
                            }
                            if ($colorss=="<font color=\"#088A08\"> &#9660; </font>"){
                                    $piece_down_s.=$piece;  
                            }
                            elseif($colorss==""){
                                // echo $colorss."null";
                                $piece_mid_s.=$piece;
                            }
                            else{
                                $piece_up_s.=$piece;
                            }

                        }
                    }   //  if ($kinase_e){
                } //  if (!empty($UU)){
                
            }//while($row = $EntrezSql->fetchArray()){
        } //if Entrezsql
              
        // $table_k.= "<tr>";
        // $table_s.= "<tr>";

}

$table_k.=$piece_up.$piece_down.$piece_mid;
$table_s.=$piece_up_s.$piece_down_s.$piece_mid_s;
$table_k.="</table>";
$table_s.="</table>";
foreach($Enrich_array as $k=>$v){
    if (!in_array($v,$p2pmid)){
        array_push($No_array, $k);
    }
}
$table_n="<table id=\"no_result\" class=\"bordered\" style=\"display: none\"><col width=\"100%\">

        <tr> 
               <th>Entrez ID</th>

               
        </tr>";

if (sizeof($No_array)!=0){
    $table_n.="<tr><td>";
    $string=implode(", ",$No_array);
    $table_n.=$string;
    $table_n.="</td></tr>";

}
else{
    $table_n.="<tr><td>0 genes had no results</td></tr>";
}
echo $table_k;
echo $table_s;
echo $table_n;
$_SESSION['session_download']=$session_download;

// echo "<div> test </div>";
// echo  "<div class=\"tooltip\" title=\"This is my div's tooltip message!\"> 
//     This div has a tooltip when you hover over it!
// </div>";
$db->close();


$given=sizeof($p2pmid);

// Testing numbers. Replace with your own.
$value = $given;
$max = $total;
$scale = 1.0;

// Get Percentage out of 100
if ( !empty($max) ) { $percent = ($value * 100) / $max; } 
else { $percent = 0; }

// Limit to 100 percent (if more than the max is allowed)
if ( $percent > 100 ) { $percent = 100; }
// print_r($Enrich_array);

?>

    <div class="result" >
        <?php
            echo "Number of genes found from your input:";
        ?>


        <div class="percentbar" style="width:<?php echo round(102 * $scale); ?>px;">
            <div style="width:<?php echo round($percent * $scale); ?>px;"><?php echo "$given"."/"."$total"; ?></div>
        </div>
    </div>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>




</body>
</html>






        