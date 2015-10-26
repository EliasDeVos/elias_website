<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('View news items'), array('action' => 'index')) ?></li>
    </ul>
</nav>
<div class="bookmarks form large-9 medium-8 columns content">
    <?php
    echo $this->Form->create('News', array('type'=>'file'));
    ?>
    <fieldset>
        <legend><?php echo __('Edit news feed'); ?></legend>
        <?php

        echo $this->Form->input('title');
        echo $this->Form->input('body', array('type' => 'textarea'));
        echo $this->Form->input('publish_date', array('class' => 'datepicker'));
        echo $this->Form->input('embargo_date', array('class' => 'datepicker'));
        echo $this->Form->input('image', array(
            'between' => '<br />',
            'type' => 'file',
            'label' => false
        ));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>