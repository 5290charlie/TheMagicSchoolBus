<div id="accordion">
	<?php
		foreach($category->result( ) as $c): ?>
			<h3>
				<span id="updates">
					Updated: <?= str_replace(array("-", "@"), array("/", " "), (string)date('m-d-Y @h:i A', $c->updated)); ?>
				</span>
				<a><?= $c->title; ?> - (<?= $numTopics[$c->cid]; ?>)</a>
			</h3>
			<div>
				<p>
					<button onclick="newTopic(<? echo $c->cid; ?>)">New <?= $c->title; ?> Topic</button>
					<div class="inner-header"><?= $numTopics[$c->cid]; ?> Topics</div>
					<div class="clear"></div>
					<ul>
						<? $i=0; 
						   foreach($topic[$c->cid]->result() as $t): 
						   if (($i%2)==0) $class='mod'; else $class=''; ?>
							<li onclick="window.location='/main/topic/<?= $t->tid ?>/'">
								<span>
									Updated: <?= str_replace(array("-", "@"), array("/", " "), (string)date('m-d-Y @h:i A', $t->updated)); ?>
									<br />
									User: <a href="/main/account/<?= $t->username; ?>/"><?= $t->username; ?></a>
									<br />
									Posts: <?= $numPosts[$t->tid]; ?>
									<br />
									Views: <?= $t->views; ?>
								</span>
								<p>
									<?= $t->title; $i++; ?>
									<br />
									<span>Details: <?= $t->details; ?></span>
								</p>
							</li>
						<? endforeach; 
						   if ($i==0) echo '<li><p>No Topics</p></li>'; ?> 
					</ul>
				</p>
			</div>
	<?php endforeach; ?>
</div>
