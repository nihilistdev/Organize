<?php

namespace app\controllers;

use app\core;
use app\utils;
use app\models;
use app\prezenter;
use app\progress;

/**
 * User
 *
 * @author Filip Ivanusec<fivanusec@gmail.com>
 * @version 0.1[ALPHA]
 */

class User extends core\Controller
{

    /**
     * Updateuser: Updates user in Database
     * @example user/updateuser
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $user
     */

    public function updateuser(string $user)
    {
        utils\Auth::checkAuth();

        if (!models\UpdateUser::updateuser($user)) {
            utils\Redirect::to("/public/user/editUser/{$user}");
        }
        utils\Redirect::to(500);
    }

    /**
     * createCard: Sends user ID to create card
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $userID
     */

    public function createCard(string $userID = "")
    {
        utils\Auth::checkAuth();

        if (!models\CreateCard::_create($userID)) {
            utils\Redirect::to("/public/user/dash/{$userID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * deletecard: Deletes card and all of it's content
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param $Card
     * @param string $userID
     */

    public function deletecard($Card, string $userID = "")
    {
        utils\Auth::checkAuth();

        if (models\Cards::getDelete($Card)) {
            utils\Redirect::to("/public/user/dash/{$userID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * updatecard: Deletes card and all of it's content
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param $Card
     * @param string $userID
     */

    public function updateCard($Card, string $userID)
    {
        utils\Auth::checkAuth();
        if (models\UpdateCard::_update($Card)) {
            utils\Redirect::to("/public/user/dash/{$userID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * createTodo: Sends TODO ID to create TODO card
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $userID
     * @param string $TodoID
     */

    public function createTodo(string $userID = "", string $TodoID = "")
    {
        utils\Auth::checkAuth();

        if (!models\CreateTodo::_create($TodoID)) {
            utils\Redirect::to("/public/user/todo/{$userID}/{$TodoID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * updateTodo: Updates TODO
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param $TodoListID
     * @param $TodoID
     * @param string $userID
     */

    public function updateTodo($TodoListID, $TodoID, string $userID)
    {
        utils\Auth::checkAuth();

        if (models\UpdateTodo::_update($TodoListID)) {
            utils\Redirect::to("/public/user/todo/{$userID}/{$TodoID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * updateTodo: Deletes TODO
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param $Todo_ID
     * @param string $userID
     * @param $TodoID
     */

    public function deleteTodo($Todo_ID, $userID, $TodoID)
    {
        utils\Auth::checkAuth();

        if (models\Todo::getDelete($Todo_ID)) {
            utils\Redirect::to("/public/user/todo/{$userID}/{$TodoID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * uploadProfilePictrue: Creates and uploads profile pictrue to /img
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param $User_ID
     */

    public function uploadProfilePictrue($User_ID)
    {
        utils\Auth::checkAuth();

        if (models\UploadProfilePictrue::_upload($User_ID)) {
            if (models\UploadProfilePictrue::_createDB($User_ID)) {
                utils\Redirect::to("/public/user/editUser/{$User_ID}");
            }
        }
        utils\Redirect::to(500);
    }

    /**
     * createTodoListItem: Creates and puts todo list item in database
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $User_ID
     * @param string $TodoID
     * @param string $TodoListID
     */

    public function createTodoListItem(string $User_ID, string $TodoID, string $TodoListID)
    {
        utils\Auth::checkAuth();

        if (!models\CreateTodoListItem::_create($TodoListID)) {
            utils\Redirect::to("/public/user/todolist/{$User_ID}/{$TodoID}/{$TodoListID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * deleteTodoListItem: Finds and deletes todo list item from database
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $User_ID
     * @param string $Todo_ID
     * @param string $TodoListID
     * @param string $TodoItemID
     */

    public function deleteTodoListItem(string $User_ID, string $TodoID, string $TodoListID, string $TodoItemID)
    {
        utils\Auth::checkAuth();

        if (models\TodoList::getDelete($TodoItemID)) {
            utils\Redirect::to("/public/user/todolist/{$User_ID}/{$TodoID}/{$TodoListID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * updateTodoListItem: Finds and updates todo list item name from database
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $User_ID
     * @param string $Todo_ID
     * @param string $TodoListID
     * @param string $TodoItemID
     */

    public function updateTodoListItem(string $User_ID, string $TodoID, string $TodoListID, string $TodoItemID)
    {
        utils\Auth::checkAuth();

        if (models\UpdateTodoItem::_update($TodoItemID)) {
            utils\Redirect::to("/public/user/todolist/{$User_ID}/{$TodoID}/{$TodoListID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * finsih: Finds and updates todo list item completion to 1 in database
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $User_ID
     * @param string $Todo_ID
     * @param string $TodoListID
     * @param string $TodoItemID
     */

    public function finishTask(string $User_ID, string $TodoID, string $TodoListID, string $TodoItemID)
    {
        utils\Auth::checkAuth();

        if (models\UpdateTodoItem::_finish($TodoItemID)) {
            utils\Redirect::to("/public/user/todolist/{$User_ID}/{$TodoID}/{$TodoListID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * createNote: Creates note on Todo list page
     * @access public
     * @return void
     * @since ALPHA[0.1]
     * @param string $User_ID
     * @param string $TodoID
     * @param string $TodoListID
     */

    public function createNote(string $User_ID, string $TodoID, string $TodoListID)
    {
        utils\Auth::checkAuth();

        if (!models\CreateNote::_create($TodoListID)) {
            utils\Redirect::to("/public/user/todolist/{$User_ID}/{$TodoID}/{$TodoListID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * updateNote: Finds and updates notes data acording to textarea on Todo list page
     * @access public
     * @return void
     * @since ALPHA[0.1]
     * @param $NoteID
     * @param string $User_ID
     * @param string $TodoID
     * @param string $TodoListID
     */

    public function updateNote(string $NoteID, string $User_ID, string $TodoID, string $TodoListID)
    {
        utils\Auth::checkAuth();

        if (!models\updateNote::_update($NoteID)) {
            utils\Redirect::to("/public/user/todolist/{$User_ID}/{$TodoID}/{$TodoListID}");
        }
        utils\Redirect::to(500);
    }

    /**
     * Todo: Renders TODO View
     * @example user/todo
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $user
     * @param string $TodoID
     */

    public function todo(string $user = "", string $TodoID = "")
    {
        utils\Auth::checkAuth();

        if ($user) {
            if (utils\Session::sessionExists(utils\Config::get("SESSION_USER"))) {
                $user = utils\Session::get(utils\Config::get("SESSION_USER"));
            }
        }

        if (!$User = models\User::getInstance($user)) {
            utils\Redirect::to(APP_URL);
        }

        if ($TodoID) {
            if ($Todo = models\Todo::getInstance($TodoID)) {
                $todo = $Todo->data();
            } else {
                $todo = [];
            }

            $progress = [];

            for ($count = 0; $count < count($todo); $count++) {
                if ($TodoList = models\TodoList::getInstance($todo[$count]->Todo_List_ID)) {
                    $TodoListData[$count] = $TodoList->data();
                    $progress[$count] = (new progress\TodoList($TodoList->data()))->checkProgress();
                } else {
                    $TodoListData = [];
                    $progress = [];
                }
            }
        }

        $check = [];

        for ($count = 0; $count < count($progress); $count++) {
            if ($progress[$count]->Progress == $progress[$count]->Data) {
                $check[$count] = true;
            } else {
                $check[$count] = false;
            }
        }

        $this->View->addCSS("css/todo.css");
        $this->View->addJS("JS/todo.js");
        $this->View->render(
            'user/todo',
            [
                'title' => 'Todo',
                'user' => (new prezenter\User($User->data()))->present(),
                'todoID' => $TodoID,
                'Todo_List' => ($todo),
                'check' => ($check)
            ]
        );
    }

    /**
     * Dash: Renders DASH View
     * @example user/dash
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $user
     */

    public function dash(string $user = "")
    {

        utils\Auth::checkAuth();

        if ($user) {
            if (utils\Session::sessionExists(utils\Config::get("SESSION_USER"))) {
                $user = utils\Session::get(utils\Config::get("SESSION_USER"));
            }
        }

        if (!$User = models\User::getInstance($user)) {
            utils\Redirect::to(APP_URL);
        }

        if ($Card = models\Cards::getInstance($user)) {
            $cards = $Card->data();
        } else {
            $cards = [];
        }

        // $picture = "img/user.png";
        //
        // if ($ProfilePicture = models\ProfilePictrue::getInstance($user)) {
        //     $profilepictrue = $ProfilePicture->data();
        //     if (!empty($profilepictrue)) {
        //         $picture = $profilepictrue->Image_Dir;
        //     }
        // }
        //
        // $this->View->addIMG($picture);
        $this->View->addJS("JS/organizeDash.js");
        $this->View->addCSS("css/organizeDash.css");
        $this->View->render(
            'user/dash',
            [
                'title' => "Dash",
                'user' => (new prezenter\User($User->data()))->present(),
                'cards' => ($cards)
            ]
        );
    }

    /**
     * TodoList: Renders Todo list view
     * @example user/todo
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param string $user
     * @param string $TodoID
     * @param string $odoListID
     */

    public function todoList(string $user = "", string $TodoID = "", string $todoListID = "")
    {

        utils\Auth::checkAuth();

        if ($user) {
            if (utils\Session::sessionExists(utils\Config::get("SESSION_USER"))) {
                $user = utils\Session::get(utils\Config::get("SESSION_USER"));
            }
        }

        if (!$User = models\User::getInstance($user)) {
            utils\Redirect::to(APP_URL);
        }

        if ($todoListID) {
            if ($TodoList = models\TodoList::getInstance($todoListID)) {
                $todolist = $TodoList->data();
            } else {
                $todolist = [];
            }
        }

        if ($todoListID) {
            if ($Notes = models\Notes::getInstance($todoListID)) {
                $notes = $Notes->data();
            } else {
                $notes = [];
            }
        }

        $this->View->addCSS("css/todoList.css");
        $this->View->addJS("JS/TodoList.js");
        $this->View->render(
            'user/todo_list',
            [
                'title' => 'Todo List',
                'user' => (new prezenter\User($User->data()))->present(),
                'todolist' => ($todolist),
                'todolistID' => $todoListID,
                'notes' => ($notes),
                'todoID' => $TodoID
            ]
        );
    }

    /**
     * Edituser: Render edit user view
     * @example user/edituser
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     * @param $user
     */

    public function editUser(string $user = "")
    {
        utils\Auth::checkAuth();

        if ($user) {
            if (utils\Session::sessionExists(utils\Config::get("SESSION_USER"))) {
                $user = utils\Session::get(utils\Config::get("SESSION_USER"));
            }
        }

        if (!$User = models\User::getInstance($user)) {
            utils\Redirect::to(APP_URL);
        }

        $picture = "img/user.png";

        // if ($ProfilePicture = models\ProfilePictrue::getInstance($user)) {
        //     $profilepictrue = $ProfilePicture->data();
        //     echo $profilepictrue;
        //     if (!empty($profilepictrue)) {
        //         $picture = $profilepictrue->Image_Dir;
        //     }
        // }
        //
        // echo $picture;
        // $this->View->addIMG($picture, "mx-auto img-fluid rounded-circle");
        $this->View->addJS("JS/edituser.js");
        $this->View->addCSS("css/editUser.css");
        $this->View->render(
            'user/editUser',
            [
                'title' => 'Edit user',
                'user' => (new prezenter\User($User->data()))->present()
            ]
        );
    }
}

//EOF
