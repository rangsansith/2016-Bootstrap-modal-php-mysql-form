<?php
$msg = "";
if(isset($_GET["msgtype"])){
	$msgtype = $_GET["msgtype"];
	if($msgtype == 1){
		$msg = 'Thank you for submitting<br />your information.<div class="red">Good Luck!</div>';
	}else if($msgtype == 2){
		$msg = 'You have been opted out<br />of the Send &amp; Score<br />Sweepstakes.';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NBA Sweepstakes Registration Form</title>

    <!-- Bootstrap -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/nba-thankyou.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>

<div class="container">
  <div class="fill">
    <div class="msg-container">
      <div class="message"><?=$msg?></div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
  
$(document).ready(function(){

  $('.modal-body', window.parent.document).css('height', '300px');


});

</script>

</body>
</html>

