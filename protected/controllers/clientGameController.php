<?php

class clientGameController extends GameController {

    public $activeNavLink = 'index';
    public $activeSubNavLink = '';
    public $userBalance = null;

    public function actionMultiple2($id = NULL) {
        //if ($this->isMobile()) {
        //    Yii::app()->theme = 'mobile';
        //    $this->layout = null;
        //}
        $user_id = Yii::app()->user->getId();
        $games = eGameChoice::model()->isActive()->asc()->findAll();
        $reveal = eGameReveal::model()->findByPk(3);
        if (empty($games)) {
            $this->redirect($this->createUrl("/winners"));
        }

        $gameManager = GameUtility::gameManager($user_id);

        if ($gameManager['set']['on'] == 0) {
            $this->redirect($this->createUrl("/game/allgamesplayed"));
        }

        if (!$gameManager['is_paid']) {
            if ($gameManager['user_response']['paid_responses'] == 0) {
                $this->redirect($this->createUrl("/payment/game_choice_response/{$gameManager['user_response']['last_response_id']}"));
            } else {
                $this->redirect($this->createUrl("/payment/game_choice_response"));
            }
        } else {
            if ($gameManager['game_id'] == 0) {
                $this->redirect($this->createUrl("/game/allgamesplayed"));
            } else {
                $id = $gameManager['game_id'];
            }
        }

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        $response = new eGameChoiceResponse;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-choice-form') {
            echo CActiveForm::validate($response);
            Yii::app()->end();
        }

        if (isset($_POST['eGameChoiceResponse'])) {
            $response->attributes = $_POST['eGameChoiceResponse'];

            if (empty($user_id)) {
                $response->user_id = 0;
            } else {
                $response->user_id = $user_id;
            }

            if ($gameManager['is_paid']) {
                $response->transaction_id = $gameManager['transaction_id']; //transaction_id
            }

            $responseUser = clientUser::model()->findByPk($response->user_id);

            if (empty($response->game_choice_answer_id)) {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', 'Please choose an answer.'));
                $this->redirect($this->createUrl('/game/multiple2'));
            }

            if ($response->validate()) {
                $response->save();
                Yii::app()->session['gamechoiceresponseId'] = $response->id;

//                $transaction = new eCreditTransaction;
//                $transaction->game_type = "game_choice";
//                $transaction->game_id = $response->game_choice_id;
//                $transaction->type = "earned";
//
//                $answer = eGameChoiceAnswer::model()->findByPk($response->game_choice_answer_id);
//
//                $transaction->credits = $answer->point_value;
//
//                $transaction->save();
                //$this->redirect($this->createUrl("/payment/game_choice_response/{$response->id}"));

                if ($response->user_id == 0) {
                    $this->redirect($this->createUrl("/loginpay"));
                } else {
                    $this->redirect($this->createUrl("/game/multiple2"));
                }
            } else {
                Yii::app()->user->setFlash('error', "Errors found!");
            }
        }

