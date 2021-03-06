<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:35
 */

namespace app\modules\models;
use app\modules\models\beans\HomeworkItemBean;
use sp_framework\components\SpException;
use sp_framework\constants\SpErrorCodeConst;
use yii\db\Query;

class HomeworkItemModel
{
    const TABLE_NAME = "homework_item";
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
        return array_map(function($d){return new HomeworkItemBean($d);}, $aData);
    }

    public static function convertDbToBean($aData){
        return new HomeworkItemBean($aData);
    }

    public static function insertOneRecord(HomeworkItemBean $schoolRecordBean){
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
     * @param HomeworkItemBean[] $homeworkItemList
     * @return mixed
     * @throws SpException
     */
    public static function insertBatchRecord($homeworkItemList){
        $insertDataList = [];
        $columnKey      = [];
        foreach($homeworkItemList as $homeworkItemBean){
            $aInsertData        = $homeworkItemBean->toArray();
            $aInsertData        = array_filter($aInsertData, function($item){return !is_null($item);});
            $insertDataList[]   = array_values($aInsertData);
            $columnKey          = array_keys($aInsertData);
        }

        try{
            $rowNum = self::getDb()->createCommand()->batchInsert(self::TABLE_NAME, $columnKey, $insertDataList)->execute();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, "insert db error, message is:" . $e->getMessage(), "插入数据库失败");
        }
        return $rowNum;
    }

    /**
     * @param $homeworkRecordUuidList
     * @return HomeworkItemBean[]
     * @throws SpException
     */
    public static function queryHomeworkItemByRecordUuidList($homeworkRecordUuidList){
        $aWhere = [
            'homework_uuid' => $homeworkRecordUuidList,
        ];

        try{
            $aData = (new Query())->select([])->where($aWhere)->from(self::TABLE_NAME)->createCommand(self::getDB())->queryAll();
        }catch(\Exception $e){
            throw new SpException(SpErrorCodeConst::INSERT_DB_ERROR, 'select db error,message is:' . $e->getMessage(), "网络繁忙,请稍后再试");
        }
        return self::convertDbToBeans($aData);
    }
}