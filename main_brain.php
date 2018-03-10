<html>
<head>
<link rel="stylesheet" href="main_brain.css">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAL2g7c4rz1EaTnogSGX5-UaCGBSNFE42I"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="Emergency_border">
<div class="emergency_title">Emergency</div>
<form method="post" action="main_brain.php">
<div class="emergency_title1">TYPE OF EMERGENCY</div>
<input type="text" name="Emergency" class="emergency_textbox" required>
<div class="emergency_title1">NAME</div>
<input type="text" name="name" class="emergency_textbox" required>
<div class="emergency_title1">PHONE NUMMBER</div>
<input type="number"  name="mobile"   id="mobile" class="emergency_textbox" required />
<div class="emergency_title1">ADDRESS</div>
<input type="text" name="Address" id="Address" class="emergency_textbox" required>
<div class="emergency_title1">LANDMARK</div>
<input type="text" name="landmark" class="emergency_textbox" placeholder="Ex.LANDMARK" required>
<div class="emergency_title1"> PINCODE</div>
<input type="number" pattern=".{06}" name="pincode" class="emergency_textbox" placeholder="Ex.641015" required>
<div class="emergency_title1"> SEND ALERT TO</div>
<input type="radio" name="choice" value="Ambulance" class="radio_choice" required>Ambulance
<input type="radio" name="choice" value="Police" class="radio_choice">Police
<input type="radio" name="choice" value="Fire station" class="radio_choice">Fire station
<input type="submit"  class="submit" onclick="getAddress()" value="START EMERGENCY">
</form>
</div>
<div class="active_block">
<div class="active">Active Emergencies</div>
<div class="view"><a href="all.php">View All Emergencies</a></div>
<div class="clear"></div>
<?php
$conn=mysqli_connect('localhost','root','','emergency') or die("Can't connect!");
$sql="SELECT * FROM store order by Id desc";
if(mysqli_query($conn,$sql)){
	$sql="SELECT * from store order by Id desc";
	$res=mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){
		while($fetch=mysqli_fetch_assoc($res)){
			$id=$fetch['Id'];
			$time=$fetch['time'];
			$name=$fetch['Name'];
			$mob=$fetch['Mobile_num'];
			$address=$fetch['Address'];
			$landmark=$fetch['Landmark'];
			$emergency=$fetch['Emergency'];
			$choice=$fetch['Choice'];
$c=str_split($mob,5);
$a=$c[0];
$b=$c[1];

			echo "<div class=\"emergency_table\">";
			echo "<div class=\"active_border\">";
			echo "<div class=\"first_active\">";
			echo "<div class=\"first_section\">";
			echo "<div class=\"started\">STARTED AT $time </div>";
			echo "<div id=\"started2\" ></div>";
			echo "</div>";
			echo "<div class=\"cancel\">cancel</div>";
			echo "</div>";
			echo "</div>";
			echo "<div class=\"second_active\">";
			echo "<div class=\"without_map\">";
			echo "<div class=\"name\">$name</div>";
			echo "<div class=\"mob\">+91-$a-$b</div>";
			echo "</div>";
			echo "<div class=\"with_map\"target='$id'>";
			echo "<i class=\"fa fa-map-marker\"   style=\"font-size:48px;color:red;margin-left:120px; margin-top:10px;\"></i>";
			//$map=$address;
			echo "</div>";
			echo "<div class=\"clear\"></div>";
			echo "<div class=\"address\">$address,</div>";
			echo "<div class=\"emergency\">Emergency <span class=\"emergency2\">$emergency</span></div>";
			echo "</div>";
			echo "<div class=\"third_active\">";
			echo "<div class=\"request\">Request Pending<span class=\"choice\">$choice</span></div>";
			echo "</div>";
			echo "</div>";
			

			
		}
	}
	//echo $count;
	}
	else{
		//echo "wrong!";
	}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$emergency=$_POST['Emergency'];
	$name=$_POST['name'];
	$mobile=$_POST['mobile'];
	$address=$_POST['Address'];
	$landmark=$_POST['landmark'];
	$pincode=$_POST['pincode'];
	$alert=$_POST['choice'];
	date_default_timezone_set('Asia/Kolkata');
	$date=date('H:i');
	$conn=mysqli_connect('localhost','root','','emergency') or die("Can't connect!");
	$sql="INSERT INTO store VALUES('','$emergency','$name','$mobile','$address','$landmark','$pincode','$alert','$date')";
	$count=0;
	if(mysqli_query($conn,$sql)){
	$sql="SELECT * from store order by Id desc LIMIT 2";
	$res=mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){
		while($fetch=mysqli_fetch_assoc($res)){
			$id=$fetch['Id'];
			$time=$fetch['time'];
			$name=$fetch['Name'];
			$mob=$fetch['Mobile_num'];
			$address=$fetch['Address'];
			$landmark=$fetch['Landmark'];
			$emergency=$fetch['Emergency'];
			$choice=$fetch['Choice'];
$c=str_split($mob,5);
$a=$c[0];
$b=$c[1];

			echo "<div class=\"emergency_table\">";
			echo "<div class=\"active_border\">";
			echo "<div class=\"first_active\">";
			echo "<div class=\"first_section\">";
			echo "<div class=\"started\">STARTED AT $time </div>";
			echo "<div id=\"started2\" ></div>";
			echo "</div>";
			echo "<div class=\"cancel\">cancel</div>";
			echo "</div>";
			echo "</div>";
			echo "<div class=\"second_active\">";
			echo "<div class=\"without_map\">";
			echo "<div class=\"name\">$name</div>";
			echo "<div class=\"mob\">+91-$a-$b</div>";
			echo "</div>";
			echo "<div class=\"with_map\"target='$id'>";
			echo "<i class=\"fa fa-map-marker\"   style=\"font-size:48px;color:red;margin-left:120px; margin-top:10px;\"></i>";
			//$map=$address;
			echo "</div>";
			echo "<div class=\"clear\"></div>";
			echo "<div class=\"address\">$address,</div>";
			echo "<div class=\"emergency\">Emergency <span class=\"emergency2\">$emergency</span></div>";
			echo "</div>";
			echo "<div class=\"third_active\">";
			echo "<div class=\"request\">Request Pending<span class=\"choice\">$choice</span></div>";
			echo "</div>";
			echo "</div>";
			
		}
	}
	//echo $count;
	}
	else{
		echo "fuck";
	}
	
}
?>
<div id="map" style="width: 400px; height: 300px;"></div>

