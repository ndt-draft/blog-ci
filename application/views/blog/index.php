<?php foreach ($posts as $post) : ?>

	<article id="post-<?php echo $post['id']; ?>" class="post">
		<header class="entry-header">
			<h2 class="entry-title"><?php echo $post['title']; ?></h2>
		</header>

		<div class="entry-content">
			<?php echo nl2br($post['content']); ?>
		</div>

		<div class="entry-actions">
			<?php if ($teaser) : ?>
				<?php echo anchor('blog/show/' . $post['slug'], 'Read more', array('class' => 'btn btn-default')); ?>
			<?php else : ?>
				<?php echo anchor('blog/update/' . $post['slug'], 'Update', array('class' => 'btn btn-primary')); ?>
				<?php echo anchor('blog/delete/' . $post['slug'], 'Delete', array( 'class' => 'btn btn-danger' )); ?>
			<?php endif; ?>
		</div>
	</article>

<?php endforeach; ?>
