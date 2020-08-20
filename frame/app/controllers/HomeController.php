<?php

namespace App\Controllers;


use App\Models\Home;
use Core\Controller;
use Core\Router;

use App\Models\Users;
use Core\DB;

class HomeController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {

        $homeModel = new Home();

        if (Users::current_user()) {

            $home = $homeModel->find_all_by_user_id(Users::current_user()->id);
            $this->view->home = $home;

            // get favourite books
            $db = DB::getInstance();

            $sql = "SELECT t1.`user_id`, `book_id`, t2.`id`, `name`, `isbn`, `description`, `image` FROM `favourite` AS t1 LEFT JOIN `books` AS t2 ON t1.`book_id` = t2.`id` WHERE (t1.`user_id`) = " . Users::current_user()->id;

            $favouriteQ = $db->query($sql)->results();

            $this->view->home = $favouriteQ;
        }


        $this->view->render('home/index');
    }

    public function viewAction($id)
    {
        $BooksModel = new Home();
        $books = $BooksModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if (!$books) {
            Router::redirect('books');
        }
        $this->view->book = $books;
        $this->view->render('books/details');
    }

    public function deleteAction($id)
    {
        $user_id = Users::current_user()->id;

        $homeModel = new Home();

        $favourite = $homeModel->delete_favourite($id);

        Router::redirect('home');
    }
}
