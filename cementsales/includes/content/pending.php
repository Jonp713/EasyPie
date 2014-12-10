
			
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				Moderator Guidelines from JD
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">


Moderators, use your own judgement but use this as a guiding principle; Maintain ICU’s brand as a site for missed connections and crushes, don’t post something if you think it could do harm.

<h4><u>Posts to ‘Deny’ (put in the hole)</u></h4><br>

Posts that aren’t defined as a missed connection or crush post.<br><br>

If you can tell it is a joke<br><br>

Posts to or about inanimate objects.<br><br>

Political posts. <br><br>

Overt and graphic sexual content<br><br>

<h4><u>What to ‘Delete’</u></h4><br>

Threats of violence<br><br>

Responses to previous posts. We should never post things like “Re: girl in 101 chem’ she’s mine back off”. It undermines the message function. <br><br>

Predatory sexual content. I want us to be willing to post risque content, but not at the expense of making an individual feel unsafe. We draw the line at the type of verbiage being used, ‘i want to’, ‘I wish I could’, ‘i think about’ vs. ‘i’m going to’.<br><br>

Self harm posts It can be extremely painful not to be able to reach out to people in this type of pain, but it is important we don’t post these. We can’t provide help to these people. Posting their pain isn’t going to help them and it takes the site in the wrong direction.<br><br>

Solicitations of sex. ‘I’m horny, hit reply and lets get weird’. That’s what tinder/grindr is for goddamnit. Find ‘hot local singles in your area’ on some other site. <br><br>

Posts including names.
The exception to this rule is if the post includes the name of a well known figure. <br><br>
  
			 		 	
      </div>
    </div>
  </div>
</div>
			


<?php

moderator_protect_page();

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(0, $_GET['community'], 0, false, 'all');

}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){

	$posts = get_posts(0, $admin_data['community'], 0, false, 'all');
}

foreach ($posts[0] as $currentpost) {
	
	display_post_admin($currentpost['id'], 'post', 'display_time', 'username', 'admin_reply', 'give_points', 'approve', 'deny', 'delete');
	
	echo('<br>');
	
}
	

?>
