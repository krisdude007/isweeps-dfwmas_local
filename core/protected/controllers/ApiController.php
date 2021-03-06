<?php

class ApiController extends Controller {

    public $layout = '//layouts/main';

    public function actionImportVideoYt() {

        $this->layout = false;
        //$this->sendEmail("Starting process");
        
        if (count($_POST) == 0 || count($_FILES) == 0) {
            $this->sendEmail("Error: No data sent or some data missing.");
            exit;
        }

        if ($_FILES["file"]["error"] > 0) {
            $this->sendEmail("Error: " . $_FILES["file"]["error"]);
            exit;
        }

        $title = trim($_POST['title']);
        $source = trim($_POST['source']);
        $user_id = 1;
        $fileName = $user_id . '_' . time();
        $fileNameTmp = $_FILES["file"]["name"];
        $fileType = $_FILES["file"]["type"];
        $filePathTmp = $_FILES["file"]["tmp_name"];
        $filePath = Yii::app()->params['paths']['video'] . '/' . $fileName . Yii::app()->params['video']['postExt'];

        if ($fileType != 'video/mp4') {
            $this->sendEmail("Error: Invalid mime type detected ($fileType)!");
            exit;
        }

        // move file to uservideos
        if (!move_uploaded_file($filePathTmp, $filePath)) {
            $this->sendEmail("Error: Unable to copy file from $filePathTmp to $filePath.");
            exit;
        }

        // delete temp file
        unlink($filePathTmp);

        // make sure file doesnt exist
        $video = eVideo::model()->findByAttributes(array('filename' => $fileName));

        // if the video does not exist
        if (!is_null($video)) {
            $this->sendEmail("Error: File name already exists in database.");
            exit;
        }

        // generate thumb
        $start = floor(Yii::app()->params['video']['duration'] / 2);
        $imagefile = str_replace(Yii::app()->params['video']['postExt'], Yii::app()->params['video']['imageExt'], $filePath);

        // generatae thumbnail from video
        VideoUtility::ffmpegGenerateThumbFromVideo($filePath, $imagefile, $start);
        
        // generate gif
        $gifName = Yii::app()->params['paths']['video'] . "/".$fileName.".gif";
        VideoUtility::ffmpegFlvToGif($filePath, $gifName);

        // save video
        $video = new eVideo;
        $video->user_id = $user_id;
        $video->question_id = 1;
        $video->filename = $fileName;
        $video->thumbnail = $fileName;
        $video->processed = 1;
        $video->watermarked = 0;
        $video->title = ($title != '') ? $title : 'untitled';
        $video->description = 'This video was imported from the YouToo App.';
        $video->source = ($source != '') ? $source : 'mobile';
        $video->to_youtube = 0;
        $video->to_facebook = 0;
        $video->to_twitter = 0;
        $video->arbitrator_id = $user_id;
        $video->status = 'new';
        $video->created_on = date("Y-m-d H:i:s");

        if (!$video->save()) {
            $this->sendEmail("Error: Unable to save video. Deleting temp data.");
            exit;
        } else {
            $this->sendEmail("Success: Video successfully imported.");
            exit;
        }
        
        
    }
    
    private function sendEmail($msg) {
        mail('mark@youtoo.com, kyrie42@gmail.com', 'MBC', $msg);
    }

}

?>
