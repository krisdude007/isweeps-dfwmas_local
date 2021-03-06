<?php

class BrightcoveUtility {

    public $errors;

    public function __construct() {
        require_once('core/protected/vendor/brightcove/bc-mapi.php');
        require_once('core/protected/vendor/brightcove/bc-mapi-cache.php');
        $this->bc = new BCMAPI(
                'Y0Qbp-HaC5xOF44xs4QjAMOxZLVap32F_GAYmPz1Plcl10Xx2tTGBQ..', 'Y0Qbp-HaC5xOF44xs4QjAMOxZLVap32F4KVvGK8i0Y9MfGHrpW-1Xg..'
        );
        $this->bc_cache = new BCMAPICache('file', 600, '/x/brightcove/cache/', '.cache');
        $this->bc->__set('secure', TRUE);
    }

    public function publish($video) {
        // TODO:  I don't like .youtoo.com here.  Needs to be dynamic.
        $client = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : Yii::app()->params['client'] . '.' . 'youtoo.com';
        if (Yii::app()->params['dev'] != '') {
            $client = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : Yii::app()->params['dev'] . '.' . Yii::app()->params['client'] . '.' . 'youtoo.com';
        }
        //echo 'client is: ' .$client .' - ';
        $source = array('web', 'instagram', 'vine', 'ad');
        $file = '';
        if (in_array($video->source, $source)) {
            $file = Yii::app()->params['paths']['video'] . "/{$video->filename}" . Yii::app()->params['video']['postExt'];
        } else {
            $findAllFiles = glob(Yii::app()->params['paths']['video'] . '/' . $video->filename . '_orig.*');
            if (!empty($findAllFiles)) {
                foreach ($findAllFiles as $findFile) {
                    $ext = VideoUtility::getFileExtension($findFile);
                    $file = Yii::app()->params['paths']['video'] . "/{$video->filename}_orig." . $ext;
                }
            } else {
                $file = Yii::app()->params['paths']['video'] . "/{$video->filename}" . Yii::app()->params['video']['postExt'];
            }
        }

        $meta = array(
            'name' => $video->title,
            'shortDescription' => $video->title,
            'referenceId' => $client . "-" . $video->id,
        );

        $options = array(
            'preserve_source_rendition' => false,
            'create_multiple_renditions' => true,
        );
        try {
            $id = $this->bc->createMedia('video', $file, $meta, $options);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo "{$video->id} failed to reach brightcove: {$message} \n\n";
            $id = 'failed';
        }
        $status = (is_numeric($id)) ? $this->status($id) : false;
        if ($status) {
            $brightcove = eBrightcove::model()->findByAttributes(Array('video_id' => $video->id));
            $brightcove->brightcove_id = $id;
            $brightcove->status = 'sent';
            $brightcove->save();
        }
        return $status;
    }

    public function status($brightcoveID) {
        try {
            $status = $this->bc->getStatus('video', $brightcoveID);
        } catch (Exception $e) {
            $status = false;
            $this->errors = $e->getMessage();
        }
        return $status;
    }

    public function retrieve($brightcoveID) {
        $params = array(
            'video_id' => $brightcoveID
        );
        $video = $this->bc->find('videoById', $params);
        $video = json_encode($video);
        return $video;
    }

    public static function getPlayCountAndItemState($video) {
        $bcove = eBrightcove::model()->findByAttributes(Array('video_id' => $video->id));
        $url = 'http://api.brightcove.com/services/library?command=find_video_by_id&video_id=' . $bcove->brightcove_id . '&video_fields=playsTotal%2CitemState&media_delivery=default&token=Y0Qbp-HaC5xOF44xs4QjAMOxZLVap32F_GAYmPz1Plcl10Xx2tTGBQ..';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        $playCountAndItemState = json_decode($json);
        return $playCountAndItemState;
    }

}

?>
