<?php

class PollController extends Controller {

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

    public function actionIndex($id = 0,$state = false) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('user/login'));
        } else {
            $polls = ePoll::model()->current()->questionType()->findAll();
            $activePoll = null;
            if(!empty($polls)) {
                $activePoll = ($id != 0) ? ePoll::model()->with('pollAnswers')->findByPK($id) : $polls[0];
            }

            $sweepstake = null;
            $sweepstakeuser = null;
            if (Yii::app()->params['enableSweepstakes']) {
                $sweepstake = eSweepStake::model()->current()->find();//->active()
                if (!is_null($sweepstake)) {
                    $sweepstakeuser = eSweepStakeUser::model()->findByAttributes(Array('sweepstake_id'=>$sweepstake->id,'user_id'=>Yii::app()->user->getId()));
                }
            }

            $this->render('index', array(
                'activePoll' => $activePoll,
                'polls' => $polls,
                'state' => $state,
                'sweepstake' => $sweepstake,
                'sweepstakeuser' => $sweepstakeuser,
                )
            );
        }
    }

    public function actionAjaxResponse() {
        foreach ($_POST as $k => $v) {
            $$k = $v;
        }
        if (!Yii::app()->user->isGuest) {
            $answerRecord = ePollAnswer::model()->findByPK($answer);
            $pollResponse = new ePollResponse;
            $pollResponse->user_id = Yii::app()->user->getId();
            $pollResponse->answer_id = $answer;
            $pollResponse->poll_id = $answerRecord->poll_id;
            $pollResponse->source = $source;
            $pollResponse->save();
            if(Yii::app()->Paypal->active){
                echo json_encode(PaymentUtility::paypal($pollResponse));
            } else {
                echo json_encode(array('success' => 'false'));
            }
        }
    }

    public function actionAjaxGetData() {
        foreach ($_POST as $k => $v) {
            $$k = $v;
        }
        if (!isset($id)) {
            echo json_encode(array('success'=>'false'));
            return;
        }
        //$polls = ePoll::model()->with('pollAnswers', 'pollAnswers:tally', 'pollResponses')->findAll();
        $poll = ePoll::model()->with('pollAnswers', 'pollAnswers:tally', 'pollResponses')->findByPK($id);
        foreach ($poll->pollAnswers as $answer) {
            $data['labels'][] = $answer->answer;
            $data['colors'][] = $answer->color;
            $data['values'][] = round($answer->tally / $poll->tally * 100);
        }
        echo json_encode($data);
    }

    public function actionQuestions() {
        $this->render('questions', array('polls' => ePoll::model()->current()->findAll()));
    }


}