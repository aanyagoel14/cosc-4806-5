<?php

class Reports extends Controller {
    public $components = array('Auth');

    public function beforeFilter() {
        parent::beforeFilter();
        if (!$this->Auth->loggedIn() || $this->Auth->user('role') !== 'admin') {
            $this->Session->setFlash('Admin access required');
            $this->redirect('/');
        }
    }

    public function index() {
        $this->loadModel('Reminder');
        $this->set('reminders', $this->Reminder->find('all'));
    }
}