<?php

namespace App\Controllers;

use Core\Controller;
use Core\H;
use Core\Router;
use App\Models\Users;
use App\Models\Login;



class RegisterController extends Controller
{


    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->set_layout('default');
    }

    // PASSWORD = rasmuslerdorf //
    public function loginAction()
    {
        $login_model = new Login();
        $user_model = new Users();
        if ($this->request->isPost()) {
            //form validation
            $this->request->csrfCheck();
            $login_model->assign($this->request->get());
            $login_model->validator();
            if ($login_model->validation_passed()) {
                $user = $user_model->findByUsername($_POST['username']);
                // $user = $user_model->findByEmail($_POST['email']);

                if ($user && password_verify($this->request->get('password'), $user->password)) {
                    $remember = $login_model->get_remember_me_checked();
                    $user->login($remember);
                    Router::redirect('');
                } else {
                    $login_model->add_error_message('username', 'Your account is not verified');
                    // $login_model->add_error_message('email', 'Your account is not verified');
                }
            }
        }
        $this->view->login = $login_model;
        $this->view->displayErrors = $login_model->get_error_messages();
        $this->view->render('register/login');
    }

    public function logoutAction()
    {
        if (Users::current_user()) {
            Users::current_user()->logout();
        }
        Router::redirect('register/login');
    }

    public function registerAction()
    {
        $newUser = new Users();

        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            var_dump($this->request->get());
            $newUser->assign($this->request->get());

            $newUser->set_confirm($this->request->get('confirm'));

            if ($newUser->save()) {
                Router::redirect('register/login');
            }
        }

        $this->view->newUser = $newUser;
        $this->view->displayErrors = $newUser->get_error_messages();
        $this->view->render('register/register');
    }
}
