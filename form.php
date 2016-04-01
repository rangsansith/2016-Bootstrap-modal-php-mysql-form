<?php
include_once('inc/FormManager.php');
/********** Page Logic *************/
$formManger = new FormManager();
$insert_array = array();
//valuses from confirmation page
$billname = "";
$billadd1 = "";
$city = "";
$state="";
$zip="";
$orderID = "";
$telefloraID = "";

if($_POST['go'] == 1){
		$billname = $_POST['billname'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		$phone = $_POST['phone'];
		$bday_month = $_POST['bday_month'];
		$bday_day = $_POST['bday_day'];
		$bday_year = $_POST['bday_year'];
		$team_preference = $_POST['team_preference'];

		/* signup_options */
		$signup_weekly = "no";
		$signup_offer = "no";
		$signup_optout = "no";
		if(isset($_POST['signup_weekly'])){
			$signup_weekly = $_POST['signup_weekly'];
		}
		if( isset($_POST['signup_offer'])){
			$signup_offer = $_POST['signup_offer'];
		}
		if( isset($_POST['signup_optout'])){
			$signup_optout = $_POST['signup_optout'];
		}

		/* IDs */
		$orderID = $_POST['orderID'];
		$telefloraID = $_POST['telefloraID'];

		if($signup_optout == 'yes'){
			$insert_array = array(
				'billname' => '', 
				'address' => '', 
				'city' => '', 
				'state' => '', 
				'country' => '', 
				'zip' => '', 
				'phone' => '', 
				'bday_month' => '', 
				'bday_day' => '', 
				'bday_year' => '', 
				'team_preference' => '',
				'signup_weekly' => '',
				'signup_offer' => '',
				'signup_optout' => $signup_optout,
				'orderID' => $orderID,
				'telefloraID' => $telefloraID
			);
			//insert data in contact_info table
			$formManger -> insertContactInfo($insert_array);
			$formManger -> goResultPage(2); 
		}else{
			//Preparing insert data
			$insert_array = array(
				'billname' => $billname, 
				'address' => $address, 
				'city' => $city, 
				'state' => $state, 
				'country' => $country, 
				'zip' => $zip, 
				'phone' => $phone, 
				'bday_month' => $bday_month, 
				'bday_day' => $bday_day, 
				'bday_year' => $bday_year, 
				'team_preference' => $team_preference,
				'signup_weekly' => $signup_weekly,
				'signup_offer' => $signup_offer,
				'signup_optout' => $signup_optout,
				'orderID' => $orderID,
				'telefloraID' => $telefloraID
			);
			//insert data in contact_info table
			$formManger -> insertContactInfo($insert_array);
			$formManger -> goResultPage(1);
		}
}else{
	$array_team = $formManger -> getTeamList();
	$array_state = $formManger -> getStateList();
	$array_month = $formManger -> getMonthList();
	$array_day = $formManger -> getDayList();
	$array_year = $formManger -> getYearList();

	$billname = $_GET['billname'];
	$billadd1 = $_GET['billadd1'];
	$billadd2 = $_GET['billadd2'];
	$orderID = $_GET['t_orderid'];
	$telefloraID = $_GET['tfid'];
	
	$city = $_GET['city'];
	$state = $_GET['state'];
	$zip = $_GET['zip'];
	$country = $_GET['country'];

}
/***********************************/
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
    <link href="css/nba-modal.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>

<form class="form-horizontal" name="NBASurveyForm" id="NBASurveyForm" action="form.php" method="post">
<div class="container" id='NBAForm-container'>

<div class="row">
  <div class="col-xs-12" style="padding-left:0px !important">
    <img src="images/form_headline.gif" border="0" alt="You're almost there!" class="img-responsive" />
  </div>
</div> 


<!-- 1 -->
<div class="row">
  <div class="col-xs-12 col-sm-12">
	<!-- Error message -->
    <div id="messageBox"></div>
    <!-- name-->
    <div class="form-group">
      <label class="col-xs-3 control-label">Name</label>
      <div class="col-xs-9" style="color:#fff">
      <?=$billname?>
      </div>
    </div>
  </div>
</div>

<!-- 2 -->
<div class="row">
  <div class="col-xs-12 col-sm-8">
    <!-- address-->
    <div class="form-group">
      <label class="col-xs-12 control-label" id="address-label">Address</label>
      <div class="col-xs-12">
        <input type="text" class="form-control" name="address" id="address" value="<?=$billadd1?>" />
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4">
    <!-- city -->
    <div class="form-group">
      <label class="col-xs-12 control-label" id="city-label">city</label>
      <div class="col-xs-12">
        <input type="text" class="form-control" name="city" id="city" value="<?=$city?>" />
      </div>
    </div>    
  </div>
</div>


<!-- 3 -->
<div class="row">
  <div class="col-xs-12 col-sm-5">
    <!-- state -->
    <div class="form-group">
      <label class="col-xs-12 control-label" id="state-label">State/Province</label>
      <div class="col-xs-12">
        <select name="state" id="state" class="form-control">
<?php 
	for($i=0; $i < count($array_state); $i++){
		$flag = 0;
		if($array_state[$i]['state'] == $state){
			$flag = 1;
		}
?>
        <option value="<?=$array_state[$i]['state'] ?>" <?=($flag)? "selected" : "" ?>><?=$array_state[$i]['state_name']?></option>
<?php
	}
?>	
        </select>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-3">
    <!-- country -->
    <div class="form-group">
      <label class="col-xs-12 control-label">Country</label>
      <div class="col-xs-12">
        <select name="country" id="country" class="form-control">
            <option value="United States" <?=($country=='United States')? 'selected' : '' ?>>United States</option>
            <option value="Canada" <?=($country=='Canada')? 'selected' : '' ?>>Canada</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4">
    <!-- zip -->
    <div class="form-group">
      <label class="col-xs-12 control-label" id="zip-label" >Zip/Postal Code</label>
      <div class="col-xs-12">
        <input type="text" class="form-control" name="zip" id="zip" value="<?=$zip?>" maxlength="6">
      </div>
    </div>
  </div>
</div>


<!-- 4 -->
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <!-- phone -->
    <div class="form-group">
      <label class="col-xs-12 control-label">Phone Number</label>
      <div class="col-xs-12">
        <input type="text" class="form-control" name="phone" id="phone" value="" />
      </div>
    </div>    
  </div>
  <div class="col-xs-12 col-sm-6">
     <!-- Birtyday-->
    <div class="form-group">
      <label class="col-xs-12 control-label">Birthday</label>
      <div class="col-xs-4" style="padding-right:0 !important">
        <select name="bday_month" id="bday_month" class="form-control">
<?php 
	for($i=0; $i < count($array_month); $i++){
?>
        <option value="<?=$array_month[$i]['id'] ?>" ><?=$array_month[$i]['month']?></option>
<?php
	}
?>
      </select>
      </div>

      <div class="col-xs-4" style="padding:0 2px !important">
        <select name="bday_day" id="bday_day" class="form-control">
<?php 
	for($i=0; $i < count($array_day); $i++){
?>
        <option value="<?=$array_day[$i]['id'] ?>"><?=$array_day[$i]['day']?></option>
<?php
	}
?>
      </select>
      </div>

      <div class="col-xs-4" style="padding-left:0 !important">
        <select name="bday_year" id="bday_year" class="form-control" >
<?php 
	for($i=0; $i < count($array_year); $i++){
?>
        <option value="<?=$array_year[$i]['year'] ?>"><?=$array_year[$i]['year']?></option>
<?php
	}
?>
        </select>
      </div>
    </div>   
  </div>
</div>

<!-- 5 -->
<div class="row">
  <div class="col-xs-12">
    <!-- Team -->
    <div class="form-group">
      <label class="col-xs-12 control-label">NBA team preference</label>
      <div class="col-xs-12">
        <select name="team_preference" id="team_preference" class="form-control">
        <option value="">Please Select...</option>
<?php 
	for($i=0; $i < count($array_team); $i++){
?>
        <option value="<?=$array_team[$i]['id'] ?>"><?=$array_team[$i]['team_name']?></option>
<?php
	}
?>
        </select>

      </div>
    </div>
  </div>
</div>

<!-- 6 -->
<div class="row">
  <div class="col-xs-12">
    <!-- sing in checkbox -->
    <div class="form-group">
          <label class="col-xs-12 control-label">
            <input type="checkbox" name="signup_weekly" id="signup_weekly" value="yes" /> Sign me up for weekly headlines and highlights, exclusive offers, and special promotions from the NBA<br />
            <input type="checkbox" name="signup_offer" id="signup_offer" value="yes" checked /> Sign me up for exclusive offers and discounts from Teleflora<br />
            <input type="checkbox" name="signup_optout" id="signup_optout" value="yes" /> I'd like to opt out of the Send &amp; Score Sweepstakes
          </label>
    </div>
  </div>
</div>

<!-- 7 -->
<div class="row">
  <div class="col-xs-12">
  <!-- Submit btn -->
  <div class="form-group">
    <div class="col-sm-12 control-label centered-text">
    <input type="hidden" name="go" id="go" value="1" />
    <input type="hidden" name="orderID" id="orderID" value="<?=$orderID?>" />
    <input type="hidden" name="billname" id="billname" value="<?=$billname?>" />
    <input type="hidden" name="telefloraID" id="telefloraID" value="<?=$telefloraID?>" />
    <input type="image" src="images/submit-btn.gif" width="165" height="46" border="0" class="submit-btn" />
    </div>
  </div>

  </div>
</div> 

</div><!-- END: container -->
</form><!-- END: form -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
<script>
jQuery(function($) {
      $('#phone').mask('(999) 999-9999');
});

$("#NBASurveyForm").submit(function( event ) {
	var errorArray=new Array(); 
	var optout_flag = 0;
	var errorString = "";
	var msg = "";
	
	if ($('#signup_optout').is(':checked')) {
		optout_flag = 1;
	}
	if(optout_flag){
		return true; //Submit Form WITHOUT CHECKING REQUIRED FIELDS.
	}else{
		/* CHECKING REQUIRED FIELDS */
		if($('#address').val()==""){
			errorArray.push("address");
		}
		if($('#city').val()==""){
			errorArray.push("city");
		}
		if($('#state').val()==""){
			errorArray.push("state");
		}
		if($('#zip').val()==""){
			errorArray.push("zip");
		}
		if( $('#phone').val() ==""){
			errorArray.push("phone");
		}		

		if( $('#bday_month').val() ==""){
			errorArray.push("bday_month");
		}
		if( $('#bday_day').val() ==""){
			errorArray.push("bday_day");
		}
		if( $('#bday_year').val() ==""){
			errorArray.push("bday_year");
		}
		if($('#team_preference').val()==""){
			errorArray.push("team_preference");
		}
//		errorString = errorArray.toString();
//		alert(errorString);

		/* reset */
		$( ":input" ).removeClass('error_fields');

		if(errorArray.length != 0 ){
			for(i=0; i<errorArray.length; i++){
				field_name = errorArray[i];
				$('#' + field_name).addClass('error_fields');
			}
		//	alert(errorString); 

			$('#messageBox').text('Please enter required fields.');
			event.preventDefault();
		}else{
			return true; //Submit Form!
		}
	}
});
</script>


</body>
</html>
