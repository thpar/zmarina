<?php
require_once("congeniecontactus/validation.php");
$redirectpath="";
if(isset($_GET['redirectpath'])){
	$redirectpath='PopGenIE generated the following error message: '.$_GET['redirectpath'];
	
}
?>
<script src="plugins/contact/fingerprint/jquery.cookie.js"></script>
<script src="plugins/contact/fingerprint/delete/alert/lib/sweet-alert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="plugins/contact/fingerprint/delete/alert/lib/sweet-alert.css">
<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">
function closeme_tip() {
  refID = document.getElementById('alert-error');
	refID.style.display = "none";
}

function removeCookies(){ 
$.removeCookie('atgenie_uuid');
$.removeCookie('popgenie_uuid');
$.removeCookie('congenie_uuid');
$.removeCookie('has_js');
$.removeCookie('__utmb');
$.removeCookie('__utmc');$.removeCookie('__utmt');$.removeCookie('__utmz');
swal("Success!","GeneList issue has been fixed successfully.")


}

</script>
<div id="alert-error" class="alert alert-error">
  <a onclick="closeme_tip()" class="close" data-dismiss="alert">×</a>
  <strong>Best tips to try before you contact us!</strong><br />We have found that many apparent problems with tools in Zostera marina Genome Integrative Explorer can result from previous results that have been cached. Before reporting a bug/problem we would request that you first clear your browser cache, quit the browser, again clear the cache when you re-open the browser and then finally check that the problems remains.
  </div>
    <button class="bx" onclick="removeCookies();">Fix GeneList problems</button>

   <br />     

    <style>
	
	 .bx {
background-color: #eed3d7;
color: #b94a48;;
border: none;
box-shadow: none;
font-size: 14px;
font-weight: 500;
font-weight: 600;
border-radius: 3px;
padding: 15px 15px;
margin-bottom:10px;
cursor: pointer;
}
		   .close {
  float: right;
  font-size: 20px;
  font-weight: bold;
  line-height: 18px;
  color: #000000;
  text-shadow: 0 1px 0 #ffffff;
  opacity: 0.2;
  filter: alpha(opacity=20);
}
.close:hover {
  color: #000000;
  text-decoration: none;
  opacity: 0.4;
  filter: alpha(opacity=40);
  cursor: pointer;
}
.alert {
	
  padding: 8px 35px 8px 14px;
margin-top:5px !important;
margin-bottom:10px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  color: #c09853;
}
.alert-heading {
  color: inherit;
}
.alert .close {
  position: relative;
  top: -2px;
  right: -21px;
  line-height: 18px;
}
.alert-success {
  background-color: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
 
}
.alert-danger,
.alert-error {
  background-color: #f2dede;
  border-color: #eed3d7;  
  color: #b94a48;
  
}



/******* /CONTAINER *******/
/******* FORM *******/
#customForm{
	padding: 0 10px 10px;
	background: #fff;
border: solid #666 1px;
padding: 10px;
padding-top: 0px;
-moz-border-radius: 0 4px 4px 4px;
-webkit-border-radius: 0 4px 4px 4px;
width: 1160px;
height:370px;
}
#customForm label{
	display: block;
	color: #797979;
	font-weight: 700;
	line-height: 1.4em;
}
#customForm input{
	width: 220px;
	padding: 6px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 11px;
	border: 1px solid #cecece;
}
#customForm input.error{
	background: #f8dbdb;
	border-color: #e77776;
}
#customForm textarea{
	width: 860px;
	height: 80px;
	padding: 6px;
	color: #000000;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-style: italic;
	font-size: 12px;
	border: 1px solid #cecece;
}
#customForm textarea.error{
	background: #f8dbdb;
	border-color: #e77776;
}
#customForm div{
	margin-bottom: 5px;
}
#customForm div span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}
#customForm div span.error{
	color: #e46c6e;
}
/*#customForm #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}
#customForm #send:hover{
	background: #79a7f1;
}*/
#error{
	margin-bottom: 20px;
	border: 1px solid #efefef;
}
#error ul{
	list-style: square;
	padding: 5px;
	font-size: 11px;
}
#error ul li{
	list-style-position: inside;
	line-height: 1.6em;
}
#error ul li strong{
	color: #e46c6d;
}
#error.valid ul li strong{
	color: #93d72e;
}
/******* /FORM *******/




		   </style> 
               	

