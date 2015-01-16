<?php

protect_moderator($_GET['service'], $_GET['c'], $session_user_id);

?>

<div class="panel-group mod-guidelines" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				Moderator Guidelines
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">

		<strong>APPROVE</strong><br>
		Things related to your board<br>
<br>
		<strong>SEND TO Hole:</strong><br>
		Posts that are entertaining, but obscene, unrelated, inappropriate, etc<br>
		
		<br>

		<strong>SEND TO another board:</strong><br>
		If the post is related to that board or if you just want to spam them hehe<br>
		
		<br>

		<strong>DELETE:</strong><br>
		Post that are bullying, threatening, or can cause serious harm to someone's reputation or feelings. We don’t want to hurt anyone with this website and we hope you don’t either.<br>
		

		Posts that look anything remotely like child porn?? Yes, please delete these.<br>

		Boring posts<br>

		Posts revealing I have a small penis<br>

      </div>
    </div>
  </div>
</div>
		

<?php

if(isset($_GET['service'])){
		
	$posts = get_posts(0, $_GET['c'], -2, $session_user_id, $_GET['service']);
	
	foreach ($posts[0] as $currentpost) {
		
	
		create_display_set($currentpost['id'], 'moderator', 'load');
	
	}
	
	if(count($posts[0]) < 1){
		
		echo("<br><center><h1>Wooow...no posts?</12> <h4>Looks like your board isnt as popular as you thought it was gonna be</h4></center>");
	}
		
	
}


?>