<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View news items'), array('action' => 'index')) ?></li>
    </ul>
</nav>
<div class="form large-9 medium-8 columns content">


    <h2 class="title"><?php echo h($newsItem['News']['title']); ?></h2>

    <p><?php echo h($newsItem['News']['publish_date']); ?></p>

    <p> <?php echo h($newsItem['News']['body']); ?></p>
    <p> <?php echo $this->Html->image($newsItem['News']['image'], array('alt' => 'Image is not available', 'size' => '200px')); ?></p>

</div>

