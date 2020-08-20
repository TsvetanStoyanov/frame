<?php

namespace App\Controllers;

use App\Models\Calendar;
use Core\Controller;
use Core\Session;
use Core\Router;

use App\Models\Users;

class CalendarController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

        $this->view->set_layout('default');
        $this->load_model('Calendar');
    }


    public function indexAction()
    {
        $CalendarModel = new Calendar();

        if (Users::current_user()->acl == 'Admin') {
            $events = $CalendarModel->find_all();
        } else {
            $events = $CalendarModel->find_all_by_user_id(Users::current_user()->id);
        }


        $this->view->events = $events;
        $this->view->render('calendar/index');
    }

    public function addAction()
    {
        $calendar = new Calendar();

        if ($this->request->isPost()) {
            // $this->request->csrfCheck();
            $calendar->assign($this->request->get());
            if ($calendar->save()) {
                Router::redirect('calendar');
            }
        }
        $this->view->calendar = $calendar;
        $this->view->displayErrors = $calendar->get_error_messages();
        $this->view->postAction = PROOT . 'calendar' . DS . 'add';
        $this->view->render('calendar/add');
    }

    public function editAction($id)
    {
        $CalendarModel = new Calendar();
        $calendar = $CalendarModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);
        if (!$calendar) {
            $this->view->postAction = PROOT . 'calendar' . DS . 'edit' . DS . $calendar->id;
            // Router::redirect('calendar');
        }
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
            $calendar->assign($this->request->get());
            if ($calendar->save()) {
                Router::redirect('calendar');
            }
        }

        $this->view->displayErrors = $calendar->get_error_messages();
        $this->view->calendar = $calendar;
        $this->view->postAction = PROOT . 'calendar' . DS . 'edit' . DS . $calendar->id;
        $this->view->render('calendar/edit');
    }


    public function detailsAction($id)
    {
        $CalendarModel = new Calendar();
        $calendar = $CalendarModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if (!$calendar) {
            Router::redirect('calendar');
        }
        $this->view->contact = $calendar;
        $this->view->render('calendar/details');
    }

    public function deleteAction($id)
    {
        $CalendarModel = new Calendar();
        $calendar = $CalendarModel->find_by_id_and_user_id((int) $id, Users::current_user()->id);

        if ($calendar) {
            $calendar->delete();
            Session::add_msg('success', 'Contact has been deleted');
        }
        Router::redirect('calendar');
    }
}
