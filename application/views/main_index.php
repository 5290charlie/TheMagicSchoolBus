<div id="accordion">
	<?php
		foreach($category->result() as $c): ?>
			<h3>
				<span>
					Updated: <?= date('m-d-Y @h:i A', $c->updated); ?>
				</span>
				<a><?= $c->title; ?> [<?= $c->topics; ?>]</a>
			</h3>
			<div>
				<p>
					<button onclick="newTopic(<? echo $c->cid; ?>)">New <?= $c->title; ?> Topic</button>
					<div class="clear"></div>
					<ul>
						<? $i=0; 
						   foreach($topic[$c->cid]->result() as $t): ?>
							<li onclick="window.location='/main/topic/<?= $t->tid ?>/'">
								<span>
									Updated: <?= date('m-d-Y @h:i A', $t->updated); ?>
									<br />
									Created By: <?= $t->username; ?>
									<br />
									Views: <?= $t->views; ?>
								</span>
								<p>
									<?= $t->title; $i++; ?>
									<br />
									Details: <?= $t->details; ?>
								</p>
							</li>
						<? endforeach; 
						   if ($i==0) echo '<li><p>No Topics</p></li>'; ?> 
					</ul>
				</p>
			</div>
	<?php endforeach; ?>
</div>
