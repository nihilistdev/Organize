<?php
namespace app\models;

use Exception;
use app\utils;


class CreateCard{

    public static function _create($userID)
    {
        try
        {
            $Card=new Cards;
            $cardID=$Card->createCard(
                [
                    "Card_ID"=>rand(0,9999999999),
                    "User_ID"=>$userID,
                    "Card_Name"=>utils\Input::post("cardName"),
                    "Card_Description"=>utils\Input::post("cardDesc"),
                    "Todo_ID"=>rand(0,999999999)
                ]
            );
            utils\Flash::success("Card created successfuly!");
            return $cardID;
        }
        catch(Exception $e)
        {
            utils\Flash::warning($e->getMessage());
        }
        return false;
    }
}