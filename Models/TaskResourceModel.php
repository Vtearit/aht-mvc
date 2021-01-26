<?php

    namespace mvc\Models;

    use mvc\Core\ResourceModel;
    use mvc\Models\TaskModel;

    class TaskResourceModel extends ResourceModel
    {
        public function __construct()
        {
            parent::_init('tasks', 'id', new TaskModel);
        }
    }

?>