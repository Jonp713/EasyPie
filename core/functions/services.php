<?php

function create_service($service_data){
		
	array_walk($service_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($service_data)) . '`';
	$data = '\'' . implode('\', \'', $service_data) . '\'';

	mysql_query("INSERT INTO `services` ($fields) VALUES ($data)");
	
}


function display_name_type($service_name){
	$service_name = sanitize($service_name);
	
	
	return mysql_result(mysql_query("SELECT `name_display` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'name_display');
	
}


function service_available($community_name, $service_name){
	$service_name = sanitize($service_name);
	$community_name = sanitize($community_name);
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `services` WHERE `community` = '$community_name' AND name = '$service_name' AND core = 0"), 0) >= 1) ? true : false;
	
}



function is_geo_locked($service_name){
	$service_name = sanitize($service_name);
	
	
	return mysql_result(mysql_query("SELECT `geo_locked` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'geo_locked');
	
}

function has_blur($service_name){
	$service_name = sanitize($service_name);
	
	
	return mysql_result(mysql_query("SELECT `blur_on` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'blur_on');
	
}

function has_identity($service_name){
	$service_name = sanitize($service_name);
	
	
	$result = mysql_result(mysql_query("SELECT `identity` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'identity');
	
	if($result == "identity"){
		
		return true;
		
	}else{
		
		return false;
	}
	
}

function is_event($service_name){
	$service_name = sanitize($service_name);
	
	return mysql_result(mysql_query("SELECT `is_event` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'is_event');
	
	
}

function is_meme($service_name){
	$service_name = sanitize($service_name);
	
	return mysql_result(mysql_query("SELECT `for_memes` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'for_memes');
	
	
}

function update_service_id($service_id, $update_data) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	$service_id = sanitize($service_id);
		
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	
	mysql_query("UPDATE `services` SET " . implode(', ', $update) . " WHERE `id` = $service_id");
}

function add_service($service_data){
		
	array_walk($service_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($service_data)) . '`';
	$data = '\'' . implode('\', \'', $service_data) . '\'';

	mysql_query("INSERT INTO `services` ($fields) VALUES ($data)") or die(mysql_error());
	
}

function service_exists($service) {
	$service = sanitize($service);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `services` WHERE `name` = '$service' AND `core` = 1"), 0) == 1) ? true : false;
}

function service_exists_in_community($service, $community) {
	$service = sanitize($service);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `services` WHERE `name` = '$service' AND `community` = '$community'"), 0) == 1) ? true : false;
}


function get_logo_picture_url_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
	
	$character_id = mysql_fetch_assoc(mysql_query("SELECT character_id FROM services WHERE name = '$service_name' AND core = 1"));
	
	$character_id = $character_id['character_id'];
	
	$picture_id = mysql_fetch_assoc(mysql_query("SELECT pic_id FROM characters WHERE id = '$character_id'"));	
	
	$picture_id = $picture_id['pic_id'];
	
	$url =  mysql_fetch_assoc(mysql_query("SELECT url FROM pictures WHERE id = '$picture_id'"));
	
	return $url['url'];
	
}


function get_service_color_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `color` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'color');
	
}


function get_service_description_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `description` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'description');
	
}

function get_service_id_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `id` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'id');
	
}

function get_service_name_from_service_id($service_id){
	
	$service_id = sanitize($service_id);
		
	return mysql_result(mysql_query("SELECT `name` FROM `services` WHERE `id` = '$service_id'"), 0, 'name');
	
}


function get_is_mine_from_service_name($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `is_mine` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'is_mine');
	
}

function is_share_on($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `share_on` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'share_on');
	
}

function get_service_char_type($service_name){
	
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `char_type` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'char_type');
	
}


function get_services_ajax($community){
	$community = sanitize($community);
	
	$result = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
	

	$allservices = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		
		$allservices[] = $number['name'];	
	
	}
	
	return $allservices;
	
}


