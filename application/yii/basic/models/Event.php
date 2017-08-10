<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $event_date_created
 * @property string $event_description
 * @property string $event_start_date
 * @property string $event_end_date
 * @property integer $marketeer_id
 *
 * @property EmailEvent[] $emailEvents
 * @property Marketeer $marketeer
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

public function getfullName()
   {
   return $this->marketeer_fname.' '.$this->marketeer_lname;
    }

    public static function tableName()
    {
        return 'event';
    }

    public function getInformation()
    {
        return 'Description: '. $this->event_description.'  Start Date: '.$this->event_start_date.'  End Date:'.$this->event_end_date;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_date_created', 'event_start_date', 'event_end_date'], 'safe'],
            [['marketeer_id'], 'required'],
            [['marketeer_id'], 'integer'],
            [['event_description'], 'string', 'max' => 400],
            [['marketeer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marketeer::className(), 'targetAttribute' => ['marketeer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_date_created' => 'Event Date Created',
            'event_description' => 'Event Description',
            'event_start_date' => 'Event Start Date',
            'event_end_date' => 'Event End Date',
            'marketeer_id' => 'Marketeer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getId0()
    {
        return $this->hasOne(Marketeer::className(), ['id' => 'id']);
    }


    public function getEmailEvents()
    {
        return $this->hasMany(EmailEvent::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarketeer()
    {
        return $this->hasOne(Marketeer::className(), ['id' => 'marketeer_id']);
    }
}
