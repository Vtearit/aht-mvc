<?php
namespace mvc\Models;

use mvc\Models\TaskResourceModel;

class TaskRepository
{
    public $taskRepository;
    
    public function __construct()
    {
        $this->taskRepository = new TaskResourceModel();
    }

    public function add($model)
    {
        return $this->taskRepository->save($model);
    }

    public function get($id)
    {
        return $this->taskRepository->get($id);
    }
    
    public function delete($model)
    {
        return $this->taskRepository->delete($model);
    }

    public function getAll()
    {
        return $this->taskRepository->getAll();
    }

    public function edit($model){
        return $this->taskRepository->save($model);
    }
}