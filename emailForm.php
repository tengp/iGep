<?php 

    $to = "tengpan@udel.edu"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['Name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $name . " " . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    // mail($to,$subject,$message,$headers);
    // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    $pop= "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
    // echo "$pop";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    
?>

<!DOCTYPE HTML>
<html>
<head>
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
                <!-- <div class="menu">
                        <ul class="nav" id="nav">
                          <li class="current"><a href="index.html" class="scroll">Home</a></li>
                          <li><a href="#about" class="scroll">Resources</a></li>
                          <li><a href="#services" class="scroll">Analyze</a></li>
                          <li><a href="#contact" class="scroll">Contact</a></li>                                
                         </ul>
                        <script type="text/javascript" src="./js/responsive-nav.js"></script>
                        <script type="text/javascript" src="./js/move-top.js"></script>
                        <script type="text/javascript" src="./js/easing.js"></script>
                        <script type="text/javascript">
                        jQuery(document).ready(function($) {
                        $(".scroll").click(function(event){     
                        event.preventDefault();
                        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                            });
                        });
                        </script>
                </div> -->
                <div class="clearfix"> </div>
                </div>
                <div class="banner-head"> 
                    <p>
                        <?php 

                            $to = "tengpan@udel.edu"; // this is your Email address
                            $from = $_POST['email']; // this is the sender's Email address
                            $name = $_POST['Name'];
                            $subject = "Form submission";
                            $subject2 = "Copy of your form submission";
                            $message = $name . " " . " wrote the following:" . "\n\n" . $_POST['message'];
                            $message2 = "Here is a copy of your message " . $name . "\n\n" . $_POST['message'];

                            $headers = "From:" . $from;
                            $headers2 = "From:" . $to;
                  // mail($to,$subject,$message,$headers);
                  // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
                            $pop= "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
                            echo "$pop";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<!-- <div class="footer" style="position:absolute bottom:0">

            <div class="container" >
                <div class="footer-top">
                <p> Schmidt's Lab</p>
                <p> Department Animal and Food Sciences & Center for Bioinformatics and Computational Biology</p>

                <p> University of Delaware</p>
                </div>
            </div>
            <script type="text/javascript">
                        $(document).ready(function() {
                            /*
                            var defaults = {
                                containerID: 'toTop', // fading element id
                                containerHoverID: 'toTopHover', // fading element hover id
                                scrollSpeed: 1200,
                                easingType: 'linear' 
                            };
                            */
                            
                            $().UItoTop({ easingType: 'easeOutQuart' });
                            
                        });
                    </script>
                <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</div> -->
</body>
</html>


