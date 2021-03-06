<?php

class FormVideoUpload extends CFormModel {

    public $is_ad;
    public $question_id;
    public $video;
    public $title;
    public $description;
    public $tags;
    public $to_twitter;
    public $to_facebook;
    public $company_name;
    public $company_email;

    public function rules() {

      $email_regex_pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z](?:[a-zA-Z]*[a-zA-Z])?$/';

        return array(
            array('question_id, is_ad', 'required'),
            array('video', 'required' ,'message'=>Yii::t('youtoo','Video cannot be blank')),
            array('title', 'required', 'message'=>Yii::t('youtoo','Title cannot be blank')),
            array('question_id, is_ad, to_facebook, to_twitter', 'numerical', 'integerOnly' => true),
            array('video', 'file', 'types' => Yii::app()->params['video']['acceptedFileTypes'],'maxSize'=>Yii::app()->params['video']['maxUploadFileSize'],'tooLarge'=>Yii::app()->params['custom_params']['invalid_file_size'],'wrongType'=>Yii::app()->params['custom_params']['invalid_file_type']),
            array('company_email', 'email', 'pattern' => $email_regex_pattern),
            array('question_id, title, description, to_facebook, to_twitter, is_ad, tags, company_name, company_email', 'safe', 'on'=>'search')
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'question_id' => 'Question',
            'video' => 'Video',
            'title' => 'Title',
            'description' =>'Descrption',
            'to_facebook' => 'To Facebook',
            'to_twitter' => 'To Twitter',
            'tags' => 'Tags'
        );
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('question_id',$this->question_id);
        $criteria->compare('video',$this->video,true);
        $criteria->compare('thumbnail',$this->thumbnail,true);
        $criteria->compare('processed',$this->processed);
        $criteria->compare('watermarked',$this->watermarked);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('duration',$this->duration,true);
        $criteria->compare('frame_rate',$this->frame_rate);
        $criteria->compare('view_key',$this->view_key,true);
        $criteria->compare('source',$this->source,true);
        $criteria->compare('to_facebook',$this->to_facebook);
        $criteria->compare('to_twitter',$this->to_twitter);
        $criteria->compare('arbitrator_id',$this->arbitrator_id);
        $criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('company_email',$this->company_email,true);
        $criteria->compare('created_on',$this->created_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->created_on)):null);
        $criteria->compare('updated_on',$this->updated_on!==null?gmdate("Y-m-d H:i:s",strtotime($this->updated_on)):null);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}
