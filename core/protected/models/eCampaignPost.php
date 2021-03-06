<?php

/**
 * This is the model class for table "campaign".
 * 
 */
class eCampaignPost extends ActiveRecord
{
    public $date;
    public $hour;
    public $am;
    public $minute;
     
     
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'campaign_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('campaign_id, media_id, media_type, post_content,date', 'required'),
			array('post_content', 'length', 'max'=>140),
			array('hash_tag, post_time, hour, am , minute, facebook_post_id, twitter_post_id', 'safe'),
			 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, campaign_id', 'safe', 'on'=>'search'),
		);
	}
	
	 
	protected function beforeValidate()
	{
	    parent::beforeValidate();
	    //  for am and pm, 0 is 12
	    if($this->hour == 0) {  
	        $this->hour = 12;   
	    }
	    $this->post_time = date('Y-m-d H:i:s', strtotime($this->date.' '.$this->hour.':'.$this->minute.':00 '.$this->am));
	    if($this->isNewRecord) {
	        $this->created_by = Yii::app()->user->id;
	        $this->created_time = date('Y-m-d H:i:s');
	    }  
	    $this->updated_by = Yii::app()->user->id;
	    $this->updated_time = date('Y-m-d H:i:s');
	    return true;
	}
	 
	protected function afterFind()
	{
	    parent::afterFind();
	    $this->date = date('Y-m-d', strtotime($this->post_time));
	    $this->hour = date('g', strtotime($this->post_time));
	    $this->minute = (int) date('i', strtotime($this->post_time));
	    $this->am = date('A', strtotime($this->post_time));
	    return true;
	}
	
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		    'campaign'=>array(SELF::BELONGS_TO, 'eCampaign', 'campaign_id'),	
		    'video'=> array(SELF::HAS_ONE, 'eVideo', array('id'=>'media_id')),
		    'image'=>array(SELF::HAS_ONE, 'eImage', array('id'=>'media_id')),
		     
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			 
			 
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
		$criteria->compare('hash_tag',$this->hash_tag);
		$criteria->compare('post_time', $this->post_time);
		$criteria->compare('media_type', $this->media_type);
		 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchByCampaignId($campaign_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array('video', 'image');
		$criteria->condition = 'campaign_id = ?';
		$criteria->params = array($campaign_id);
        
		$criteria->compare('id',$this->id);
		 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
