<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?php
            if ($role == 'admin')
            {
                echo $this->Html->link(__('Log out'), ['controller' => 'Users', 'action' => 'logout']);
            }
            else
            {
                echo $this->Html->link(__('Log in'), ['controller' => 'Users', 'action' => 'login']);
            }
            ?>
            </li>
            <?php
            if ($role == 'admin')
            {
                echo "<li>";
                echo $this->Html->link(__('Manage users'), ['controller' => 'Users', 'action' => 'index']);
                echo "</li>";
            }
            ?>
        <?php
        if ($role == 'admin')
        {
            echo "<li>";
            echo $this->Html->link(__('Add news item'), ['controller' => 'News', 'action' => 'add']);
            echo "</li>";
        }
        ?>
    </ul>
</nav>
<div class="index large-9 medium-8 columns content">
    <h3><?= __('Bookmarks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('publish_date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($news as $newsItem): ?>
            <tr>
                <td><?= h($newsItem['News']['id']) ?></td>
                <td><?= h($newsItem['News']['title']) ?></td>
                <td><?= h($newsItem['News']['publish_date']) ?></td>
                <td>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $newsItem['News']['id']]) ?>
                    <?php
                    if ($role == 'admin')
                    {
                        echo $this->Html->link(__('Edit'), ['action'   => 'edit', $newsItem['News']['id']]);
                        echo " ";
                        echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $newsItem['News']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                    }
                    ?>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
