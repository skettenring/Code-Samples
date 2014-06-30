<?php
	require("includes/lib/db.php");
	require("includes/header.php");
	require("scripts/format_date.php");
?>
<div id="wrapper">
	<div id="left">
		<div id="rightCol">

			<div id="UsersLoggedIn">
				<table>
					<tr><th>Active Users:</th></tr>
					<?php
					$result = mysql_query("SELECT * FROM GUERRILLA_USER WHERE last_active > now() - INTERVAL 10 MINUTE ");
						if(mysql_num_rows($result)==0){
							echo "<tr id='Loggedintr'><td>There are currently no active users.</td></tr>";
						}
						else{
							while($row = mysql_fetch_array($result)){
								echo "<tr id='Loggedintr'><td><a href='http://www.gmrnation.com/profile/viewProfile.php?profileName=" . $row["USERNAME"] . "'>" ;
								if (file_exists('profile/avatars/' . $row["USERNAME"] . '.jpg')){
									echo '<img class="avatar" src="profile/avatars/' . $row["USERNAME"] . '.jpg" />';
								}
								else{
									echo '<img class="avatar" src="images/default_avatar.jpg" />';
								}
								echo $row["USERNAME"] . "</a></td></tr>";
							}
						}?>
				</table>
			</div>

			<div id="recentForumPosts">
				<table id="recentPostTable">
					<tr><th colspan="2">Recent Forum Topics</th></tr>
					<?php
					$result = mysql_query("SELECT * FROM GUERRILLA_FORUM_MESSAGE WHERE PARENT_MESSAGE_ID='0' ORDER BY MESSAGE_DATE DESC LIMIT 10");

					while($row = mysql_fetch_array($result)){
						$id=$row["USER_ID"];
						$result2= mysql_query("SELECT USERNAME FROM GUERRILLA_USER WHERE USER_ID='$id'");
						$row2=mysql_fetch_array($result2);
						echo "<tr><td class='recentPostLeft'><a href='http://www.gmrnation.com/includes/public_files/view.php?fid=" . $row["FORUM_ID"] . "&mid=" . $row["MESSAGE_ID"] . "'>" . $row["SUBJECT"] . "</a></td><td class='recentPostRight'><a href='http://www.gmrnation.com/profile/viewProfile.php?profileName=" .$row2["USERNAME"] . "'>";
						if (file_exists('profile/avatars/' . $row2["USERNAME"] . '.jpg')){
							echo '<img class="avatar" src="profile/avatars/' . $row2["USERNAME"] . '.jpg" />';
						}
						else{
							echo '<img class="avatar" src="images/default_avatar.jpg" />';
						}
						echo  $row2["USERNAME"] . "</a></td>";
					}?>
				</table>
			</div>

			<div id="leftCol">
				<div id="posts">
					<ul id="middlelist">
					<?php
					$result = mysql_query("SELECT * FROM POST_ADMIN ORDER BY id DESC LIMIT 6");
					while($row = mysql_fetch_array($result)){ 
						echo "<li><h4>" .$row["title"] . "<!--<img id='midListImg' src='http://www.gmrnation.com/images/background/h3slant.gif'  />-->";
						if ($row['type'] == 'News'){
							echo '<img class="avatar" src = "posts/img/news.png" />';
						}
						else if($row['type'] == 'Preview'){
							echo '<img class="avatar" src = "posts/img/preview.png" />';
						}
						else if($row['type'] == 'Review'){
							echo '<img class="avatar" src = "posts/img/review.png" />';
						}

						echo "<span id='postdate'>Posted by: ".$row["admin"] . "<br/>". showdate($row["date"]) . "</span></h4><a class='popup' href='http://www.gmrnation.com/posts/view.php?pid=" . $row['id'] ."'>";
						echo "<span class='blurb'>";
						echo $row["blurb"]  ."</span>";
						echo "</a></li>";
					 }

					?>
					<div id="hiddenPosts" class="more">
						<?php
						$result = mysql_query("SELECT * FROM POST_ADMIN ORDER BY id DESC LIMIT 6, 18000000000000");
						while($row = mysql_fetch_array($result)){ 
							echo "<li><h4>" .$row["title"] . "<!--<img id='midListImg' src='http://www.gmrnation.com/images/background/h3slant.gif'  />-->";

							if ($row['type'] == 'News'){
								echo '<img class="avatar" src = "posts/img/news.jpg" />';
							}
							else if($row['type'] == 'Preview'){
								echo '<img class="avatar" src = "posts/img/news.jpg" />';
							}
							else if($row['type'] == 'Review'){
								echo '<img class="avatar" src = "posts/img/news.jpg" />';
							}
							echo "<span id='postdate'>Posted by: ".$row["admin"] . "<br/>". showdate($row["date"]) . "</span></h4><a class='popup' href='http://www.gmrnation.com/posts/view.php?pid=" . $row['id'] ."'>";
							echo "<span class='blurb'>";
							echo $row["blurb"]  ."</span>";
							echo "</a></li>";
						} ?>
						<a href="#" id="hiddenPosts-hide" class="hideLink" onclick="showHide('hiddenPosts');return false;">Hide this content.</a>
					</div>


					</ul>
					<a href="#" id="hiddenPosts-show" class="showLink" onclick="showHide('hiddenPosts');return false;">See all articles.</a>
				</div>

			</div>
		</div>
	</div>
</div>
<?php 
	require("includes/footer.php"); 
?>
