<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 25/10/2015
 * Time: 14:03
 */

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    public $avatarUploadDir = 'img/avatars';

    public $validate = array(
        'username' => array(
            'nonEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'A username is required',
                'allowBlank' => false
            ),
            'between' => array(
                'rule' => array('between', 2, 15),
                'required' => true,
                'message' => 'Usernames must be between 5 to 15 characters'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'A password is required'
            ),
        ),

        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin')),
                'message' => 'Please enter a valid role',
                'allowBlank' => false
            )
        ),

    );

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }

        // fallback to our parent
        return parent::beforeSave($options);
    }

}