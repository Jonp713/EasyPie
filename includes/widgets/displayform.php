<?php
	
//ICU	
/*
if($service_in == 'ICU'){

	echo('<span id = "sf-ICU" data-active = "active">');

}else{
	
   echo('<span id = "sf-ICU" data-active = "notactive">');
   
}
	
?>

		  <form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
			  
				<div class="form-group">
				
			    <input class = "sf-ICU-disable" type="text" id = "sf-ICU-service" value = "ICU" name = "service" hidden>
				
				
		      <div class="col-xs-12">
				<textarea placeholder = "ICU..." name="post" class = "sf-ICU-disable form-control" id = "sf-ICU-textarea"></textarea>
				</div>
			</div>
		
			<?php if(logged_in() === true){ ?>
									

			    <div class="checkbox">
			      <label data-container="body" data-toggle="popover" data-placement="left" data-content="
Users can anonymously send you messages by clicking reply. They will not see your username in a message.
">
			 		 <input class = "sf-ICU-disable" type="checkbox" id = "sf-ICU-reply" name="reply_on" checked = 'checked'>I want replies
			      </label>
			    </div>
						
			
			<?php }else{?>
				
				<div class="checkbox disabled">
				  <label>
				    <input class = "sf-ICU-disable" type="checkbox" value="" disabled>
					I want replies
				  </label>
				</div>
				
	You must <a href = 'login.php'>login</a> or <a href = 'register.php'>register</a> to recieve private replies
	
	
<?php } ?>

			    <div class="checkbox">
			      <label>
			 		 <input class = "sf-ICU-disable" type="checkbox" id = "sf-ICU-comments" name="comments_on">Allow comments
			      </label>
			    </div>	
				
				<br>
		    <button type="submit" class="post-submit-button btn btn-info">SUBMIT</button>
		</form>
	</span>
	
	

<?php

//BONE
	
if($service_in == 'Bone'){

	echo('<span id = "sf-Bone" data-active = "active">');

}else{
	
   echo('<span id = "sf-Bone" data-active = "notactive">');
   
}
	
?>


		  <form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
			  
			<?php if(logged_in() === true){ ?>

				<div class="form-group">
				
			    <input class = "sf-Bone-disable" type="text" id = "sf-Bone-service"  value = "Bone" name = "service" hidden>
				<input class = "sf-Bone-disable" type="checkbox" id = "sf-Bone-reply" name="reply_on" checked = 'checked' hidden>	
				
				
				
		      <div class="col-xs-12">
				<textarea placeholder = "Will someone with a hot body make out with me NSA?" name="post" id = "sf-Bone-textarea" class = "form-control sf-Bone-disable" ></textarea>
				</div>
			</div>
						
						
		    <div class="checkbox">
		      <label>
		 		 <input class = "sf-Bone-disable" type="checkbox" id = "sf-Bone-comments" name="comments_on">Allow comments
		      </label>
		    </div>
											
				
				<?php }else{
					
					?>
					
					You must <a href = 'login.php'>login</a> or <a href = 'register.php'>register</a> before you can post to Bone because Bone only works if people can reply to your posts.
										
					<?php }?>
			
			<br>
			    <button type="submit" class="post-submit-button btn btn-info">SUBMIT</button>
			</form>
		
	</span>		
	
	
	
	
	
	<?php

	//Hole
	
	if($service_in == 'Hole'){

		echo('<span id = "sf-Hole" data-active = "active">');

	}else{
	
	   echo('<span id = "sf-Hole" data-active = "notactive">');
   
	}
	
	?>
		  <form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

					<div class="form-group">
				
				    <input class = "sf-Hole-disable"  type="text" id = "sf-Hole-service" value = "Hole" name = "service" hidden>
								
			      <div class="col-xs-12">
					<textarea placeholder = "Post to the hole skip our moderation system" name="post" id = "sf-Hole-textarea" class = "form-control sf-Hole-disable"></textarea>
					</div>
				</div>
				
				
				<div class = "form-group">
   			     <label for="is_image"   class="col-xs-3 control-label">Use a picture:</label>
					
				 <div class="col-xs-8">
					
					 <input id = "sf-Hole-is-image"  class = "sf-Hole-disable" onclick = "toggle_post_picture('Hole')" type="checkbox" name = "is_image" value="checked">
				 
				 </div></div>
				
			 <div id = "post-pic-form-Hole" class="form-group picture-disabled">
							
					     <label for="pic" class="col-xs-3 control-label">Picture:</label>
						 <div class="col-xs-8">
	
					 <input class = "form-control"  type="file" name="pic_Hole">
	
				</div></div><br>
					    <button type="submit" class="post-submit-button btn btn-info">SUBMIT</button>
					</form>	
			
		
		</span>
	
	
	
	
	<?php
*/
	//Events
	
	if($service_in == 'Events'){

		echo('<span id = "sf-Events" data-active = "active">');

	}else{
	
	   echo('<span id = "sf-Events" data-active = "notactive">');
   
	}
	
	?>
	
			  <form class = "submit_post form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
	
	
    <input type="text" id = "sf-Events-service"  class = "sf-Events-disable" value = "Events" name = "service" hidden>
	
	
      <div class="form-group">
        <div class="col-sm-12">
          <input type="text" class="form-control sf-Events-disable" id="title" name = "title" placeholder="Event Title">
        </div>
      </div>
	
      <div class="form-group">
        <div class="col-sm-12">
          <input type="text" class="form-control" id="location" name = "location" class = "sf-Events-disable"  placeholder="Event Location">
        </div>
      </div>
	  
	  <textarea placeholder = "Describe your event, give all of the details someone needs to know to come...." name="post" class = "form-control sf-Events-disable"  id = "sf-Events-textarea"></textarea><br>
	
    <div class="form-group">
  	<div class = "col-sm-12"><label>Start Time:</label></div>
  	    <div class="col-sm-4">
		
        <select class="form-control" id= "hour" class = "sf-Events-disable" name = 'hour'>
  		  <option value = '1'>1</option>
  		  <option value = '2'>2</option>
  		  <option value = '3'>3</option>
  		  <option value = '4'>4</option>
  		  <option value = '5'>5</option>
  		  <option value = '6'>6</option>
  		  <option value = '7'>7</option>
  		  <option value = '8'>8</option>
  		  <option value = '9'>9</option>
  		  <option value = '10'>10</option>
  		  <option value = '11'>11</option>
  		  <option value = '12'>12</option>
  	  </select>
  		</div>

		<div class="col-sm-4">
  

        <select class = "sf-Events-disable form-control" id="minute" name = 'minute'>
  		  <option value = '00'>00</option>
  		  <option value = '15'>15</option>
  		  <option value = '30'>30</option>
  		  <option value = '45'>45</option>
  	  </select>
	  
  	  </div>
	  
     <div class="col-sm-4">
	 
        <select class = "sf-Events-disable form-control" id="apm" name = 'apm'>
  		  <option value = 'am'>AM</option>
  		  <option value = 'pm'>PM</option>
  	  </select>
      </div>
