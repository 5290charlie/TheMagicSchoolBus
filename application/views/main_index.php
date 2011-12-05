<?php 
// Require header.php at the top of every page
require_once('header.php'); 
?>

<div id="accordion">
	<?php
		foreach($category->result() as $c) { ?>
			<h3><a><? echo $c->cid . ' ' . $c->title; ?></a></h3>
			<div>
				<p>
					<? foreach($topic[$c->cid]->result() as $t) { ?>
						<p><? echo $t->title; ?></p>
					<? } ?> 
				</p>
			</div>
	<?php } ?>
</div>

<?php 
// Require footer.php at the bottom of every page
require_once('footer.php'); 
?>