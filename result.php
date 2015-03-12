
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<body>
<table class="bordered">

<tr> 
               <th>Entrez</th>
               <th>Symbol</th>
               <th>Enriched</th>
               <th>Ratio</th>
               <th>Kinase</th>
               <th>K_PMID</th>
               <th>Substrate</th>
               <th>S_PMID</th>
               <th>Rlimsp_Evidence</th>

<?PHP

$Enrich_array=array();
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
   // } else {
   //    echo "Opened database successfully<br>";
   // }
   // $db->query("pragma synchronous = off;");

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
    }
// print_r($Enrich_array);


for ($i=0; $i<sizeof($enriched_lines); $i++){

        echo "<tr>";
        $data=explode("\t",$enriched_lines[$i]);

    // foreach ($data[$i] as $element){
    //     $EntrezID=$element;
      

      ////Entrez////

        $EntrezID=strtoupper($data[0]);
        $level=$data[1];

        echo "<td>$EntrezID</td>";
      ////Symbol (ShortName)/////
        // $shortNameSql ="select ShortName from UDGenes u join GeneIDs g on u.UDID=g.UDID join UniProtKBIDs uni where g.EntrezID=$EntrezID limit 1";      
        // $ret = $db->query($shortNameSql);
        // while($row = $ret->fetchArray()){
        //     $ShortName=$row[0];
        //     echo "<td>$ShortName</td>";
        // }

        $shortNameSql ="select ShortName from UDGenes u join GeneIDs g on u.UDID=g.UDID join UniProtKBIDs uni where g.EntrezID=$EntrezID limit 1";      
        $shortName = $db->query($shortNameSql);
        if (!$shortName){
          echo "<td>&#9747;</td>";
        }
        else{

           if($row = $shortName->fetchArray()){
              $ss=strtoupper($row[0]);
              echo "<td>$ss</td>";
              // $Enrich_array[$EntrezID]=$ss;
           }
           else{
            echo "<td>&#9747;</td>";
           }

        }

      /////Enriched+ ExpressionRatio/////

        if ($exRatio == "other"){
          if ($level > $upRatio or $level < $downRatio){
            echo "<td>Yes</td><td>$level</td>";
          }
          else{
            echo "<td></td><td>$level</td>";
          }
        }
        elseif($exRatio=="Default"){
          if ($level>=1.5 or $level < -1.5){
            echo "<td>Yes</td><td>$level</td>";
          }
          else{
            echo "<td></td><td>$level</td>";
          }
        }


      ////Kinase/////  $kk here is the kinase name which printed

        $kinaseSQL ='select * from sk_new where substrate_genename='.'"'.$ss.'"'.'or kinase_genename='.'"'.$ss.'";';
        $kinase_e = $db->query($kinaseSQL);
        if (!$kinase_e||!$shortName) {

          echo "<td></td><td></td><td></td><td></td><td></td>";
        }
        if ($kinase_e&&$shortName){
          $kkAray=array();
          $ssAray=array();
          $k_pmidArray=array();
          $s_pmidArray=array();
          $r_pmidArray=array();
            // while($row = $kinase_e->fetchArray(SQLITE3_ASSOC)){
            //   $kinase=$row['kinase_genename'];
            //   $pmid=$row['pmid'];


/////////////////////////////////////////Kinase////////////////////////////////////////////////////////
          echo "<td>";
            while ($row=$kinase_e->fetchArray()){

              $kk=strtoupper($row['kinase_genename']);
              $pmid=$row['pmid'];
              $substrate=strtoupper($row['substrate_genename']);
              if ($substrate==$ss){
              // $substrate=strtoupper($row['substrate_genename']);
                  if ((in_array($kk, $Enrich_array))&&(!in_array($kk, $kkAray))){
              // if (in_array($kk, $Enrich_array)){
                      echo $kk." ";
                  }
                  if (in_array($kk, $Enrich_array)){
                      $ppp=explode(",",$pmid);
                // for ($i=0; $i<sizeof($ppp); $i++){  
                      // $pmidArray=$pmidArray+$ppp;
                      $k_pmidArray=array_merge($ppp,$k_pmidArray);
                // }
                  }

                  array_push($kkAray,$kk);
              }
            }  
          echo "</td>";


          
          echo "<td>";
              $k_pmidArray_unique=array_unique($k_pmidArray);
              foreach ($k_pmidArray_unique as $k){
                  echo "<a href=\"http://www.ncbi.nlm.nih.gov/pubmed/$k\">$k</a>"." ";
              }
          echo "</td>";
/////////////////////////////////////////Kinase////////////////////////////////////////////////////////





          

/////////////////////////////////////////Substrate////////////////////////////////////////////////////////         
          echo "<td>";
                while ($row=$kinase_e->fetchArray()){
                    $kk=strtoupper($row['kinase_genename']);
                    $substrate=strtoupper($row['substrate_genename']);
                    $pmid=$row['pmid'];
                    if ($kk==$ss){
              // $substrate=strtoupper($row['substrate_genename']);
                        if ((in_array($substrate, $Enrich_array))&&(!in_array($substrate, $ssAray))){
              // if (in_array($kk, $Enrich_array)){
                            echo $substrate." ";
                        }
                        if (in_array($substrate, $Enrich_array)){
                            $pppp=explode(",",$pmid);
                // for ($i=0; $i<sizeof($ppp); $i++){  
                            $s_pmidArray=array_merge($pppp,$s_pmidArray);
                // }
                         }

                         array_push($ssAray,$substrate);
                    }
                } 

          echo "</td>";

          $s_pmidArray_unique=array_unique($s_pmidArray);

          echo "<td>";
              foreach ($s_pmidArray_unique as $s){
                  echo "<a href=\"http://www.ncbi.nlm.nih.gov/pubmed/$s\">$s</a>"." ";
              }
          echo "</td>";

/////////////////////////////////////////Substrate////////////////////////////////////////////////////////
          echo "<td>";
              while ($row=$kinase_e->fetchArray()){
                    $kk=strtoupper($row['kinase_genename']);
                    $substrate=strtoupper($row['substrate_genename']);
                    $pmid=$row['pmid'];
                    $source=$row['source'];
                    if ($source=="rlim"){
                      // if (($kk==$ss)||($substrate==$ss)){
                        if (($kk==$ss&&in_array($substrate, $Enrich_array))||($substrate==$ss)&&in_array($kk, $Enrich_array)){
                          $ppppp=explode(",",$pmid);
                          $r_pmidArray=array_merge($ppppp,$r_pmidArray);

                        }  
                      // }

                    }
              
              }
              $r_pmidArray_unique=implode(",",array_unique($r_pmidArray));

              echo "<a href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?pmids=$r_pmidArray_unique\">View in Rlimsp</a></td>";
/////////////////////////////////////////Rlims////////////////////////////////////////////////////////







        }

    echo "</tr>";
  
}


$db->close();

// print_r($Enrich_array);

?>






</table>

</body></html>



