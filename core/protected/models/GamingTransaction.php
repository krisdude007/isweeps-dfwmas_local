<?php

/**
 * This is the model class for table "gaming_transaction".
 *
 * The followings are the available columns in table 'gaming_transaction':
 * @property integer $id
 * @property integer $user_id
 * @property integer $game_choice_id
 * @property integer $ivr_id
 * @property string $processor
 * @property string $request
 * @property string $response
 * @property string $description
 * @property string $country
 * @property string $operator
 * @property double $price
 * @property string $created_on
 */
class GamingTransaction extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gaming_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, game_choice_id, processor, request, response, description, price, created_on', 'required'),
			array('user_id, game_choice_id, ivr_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('processor, description, country, operator', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, game_choice_id, ivr_id, processor, request, response, description, country, operator, price, created_on', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'game_choice_id' => 'Game Choice',
			'ivr_id' => 'Ivr',
			'processor' => 'Processor',
			'request' => 'Request',
			'response' => 'Response',
			'description' => 'Description',
			'country' => 'Country',
			'operator' => 'Operator',
			'price' => 'Price',
			'created_on' => 'Created On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('game_choice_id',$this->game_choice_id);
		$criteria->compare('ivr_id',$this->ivr_id);
		$criteria->compare('processor',$this->processor,true);
		$criteria->compare('request',$this->request,true);
		$criteria->compare('response',$this->response,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('operator',$this->operator,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GamingTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