</div>

    <div class="form-group">
  	 <div class = "col-sm-12"><labeL>Date:</label></div>
		
  	    <div class="col-sm-4">
		
  		<select class = "sf-Events-disable form-control" name = "month">
  		<option value = ""> </option>
  		<option value = "01">January</option>
  		<option value = "02">February</option>
  		<option value = "03">March</option>
  		<option value = "04">April</option>
  		<option value = "05">May</option>
  		<option value = "06">June</option>
  		<option value = "07">July</option>
  		<option value = "08">August</option>
  		<option value = "09">September</option>
  		<option value = "10">October</option>
  		<option value = "11">November</option>
  		<option value = "12">December</option>
  		</select>
		
  	    </div>
		
  	    <div class="col-sm-4">
		
		
  		<select class = "sf-Events-disable form-control" name = "day">
  			<option value = '1'>1</option>
  		</select>
		
  	    </div>
		
  	    <div class="col-sm-4">

  		<select class = "sf-Events-disable form-control" name = "year">
  		<option value = ""> </option>
  		<option value = "2014">2014</option>
  		<option value = "2015">2015</option>
  		<option value = "2016">2016</option>
  		</select>
	

  		<script type = "text/javascript">
  		var ysel = document.getElementsByName("year")[0],
  		    msel = document.getElementsByName("month")[0],
  		    dsel = document.getElementsByName("day")[0];
  		for (var i = 2000; i >= 1950; i--) {
  		    var opt = new Option();
  		    opt.value = opt.text = i;
  		    //ysel.add(opt);
  		}
  		ysel.addEventListener("change", validate_date);
  		msel.addEventListener("change", validate_date);

  		function validate_date() {
  		    var y = +ysel.value, m = msel.value, d = dsel.value;
  		    if (m === "2")
  		        var mlength = 28 + (!(y & 3) && ((y % 100)!==0 || !(y & 15)));
  		    else var mlength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][m - 1];
  		    dsel.length = 0;
  		    for (var i = 1; i <= mlength; i++) {
  		        var opt = new Option();
  				if(i < 10){
		        	
  					opt.value = opt.text = ("0" + i);
					
					
  				}else{
				
  		        	opt.value = opt.text = i;
				
  				}
  		        if (i == d) opt.selected = true;
  		        dsel.add(opt);
  		    }
  		}
  		validate_date();
  		</script>
		
  	    </div>
		
    </div>
  
  
      <div class="form-group">
        <div class="col-sm-6">
    	<label>Duration:</label>
    	<select class = "sf-Events-disable form-control" value = "3600" name = "duration">
    	<option value = "3600">1 Hour</option>
    	<option value = "7200">2 Hours</option>
    	<option value = "10800">3 Hours</option>
    	<option value = "14400">4 Hours</option>
    	<option value = "18000">5 Hours</option>
    	<option value = "21600">6 Hours</option>
    	<option value = "25200">7 Hours</option>
    	<option value = "28800">8 Hours</option>
    	<option value = "32400">9 Hours</option>
    	<option value = "36000">10 Hours</option>

    	</select>
      </div>
	
        <div class="col-sm-6">
    	<label>Recurring:</label>
    	<select class = "sf-Events-disable form-control" value = "Not" id = "recurring" name = "recurring_type">
    	<option value = "Not">Not Recurring</option>
    	<option value = "Weekly">Weekly</option>
    	<option value = "Bi-Weekly">Bi-Weekly</option>

    	</select>
      </div>
    </div>
	
    <div id = "recurring_end" class="form-group">
  	 <div class = "col-sm-12"><labeL>Recurring End Date:</label></div>
		
  	    <div class="col-sm-4">
		
  		<select class = "sf-Events-disable form-control" name = "r_month">
  		<option value = ""> </option>
  		<option value = "01">January</option>
  		<option value = "02">February</option>
  		<option value = "03">March</option>
  		<option value = "04">April</option>
  		<option value = "05">May</option>
  		<option value = "06">June</option>
  		<option value = "07">July</option>
  		<option value = "08">August</option>
  		<option value = "09">September</option>
  		<option value = "10">October</option>
  		<option value = "11">November</option>
  		<option value = "12">December</option>
  		</select>
		
  	    </div>
		
  	    <div class="col-sm-4">
		
		
  		<select class = "sf-Events-disable form-control" name = "r_day">
  			<option value = '1'>1</option>
  		</select>
		
  	    </div>
		
  	    <div class="col-sm-4">

  		<select class = "sf-Events-disable form-control" name = "r_year">
  		<option value = ""> </option>
  		<option value = "2014">2014</option>
  		<option value = "2015">2015</option>
  		<option value = "2016">2016</option>
  		<option value = "2017">2017</option>
  		<option value = "2018">2018</option>
  		</select>
	

  		<script type = "text/javascript">
  		var r_ysel = document.getElementsByName("r_year")[0],
  		    r_msel = document.getElementsByName("r_month")[0],
  		    r_dsel = document.getElementsByName("r_day")[0];
  		for (var i = 2000; i >= 1950; i--) {
  		    var opt = new Option();
  		    opt.value = opt.text = i;
  		    //ysel.add(opt);
  		}
  		r_ysel.addEventListener("change", validate_date);
  		r_msel.addEventListener("change", validate_date);

  		function validate_date() {
  		    var y = +r_ysel.value, m = r_msel.value, d = r_dsel.value;
  		    if (m === "2")
  		        var mlength = 28 + (!(y & 3) && ((y % 100)!==0 || !(y & 15)));
  		    else var mlength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][m - 1];
  		    r_dsel.length = 0;
  		    for (var i = 1; i <= mlength; i++) {
  		        var opt = new Option();
  				if(i < 10){
		        	
  					opt.value = opt.text = ("0" + i);
					
					
  				}else{
				
  		        	opt.value = opt.text = i;
				
  				}
  		        if (i == d) opt.selected = true;
  		        r_dsel.add(opt);
  		    }
  		}
  		validate_date();
  		</script>
		
  	    </div>
    </div>
		
		
    <div class="checkbox">
      <label>
 		 <input type="checkbox" id = "sf-Events-comments" class = "sf-Hole-disable"  name="comments_on" checked>Allow comments
      </label>
    </div>
    <div class="checkbox">
      <label>
 		 <input class = "sf-Events-disable" type="checkbox" name="freefood_on">Free food
      </label>
    </div>
	<br>
	<div class = "form-group">
     <label for="is_image"   class = "sf-Events-disable col-xs-3 control-label">Use an icon:</label>
		
	 <div class="col-xs-8">
		
		 <input id = "sf-Events-is-image" class = "sf-Events-disable"  onclick = "toggle_post_picture('Events')" type="checkbox" name = "is_image" value="checked">
	 
	 </div></div>
	
 <div id = "post-pic-form-Events" class="form-group picture-disabled">
				
		     <label for="pic" class="col-xs-3 control-label">Icon:</label>
			 <div class="col-xs-8">

		 <input class = "form-control" type="file" name="pic_Events">

	</div></div>
	<br>
    <button type="submit" class="post-submit-button btn btn-info">SUBMIT</button>
</form>
	
</span>


<?php
	
	
$services = get_services($_GET['c'], 0);

foreach ($services as $currentservice){
	
	if(get_is_mine_from_service_name($currentservice['name']) != 1){
		
	
		display_form($currentservice['name'], $service_in);
	
	}
	
}


?>




	
	