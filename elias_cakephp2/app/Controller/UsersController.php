<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 25/10/2015
 * Time: 14:05
 */

App::uses('AppController', 'Controller');

class UsersController  extends AppController{

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add');
    }



    public function login() {

        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Flash->success(__('Welcome, '. $this->Auth->user('username')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Invalid username or password'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been created'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The user could not be created. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            $this->Flash->error('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            $this->Flash->error('Invalid User ID Provided');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been updated'));
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Flash->error(__('Unable to update your user.'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
        $this->set('user', $user);
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Flash->error('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Flash->error('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->delete($id)) {
            $this->Flash->success(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
} 