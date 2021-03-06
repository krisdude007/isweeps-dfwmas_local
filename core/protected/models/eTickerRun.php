<?php

/**
 * This is the model class for table "ticker_runs".
 *
 * The followings are the available columns in table 'ticker_runs':
 * @property integer $id
 * @property integer $ticker_id
 * @property integer $user_id
 * @property integer $web_runs
 * @property integer $mobile_runs
 * @property integer $tv_runs
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property Ticker $ticker
 * @property User $user
 */
class eTickerRun extends TickerRun
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TickerRuns the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('ticker_id, user_id', 'required'),
			array('ticker_id, user_id, web_runs, mobile_runs, tv_runs, web_ran, mobile_ran, tv_ran, stopped', 'numerical', 'integerOnly'=>true),
                        array('created_on,updated_on', 'default', 'value' => date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on' => 'insert'),
                        array('updated_on', 'default', 'value' => date("Y-m-d H:i:s"),'setOnEmpty'=>false,'on' => 'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ticker_id, user_id, web_runs, mobile_runs, tv_runs, web_ran, mobile_ran, tv_ran, stopped, created_on, updated_on', 'safe', 'on'=>'search'),
		);
	}

        public function afterSave(){
            $runs = self::model()->shouldRun()->findAll();
            if(sizeof($runs) > 0){
                ProcessUtility::startProcess('tickerstream');
            } else {
                ProcessUtility::killProcess('tickerstream');
            }
            return parent::afterSave();
        }


	public function scopes(){
            return array(
                'shouldRun' => array('condition' => 'stopped != 1 && (web_runs > web_ran || mobile_runs > mobile_ran || tv_runs > tv_ran)'),
            );
        }
}