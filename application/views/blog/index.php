<?php foreach ($posts as $post) : ?>

<article class="post-<?php echo $post['id']; ?>">
	<h2><?php echo $post['title']; ?></h2>

	<div class="content"><?php echo $post['content']; ?></div>

	<?php if ($teaser) : ?>
		<?php echo anchor('blog/show/' . $post['slug'], 'Read more'); ?>
	<?php else : ?>
		<?php echo anchor('blog/update/' . $post['slug'], 'Update'); ?>
		<?php echo anchor('blog/delete/' . $post['slug'], 'Delete'); ?>
	<?php endif; ?>
</article>

<?php endforeach; ?>
