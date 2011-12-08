<?php 
// Require header.php at the top of every page
require_once('header.php'); 
?>

<div id="accordion">
	<?php
		foreach($category->result() as $c) { ?>
			<h3>
				<a><? echo $c->cid . ' ' . $c->title; ?></a>
				<br />
				<? echo $c->updated; ?>
			</h3>
			<div>
				<p>
					<button onclick="newTopic(<? echo $c->cid; ?>)">New Topic</button>
					<ul>
						<? $i=0; foreach($topic[$c->cid]->result() as $t) { ?>
							<li>
								<a href="/main/topic/<? echo $t->tid; ?>/"><? echo $t->title; $i++; ?></a>
								<br />
								<? echo $t->updated; ?>
							</li>
						<? } if ($i==0) echo '<li>No Topics</li>'; ?> 
					</ul>
				</p>
			</div>
	<?php } ?>
</div>

<?php 
// Require footer.php at the bottom of every page
require_once('footer.php'); 
?>