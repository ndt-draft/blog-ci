<?php foreach ($posts as $post) : ?>

<article class="post-<?php echo $post['id']; ?>">
	<h2><?php echo $post['title']; ?></h2>

	<div class="content"><?php echo $post['content']; ?></div>

	<?php if ($teaser) : ?>
		<?php echo anchor('blog/' . $post['slug'], 'Read more'); ?>
	<?php endif; ?>
</article>

<?php endforeach; ?>
