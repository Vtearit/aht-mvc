<?php
namespace mvc\Controllers;

use mvc\Core\Controller;
use mvc\Core\Model;
use mvc\Models\Task;
use mvc\Models\TaskModel;
use mvc\Models\TaskRepository;

class tasksController extends Controller
{
    function index()
    {
        $task = new TaskRepository();

        $d['tasks'] = $task->getAll();
        $this->set($d);
        $this->render("index");
    }

    function edit($id)
    {
        $task = new TaskRepository();
        $d["task"] = $task->get($id);
        if (isset($_POST["title"]))
        {
            $taskM=new TaskModel();
            $taskM->setId($id);
            $taskM->setTitle($_POST['title']);
            $taskM->setDescription($_POST['description']);
            $taskM->setUpdated_at(date("Y-m-d H:i:s"));

            $taskR= new TaskRepository();

            if ($taskR->edit($taskM)){

                header("Location: " . WEBROOT . "Tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function create()
    {
        // if (isset($_POST["title"]))
        // {
        //     // require(ROOT . 'Models/Task.php');

        //     // $task = new TaskModel();
        //     // $task->setTitle($_POST["title"]);
        //     // $task->setDescription($_POST["description"]);
        //     // $task->setCreated_at(date("Y-m-d H:i:s"));

        //     $task = new TaskRepository();
        //     if ($task->add($_POST["title"], $_POST["description"], date("Y-m-d H:i:s")))
        //     {
        //         header("Location: " . WEBROOT . "tasks/index");
        //     }
        // }

        // $this->render("create");
        if (isset($_POST["title"]))
        {
            
            $taskM= new TaskModel();
            $taskM->setTitle($_POST['title']);
            $taskM->setDescription($_POST['description']);
            $taskM->setCreated_at(date("Y-m-d H:i:s"));

            $taskR=new TaskRepository();
            if ($taskR->add($taskM)){
                header("Location: " . WEBROOT . "Tasks/index");
            }

        }

        $this->render("create");
    }

    // function create()
    // {
    //     if (isset($_POST["title"]))
    //     {
    //         // require(ROOT . 'Models/Task.php');

    //         $task= new Task();

    //         if ($task->create($_POST["title"], $_POST["description"]))
    //         {
    //             header("Location: " . WEBROOT . "tasks/index");
    //         }
    //     }

    //     $this->render("create");
    // }

    // function edit($id)
    // {
    //     // require(ROOT . 'Models/Task.php');
    //     $task= new Task();

    //     $d["task"] = $task->showTask($id);

    //     if (isset($_POST["title"]))
    //     {
    //         if ($task->edit($id, $_POST["title"], $_POST["description"]))
    //         {
    //             header("Location: " . WEBROOT . "tasks/index");
    //         }
    //     }
    //     $this->set($d);
    //     $this->render("edit");
    // }

    function delete($id)
    {
        $task = new TaskRepository();
        $model = new TaskModel();
        $model->setId($id);

        if ($task->delete($model))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}