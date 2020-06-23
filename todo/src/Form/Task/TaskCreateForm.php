<?php declare(strict_types=1);

namespace App\Form\Task;

use yii\base\Model;

/**
 * Class TaskCreateForm
 * @package App\Form\Task
 */
class TaskCreateForm extends Model
{
    public string $name;
    public string $content;
    public int $userId;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'content', 'userId'], 'required'],
        ];
    }
}