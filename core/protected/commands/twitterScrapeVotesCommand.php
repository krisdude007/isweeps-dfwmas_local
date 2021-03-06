<?php

class twitterScrapeVotesCommand extends CConsoleCommand {
    public function run($args){
        $responses = array();
        $polls = ePoll::model()->with('pollAnswers')->current()->findAll();
        foreach($polls as $poll){
            foreach($poll->pollAnswers as $pollAnswer){
                $responses[] = Array(
                    'hashtag'=>$pollAnswer['hashtag'],
                    'answer_id'=>$pollAnswer['id'],
                    'poll_id'=>$poll['id'],
                );
            }
        }
        $pos = 0;
        while(true){
            $result = self::getVotesFromStream($responses,$pos);
            $positions = json_decode($result);
            $pos = $positions->endPos;
            usleep(500000);
        }
    }

    private static function getVotesFromStream($responses,$position){
        $position = (is_numeric($position)) ? $position : -20000;
        $file = Yii::app()->twitter->streamFile;
        $fp = fopen($file, 'r');
        if(!$fp){
            die('can\'t open stream file!');
        }
        fseek($fp,$position,($position < 0) ? SEEK_END : SEEK_SET);
        if(!feof($fp)){
            $buffer = stream_get_line($fp,10000,"\r\n");
            if($position < 0){
                $buffer = stream_get_line($fp,10000,"\r\n");
            }
            $tweet = json_decode($buffer);
            if(is_object($tweet)){
                foreach($responses as $response){
                    if(stripos($tweet->text,$response['hashtag'])){
                        $pollResponse = new ePollResponse;
                        $pollResponse->answer_id = $response['answer_id'];
                        $pollResponse->poll_id = $response['poll_id'];
                        $pollResponse->source = 'twitter';
                        $pollResponse->source_user_id = $tweet->user->id;
                        $pollResponse->source_content_id = $tweet->id_str;
                        $pollResponse->save();
                    }
                }
            }
        }
        $results['beginPos'] = $position;
        $results['endPos'] = ftell($fp);
        fclose($fp);
        return(json_encode($results));
    }
}

?>
