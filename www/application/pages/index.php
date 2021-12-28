<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>



<ul>
	<?php if(!empty($pages)): foreach($pages as $page):?>
	<li>
		<span>
			<?php echo $page['name'];?>
		</span>
		<span>
			<?php echo substr($page['content'], 0, 100);?>
		</span>
		<span>
			<a href="<?php echo site_url() . '/pages/edit/' . $page['name'];?>">Edit this page</a>
		</span>
	</li>

	<?php endforeach; endif;?>
</ul>

<!--
<div>
<a href="/pages/create">Create new page</a>
</div>
-->