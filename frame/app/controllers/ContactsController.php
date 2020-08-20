<?php

namespace App\Controllers;

use Core\Controller;
use Core\Session;
use Core\Router;
use App\Models\Contacts;
use App\Models\Users;

class ContactsController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        $this->view->set_layout('default');
        $this->load_model('Contacts');
    }


    public function indexAction()
    {
        $ContactsModel = new Contacts();

        $contacts = $ContactsModel->find_all_by_user_id(Users::current_user()->id, ['order' => 'fname, id']);
        $this->view->contacts = $contacts;
        $this->view->render('contacts/index');
    }

    public function addAction()
    {
        $contact = new Contacts();

        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $contact->assign($this->request->get());
            $contact->user_id = Users::current_user()->id;

            if ($contact->save()) {
                Router::redirect('contacts');
            }
        }
        $this->view->contact = $contact;
        $this->view->displayErrors = $contact->get_error_messages();
        $this->view->postAction = PROOT . 'contacts' . DS . 'add';
        $this->view->render('contacts/add');
    }

    public function editAction($id)
    {
        $ContactsModel = new Contacts();
        $contact = $ContactsModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);
        if (!$contact) {
            Router::redirect('contacts');
        }
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $contact->assign($this->request->get());
            if ($contact->save()) {
                Router::redirect('contacts');
            }
        }

        $this->view->displayErrors = $contact->get_error_messages();
        $this->view->contact = $contact;
        $this->view->postAction = PROOT . 'contacts' . DS . 'edit' . DS . $contact->id;
        $this->view->render('contacts/edit');
    }


    public function detailsAction($id)
    {
        $ContactsModel = new Contacts();
        $contact = $ContactsModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if (!$contact) {
            Router::redirect('contacts');
        }
        $this->view->contact = $contact;
        $this->view->render('contacts/details');
    }

    public function deleteAction($id)
    {
        $ContactsModel = new Contacts();
        $contact = $ContactsModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if ($contact) {
            $contact->delete();
            Session::add_msg('success', 'Contact has been deleted');
        }
        Router::redirect('contacts');
    }
}