</div>
<Script>
/*$(document).ready(function(){
$(".submit").click(function(){
	var qwe=$("#mobile").val();
	alert(qwe.length);
});
});*/
if(performance.navigation.type==1){
	alert("THe page is reloaded~!");
	e.preventDefault();
	document.document.getElementsByClassName("emergency_table").innerHTML='';

}
$(document).ready(function(){
	$(".submit").click(function(){
		$("active_border.active").removeClass('active');
		
	});
});
</script>
<Script>
if($("#started2").hasClass('active')){
	var sec=0;
var min=0;
var hr=0;
	var x= setInterval(function(){
	sec+=1;
	if(sec>=60){
	sec=0;
	min+=1;
	}
	if(min>=60){
	hr+=1;
	min=0;
	}
	document.getElementById("started2").innerHTML = hr + ":" + min + ":" + sec+"sec" ;	
	},1000);

}
var sec=0;
var min=0;
var hr=0;
	var x= setInterval(function(){
	sec+=1;
	if(sec>=60){
	sec=0;
	min+=1;
	}
	if(min>=60){
	hr+=1;
	min=0;
	}
	document.getElementById("started2").innerHTML = hr + ":" + min + ":" + sec+"sec" ;	
	},1000);

</script>
<script>
$(document).ready(function() {
    $(window).resize(function() {
        google.maps.event.trigger(map, 'resize');
    });
    google.maps.event.trigger(map, 'resize');
});
</script>
<script>
$(document).ready(function(){
	$(".with_map").click(function(){
		$("#map").css('display','block');
		var q=$(this).attr("target");
		
			
		$.ajax({
			method: "POST",
			url: "map.php",
			data: {username: q
			},
			success: function(data){
				var addr=data;
				window.location.href = "testmap.php?dist=" + addr;
				
			},
			failure:function(){
				alert("Eroor");
			}		
		})
	});
});

</script>
<script>
var error=0;
$("#mobile").blur(function(e){
			 var d=$("#mobile").val();
			
			if(d.length==10) {
				error=0;
			} else {
				alert("Enter 10 digit phone number!");
					e.preventDefault();
					error=1;

				}
	
		});
		$("#pincode").blur(function(e){
			var d=$("#pincode").val();
			if(d.length==6) {
				error=0;
			} else {
				alert("Enter 6 digit phone number!");
					e.preventDefault();
error=1;
				}
		});
		$(".submit").click(function(){
			if(error==1){
				alert("Enter the correct data!");
				error=0;
				location.reload();
			}
			
		});
</script>


</body>
</html>
