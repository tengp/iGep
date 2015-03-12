
<?PHP
session_start();
$session_download= $_SESSION['session_download'];
$lines=explode("~@@~", $session_download);
$lines=array_filter($lines);
// print_r($lines);

function array_to_csv_download($array, $filename, $delimiter=",") {
    header('Content-Type: application/csv');
    // // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachement; filename="'.$filename.'";');
    // open raw memory as file so no temp files needed, you might run out of memory though

    $f = fopen('php://output', 'w'); 
    // loop over the input array
    $header_string="Kinase Entrez ID, Kinase Name, Kinase Up/Down Regulated, Substrate Entrez ID, Substrate Name, Substrate Up/Down Regulated, PMID";
    $header_array=explode(",", $header_string);
    fputcsv($f, $header_array, $delimiter); 
    foreach ($array as $line) { 
        if (!empty($line)){
        $line_array=explode("~#~", $line);
        // generate csv lines from the inner arrays
        fputcsv($f, $line_array, $delimiter); 
        }

    }
    // rewrind the "file" with the csv lines
    // fseek($f, 0);
    // // tell the browser it's going to be a csv file

    // // make php send the generated csv lines to the browser
    // fpassthru($f);
}
array_to_csv_download($lines, // this array is going to be the second row
  "iGep_result.csv"
);
// array_to_csv_download(array(
//   array(1,2,3,4), // this array is going to be the first row
//   array(1,2,3,4)), // this array is going to be the second row
//   "numbers.csv"
// );


?>
