<?php
/**
 * Created by PhpStorm.
 * User: братья
 * Date: 03.04.2018
 * Time: 20:41
 */

namespace app\models;


interface AuthInter
{
    public static function identityById ($id);



    public static function identityByUserName ($username);



    public static function identityByPassword ($password);
}