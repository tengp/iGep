
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
               <th colspan="2">Kinase</th>
               <th colspan="2">Substrate</th>
               <th>Rlimsp_Evidence</th>
</tr>

<?PHP

$Enrich_array=array();
$enriched = $_POST['enriched'];
$exRatio=$_POST["expression_ratio"];
$upRatio=$_POST["upRatio"];
$downRatio=$_POST["downRatio"];

$enriched_lines = explode("\n", $enriched);
function   min_multiple($a, $b)
{    if($b==0){    //一定要考虑除数不能为零     
        return $a;
     }
     if($a==0){
        return $b;
     }
     else{
        $m = max($a, $b);
        $n = min($a, $b);
        for($i=2; ; $i++){
             if (is_int($m*$i/$n)){
                return $i*$m;
             }
        }

     }
}
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
   // else {
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

        // echo "<tr>";
        $data=explode("\t",$enriched_lines[$i]);

    // foreach ($data[$i] as $element){
    //     $EntrezID=$element;
      

      ////Entrez////

        $EntrezID=strtoupper($data[0]);
        $level=$data[1];

      ////Symbol (ShortName)/////


        $shortNameSql ="select ShortName from UDGenes u join GeneIDs g on u.UDID=g.UDID join UniProtKBIDs uni where g.EntrezID=$EntrezID limit 1";      
        $shortName = $db->query($shortNameSql);
        if ($shortName){


            if($row = $shortName->fetchArray()){
              $ss=strtoupper($row[0]);
              // echo "<td>$ss</td>";
              // $Enrich_array[$EntrezID]=$ss;
            }
           // else{
           //  echo "<td>&#9747;</td>";
           // }

        

      /////Enriched+ ExpressionRatio/////

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


      ////Kinase/////  $kk here is the kinase name which printed

            $kinaseSQL ='select * from sk_new where substrate_genename='.'"'.$ss.'"'.'or kinase_genename='.'"'.$ss.'";';
            $kinase_e = $db->query($kinaseSQL);

            if ($kinase_e&&$shortName){
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

                    if ($substrate==$ss&&$source!='psp'){

                        if ((in_array($kk, $Enrich_array))&&(!in_array($kk, $kkAray))){
                            // echo $kk." ";
                        }
                        if (in_array($kk, $Enrich_array)){
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

                    if ($kk==$ss&&$source!='psp'){

                        if ((in_array($substrate, $Enrich_array))&&(!in_array($substrate, $subAray))){
                            // echo $kk." ";
                        }
                        if (in_array($substrate, $Enrich_array)){
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
                    // print_r($k2pmid);
                    // print_r($s2pmid); 
                  if (!empty($k2pmid)||!empty($s2pmid)){

                    $rowNumber=min_multiple(sizeof($s2pmid),sizeof($k2pmid));
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
                        echo "<a href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\">$v</a>"." ";
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
                        echo "<a href=\"http://www.ncbi.nlm.nih.gov/pubmed/$v\">$v</a>"." ";
                      }
                      echo "</td>";
                      echo "</tr>";

                      }
                      echo "</table>";

                      echo "</td>";
                              
              
                    
              
          
                      echo "<td><a href=\"http://research.bioinformatics.udel.edu/rlimsp/view.php?pmids=$r_pmidArray_unique\">View in Rlimsp</a></td>";
/////////////////////////////////////////Rlims////////////////////////////////////////////////////////


                    }
                  }
                  


            


        }

        


    echo "</tr>";
  
}


$db->close();

// print_r($Enrich_array);

?>






</table>

</body></html>



