<?php

class AdminSocialSearchController extends Controller
{
    public $user;
    public $notification;
    public $layout = '//layouts/admin';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array(
                    'index',
                    'ajaxSearch',
                    'save',
                ),
                'expression' => '(Yii::app()->user->isAdmin())',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Anything required on every page should be loaded here
     * and should also be made a class member.
     */
    function init() {
        parent::init();
        Yii::app()->setComponents(array('errorHandler' => array('errorAction' => 'admin/error',)));
        $this->user = ClientUtility::getUser();
        $this->notification = eNotification::model()->orderDesc()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
    }

    /**
     *
     *
     * SOCIAL ACTIONS
     * This section contains everything required for the social section of the admin
     *
     *
     */
    public function actionIndex() {
        $questions = eQuestion::model()->ticker()->current()->findAll();
        $this->render('index',Array('questions'=>$questions));
    }

    public function actionSave() {
        $this->layout = false;

        foreach ($_POST as $k => $v) {
            $$k = $v;
        }

        $ticker = eTicker::model()->find('source_content_id=:sourceContentId', array(':sourceContentId'=>$id ));
        if(is_null($ticker))
            $ticker = new eTicker();

        $ticker->arbitrator_id = Yii::app()->user->getId();
        $ticker->ticker = strip_tags($content, '<3>');
        $ticker->type = 'social';
        $ticker->source = $source;
        $ticker->source_content_id = $id;
        $ticker->source_user_id = $userid;

        switch($source){
            case 'twitter':
                TwitterUtility::getUsernameFromID($userid);
                break;
            case 'facebook':
                FacebookUtility::getUsernameFromID($userid);
                break;
        }

        if(strpos($questionid,'b') === FALSE)
        {
            $ticker->question_id = $questionid;
            $ticker->is_breaking = '';
        }
        else
        {
            $ticker->question_id = str_replace('b', '', $questionid);
            $ticker->is_breaking = 1;
        }

        $ticker->extendedStatus['accepted'] = true;
        $ticker->extendedStatus['accepted_tv'] = true;

        if ($ticker->save()) {
            $ret = Array('code' => 'saved');
        } else {
            $ret = Array('code' => 'Ticker did not validate', 'errors' => $ticker->errors);
        }
        echo json_encode($ret);
    }

    public function actionAjaxSearch() {
        $this->layout = false;

        foreach ($_POST as $k => $v) {
            $$k = $v;
        }
        
        $q = (int)$q;
        
        $limit = 100;
        if(Yii::app()->twitter->advancedFilters) {
            $limit = 30;
        }
        echo json_encode(eTicker::model()->searchSocial($terms, $boolean, $filters, $q, $limit));
        Yii::app()->end();
    }
}