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

        $db = DB::getInstance();

        $sql = "SELECT * from `books`";

        $favouriteQ = $db->query($sql)->results();

        $this->view->invoicing = $favouriteQ;
        $this->view->render('invoicing/index');
    }
}
