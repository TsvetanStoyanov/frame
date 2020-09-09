<?php

namespace App\Controllers;


use App\Models\Home;
use App\Models\Weather;
use Core\Controller;
use Core\Router;

use App\Models\Users;
use Core\DB;

class WeatherController extends Controller
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

        $this->view->weather = $favouriteQ;


        // Get from model
        $weatherModel = new Weather();
        $books = $weatherModel->find_all_books();
        $this->view->books = $books;

        $this->view->render('weather/index');
    }
}