<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $lock_version
 * @property integer $updated_at
 * @property integer $updated_by
 * @property string $name
 * @property string $label
 *
 * @property Project[] $projects
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'name', 'label'], 'required'],
            [['created_at', 'created_by', 'lock_version', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'label'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'create'   => ['name', 'label'],
            'update'   => ['name', 'label'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'lock_version' => 'Lock Version',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'name' => 'Name',
            'label' => 'Label',
        ];
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['client_id' => 'id']);
    }
}
