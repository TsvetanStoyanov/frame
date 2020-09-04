<?php

namespace App\Controllers;


use App\Models\Home;
use App\Models\Invoicing;
use Core\Controller;
use Core\Router;

use App\Models\Users;
use Core\DB;

class InvoicingController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }


    public function indexAction()
    {

        // Get from Query 
        $db = DB::getInstance();

        $sql = "SELECT * from `books`";

        $favouriteQ = $db->query($sql)->results();

        $this->view->invoicing = $favouriteQ;


        // Get from model
        $InvoicingModel = new Invoicing();
        $books = $InvoicingModel->find_all_books();
        $this->view->books = $books;

        $this->view->render('invoicing/index');
    }
}
