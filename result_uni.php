
<!DOCTYPE html>
<html>
<title>iGEP: A web tool for Integrating Gene Expression and Phosphorylation data</title>
<!-- Bootstrap link -->
<link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- Bootstrap link  end-->
<!-- CSS stylesheet -->
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- CSS stylesheet end-->
<!-- Google fonts Link-->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="./js/jquery.min.js"> </script>
<script src="./js/hover_pack.js"></script>
</head>
<body>
<!-- Header starts here -->
    <div class="strip"> </div>
    <div class="header">
        <div class="container">
            <div class="header-top">
                <div class="logo">
                    <h1><a href="index.html">iGep</a></h1>

                </div>
                
                <div class="clearfix"> </div>
                </div>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<!-- <body>-->
<div>
<table class="bordered">

<tr> 
               <th>Entrez</th>
               <th>Protein</th>
               <th>Differentially Expressed</th>
               <th>Ratio</th>
               <th colspan="2">Protein's Kinase</th>
               <th colspan="2">Protein's Substrate</th>
               <th>Rlimsp_Evidence</th>
</tr>

<?PHP
ini_set('memory_limit', '3072M');
ini_set('max_execution_time','3600');

$Enrich_array=array();
$Enrich_EE_array=array();
// $Enrich_EE_array=new SplfixedArray(1000000);
$Enrich_UU_array=array();
// $Enrich_UU_array=new SplfixedArray(1000000);
$enriched = $_POST['enriched'];
$exRatio=$_POST["expression_ratio"];
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
        $L=$data[1];
        // $Enrich_array[$E]=$L;
        $shortNameSql ="select ShortName from UDGenes u join GeneIDs g on u.UDID=g.UDID join UniProtKBIDs uni where g.EntrezID=$E limit 1";      
        $shortName = $db->query($shortNameSql);
        if ($shortName){


           if($row = $shortName->fetchArray()){
              $ss=strtoupper($row[0]);
              $Enrich_array[$E]=$ss;
           }


        }
        $EntrezSqlQuery ="select EntrezID from GeneIDs where UDID=(select UDID from GeneIDs where EntrezID=$E);";      
        $EntrezSql = $db->query($EntrezSqlQuery);
        if ($EntrezSql){
            $EEE_from_Entrez=array();
            while ($row=$EntrezSql->fetchArray()){
                $EEE=$row['EntrezID'];
                // echo "EEE is $EEE";
                array_push($Enrich_EE_array,$EEE);
                array_push($EEE_from_Entrez,$EEE);

            }
            $EEE_for_Uniprot=implode(",",array_unique($EEE_from_Entrez));
            $UniprotSql="select UniProtKB_AC from idmapping where GeneID in ($EEE_for_Uniprot);";
            $Uniprot=$db->query($UniprotSql);
            if ($Uniprot){
                  while($row=$Uniprot->fetchArray()){
                        $UU=$row['UniProtKB_AC'];
                        array_push($Enrich_UU_array,$UU);
                  }
        
            }

        }

}
// print_r($Enrich_array);
// echo "<br>Enrich_UU_array<br>";
// print_r($Enrich_UU_array);
// echo "<br>Enrich_EE_array<br>";
// print_r($Enrich_EE_array);

