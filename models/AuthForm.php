<?php
/**
 * Created by PhpStorm.
 * User: братья
 * Date: 03.04.2018
 * Time: 21:07
 */

namespace app\models;


use yii\base\Model;

class AuthForm extends Model
{
    public $login;
    public $password;

    public function rules()
    {
       return [
           [['login','password'],'required'],
           ['password','string','min'=>2, 'max' => 10]
       ];

    }


}