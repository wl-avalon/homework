<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:35
 */

namespace app\modules\models;
use app\modules\models\beans\HomeworkScheduleBean;
use sp_framework\components\SpException;
use sp_framework\constants\SpErrorCodeConst;
use yii\db\Query;

class HomeworkScheduleModel
{
    const TABLE_NAME = "homework_schedule";
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
        return array_map(function($d){return new HomeworkScheduleBean($d);}, $aData);
    }

    public static function convertDbToBean($aData){
        return new HomeworkScheduleBean($aData);
    }

    public static function insertOneRecord(HomeworkScheduleBean $schoolRecordBean){
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
     * @param $homeworkItemUuidList
     * @param $childUuid
     * @return HomeworkScheduleBean[]
     * @throws SpException
     */
    public static function queryScheduleByChildAndItemUuidList($childUuid, $homeworkItemUuidList){
        $aWhere = [
            'homework_item_uuid'    => $homeworkItemUuidList,
            'student_uuid'          => $childUuid,
        ];

        try{
            $aData = (new Query())->select([])->where($aWhere)->from(self::TABLE_NAME)->createCommand(self::getDB())->queryAll();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, 'select db error,message is:' . $e->getMessage(), "网络繁忙,请稍后再试");
        }
        return self::convertDbToBeans($aData);
    }

    public static function queryScheduleByChildAndItemUuid($childUuid, $homeworkItemUuid){
        $aWhere = [
            'homework_item_uuid'    => $homeworkItemUuid,
            'student_uuid'          => $childUuid,
        ];

        try{
            $aData = (new Query())->select([])->where($aWhere)->from(self::TABLE_NAME)->createCommand(self::getDB())->queryOne();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, 'select db error,message is:' . $e->getMessage(), "网络繁忙,请稍后再试");
        }
        return self::convertDbToBean($aData);
    }

    /**
     * @param $homeworkItemUuid
     * @return HomeworkScheduleBean[]
     * @throws SpException
     */
    public static function queryScheduleByHomeworkItemUuidList($homeworkItemUuid){
        $aWhere = [
            'homework_item_uuid'    => $homeworkItemUuid,
        ];

        try{
            $aData = (new Query())->select([])->where($aWhere)->from(self::TABLE_NAME)->createCommand(self::getDB())->queryAll();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, 'select db error,message is:' . $e->getMessage(), "网络繁忙,请稍后再试");
        }
        return self::convertDbToBeans($aData);
    }
}