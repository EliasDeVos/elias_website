<?php

/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 25/10/2015
 * Time: 11:07
 */

App::uses('AppController', 'Controller');

class NewsController extends AppController
{

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Session');
    }

    public function index()
    {
        $news = $this->News->find('all', array('conditions' => array('News.embargo_date <' => date('Y-m-d H:i:s'))));
        $this->set('news', $news);
        $this->set('role', $this->Auth->user()['role']);
    }

    public function view($id = null)
    {
        $newsItem = $this->News->findById($id);
        $this->set('newsItem', $newsItem);
    }

    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid news item'));
        }

        $newsItem = $this->News->findById($id);
        if (!$newsItem) {
            throw new NotFoundException(__('Invalid news item'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['News']['image']))
            {
                $filename = $this->request->data['News']['image']['tmp_name'];
                move_uploaded_file($filename, WWW_ROOT . DS . 'img' . DS . $this->request->data['News']['image']['name']);
            }
            $this->News->id = $id;
            $this->request->data['News']['image'] = $this->request->data['News']['image']['name'];
            if ($this->News->save($this->request->data)) {
                $this->Flash->success(__('Your news item has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your news item.'));
        }

        if (!$this->request->data) {
            $this->request->data = $newsItem;
        }
        $this->set('newsItem', $newsItem);
    }

    public function beforeFilter() {
        $this->Auth->allow('index');
    }
    
    public function add()
    {
        $newsItem = $this->News->create();
        if ($this->request->is('post')) {
            if (isset($this->request->data['News']['image']))
            {
                $filename = $this->request->data['News']['image']['tmp_name'];
                move_uploaded_file($filename, WWW_ROOT . DS . 'img' . DS . $this->request->data['News']['image']['name']);
            }
            $this->request->data['News']['image'] = $this->request->data['News']['image']['name'];
            if ($this->News->save($this->request->data)) {
                $this->Flash->success(__('The news item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news item could not be saved. Please, try again.'));
            }
        }
        $this->set('newsItem', $newsItem);
    }

    public function delete($id)
    {
        if ($this->News->delete($id)) {
            $this->Flash->success(
                __('The news item has been deleted.')
            );
        } else {
            $this->Flash->error(
                __('The news item could not be deleted.')
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
} 