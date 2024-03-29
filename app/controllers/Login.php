<?php

namespace app\controllers;

use app\core;
use app\models;
use app\utils;

/** 
 * 
 * Login controller: extends Core\Controller in whicih calls View to render.
 * 
 * @author Filip Ivanusec<fivanusec@gmail.com>
 * @version 0.1[ALPHA]
 */

class Login extends core\Controller
{

    /**
     * Initializes variables for usage in Login controller
     */

    protected $ID = null;

    /**
     * Index: Renders login/index controller 
     * @example login/index
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     */

    public function index()
    {
        utils\Auth::checkUnAuth();
        
        $this->View->addCSS("css/signin.css");
        $this->View->addJS("JS/signin.js");
        $this->View->renderMain(
            'login/index',
            [
                'title' => 'Log in'
            ]
        );
    }

    /**
     * Register: Checks if user is authenticated and starts the registering process
     * @example register/_register
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     */

    public function register()
    {
        utils\Auth::checkUnAuth();

        if (!models\UserRegister::_register()) {
            utils\Redirect::to("/public/Login/index");
        }
        utils\Redirect::to("/public/Login/index");
    }

    /**
     * Login: calls the model UserLogin and checks
     * if user exists in database
     * @example login/_login
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     */

    public function login()
    {
        utils\Auth::checkUnAuth();
        if (models\UserLogin::_login()) {
            $this->ID = utils\Session::get(utils\Config::get("SESSION_USER"));
            utils\Redirect::to("/public/User/dash/{$this->ID}");
        }
        utils\Redirect::to("/public/Login/index");
    }

    public function _loginWithCookie()
    {
        utils\Auth::checkUnAuth();

        if (models\UserLogin::loginWithCookie()) {
            $this->ID = utils\Session::get(utils\Config::get("SESSION_USER"));
            utils\Redirect::to("/public/User/dash/{$this->ID}");
        }
        utils\Redirect::to("/public/Login/index");
    }

    /**
     * Logout: checks if user is logged in and if user is logged in
     * than deletes session in whici is user logged in
     * @example login/_logout
     * @access public
     * @return void
     * @since 0.1[ALPHA]
     */

    public function logOut($user = "")
    {
        if ($user) {
            utils\Auth::checkAuth();

            if (models\UserLogin::_logout()) {
                utils\Redirect::to("/public/Login/index");
            }
        }
        utils\Redirect::to("/public/User/dash/{$user}");
    }
}

//EOF
