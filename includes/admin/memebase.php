			<?php
			
				$memes = get_memes($_GET['c'], $_GET['service']);
				
				echo('<span class = "row no-padding">');

				foreach ($memes as $currentmeme) {
					
					echo('<span id = "meme'.$currentmeme['id'].'" class = "col-xs-3"><span class = "hoverer-icon meme-x glyphicon glyphicon-remove" onclick = "delete_meme('.$currentmeme['id'].')"></span><img src = "'.$currentmeme['url'].'" class = "img-responsive"></span>');
					
				}
				
				if(count($memes) < 1){
					
					echo('No memes in the memebase, yet! What a shame...');
				}
				
				?>