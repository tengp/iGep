<html>
<body>


<?php
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
   } else {
      echo "Opened database successfully<br>";
   }

   $sql = 'SELECT * from sk_new where substrate_genename="VRK1"';
   $ret = $db->query($sql);

   ////////while//////////////////
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      // echo $row['source']."<br>";
      // echo $row['substrate_AC'] ."<br>";
      // echo $row['substrate_genename'] ."<br>";
      // echo $row['kinase_AC'] ."<br>";
      // echo $row['kinase_genename'] ."<br>";
      $kinase=$row['kinase_genename'];
      $pmid=explode(",",$row['pmid']);
      if(array_key_exists($kinase, $Array)){
         $Array[$kinase]=array_merge($Array[$kinase],$pmid);
      }
      else{
         // array_merge($pmid,$Array[$kinase]);
         
         $Array[$kinase]=$pmid;
      }

      if (!empty($kinase)){
         echo strtoupper($kinase)."<br>";


      }
   }
   /////////while////////////////

   echo '<!DOCTYPE html>
<html><link rel="stylesheet" type="text/css" href="css/mystyle.css">
<body>
<table class="bordered">
<tr><th colspan="2">aaa</th></tr>
<tr><td>a</td><td>a2</td></tr>
<tr><td>b</td><td>b2</td></tr>
<tr><td>b</td><td>  <table class="inside"><tr><td>2</td></tr><tr><td>4</td></tr></table>                    </td></tr>

</table></body></html>';
   $db->close();
   print_r($Array);
   
?>
</body>
</html>