for ($i=0; $i<sizeof($enriched_lines); $i++){

        echo "<tr>";
        $data=explode("\t",$enriched_lines[$i]);
      ////Entrez////
        $EntrezID=strtoupper($data[0]);
        $level=$data[1];

      ////Symbol (ShortName)/////

        $EntrezSqlQuery ="select EntrezID from GeneIDs where UDID=(select UDID from GeneIDs where EntrezID=$EntrezID);";      
        $EntrezSql = $db->query($EntrezSqlQuery);
        if ($EntrezSql){
            if ($exRatio == "other"){
                if ($level > $upRatio or $level < $downRatio){
                    $er="Yes";
                }
                else{
                    $er="";
                }
            }
            elseif($exRatio=="Default"){
                if ($level>=1.5 or $level < -1.5){
                    $er="Yes";
                }
                else{
                    $er="";
                }
            }
            $EEArray=array();
            $UUArray=array();
            while($row = $EntrezSql->fetchArray()){
              $EE=$row['EntrezID'];
              array_push($EEArray,$EE);
            }
            $EEE=implode(",",array_unique($EEArray));
            // echo $EEE;
            $UniprotSql="select UniProtKB_AC from idmapping where GeneID in ($EEE);";
            $Uniprot=$db->query($UniprotSql);
            if ($Uniprot){
                while($row=$Uniprot->fetchArray()){
                  $UU=$row['UniProtKB_AC'];
                  array_push($UUArray,$UU);
                }
            }
            $UUU='"'.implode('","',array_unique($UUArray)).'"'; ///  "," joined Uniprot IDs for SQL query
            // print_r($EEArray);
            // print_r($UUArray);
            // echo $UUU."<br>";
            $shortNameSql ="select ShortName from UDGenes u join GeneIDs g on u.UDID=g.UDID join UniProtKBIDs uni where g.EntrezID=$EntrezID limit 1";      
               $shortName = $db->query($shortNameSql);
            if ($shortName){
                  if($row = $shortName->fetchArray()){
                      $ss=strtoupper($row[0]);
                      // echo "$ss";
                  }
            }
            // echo "UUU is $UUU <br>";

            $kinaseSQL ='select * from sk_new where substrate_AC in ('.$UUU.') or kinase_AC in ('.$UUU.');';
            $kinase_e = $db->query($kinaseSQL);
            if ($kinase_e){
                $kkAray=array();
                $ssAray=array();
                $k_pmidArray=array();
                $s_pmidArray=array();
                $k2pmid=array();
                $s2pmid=array();
                $r_pmidArray=array();

                while ($row=$kinase_e->fetchArray()){

                    $kk=strtoupper($row['kinase_genename']);
                    $pmid=$row['pmid'];
                    $substrate=strtoupper($row['substrate_genename']);
                    $source=$row['source'];
                    $kk_AC=$row['kinase_AC'];
                    $substrate_AC=$row['substrate_AC'];
                    // echo "kk is $kk, ss is $ss, substrate is $substrate<br>";


                    // if ($substrate==$ss&&$source!='psp'){
                    if (in_array($substrate_AC, $UUArray)&&$source!='psp'){

                        // if (in_array($kk, $Enrich_array)){
                        if (in_array($kk_AC, $Enrich_UU_array)){
                            $ppp=explode(",",$pmid);
                  // for ($i=0; $i<sizeof($ppp); $i++){  
                      // $pmidArray=$pmidArray+$ppp;

                      // $k2pmid[$kk]=array_merge($ppp,$k2pmid[$kk]);

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
                    }

                    if (in_array($kk_AC, $UUArray)&&$source!='psp'){


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

                        array_push($subAray,$substrate);
                    }               
                
                    foreach ($s2pmid as $key=>$value){
                       $s2pmid[$key]=array_unique($s2pmid[$key]);
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
                  
                    print_r($k2pmid);
                    print_r($s2pmid);

                    if (!empty($k2pmid)||!empty($s2pmid)){

                    echo "<td >$EntrezID</td>";
                    echo "<td >$ss</td>";
                    echo "<td >$er</td>";
                    echo "<td >$level</td>";
                      echo "<td colspan=\"2\">";
                      echo "<table class=\"inside\">";
                    foreach ($k2pmid as $key=>$value){
                      echo"<tr>";
                      echo "<td>$key</td>";
                      echo "<td>";
                      foreach($value as $v){
                          echo "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                          if (in_array($v, $r_pmidArray)){ 
                              echo "<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">[Rlims]</a><br>";
                          }
                          else{
                            echo "<br>";
                          }
                      }
                      echo "</td>";
                      

                      }
                      echo "</tr>";
                      echo "</table>";
                       echo "</td>";
                       echo "<td colspan=\"2\">";
                      echo "<table class=\"inside\">";
                      foreach ($s2pmid as $key=>$value){
                      echo"<tr>";
                      echo "<td>$key</td>";
                      echo "<td>";
                      foreach($value as $v){
                        echo "<a class='pmid' href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\" target=\"_blank\">$v</a>";
                        if (in_array($v, $r_pmidArray)){ 
                              echo "<a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?s=1225&abs=0#EvidenceView?pmid=$v\" target=\"_blank\">[Rlims]</a>"." ";
                        }
                        else{
                          echo "<br>";
                        }
                      }
                      echo "</td>";
                      echo "</tr>";

                      }
                      echo "</table>";

                      echo "</td>";
                      // echo "<td><a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?pmids=$r_pmidArray_unique\">$ss in Rlimsp</a></td>";
                      echo "<td><a class='rlims' href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?gid=$ss\" target=\"_blank\">$ss in Rlimsp</a></td>";

                    }



              }
}
              
echo "<tr>";
            
}
$db->close();

// print_r($Enrich_array);

?>






</table>
</div>

</body></html>






        