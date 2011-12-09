<div id="accordion">
	<?php
		foreach($category->result() as $c): ?>
			<h3>
				<a><?= $c->cid . ' ' . $c->title; ?></a>
				<br />
				<?= $c->updated; ?>
			</h3>
			<div>
				<p>
					<button onclick="newTopic(<? echo $c->cid; ?>)">New Topic</button>
					<ul>
						<? $i=0; 
						   foreach($topic[$c->cid]->result() as $t): ?>
							<li>
								<a href="/main/topic/<?= $t->tid ?>/"><?= $t->title; $i++; ?></a>
								<br />
								<?= $t->updated; ?>
							</li>
						<? endforeach; 
						   if ($i==0) echo '<li>No Topics</li>'; ?> 
					</ul>
				</p>
			</div>
	<?php endforeach; ?>
</div>