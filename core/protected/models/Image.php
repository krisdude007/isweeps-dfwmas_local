<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property integer $user_id
 * @property integer $entity_id
 * @property string $filename
 * @property integer $watermarked
 * @property string $title
 * @property string $description
 * @property string $view_key
 * @property string $source
 * @property integer $to_facebook
 * @property integer $to_twitter
 * @property integer $arbitrator_id
 * @property string $status
 * @property integer $is_avatar
 * @property string $status_date
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property Entity $entity
 * @property User $user
 * @property User $arbitrator
 * @property ImageDestination[] $imageDestinations
 * @property ImageRating[] $imageRatings
 * @property ImageView[] $imageViews
 * @property Tag[] $tags
 */
class Image extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_id, filename, title, description, view_key, source, to_facebook, to_twitter, arbitrator_id, status, status_date, created_on, updated_on', 'required'),
			array('user_id, entity_id, watermarked, to_facebook, to_twitter, arbitrator_id, is_avatar', 'numerical', 'integerOnly'=>true),
			array('filename, title, description, view_key, source', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, entity_id, filename, watermarked, title, description, view_key, source, to_facebook, to_twitter, arbitrator_id, status, is_avatar, status_date, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'entity' => array(self::BELONGS_TO, 'Entity', 'entity_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'arbitrator' => array(self::BELONGS_TO, 'User', 'arbitrator_id'),
			'imageDestinations' => array(self::HAS_MANY, 'ImageDestination', 'image_id'),
			'imageRatings' => array(self::HAS_MANY, 'ImageRating', 'image_id'),
			'imageViews' => array(self::HAS_MANY, 'ImageView', 'image_id'),
			'tags' => array(self::MANY_MANY, 'Tag', 'tag_image(image_id, tag_id)'),
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
			'entity_id' => 'Entity',
			'filename' => 'Filename',
			'watermarked' => 'Watermarked',
			'title' => 'Title',
			'description' => 'Description',
			'view_key' => 'View Key',
			'source' => 'Source',
			'to_facebook' => 'To Facebook',
			'to_twitter' => 'To Twitter',
			'arbitrator_id' => 'Arbitrator',
			'status' => 'Status',
			'is_avatar' => 'Is Avatar',
			'status_date' => 'Status Date',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
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
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('watermarked',$this->watermarked);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('view_key',$this->view_key,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('to_facebook',$this->to_facebook);
		$criteria->compare('to_twitter',$this->to_twitter);
		$criteria->compare('arbitrator_id',$this->arbitrator_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_avatar',$this->is_avatar);
		$criteria->compare('status_date',$this->status_date!==null?gmdate("Y-m-d H:i:s",strtotime($this->status_date)):null);
		$criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
		$criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
