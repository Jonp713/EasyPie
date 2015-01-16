
<?php

	$points = count_user_points($session_user_id, 0, null);
	
	echo('<span class = "pointsline ">');
	
	echo('You have <span class = "pointscount">'.$points.'</span> points!&nbsp;');
	echo('<button class = "btn btn-default whatspoints btn-xs glyphicon glyphicon-question-sign" data-toggle="modal" data-target="#pointsmodal"></button>');
	
	echo('</span>');

?>

<!-- Modal -->
<div class="modal fade" id="pointsmodal" tabindex="-1" role="dialog" aria-labelledby="pointsmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">About Points</h4>
      </div>
      <div class="modal-body">
		  Points..yes...points. The mysterious value. Points are given when a post of yours is upvoted. Posts with high points will be sorted higher on its communities home feed. So thats what points do for your posts, but what do they do for YOU? Good question, we are still working on that. I have an answer for you, actually, but its not complete yet and I want to keep it a secret until its ready ... :)
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>