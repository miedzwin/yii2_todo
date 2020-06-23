<?php declare(strict_types=1);

namespace App\Form\Security;

use yii\base\Model;

/**
 * Class UserRegisterForm
 * @package App\Form
 */
class UserRegisterForm extends Model
{
    /**
     * @var string
     */
    public string $username;
    public string $password;
    public string $repeatPassword;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repeatPassword'], 'required'],
            [['username'], 'string', 'min' => 4],
            [['password', 'repeatPassword'], 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute' => 'repeatPassword'],
        ];
    }
}
