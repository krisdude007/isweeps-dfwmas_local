<?php

class eUser extends User {

    public $birthDay;
    public $birthMonth;
    public $birthYear;
    public $email;
    public $userPermissions;
    public $confirm_password;
    public $newPassword;
    public $newPasswordConfirm;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function ageOfMajority($attribute, $params) {
        if (strtotime($this->birthday) > strtotime('18 years ago')) {
            $this->addError($attribute, Yii::t('youtoo','You must be 18 or older'));
        }
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('birthday, gender', 'required', 'on' => 'register,profile,twitter', 'message' => Yii::t('youtoo','Gender cannot be blank')),
            array('first_name','required','on' => 'register,profile,twitter', 'message' => Yii::t('youtoo','First Name cannot be blank')),
            array('last_name','required','on' => 'register,profile,twitter', 'message' =>  Yii::t('youtoo','Last Name cannot be blank')),
            array('password, source', 'required', 'on' => 'register,twitter', 'message' => Yii::t('youtoo','Password cannot be blank')),
            array('birthday', 'date', 'format' => 'yyyy-MM-dd', 'message'=>Yii::t('youtoo','The Birthday Month, Day, Year must be selected')),
            array('birthYear', 'date', 'format' => 'yyyy'),
            array('birthMonth', 'date', 'format' => 'MM'),
            array('birthDay', 'date', 'format' => 'dd'),
            array('birthday', 'ageOfMajority', 'on' => 'register,profile,twitter', 'message'=>Yii::t('youtoo','You must be 18 or older')),
            array('username', 'required', 'on' => 'login', 'message'=>Yii::t('youtoo','Username cannot be blank')),
            array('password','required', 'on' => 'login', 'message'=>Yii::t('youtoo','Password cannot be blank')),
            //this will cause, admin registration to not work, should be in override if register page has password and confirm.
            //array('confirm_password', 'compare', 'compareAttribute' => 'password', 'on' => 'register','message' => Yii::t('youtoo','Confirm Password must be repeated exactly')),
            array('newPassword,', 'required', 'on' => 'changePassword', 'message' => Yii::t('youtoo','New Password cannot be blank')),
            array('newPasswordConfirm','required','on' => 'changePassword', 'message' => Yii::t('youtoo','New Password Confirm cannot be blank')),
            array('newPasswordConfirm', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('youtoo','New passwords do not match'), 'on' => 'changePassword'),
            array('newPassword', 'length', 'min' => 6, 'max' => 255, 'on' => 'changePassword', 'tooShort' => Yii::t('youtoo','New Password is too short (minimum is 6 characters)')),
            array('source','required', 'on' => 'login'),
            array('username', 'required', 'on' => 'register,profile,reset', 'message'=>Yii::t('youtoo','Username cannot be blank')),
            array('username', 'unique', 'on' => 'register,profile,twitter', 'message'=> Yii::t('youtoo','Sorry, this username has already been used')),
            array('terms_accepted', 'numerical', 'integerOnly' => true),
            //array('terms_accepted', 'required', 'requiredValue' => 1, 'on' => 'register', 'message'=>Yii::t('youtoo','Please accept terms')),
            array('username, password, first_name, last_name, source', 'length', 'max' => 255),
            array('gender', 'length', 'max' => 1),
            array('role', 'length', 'max' => 14),
            array('created_on,updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert, register, twitter, facebook'),
            array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'update, profile'),
            array('id, password, birthday, gender, first_name, last_name, terms_accepted, source, created_on, updated_on', 'safe', 'on' => 'auditSearch'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('email, userPermissions, id, username, password, birthday, gender, first_name, last_name, terms_accepted, source, created_on, updated_on', 'safe', 'on' => 'search'),
        );
    }

    public function validatePassword($password, $scenario) {
        if (crypt($password, $this->salt) === $this->password) {
            return true;
        } else {
            switch ($scenario) {
                case 'facebook':
                case 'twitter':
                case 'reset':
                case 'register':
                    if ($password === $this->password) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                default:
                    return false;
                    break;
            }
        }
    }

    public function beforeSave() {
        if (($this->scenario != 'terms' && $this->scenario != 'profile' && !empty($this->password)) || ($this->scenario == 'profile' && !empty($this->password))) {
            $this->salt = '$6$' . hash('sha512', uniqid('', true));
            $pass = crypt($this->password, $this->salt);
            $this->password = $pass;
        } else {
            $user = self::model()->findByPK($this->id);
            $this->password = $user->password;
        }
        return parent::beforeSave();
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'audits' => array(self::HAS_MANY, 'eAudit', 'user_id'),
            'images' => array(self::HAS_MANY, 'eImage', 'user_id'),
            'imagesArbitrated' => array(self::HAS_MANY, 'eImage', 'arbitrator_id'),
            'imageDestinations' => array(self::HAS_MANY, 'eImageDestination', 'user_id'),
            'imageRatings' => array(self::HAS_MANY, 'eImageRating', 'user_id'),
            'imageViews' => array(self::HAS_MANY, 'eImageView', 'user_id'),
            'languageFilters' => array(self::HAS_MANY, 'eLanguageFilter', 'user_id'),
            'notifications' => array(self::HAS_MANY, 'eNotification', 'user_id'),
            'polls' => array(self::HAS_MANY, 'ePoll', 'user_id'),
            'pollAnswers' => array(self::HAS_MANY, 'ePollAnswer', 'user_id'),
            'pollResponses' => array(self::HAS_MANY, 'ePollResponse', 'user_id'),
            'programs' => array(self::HAS_MANY,'eProgram', 'user_id'),
            'gameChoices' => array(self::HAS_MANY, 'eGameChoice', 'user_id'),
            'gameChoiceAnswers' => array(self::HAS_MANY, 'eGameChoiceAnswer', 'user_id'),
            'gameChoiceResponses' => array(self::HAS_MANY, 'eGameChoiceResponse', 'user_id'),
            'questions' => array(self::HAS_MANY, 'eQuestion', 'user_id'),
            'questionDestinations' => array(self::HAS_MANY, 'eQuestionDestination', 'user_id'),
            'tickers' => array(self::HAS_MANY, 'eTicker', 'user_id'),
            'tickersArbitrated' => array(self::HAS_MANY, 'eTicker', 'arbitrator_id'),
            'tickerDestinations' => array(self::HAS_MANY, 'eTickerDestination', 'user_id'),
            'tickerImpressions' => array(self::HAS_MANY, 'eTickerImpression', 'user_id'),
            'tickerRuns' => array(self::HAS_MANY, 'eTickerRun', 'user_id'),
            'userEmails' => array(self::HAS_MANY, 'eUserEmail', 'user_id'),
            'userFacebooks' => array(self::HAS_MANY, 'eUserFacebook', 'user_id'),
            'userLocations' => array(self::HAS_MANY, 'eUserLocation', 'user_id'),
            'userLogins' => array(self::HAS_MANY, 'eUserLogin', 'user_id'),
            'userPermissions' => array(self::HAS_MANY, 'eUserPermission', 'user_id'),
            'userPermissionCount' => array(self::STAT, 'eUserPermission', 'user_id'),
            'userPhones' => array(self::HAS_MANY, 'eUserPhone', 'user_id'),
            //'userPhotos' => array(self::HAS_MANY, 'eUserPhoto', 'user_id'),
            'userResets' => array(self::HAS_MANY, 'eUserReset', 'user_id'),
            'userTeches' => array(self::HAS_MANY, 'eUserTech', 'user_id'),
            'userTwitters' => array(self::HAS_MANY, 'eUserTwitter', 'user_id'),
            'videos' => array(self::HAS_MANY, 'eVideo', 'user_id'),
            'videosArbitrated' => array(self::HAS_MANY, 'eVideo', 'arbitrator_id'),
            'videoDestinations' => array(self::HAS_MANY, 'eVideoDestination', 'user_id'),
            'videoRatings' => array(self::HAS_MANY, 'eVideoRating', 'user_id'),
            'videoViews' => array(self::HAS_MANY, 'eVideoView', 'user_id'),
            'votesByUserId' => array(self::HAS_MANY, 'ePollResponse', 'user_id'),
            'gameChoiceResponsesByUserId' => array(self::HAS_MANY, 'eGameChoiceResponse', 'user_id'),
            'countVotesByUserId' => array(self::STAT, 'ePollResponse', 'user_id', 'select' => 'COUNT(id)', 'group' => 'user_id'),
            'countGameChoiceResponsesByUserId' => array(self::STAT, 'eGameChoiceResponse', 'user_id', 'select' => 'COUNT(id)', 'group' => 'user_id'),
            'countVideosByUserId' => array(self::STAT, 'eVideo', 'user_id', 'select' => 'COUNT(id)', 'group' => 'user_id', 'condition' => 'status="accepted"'),
            //'avatar' => array(self::HAS_MANY, 'eUserPhoto', 'user_id', 'condition'=>'avatar.type="primary"'),
            'avatarImage' => array(self::HAS_MANY, 'eImage', 'user_id', 'condition' => 'image.is_avatar=1'),
            'avatarImages' => array(self::HAS_MANY, 'eImage', 'user_id', 'on' => 'avatarImages.is_avatar=1'),
            'isContestant' => array(self::HAS_MANY, 'eEntityAnswer', 'user_id', 'on' => 'isContestant.id is not null', 'joinType'=>'INNER JOIN'),
        );
    }

    public function filterByDates($startDate, $endDate) {
        return DateTimeUtility::filterByDates($this, $startDate , $endDate);
    }

    public function filterByWeek($filterDate) {
        return DateTimeUtility::filterByWeek($this, $filterDate);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'terms_accepted' => 'Terms Accepted',
            'source' => 'Source',
            'created_on' => 'Created',
            'updated_on' => 'Updated',
            'email' => 'Email',
            'userPermissions' => 'User Permissions'
        );
    }

    public function scopes() {
        // todo - fix this so that it looks for specific roles
        // instead of anything that is not user
        return array(
            'isAdmin' => array('condition' => 'role != "user"'),
            'orderLastNameAsc' => array('order' => 'last_name ASC'),
            'recent' => array('order' => '`t`.`id` DESC'),
            'asc' => array('order' => '`t`.`id` ASC'),
            'orderByCreatedDesc' => array(
                'order' => '`t`.created_on DESC',
            ),
            'orderByCreatedAsc' => array(
                'order' => '`t`.created_on ASC',
            ),
            'orderByIDDesc' => array(
                'order' => '`t`.id DESC',
            ),
        );
    }

    public function search($perPage = 0) {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->with = array('userEmails:primary');
        $criteria->together = true;
        $criteria->compare('t.username', $this->username, true);
        $criteria->compare('t.role', $this->role, true);
        $criteria->compare('t.first_name', $this->first_name, true);
        $criteria->compare('t.last_name', $this->last_name, true);
        $criteria->compare('userEmails.email', $this->email, true);

        // prevent them from seeing super admins if they are not one
        if(Yii::app()->user->isSiteAdmin()) {
            $criteria->addCondition("t.role != 'super admin'");
        }
        // prevent them from seeing super admins and site admins if they are not one
        elseif(Yii::app()->user->isProducerAdmin()) {
            $criteria->addCondition("t.role != 'super admin' AND t.role != 'site admin'");
        }


        if($this->userPermissions == 'Yes') {
            $criteria->join = ' left join user_permission as up on t.id = up.user_id';
            $criteria->having = 'COUNT(up.user_id) > 0';
            $criteria->group = 'up.user_id';
        } elseif ($this->userPermissions == 'No') {
            $criteria->join = ' left join user_permission as up on t.id = up.user_id';
            $criteria->condition = 'up.user_id is null';
        }

        if($perPage == 0)
            $perPage = Yii::app()->params['perPage'];
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $perPage,
            ),
        ));
    }

    public function afterFind() {
        list($this->birthYear, $this->birthMonth, $this->birthDay) = preg_split('/-/', $this->birthday);
        $this->userPermissions = $this->userPermissionCount ? "Yes" : ($this->userPermissionCount == 0 ? "No" : "Any");
        return parent::afterFind();
    }

}
