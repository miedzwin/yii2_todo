<?php declare(strict_types=1);

namespace App\Models;

use yii\db\ActiveRecord;

/**
 * Class Task
 * @package App\Models
 */
class Task extends ActiveRecord
{
    public const STATUS_TODO = 'todo';
    public const STATUS_DONE = 'done';
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{task}}';
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->status = self::STATUS_TODO;
            }
            return true;
        }
        return false;
    }
}