function get_services($community, $type){
	$type = sanitize($type);
	$community = sanitize($community);
	
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 1");
	
	}
	if($type == 0){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
		
	}
	if($type == 2){
		
		$result = mysql_query("SELECT * FROM `services` WHERE core = 1") or die(mysql_error());
		
		$result2 = mysql_query("SELECT * FROM `services` WHERE core = 0 AND community = '$community'") or die(mysql_error());
		
	}
	
	
	$allservices = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$continue = true;
		
		
		if($type == 2){
			
			if(count($result2) != 0){
			
			    while($number_community = mysql_fetch_assoc($result2)) { 
								
				
					if($number['name'] == $number_community['name']){
					
						$continue = false;
					}
				
			
				}
			
			
				mysql_data_seek($result2, 0);
			
			}
			
			if($continue && $type == 2){
			
				$allservices[] = $number;	
			
			}
			
		}else{
		
			$allservices[] = $number;	
			
		}	
		
		
	
   	}
	
	return $allservices;
	
	
}

function add_to_memebase($community, $service, $post_id){
	$community = sanitize($community);
	$service = sanitize($service);
	$post_id = sanitize($post_id);
	
	$src = mysql_fetch_assoc(mysql_query("SELECT img_src FROM posts WHERE id = '$post_id'"));
	
	$src = $src['img_src'];
	
	$type = 'memebase';
	
	mysql_query("INSERT INTO pictures (url, community, service, type) VALUES ('$src', '$community', '$service', '$type')") or die(mysql_error());
	
	
}

function get_memes($community, $service){
	$community = sanitize($community);
	$service = sanitize($service);
	
	$result = mysql_query("SELECT url, id FROM `pictures` WHERE community = '$community' AND service = '$service' AND type = 'memebase'") or die(mysql_error());
	
	$allmemes = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		
		$allmemes[] = $number;	
	
	}
	
	return $allmemes;
	
}

function delete_meme($pic_id){
	
	$pic_id = sanitize($pic_id);
	
	mysql_query("DELETE FROM `pictures` WHERE id = '$pic_id'") or die(mysql_error());
	
}

function update_service($update_data, $service_name){
	$service_name = sanitize($service_name);
	
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	
	}

	return mysql_query("UPDATE `services` SET " . implode(', ', $update) . " WHERE `name` = '$service_name' AND core = 1") or die(mysql_error());
		

}

function service_is_home($service_name, $community){
	$service_name = sanitize($service_name);
	$community = sanitize($community);
	
		
	return mysql_result(mysql_query("SELECT `is_home` FROM `services` WHERE `name` = '$service_name' AND community = '$community' AND core = 0"), 0, 'is_home');
	
}

function service_needs_approve($service_name){
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `moderation` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'moderation');
	
}

function service_is_inappropriate($service_name){
	$service_name = sanitize($service_name);
		
	return mysql_result(mysql_query("SELECT `inappropriate` FROM `services` WHERE `name` = '$service_name' AND core = 1"), 0, 'inappropriate');
	
}

function service_sub_count($service_name, $community_name){
	$service_name = sanitize($service_name);
	$community_name = sanitize($community_name);
	
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(user_id) AS totalsubs FROM subscriptions WHERE service = '$service_name' AND community_name = '$community_name'"));
	
	return ($count['totalsubs']);
}


function count_franchises($service_name){
		
	$result = mysql_fetch_assoc(mysql_query("SELECT COUNT(`id`) AS total FROM `services` WHERE `name` = '$service_name' AND core = 0"));
	
	return $result['total'];
	
}