<div  id="form">
	<?if( isset($_POST['send']) && (!validateName($_POST['email']) || !validateMessage($_POST['message']) ) ):?>
				<div id="error">
					<ul>
				
						<?if(!validateName($_POST['email'])):?>
							<li><strong>Invalid E-mail:</strong> Please type a valid e-mail!</li>
						<?endif?>
						
					<?if(!validateMessage($_POST['message'])):?>
							<li><strong>Ivalid message:</strong> Type a message with at least with 10 letters</li>
						<?endif?>
					</ul>
				</div>
			<?elseif(isset($_POST['send'])):?>
				<div id="error" class="valid">
    <?php 
	$captcha;
$to = "Zander.Myburg@up.ac.za,nanette.christie@gmail.com,vdmerwe.karen@gmail.com,nathaniel.street@umu.se,chanaka.mannapperuma@umu.se"; 
 $subject = "Zostera marina Genome Integrative Explorer Contact Us";  
 $email = $_REQUEST['email'] ; 
 $message ='Name: '.$_REQUEST['name'].'
E-mail: '.$_REQUEST['email'] .'
Message: '.$_REQUEST['message']; 

  $headers .= "Organization: Zostera marina Genome Integrative Explorer contact page\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
 $headers = "From: ".$email;  
  
  
   if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
  if(!$captcha){
          print "<pre><strong>Error! Please check the the captcha form.</strong></pre>";
       
        }
          $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lc1P0MUAAAAAEC7kvvkAYkUHZDde9tKLJisch0N&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		 $response = json_decode($response, true);
  if($response["success"]==false)
        {
         // print "<ul><strong>Error!</strong> We encountered an error sending your mail! :(</ul>";
        }else{
		 $sent = mail($to, $subject, $message, $headers) ; 
	 print " <pre><strong>Thank you | We will Contact You Shortly</strong></pre>" ;  
	 
require_once('/mnt/spruce/www/slack/lib/Loader.php');
$client = new SlackClient('https://hooks.slack.com/services/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');
$client->to('#plantgenie')->message(['username' =>'Zostera marina Genome Integrative Explorer','icon_emoji' => ':eucgenie:'])->attach(['pretext' => $subject,'text' => $message,'color' => '#7ab6ab'])->send();
 
		}
  ?> 
				</div>
		<?endif?>

		<form method="post" id="customForm" action="">
			<div>
				<label for="name">Name</label>
				<input id="name" name="name" style="font-size:14px;width:400px;" type="text" placeholder="Anonymous"  />
				<span id="nameInfo"></span>
			</div>
			<div>
				<label for="email">E-mail</label>
				<input id="email" style="font-size:14px;width:400px;"  name="email" type="text" />
				<span id="emailInfo"></span>
			</div>
			<div>
				<label for="message">Message</label>
				<textarea style="width:1014px;" id="message" name="message" cols="0" rows="0"><?php echo $redirectpath;?></textarea>
         </div> <!--<div>      
                <?php
$randomn=rand(0,3);
$questions=array("What color is a poplar leaf?","Write h3ll0 with letters instead of numbers?","Write a name of a Scandinavian country?","What day comes after the weekend?");
$answers=array("(green)|(Green)","(hello)|(Hello)","(Finland)|(Sweden)|(Norway)|(Denmark)|(Iceland)|(Greenland)|(finland)|(sweden)|(norway)|(denmark)|(iceland)|(greenland)","(Monday)|(monday)");
echo '<div class="item" ><label >'.$questions[$randomn].'&nbsp;&nbsp;<input autocomplete="off" id="leaf_color" name="leaf_color" pattern="'.$answers[$randomn].'" maxlength="120" type="text"  required/>&nbsp;&nbsp;(Human verification question)</label></div> ';
?>
               
               
			</div>-->
            
            
            <div class="g-recaptcha" data-sitekey="6Lc1P0MUAAAAAFQhljUXgujlaoJKKpEXllwpLw_3"></div>

             <input class="form-submit" style="font-size:16px;float: right;cursor:pointer;width:100px" id="send" name="send" type="submit" value="Send" /><br /><br /><br /><br /><br />
			
		</form>
	</div>

	<script type="text/javascript" src="plugins/contact/congeniecontactus/validation.js"></script>
