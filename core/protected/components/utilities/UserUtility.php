<?php

class UserUtility {

    /**
     * login
     *
     * Put these here to avoid duplicate methods for admin and client
     */
    public static function login($user, $adminAuthAttempt = false, $mobileAuthAttempt = false) {
        if ($user->validate()) {

            if($adminAuthAttempt) {
                $userRecord = $user->isAdmin()->findByAttributes(array('username' => $user->username));
            } else {
                $userRecord = $user->findByAttributes(array('username' => $user->username));
            }

            if(is_null($userRecord)) {
                return false;
            }

            $identity = new UserIdentity($user->username,$user->password,$user->scenario);
            $userLogin = new eUserLogin;
            $userLogin->source = $user->source;
            $userLogin->user_id = $userRecord->id;

            if ($identity->authenticate()) {

                if(!$mobileAuthAttempt) {
                    Yii::app()->user->login($identity, Yii::app()->params['session']['duration']);
                }

                $userLogin->result = 'PASS';
                $userLogin->save();

                $userTech = new eUserTech();
                $userTech->user_id = $userRecord->id;
                $userTech->login_id = $userLogin->id;
                $userTech->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $userTech->screen_height =  (isset($_POST['screen_height'])) ? $_POST['screen_height'] : 0;
                $userTech->screen_width = (isset($_POST['screen_width'])) ? $_POST['screen_width'] : 0;
                $userTech->save();



                return true;
            } else {

                $userLogin->result = 'FAIL';
                $userLogin->save();

                if(!$mobileAuthAttempt) {
                    Yii::app()->user->setFlash('error', Yii::app()->params['flashMessage']['loginError']);
                }

                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * logout
     *
     * Put these here to avoid duplicate methods for admin and client
     */
    public static function logout($deleteCookies = true) {
        if($deleteCookies) {
            Yii::app()->request->cookies->clear();
        }
        $audit = new eAudit;
        $audit->action = 'Logged Out';
        $audit->save();
        Yii::app()->user->logout();
        return true;
    }


    public static function getAvatar($user,$size='') {
        if($user) {
            if( $image = eImage::model()->accepted()->recent()->isAvatar()->findByAttributes(array('user_id' => $user->id))) {
                if(empty($size))
                    return '/'. basename(Yii::app()->params['paths']['image'])."/{$image->filename}";
                $fileName = ImageUtility::getThumbName($image->filename, $size);
                if(file_exists(Yii::app()->params['paths']['image']."/" .$fileName))
                    return '/'. basename(Yii::app()->params['paths']['image'])."/". $fileName;
                else
                    return '/'. basename(Yii::app()->params['paths']['image'])."/{$image->filename}";
            } else {
                if($twitter = eUserTwitter::model()->findByAttributes(Array('user_id'=>$user->id))) {
                    return TwitterUtility::getAvatarFromID($twitter->twitter_user_id);
                }
                if($facebook = eUserFacebook::model()->findByAttributes(Array('user_id'=>$user->id))) {
                    return FacebookUtility::getAvatarFromID($facebook->facebook_user_id);
                }
            }
        }
        return '/webassets/images/you/profile-avitar.png';
    }

    public static function register($user,$userEmail,$userLocation){
        //forcefully execute all validate for error message
        $valUser = $user->validate();
        $valEmail = $userEmail->validate();
        $valLocation = $userLocation->validate();
        if($valEmail && $valLocation && $valUser) {
            $user->save();
            $userEmail->user_id = $user->id;
            $userLocation->user_id = $user->id;
            $userEmail->save();
            $userLocation->save();
            $audit = new eAudit;
            $audit->user_id = $user->id;
            $audit->action = 'created an account via '.$user->source;
            $audit->save();
            return true;
        }
        return false;
    }

    public static function getAvailablePermissions(){
        $declaredClasses = get_declared_classes();
        foreach (glob('{'.Yii::getPathOfAlias('core.controllers').'/Admin*Controller.php,'.Yii::getPathOfAlias('client.controllers').'/Admin*Controller.php}',GLOB_BRACE) as $controller){
            $class = basename($controller, ".php");
            if (!in_array($class, $declaredClasses)){
                include_once($controller);
            }
        }
        foreach(get_declared_classes() as $class){
            if(preg_match('/^Admin\w+Controller/',$class)){
                $classes[strtolower(preg_replace('/Controller/','',$class))] = implode(' ',preg_split('/(?<=\\w)(?=[A-Z])/',preg_replace('/Controller/','',$class)));
            }
        }
        ksort($classes);

        $permissionsExtended = empty(Yii::app()->params['user']['extendedPermissions'])?null:Yii::app()->params['user']['extendedPermissions'];

        if(!empty($permissionsExtended))
        {
            $classes = CMap::mergeArray($classes, $permissionsExtended);
        }

        return $classes;
    }

    public static function getUserIP()
    {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

}

?>
