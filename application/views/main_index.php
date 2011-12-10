<? require_once('header.php'); ?>
<div id="accordion">
	<?php
		foreach($category->result() as $c): ?>
			<h3>
				<span>Updated: <? echo date('m-d-Y @h:i A', $c->updated); ?></span>
				<a><?= $c->cid . ' ' . $c->title; ?></a>
			</h3>
			<div>
				<p>
					<button onclick="newTopic(<? echo $c->cid; ?>)">New Topic</button>
					<div class="clear"></div>
					<ul>
						<? $i=0; 
						   foreach($topic[$c->cid]->result() as $t): ?>
							<li onclick="window.location='/main/topic/<?= $t->tid ?>/'">
								<span><? echo date('m-d-Y @h:i A', $t->updated); ?></span>
								<p><?= $t->title; $i++; ?></p>
							</li>
						<? endforeach; 
						   if ($i==0) echo '<li>No Topics</li>'; ?> 
					</ul>
				</p>
			</div>
	<?php endforeach; ?>
</div>
<? require_once('footer.php'); ?>