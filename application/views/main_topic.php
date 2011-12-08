<?php 
// Require header.php at the top of every page
require_once('header.php'); 
?>

<div id="accordion">
		<h3><a><? echo $topic->title; ?></a></h3>
		<div>
			<p>
				<button onclick="newPost(<? echo $topic->tid; ?>)">New Post</button>
				<ul>
					<? $i=0; foreach($post->result() as $p) { ?>
						<li>
							<? echo $p->text; $i++; ?>
							<br />
							<? echo $p->date;
						</li>
					<? } if ($i==0) echo '<li>No Posts</li>'; ?>
				</ul>
			</p>
		</div>
</div>

<?php 
// Require footer.php at the bottom of every page
require_once('footer.php'); 
?>