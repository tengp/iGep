<?php

$pandiseasefolder = "/home/TextMining/Pan_Disease/source";
$resultsfolder = "/home/TextMining/Pan_Disease/results";
$thisapp = "/home/annotation/htdocs/text_mining/doc/pan/MMD";
$filename = "webtext.txt";
$outputfile = $thisapp . "/" . $filename;

$command = "touch $resultsfolder/$filename".".out; chmod 777 $resultsfolder/*";
exec($command);


$page = <<<EOD
<html>
<head><title>Phosphorylation information</title>
</head>

<body>
<h1>Phosphorylation information</h1>
EOD;


$page .= <<<EOD
<form method="post" ACTION="test.php">
Please input expression data:<br />
<a href="sampleInput.txt" target="_blank">(click here for sample input)</a><br/>
<textarea name="enriched" cols=40 rows=5></textarea><br />
Regulation of Expression setup<br/>
<input type="radio" name="expression_ratio" value="Default" CHECKED> 
Default: Expression ratio >=1.5 (log2 based) is upregulated, expression ratio <=-1.5 (log2 based) is downregulated<br/>
<input type="radio" name="expression_ratio" value="other">
Customized value: <br/>
Upregulated  Ratio>= <textarea name="upRatio" cols=5 rows=1>$upRatio</textarea><br/>
Downregulated  Ratio<<textarea name="downRatio" cols=5 rows=1>$downRatio</textarea><br/>


<input type="submit" value="Submit" />
</form>
EOD;
/////<?php if (isset($gender) && $gender=="male") echo "checked";
$page .= <<<EOD
</body>
</html>
EOD;

echo $page;

?>
