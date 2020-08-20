<?php

namespace App\Controllers;

use App\Models\Books;
use App\Models\Calendar;
use Core\Controller;
use Core\Session;
use Core\Router;

use App\Models\Users;

class BooksController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        $this->view->set_layout('default');
        $this->load_model('Books');
    }


    public function indexAction()
    {
        $BooksModel = new Books();

        if (Users::current_user()->acl == 'Admin') {
            $books = $BooksModel->find_all();
        } else {
            $books = $BooksModel->find_all_by_user_id(Users::current_user()->id);
        }


        $this->view->books = $books;
        $this->view->render('books/index');

        if (isset($_GET['favourite'])) {
            Users::favourite();
        }
    }

    public function createAction()
    {
        $books = new Books();

        if ($this->request->isPost()) {
            // $this->request->csrfCheck();
            $books->assign($this->request->get());
            if ($books->save()) {
                // Router::redirect('books');
            }
        }
        $this->view->books = $books;
        $this->view->displayErrors = $books->get_error_messages();
        $this->view->postAction = PROOT . 'books' . DS . 'create';
        $this->view->render('books/create');
    }

    public function editAction($id)
    {
        $BooksModel = new Books();

        $books = $BooksModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);
        if (!$books) {
            $this->view->postAction = PROOT . 'books' . DS . 'edit' . DS . $books->id;
            // Router::redirect('books');
        }
        if ($this->request->isPost()) {
            // $this->request->csrfCheck();
            $books->assign($this->request->get());
            if ($books->save()) {
                // Router::redirect('books/edit/1');
            }
        }

        $this->view->displayErrors = $books->get_error_messages();
        $this->view->books = $books;
        $this->view->postAction = PROOT . 'books' . DS . 'edit' . DS . $books->id;
        $this->view->render('books/edit');
    }


    public function viewAction($id)
    {
        $BooksModel = new Books();
        $books = $BooksModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if (!$books) {
            Router::redirect('books');
        }
        $this->view->book = $books;
        $this->view->render('books/details');
    }

    public function deleteAction($id)
    {
        $BooksModel = new Books();
        $books = $BooksModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if ($books) {
            $books->delete();
            // Session::create_msg('success', 'Contact has been deleted');
        }
        Router::redirect('books');
    }
}
