<html>
<head>
<link rel="stylesheet" href="main_brain.css">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAL2g7c4rz1EaTnogSGX5-UaCGBSNFE42I"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="active">Active Emergencies</div>
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


?>
<Script>
$(document).ready(function(){
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
</body>
</html>