function display_form($service_name, $service_in){
	$service_name = sanitize($service_name);
	
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM services WHERE name = '$service_name' AND core = 1"));
	

	
	if($service_in == $service_name){

		echo('<span id = "sf-'.$service_name.'" data-active = "active">');

	}else{
	
	   echo('<span id = "sf-'.$service_name.'" data-active = "notactive">');
   
	}

	
	echo('<form class = "submit_post form-horizontal col-xs-12 no-padding" role="form" action="" method="post" enctype="multipart/form-data">');
	
	echo('<strong class = "col-xs-12 no-padding service-title">'.$service_name.'</strong>');
	
	if($data['identity'] == "identity" && user_has_identity($_SESSION['user_id']) == 0){
		
		if(logged_in() == false){
			
			echo('<span class = "form-note col-xs-12">This board requires that you display your identity. You need to <a href = "login.php">login</a> or <a href = "register.php">sign up</a> in order to get one.</span>');
			
		}else{
		
			echo('<span class = "form-note col-xs-12">This board requires that you display your identity. You do not currently have a an identity registered. You can do that <a href = "identity.php">here</a></span>');
		
		}
				
	}else{
	
		if($data['identity'] == "identity" && user_has_identity($_SESSION['user_id']) == 1){
			echo('<span class = "form-note col-xs-12">This board uses your <a href = "identity.php">identity</a>. Your first and last name as well as your picture if you uploaded one will appear at the top of the post</span>');
		
		}
	
		echo('<input value = "'.$data['name'].'" name = "service" hidden>');
	
	
		if($data['title_on'] == 1){
	
			 echo('<div class = "form-group"><div class="col-xs-12"><input class = "form-control" id = "title" type="text" name="title" placeholder = "Title"></div></div>');
	
		}
		
	
		if($data['for_memes'] == 1){
	
			echo('<span class = "form-note col-xs-12">This board is for memes! You know what a meme is, right?...well <a href = "http://knowyourmeme.com">here\'s</a> a link anyways</span>');
			
		
		}
		
		//textarea 4posts
		echo('<div class="form-group"><div class="col-xs-12"><textarea placeholder = "'.$data['prompt'].'" name="post" class ="form-control" ></textarea></div></div>');
		
	
				
		if($data['is_event'] == 1){
			
			echo('
				
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text" class="form-control" id="location" name = "location" placeholder="Location">
          </div>
        </div>
			
		    <div class="form-group">
		  	<div class = "col-sm-12"><label>Start Time:</label></div>
		  	    <div class="col-sm-4">
		
		        <select class="form-control" id= "hour" class = "sf-Events-disable" name = "hour">
		  		  <option value = "1">1</option>
		  		  <option value = "2">2</option>
		  		  <option value = "3">3</option>
		  		  <option value = "4">4</option>
		  		  <option value = "5">5</option>
		  		  <option value = "6">6</option>
		  		  <option value = "7">7</option>
		  		  <option value = "8">8</option>
		  		  <option value = "9">9</option>
		  		  <option value = "10">10</option>
		  		  <option value = "11">11</option>
		  		  <option value = "12">12</option>
		  	  </select>
		  		</div>

				<div class="col-sm-4">
  

		        <select class = "sf-Events-disable form-control" id="minute" name = "minute">
		  		  <option value = "00">00</option>
		  		  <option value = "15">15</option>
		  		  <option value = "30">30</option>
		  		  <option value = "45">45</option>
		  	  </select>
	  
		  	  </div>
	  
		     <div class="col-sm-4">
	 
		        <select class = "sf-Events-disable form-control" id="apm" name = "apm">
		  		  <option value = "am">AM</option>
		  		  <option value = "pm">PM</option>
		  	  </select>
		      </div>
		</div>

		    <div class="form-group">
		  	 <div class = "col-sm-12"><labeL>Date:</label></div>
		
		  	    <div class="col-sm-4">
		
		  		<select class = "form-control" name = "month" id = "'.$data['name'].'_month">
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
		
		
		  		<select class = "form-control" name = "day" id = "'.$data['name'].'_day">
		  			<option value = "1">1</option>
		  		</select>
		
		  	    </div>
		
		  	    <div class="col-sm-4">

		  		<select class = "form-control" name = "year" id = "'.$data['name'].'_year">
		  		<option value = ""> </option>
		  		</select>

				<script type = "text/javascript">
				
				var '.$data['name'].'_ysel = document.getElementById("'.$data['name'].'_year"),
				    '.$data['name'].'_msel = document.getElementById("'.$data['name'].'_month"),
				    '.$data['name'].'_dsel = document.getElementById("'.$data['name'].'_day");
				for (var i = 2015; i <= 2019; i++) {
				    var opt = new Option();
				    opt.value = opt.text = i;
				    '.$data['name'].'_ysel.add(opt);
				}
				'.$data['name'].'_ysel.addEventListener("change", function(){ validate_date(\''.$data['name'].'\')});
				'.$data['name'].'_msel.addEventListener("change", function(){ validate_date(\''.$data['name'].'\')});
				
				</script>
				
		  	    </div>
		
		    </div>
  
  
		      <div class="form-group">
		        <div class="col-sm-6">
		    	<label>Duration:</label>
		    	<select class = "form-control" value = "3600" name = "duration">
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
		    	<select class = "form-control" value = "Not" id = "recurring_'.$data['name'].'" name = "recurring_type">
		    	<option value = "Not">Not Recurring</option>
		    	<option value = "Weekly">Weekly</option>
		    	<option value = "Bi-Weekly">Bi-Weekly</option>

		    	</select>
		      </div>
		    </div>
			
			<script type = "text/javascript">
			
			var recurring_'.$data['name'].' = document.getElementById("recurring_'.$data['name'].'");
		
			recurring_'.$data['name'].'.addEventListener("change", function(){ recurring(\''.$data['name'].'\')});
			
			</script>
		
				
		    <div id = "recurring_end_'.$data['name'].'" class="not-visible form-group">
		  	 <div class = "col-sm-12"><labeL>Recurring End Date:</label></div>
		
		  	    <div class="col-sm-4">
		
		  		<select class = "form-control" name = "r_month" id = "r_'.$data['name'].'_month">
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
		
		
		  		<select class = "form-control" name = "r_day" id = "r_'.$data['name'].'_day">
		  			<option value = "1">1</option>
		  		</select>
		
		  	    </div>
		
		  	    <div class="col-sm-4">

		  		<select class = "form-control" name = "r_year" id = "r_'.$data['name'].'_year">
		  		<option value = ""> </option>
		  		</select>
	
				<script type = "text/javascript">
				
				var r_'.$data['name'].'_ysel = document.getElementById("r_'.$data['name'].'_year"),
				    r_'.$data['name'].'_msel = document.getElementById("r_'.$data['name'].'_month"),
				    r_'.$data['name'].'_dsel = document.getElementById("r_'.$data['name'].'_day");
				
				for (var i = 2015; i <= 2019; i++) {
				    var opt = new Option();
				    opt.value = opt.text = i;
				    r_'.$data['name'].'_ysel.add(opt);
				}
				
				r_'.$data['name'].'_ysel.addEventListener("change", function(){ validate_date(\'r_'.$data['name'].'\')});
				r_'.$data['name'].'_msel.addEventListener("change", function(){ validate_date(\'r_'.$data['name'].'\')});
				
				
						
				
				</script>
		  		
		  	    </div>
		    </div>
			
			');
			
		}
	
	
		if($data['images_on'] == 1 || $data['for_memes'] == 1){
			
			if($data['for_memes'] == 1){
				
			
					
					
				
			}else{
		
			echo('<div class = "form-group"><label for="is_image" class="col-xs-3 control-label">Use a picture:</label><div class="col-xs-8">');
			
			echo('<input onclick = "toggle_post_picture(\''.$service_name.'\')" type="checkbox" name = "is_image" value="checked"></div></div>');
			
		
		 	echo('<div id = "post-pic-form-'.$service_name.'" class="form-group picture-disabled"><label for="pic" class="col-xs-3 control-label">Picture:</label><div class="col-xs-8"><input class = "form-control"  type="file" name="pic">JPG, PNG, and GIFs are allowed!</div></div>');
			
			}
		
			
	 	
		}
	
		if($data['videos_on'] == 1){
		
			echo('<div class = "form-group"><label for="is_video"   class="col-xs-3 control-label">Use a video:</label><div class="col-xs-8">');
			
		echo('<input onclick = "toggle_post_video(\''.$service_name.'\')" type="checkbox" name = "is_video" value="checked"></div></div>');
		
		 echo('<div id = "post-vid-form-'.$service_name.'" class="form-group picture-disabled"><label for="vurl" class="col-xs-3 control-label">Video URL (Youtube Only)</label><div class="col-xs-8"><input class = "form-control"  type="text" onchange="youtube_parser(this.value,\''.$service_name.'\')" id = "vurl_'.$service_name.'" name="vurl"></div></div>');

		}
	
		if($data['websites_on'] == 1){
		
			echo('<div class = "form-group"><label for="is_website"   class="col-xs-3 control-label">Use a website:</label><div class="col-xs-8">');
			
		echo('<input onclick = "toggle_post_web(\''.$service_name.'\')" type="checkbox" name = "is_website" value="checked"></div></div>');
		
		 echo('<div id = "post-web-form-'.$service_name.'" class="form-group picture-disabled"><label for="web" class="col-xs-3 control-label">Website URL</label><div class="col-xs-8"><input class = "form-control" id = "web" type="text" name="wurl" value = "http://"></div></div>');
		
		}
		
		
		if($data['for_memes'] == 1){
		
			echo('<span class = "col-xs-12 memeforms">');
		
			echo('<strong>Meme:</strong>');
		
			echo('<div class = "form-group"><div class="col-xs-12"><input class = "form-control" id = "top_line" type="text" name="top_line" placeholder = "Top Line"></div></div>');
	 
		 	echo('<div class = "form-group"><div class="col-xs-12"><input class = "form-control" id = "bottom_line" type="text" name="bottom_line" placeholder = "Bottom Line"></div></div>');
			 
			echo('<div class = "form-group"><label for="is_image" class="col-xs-3 control-label">Use picture from memebase:</label><div class="col-xs-8">');
	
			echo('<input onchange = "toggle_post_picture(\''.$service_name.'\')" type="radio" name = "meme_type" value="base" checked></div></div>');

			$memes = get_memes($_GET['c'], $service_name);
		
			echo('<span class = "row no-padding">');

			foreach ($memes as $currentmeme) {
			
				echo('<span class = "col-xs-2 light-padding"><img src = "'.$currentmeme['url'].'" class = "img-responsive"><center><input type = "radio" name = "meme_img_src" value = "'.$currentmeme['url'].'"></center></span>');
			
			}
		
			if(count($memes) < 1){
			
				echo('No memes in the memebase, yet! What a shame...');
			}
		
			echo('</span><hr class = "messagehr">');
		

	 			echo('<div class = "form-group"><label for="is_image" class="col-xs-3 control-label">Or upload your own picture:</label><div class="col-xs-8">');

	 			echo('<input onchange = "toggle_post_picture(\''.$service_name.'\')" type="radio" name = "meme_type" value="upload"></div></div>');

	 		 	echo('<div id = "post-pic-form-'.$service_name.'" class="form-group picture-disabled"><label for="pic" class="col-xs-3 control-label">Picture:</label><div class="col-xs-8"><input class = "form-control"  type="file" name="pic">JPG, PNG, and GIFs are allowed!</div></div>');
				
				echo('</span>');
			
	
		}
	
		if($data['comments_on'] == 1){
		
		   echo('<div class="checkbox"><label><input type="checkbox" name="comments_on" checked = "checked">Allow comments</label></div>');
		
		}
	
		if($data['private_on'] == 1){
		
			if(logged_in() === true){ 
								
				echo('<div class="checkbox"><label data-container="body" data-toggle="popover" data-placement="left" data-content="Users can anonymously send you messages by clicking reply. They will not see your username in a message.">');
		 		
				echo('<input type="checkbox" name="reply_on" checked = "checked">I want replies </label></div>');
					
		
			}else{
			
				echo('<div class="checkbox disabled"><label><input type="checkbox" value="" disabled>I want replies</label></div><span class = "form-note col-xs-12">You must <a href = "login.php">login</a> or <a href = "register.php">sign up</a> to recieve private replies</span>');
		
			} 
		
		
		}
	
	
		echo('<br><button type="submit" class="post-submit-button btn btn-info">SUBMIT</button>');
		
	}
	
	echo('</form></span>');
	
}





?>