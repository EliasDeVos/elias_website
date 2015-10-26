<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 25/10/2015
 * Time: 11:06
 */

class News extends AppModel{

    public $validate = array(
        'title' => array(
            'rule' => 'notBlank',
            'message' => 'title can not be empty'
        ),
        'body' => array(
            'rule' => 'notBlank',
            'message' => 'body can not be empty'
        )
    );
} 