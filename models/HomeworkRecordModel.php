<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:34
 */

namespace app\modules\models;
use app\modules\models\beans\HomeworkRecordBean;
use sp_framework\components\SpException;
use sp_framework\constants\SpErrorCodeConst;
use yii\db\Query;

class HomeworkRecordModel
{
    const TABLE_NAME = "homework_record";
    private static $db_homework;

    public static function getDB(){
        if(is_null(self::$db_homework)){
            self::$db_homework = \Yii::$app->db_homework;
        }
        return self::$db_homework;
    }

    public static function convertDbToBeans($aData){
        if(!is_array($aData) || empty($aData)) {
            return [];
        }
        return array_map(function($d){return new HomeworkRecordBean($d);}, $aData);
    }

    public static function convertDbToBean($aData){
        return new HomeworkRecordBean($aData);
    }

    public static function insertOneRecord(HomeworkRecordBean $schoolRecordBean){
        $aInsertData = $schoolRecordBean->toArray();
        $aInsertData = array_filter($aInsertData, function($item){return !is_null($item);});
        try{
            $rowNum = self::getDB()->createCommand()->insert(self::TABLE_NAME, $aInsertData)->execute();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, "insert db error, message is:" . $e->getMessage(), "网络繁忙,请稍后再试");
        }
        return $rowNum;
    }

    /**
     * @param $classUuidList
     * @param $creatorUuid
     * @return HomeworkRecordBean[]
     * @throws SpException
     */
    public static function queryTodayHomeworkRecordByClassUuidList($classUuidList, $creatorUuid = ''){
        $aWhere = [
            'class'         => $classUuidList,
            'homework_date' => date('Y-m-d'),
        ];
        if(!empty($creatorUuid)){
            $aWhere['creator_uuid'] = $creatorUuid;
        }

        try{
            $aData = (new Query())->select([])->where($aWhere)->from(self::TABLE_NAME)->createCommand(self::getDB())->queryAll();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, 'select db error,message is:' . $e->getMessage(), "网络繁忙,请稍后再试");
        }
        return self::convertDbToBeans($aData);
    }
}