
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
		  Points are dished out by the Moderator when you submit a post that they like. They can dish out anywhere between 1-100 points. We will be adding lots of bonus features and special treatment for users with high point counts. Right now, the only reward is that the users with the top 3 point counts will be considered to be brought onto the ICU team as a Moderator. Start posting!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>