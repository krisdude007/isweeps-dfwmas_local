<?php

class EntityController extends Controller
{
    public $layout = '//layouts/main';
    public $user;
    public $ticker; // used for ticker form shown on every page when user is logged in

    /**
     * Anything required on every page should be loaded here
     * and should also be made a class member.
     */
    function init() {
        parent::init();

        if (!Yii::app()->user->isGuest) {
            $this->user = ClientUtility::getUser();
            $this->ticker = new eTicker();
        }
    }
        
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}