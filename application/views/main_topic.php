<div id="accordion">
		<h3><a><? echo $topic->title; ?></a></h3>
		<div>
			<p>
				<button onclick="newPost(<? echo $topic->tid; ?>)">New Post</button>
				<div class="clear"></div>
				<ul>
					<? $i=0; foreach($post->result() as $p) { ?>
						<li>
							<span><? echo date(DATE_FORMAT, $p->date); ?></span>
							<p><? echo $p->text; $i++; ?></p>
						</li>
					<? } if ($i==0) echo '<li><p style="text-align:center;">No Posts</p></li>'; ?>
				</ul>
			</p>
		</div>
</div>