<?php

namespace App\Controllers;

use App\Models\Admin;
use Core\Controller;
use Core\Router;
use App\Models\Users;
use Core\H;
use Core\FH;

class AdminController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        $this->view->set_layout('default');
        $this->load_model('Admin');
    }


    public function indexAction()
    {
        $AdminModel = new Admin();

        $users = $AdminModel->find_all_users();

        $this->view->users = $users;
        $this->view->render('admin/index');
    }

    public function usersAction()
    {
        $AdminModel = new Admin();

        $users = $AdminModel->find_all_users();
        $this->view->users = $users;

        // var_dump($users);


        $this->view->render('admin/users');
    }

    public function editAction($id)
    {
        $AdminModel = new Admin();
        $admin = $AdminModel->find_by_id_and_user_id((int)$id, Users::current_user()->id);



        // Only super admins have full permissions 
        if (Users::current_user()->acl != 'Super_admin' && Users::current_user()->id != (int)$id) {
            Router::redirect('admin');
        }


        if ($this->request->isPost()) {
            // $this->request->csrfCheck();
            $admin->assign($this->request->get());

            // get image upload from core helper
            if (isset($_POST["submit"])) {
                $target_dir  = '/var/www/html/frame/images/admin/';
                if (H::image($target_dir) == 1) {

                    $modal = FH::modal('danger', 'This image is too large', 'This is not saved');
                    // return in view side
                    $this->view->modal = $modal;
                } else {
                    $modal = FH::modal('success', 'Saved', 'done');
                    $this->view->modal = $modal;

                    $admin->save();
                }
            }

            // $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        }
        
        $this->view->displayErrors = $admin->get_error_messages();
        $this->view->admin = $admin;
        
        
        $this->view->admin = $admin;

        $this->view->postAction = PROOT . 'admin' . DS . 'edit' . DS . $admin->id;
        $this->view->render('admin/edit');
    }

    public function userAction($id)
    {
        $AdminModel = new Admin();
        $admin = $AdminModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if (!$admin) {
            Router::redirect('admin');
        }
        $this->view->admin = $admin;
        $this->view->render('admin/user');
    }
}
