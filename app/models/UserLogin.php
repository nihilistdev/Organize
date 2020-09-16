<?php

namespace app\models;

use Exception;
use app\utils;


class UserLogin
{

    public static function remeberCookies($userID)
    {
        $Db = utils\Database::getIstance();
        $check = $Db->select("user_cookies", ["User_ID", "=", $userID]);
        if ($check->count()) {
            $hash = $check->first()->hash;
        } else {
            $hash = utils\Hash::generateUnique();
            if (!$Db->insert("user_cookies", ["User_ID" => $userID, "hash" => $hash])) {
                return false;
            }
        }
        $cookie = "user";
        $expiery = 604800;
        return (utils\Cookies::put($cookie, $hash, $expiery));
    }

    public static function loginWithCookie()
    {
        if (!utils\Cookies::exists(utils\Config::get("COOKIE_USER"))) {
            return false;
        }
        $Db = utils\Database::getIstance();
        $hash = utils\Cookies::get(utils\Config::get("COOKIE_USER"));
        $check = $Db->select("user_cookies", ["hash", "=", $hash]);
        if ($check->count()) {
            $userID = $Db->first()->user_id;
            if (($User = User::getInstance($userID))) {
                $data = $User->data();
                utils\Session::put(utils\Config::get("SESSION_USER"), $data->id);
                return true;
            }
        }
        utils\Cookies::delete(utils\Config::get("COOKIE_USER"));
        return false;
    }

    public static function _login()
    {
        $email = utils\Input::post("email");
        if (!$User = User::getInstance($email)) {
            utils\Flash::info(utils\Text::get("LOGIN_USER_NOT_FOUND"));
            return false;
        }
        try {
            $data = $User->data();
            $password = utils\Input::post("password");
            if (utils\Hash::generate($password, $data->salt) !== $data->Password) {
                utils\Flash::info(utils\Text::get("LOGIN_INVALID_DATA"));
                return false;
            }

            $remeber = utils\Input::post("remember") === "on";
            if ($remeber and !self::remeberCookies($data->ID)) {
                utils\Flash::danger(utils\Text::get("SERVER_ERROR"));
                return false;
            }

            utils\Session::put(utils\Config::get("SESSION_USER"), $data->ID);
            return true;
        } catch (Exception $ex) {
            utils\Flash::info($ex->getMessage());
        }
        return false;
    }

    public static function _logout()
    {
        utils\Session::closeSession();
        return true;
    }
}
