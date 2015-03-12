
<?PHP


function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w'); 
    // loop over the input array
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // rewrind the "file" with the csv lines
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachement; filename="'.$filename.'";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
}
array_to_csv_download(array(
  array(1,2,3,4), // this array is going to be the first row
  array(1,2,3,4)), // this array is going to be the second row
  "numbers.csv"
);
?>
