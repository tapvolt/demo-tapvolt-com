<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $lock_version
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $client_id
 * @property string $name
 * @property string $label
 *
 * @property Client $client
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'client_id', 'name', 'label'], 'required'],
            [['created_at', 'created_by', 'lock_version', 'updated_at', 'updated_by', 'client_id'], 'integer'],
            [['name', 'label'], 'string', 'max' => 255],
            [['name'], 'unique']
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
            'client_id' => 'Client ID',
            'name' => 'Name',
            'label' => 'Label',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
}
