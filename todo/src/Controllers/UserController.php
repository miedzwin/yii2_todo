<?php declare(strict_types=1);

namespace App\Controllers;

use App\Form\Security\UserLoginForm;
use App\Form\Security\UserRegisterForm;
use App\Models\User;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends ActiveController
{
    public $modelClass = User::class;

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['bootstrap'] = [
            'class' => \yii\filters\ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    /**
     * Method that creates user in database
     *
     * Request POST
     * {
     *   "username": "john",
     *   "password": "johndoe",
     *   "repeatPassword": "johndoe"
     *  }
     *
     * @return array
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        if(!Yii::$app->request->getIsPost()) {
            return [
                'hasErrors' => true,
                'errors' => 'method not allowed',
            ];
        }
        $registerForm = new UserRegisterForm();
        $body = Yii::$app->request->getRawBody();
        $data = json_decode($body, true);
        $registerForm->username = $data['username'];
        $registerForm->password = $data['password'];
        $registerForm->repeatPassword = $data['repeatPassword'];
        $registerForm->validate();
        if ($registerForm->hasErrors()) {
            return [
                'hasErrors' => true,
                'errors' => $registerForm->getErrors(),
            ];
        }

        $user = User::findOne(['username' => $data['username']]);
        if ($user) {
            return [
                'hasErrors' => true,
                'errors' => 'username already exists',
            ];
        }

        $user = new User();
        $user->username = $data['username'];
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($data['password']);
        $user->save();

        return [
            'success' => true,
            'message' => 'Account successfully created'
        ];
    }

    /**
     * Request POST
     * {
     *   "username": "foo",
     *   "password": "foobar"
     *  }
     */
    public function actionLogin()
    {
        if(!Yii::$app->request->getIsPost()) {
            return [
                'hasErrors' => true,
                'errors' => 'method not allowed',
            ];
        }
        $loginForm = new UserLoginForm();
        $body = Yii::$app->request->getRawBody();
        $data = json_decode($body, true);
        $loginForm->username = $data['username'];
        $loginForm->password = $data['password'];
        $loginForm->validate();
        if ($loginForm->hasErrors()) {
            return [
                'hasErrors' => true,
                'errors' => $loginForm->getErrors(),
            ];
        }

        if ($loginForm->login()) {
            return [
                'success' => true,
                'message' => 'Successfully logged in'
            ];
        }

        return [
            'hasErrors' => true,
            'errors' => 'wrong username or password'
        ];
    }
}