        if ($game) {
            $this->render('multiple', array(
                'game' => $game,
                'response' => $response,
                'game_manager' => $gameManager,
                'reveal' => $reveal
            ));
        } else {
            echo "No game with this ID exists.";
        }
    }

    public function actionMultiple3($id = NULL) {
        $user_id = Yii::app()->user->getId();

        if (empty($user_id)) {
            $this->redirect($this->createUrl("/loginpay"));
        }

        $games = eGameChoice::model()->isActive()->asc()->findAll();

        if (empty($games)) {
            $this->redirect($this->createUrl("/winners"));
        }

        $gameManager = GameUtility::managerPayPlay($user_id);

        //var_dump($gameManager);
        //exit;

        if ($gameManager['game_id'] == 0) {
            $this->redirect($this->createUrl("/game/allgamesplayed"));
        }

        if (isset($_POST['stripeToken'])) {
            $transactionID = PaymentUtility::stripePaymentGame("game_choice", $gameManager['game_id'], $_POST['stripeToken']);
            $this->redirect($this->createUrl("/playnow"));
        }

        if ($gameManager['is_payed']) {
            $id = $gameManager['game_id'];
        } else {
            $this->redirect($this->createUrl("/payment/game_choice/{$gameManager['game_id']}"));
        }

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        if ($game->reveal_id == NULL) {
            $reveal_id = 1;
        } else {
            $reveal_id = $game->reveal_id;
        }

        $reveal = eGameReveal::model()->findByPk($reveal_id);
        $revealGrid = GameUtility::revealGetGrid($reveal->id);
        $revealInfo = GameUtility::revealGetInfo($reveal->id, $gameManager['transaction_num']);

        $response = new eGameChoiceResponse;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-choice-form') {
            echo CActiveForm::validate($response);
            Yii::app()->end();
        }

        if (isset($_POST['eGameChoiceResponse'])) {
            $response->attributes = $_POST['eGameChoiceResponse'];

            $response->user_id = $user_id;
            $response->transaction_id = $gameManager['transaction_id'];

            $responseUser = clientUser::model()->findByPk($response->user_id);

            if (empty($response->game_choice_answer_id)) {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', 'Please choose an answer.'));
                $this->redirect($this->createUrl('/game/multiple3'));
            }

            if ($response->validate()) {
                $response->save();
                Yii::app()->session['gamechoiceresponseId'] = $response->id;

                if ($response->user_id == 0) {
                    $this->redirect($this->createUrl("/loginpay"));
                } else {
                    //$this->redirect($this->createUrl("/game/multiple3"));
                    $this->redirect($this->createURL("/paymentdone/thankyou/{$response->transaction_id}"));
                }
            } else {
                Yii::app()->user->setFlash('error', "Errors found!");
            }
        }

        if ($game) {
            $this->render('multiple', array(
                'game' => $game,
                'response' => $response,
                'game_manager' => $gameManager,
                'reveal' => $reveal,
                'reveal_grid' => $revealGrid,
                'reveal_info' => $revealInfo
            ));
        } else {
            echo "No game with this ID exists.";
        }
    }

    public function actionMultiple4($id = NULL) {
        $user_id = Yii::app()->user->getId();

        if (empty($user_id)) {
            $this->redirect($this->createUrl("/login/" . $id));
        }

        if ($id == NULL) {
            $game = eGameChoice::model()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        if (!$game) {
            echo "No game with this ID exists.";
        }
        
        if($game->type == 'sub') {
            $mainGame = eGameChoice::model()->findByPk($game->g_parant_id);
        } else { 
            $mainGame = null;
        }

        if ($game->price == 0) {

        } else {
            if (GameUtility::getCashBalance($user_id) > 0) {

            } else {
                $this->redirect($this->createUrl("/payment"));
            }
        }

        $response = new eGameChoiceResponse;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-choice-form') {
            echo CActiveForm::validate($response);
            Yii::app()->end();
        }

        if (isset($_POST['eGameChoiceResponse'])) {
            $response->attributes = $_POST['eGameChoiceResponse'];
            $response->user_id = $user_id;
            //$response->transaction_id = $gameManager['transaction_id'];
//            $response->ip_address = ClientUtility::getClientIpAddress();
//            $ipinfo = ClientUtility::getIPInfo($response->ip_address);
//            $ipinfo2 = json_decode(file_get_contents('http://ipinfo.io/'.$response->ip_address.'/geo'));
//            $response->ip_derivedcity = isset($ipinfo) ? $ipinfo->city : $ipinfo2->city;
//            $response->ip_derivedstate = isset($ipinfo) ? $ipinfo->region : $ipinfo2->region;

            $responseUser = clientUser::model()->findByPk($response->user_id);

            if (empty($response->game_choice_answer_id)) {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', 'Please choose an answer.'));
                $this->redirect($this->createUrl('/game/multiple4/' . $game->id));
            }

            if ($response->validate()) {
                $response->save();
                Yii::app()->session['gamechoiceresponseId'] = $response->id;

                if ($response->user_id == 0) {
                    $this->redirect($this->createUrl("/loginpay"));
                } else {
                    //$mainGame = $game->g_parant_id;

                    if ($this->isMobile()) {
                        $this->redirect($this->createURL("/continue/" . $game->id));
                        //$this->redirect($this->createURL("/thankyou"));
                    }
                    $this->redirect($this->createURL("/continue/" . $game->id));
                    //$this->redirect($this->createURL("/index.php?f=g"));
                }
            } else {
                Yii::app()->user->setFlash('error', "Errors found!");
            }
        }

        if ($game) {
            $this->render('multiple', array(
                'game' => $game,
                'mainGame' => $mainGame,
                'response' => $response,
            ));
        } else {
            echo "No game with this ID exists.";
        }
    }

    public function actionWinLooseOrDraw($id = NULL) {
        $user_id = Yii::app()->user->getId();

        if (empty($user_id)) {
            $this->redirect($this->createUrl("/login/{$id}"));
        }

        $user = clientUser::model()->findByPK($user_id);

        if($id == NULL) {
            $game = eGameChoice::model()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        if (!$game) {
            echo "No game with this ID exists.";
        }
        
        if($game->type == 'sub') {
            $mainGame = eGameChoice::model()->findByPk($game->g_parant_id);
        } else { 
            $mainGame = null;
        }

        //$geoLocation = GeoUtility::GeoLocation();
        //if(!$geoLocation['isValid']) {
        //    $this->redirect($this->createUrl("/geocoordinates/{$id}"));
        //}

        if ($game->price == 0) {

        } else {
            if (GameUtility::getCashBalance($user_id) > 0) {

            } else {
                $this->redirect($this->createUrl("/payment?gid={$game->id}"));
            }
        }

        $response = new eGameChoiceResponse;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-choice-form') {
            echo CActiveForm::validate($response);
            Yii::app()->end();
        }

        if (isset($_POST['eGameChoiceResponse'])) {
            $response->attributes = $_POST['eGameChoiceResponse'];
            $response->transaction_id = GameUtility::getNextTransactionID($user_id);
            $response->user_id = $user_id;
            //$response->transaction_id = $gameManager['transaction_id'];

//            $response->ip_address = ClientUtility::getClientIpAddress();
//            $ipinfo = ClientUtility::getIPInfo($response->ip_address);
//            $ipinfo2 = json_decode(file_get_contents('http://ipinfo.io/' . $response->ip_address . '/geo'));
//            $response->ip_derivedcity = isset($ipinfo) ? $ipinfo->city : $ipinfo2->city;
//
//            $responseUser = clientUser::model()->findByPk($response->user_id);

            if (empty($response->game_choice_answer_id)) {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', 'Please choose an answer.'));
                $this->redirect($this->createUrl('/game/winlooseordraw/' . $game->id));
            }

            if ($response->validate()) {
                $response->save();
                Yii::app()->session['gamechoiceresponseId'] = $response->id;

                if ($response->user_id == 0) {
                    $this->redirect($this->createUrl("/loginpay"));
                } else {
                    if ($this->isMobile()) {
                        $this->redirect($this->createURL("/continuepaid/" . $game->id));
                    }
                    $this->redirect($this->createURL("/continuepaid/" . $game->id));
                    //$this->redirect($this->createURL("/index.php?f=g"));
                }
            } else {
                Yii::app()->user->setFlash('error', "Errors found!");
            }
        }

        if ($game) {
            $this->render('winlooseordraw', array(
                'game' => $game,
                'mainGame' => $mainGame,
                'response' => $response,
                'user' => $user,
            ));
        } else {
            echo "No game with this ID exists.";
        }
    }

    public function actionReveal($id = NULL) {

        $user_id = Yii::app()->user->getId();
        $user = clientUser::model()->findByPK($user_id);
        $balance = eCreditBalance::getTotalUserBalance($user_id);

        if (empty($user_id)) {
            $this->redirect($this->createUrl("/login"));
        }

        if ($id == NULL) {
            $game = eGameChoice::model()->multiple()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->multiple()->with('gameChoiceAnswers')->findByPk((int) $id);
        }

        if (!$game) {
            echo "No game with this ID exists.";
        }

        if ($game->price == 0) {

        } else {
            if (GameUtility::getCashBalance($user_id) > 0) {

            } else {
                $this->redirect($this->createUrl("/payment"));
            }
        }

        if ($game->reveal_id == NULL) {
            $reveal_id = 1;
        } else {
            $reveal_id = $game->reveal_id;
        }

        $reveal = eGameReveal::model()->findByPk($reveal_id);
        $revealGrid = GameUtility::revealGetGrid($reveal->id);
        $revealInfo = GameUtility::revealGetInfo($reveal->id, $gameManager['transaction_num']);

        $response = new eGameChoiceResponse;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'game-choice-form') {
            echo CActiveForm::validate($response);
            Yii::app()->end();
        }

        if (isset($_POST['eGameChoiceResponse'])) {
            $response->attributes = $_POST['eGameChoiceResponse'];

            $response->user_id = $user_id;
            $response->transaction_id = $gameManager['transaction_id'];

            $responseUser = clientUser::model()->findByPk($response->user_id);

            if (empty($response->game_choice_answer_id)) {
                Yii::app()->user->setFlash('error', Yii::t('youtoo', 'Please choose an answer.'));
                $this->redirect($this->createUrl('/game/multiple3'));
            }

            if ($response->validate()) {
                $response->save();
                Yii::app()->session['gamechoiceresponseId'] = $response->id;

                if ($response->user_id == 0) {
                    $this->redirect($this->createUrl("/loginpay"));
                } else {
                    if ($this->isMobile()) {
                        $this->redirect($this->createURL("/thankyou/"));
                    }
                    $this->redirect($this->createURL("/index.php?f=g"));
                }
            } else {
                Yii::app()->user->setFlash('error', "Errors found!");
            }
        }

        if ($game) {
            $this->render('reveal', array(
                'game' => $game,
                'response' => $response,
                'game_manager' => $gameManager,
                'reveal' => $reveal,
                'reveal_grid' => $revealGrid,
                'reveal_info' => $revealInfo
            ));
        } else {
            echo "No game with this ID exists.";
        }
    }

    public function actionThankYou($id = NULL) {

        if (Yii::app()->user->isGuest) {
            Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl());
            $this->redirect($this->createUrl("/login"));
        }

        $user = clientUser::model()->findByPK(Yii::app()->user->getId());
        $subgameId = GameUtility::getRandomSubGames($id, $user->id);

        if (is_null($subgameId)) {
            if ($this->isMobile()) {
                $this->redirect($this->createURL("/thankyoumobile"));
            }
            $this->redirect($this->createURL("/index.php?f=g"));
        }

        if ($id == NULL) {
            $game = eGameChoice::model()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->with('gameChoiceAnswers')->findByPk((int) $id);
        }
        
        if($game->type == 'sub') {
            $mainGame = eGameChoice::model()->findByPk($game->g_parant_id);
        } else { 
            $mainGame = null;
        }

        $this->render('thankyou', array(
            'user' => $user,
            'game' => $game,
            'mainGame' => $mainGame,
            'subgameId' => $subgameId,
        ));
    }

    public function actionPaidThankYou($id = NULL) {

        if (Yii::app()->user->isGuest) {
            Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl());
            $this->redirect($this->createUrl("/login"));
        }

        $user = clientUser::model()->findByPK(Yii::app()->user->getId());
        $balance = GameUtility::getCashBalance(Yii::app()->user->getId());
        $credits = ClientUtility::getTotalUserBalanceCredits();
        $subgameId = GameUtility::getRandomSubGames($id, $user->id);

        if (is_null($subgameId)) {
            if ($this->isMobile()) {
                $this->redirect($this->createURL("/thankyoumobile"));
            }
            $this->redirect($this->createURL("/index.php?f=g"));
        }

        if ($id == NULL) {
            $game = eGameChoice::model()->isActive()->with('gameChoiceAnswers')->find();
        } else {
            $game = eGameChoice::model()->with('gameChoiceAnswers')->findByPk((int) $id);
        }
        
        if($game->type == 'sub') {
            $mainGame = eGameChoice::model()->findByPk($game->g_parant_id);
        } else { 
            $mainGame = null;
        }

        $this->render('paidthankyou', array(
            'user' => $user,
            'balance' => $balance,
            'credits' => $credits,
            'game' => $game,
            'mainGame' => $mainGame,
            'subgameId' => $subgameId,
        ));
    }

    public function actionThankYouMobile() {

        if (Yii::app()->user->isGuest) {
            Yii::app()->user->setReturnUrl(Yii::app()->request->getUrl());
            $this->redirect($this->createUrl("/login"));
        }

        $this->render('thankyoumobile', array());
    }

}

?>
