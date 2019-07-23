<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{

	  public function login()
    {
        if($this->request->is('post'))
        {
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else
            {
                $this->Flash->error('Datos son invalidos, por favor intente nuevamente', ['key' => 'auth']);
            }
        }

}


    public function home(){
    	$this->render();
    }

	public function index(){
		$users = $this->Users->find('all');
		$this->set('users',$users);
	}

	public function add (){
	$user  =  $this -> Users -> newEntity ();
	if ($this->request->is('post')) {
		$user = $this->Users->patchEntity($user, $this->request->data);
		 if ($this->Users->save($user)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
	}
	$this->set('user', $user);
	}
}
