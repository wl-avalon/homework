<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/17
 * Time: 上午11:39
 */

namespace app\modules\services\daemon;
use app\modules\apis\SchoolAdminApi;
use app\modules\constants\RedisKey;
use app\modules\models\beans\HomeworkItemBean;
use app\modules\models\beans\HomeworkRecordBean;
use app\modules\models\HomeworkItemModel;
use app\modules\models\HomeworkRecordModel;
use app\modules\models\HomeworkScheduleModel;
use sp_framework\util\RedisUtil;

class QueryClassFinishDetailService
{
    public static function queryClassFinishDetail(){
        $pageNo = 0;
        $redis = RedisUtil::getInstance('redis');
        while(true){
            $yesterdayDate = date('Y-m-d', strtotime('-1 day'));
            $response = SchoolAdminApi::getClassList($pageNo);
            if($response->failed()){
                sleep(1);
                continue;
            }
            $pageNo++;
            $classRecordList = $response->toArray()['classList'];
            if(empty($classRecordList)){
                break;
            }
            $classUuidList = array_map(function($record){return $record['classUuid'];}, $classRecordList);

            $homeworkRecordBeanList = HomeworkRecordModel::queryHomeworkRecordByDateAndClassUuidList($classUuidList, $yesterdayDate);
            $recordUuidList = [];
            $uuidMapToRecord = [];/** @var HomeworkRecordBean[] $uuidMapToRecord */
            foreach($homeworkRecordBeanList as $homeworkRecordBean){
                $recordUuidList[] = $homeworkRecordBean->getUuid();
                $uuidMapToRecord[$homeworkRecordBean->getUuid()] = $homeworkRecordBean;
            }

            $homeworkItemBeanList = HomeworkItemModel::queryHomeworkItemByRecordUuidList($recordUuidList);
            $itemUuidList = [];
            $itemUuidMapToItem = [];/** @var HomeworkItemBean[] $itemUuidMapToItem */
            foreach($homeworkItemBeanList as $homeworkItemBean){
                $itemUuidList[] = $homeworkItemBean->getUuid();
                $itemUuidMapToItem[$homeworkItemBean->getUuid()] = $homeworkItemBean;
            }

            $scheduleBeanList = HomeworkScheduleModel::queryScheduleByHomeworkItemUuidList($itemUuidList);
            $scheduleDetailList = [];
            foreach($scheduleBeanList as $scheduleBean){
                $itemBean   = $itemUuidMapToItem[$scheduleBean->getUuid()];
                $recordBean = $uuidMapToRecord[$itemBean->getHomeworkUuid()];
                $class      = $recordBean->getClass();
                $subject    = $recordBean->getSubject();

                if(!isset($scheduleDetailList[$class][$subject])){
                    $scheduleDetailList[$class][$subject] = [
                        'sumCostTime'   => 0,
                        'sumCount'      => 0,
                    ];
                }
                $scheduleDetailList[$class][$subject]['sumCount']       += 1;
                $scheduleDetailList[$class][$subject]['sumCostTime']    += $scheduleBean->getCostTime();
            }

            $classFinishDetailList = [];
            foreach($scheduleDetailList as $class => $subjectList){
                foreach($subjectList as $subject => $detail){
                    $classFinishDetailList[$class][$subject] = [
                        'averageTime'   => $detail['sumCount'] > 0 ? $detail['sumCostTime'] / $detail['sumCount'] : 0,
                        'sumCount'      => $detail['sumCount'],
                    ];
                }
            }

            foreach($classFinishDetailList as $class => $subjectList){
                foreach($subjectList as $subject => $detail){
                    $redisKey = RedisKey::CLASS_FINISH_DETAIL_DATE . "{$class}_{$subject}_{$yesterdayDate}";
                    $redis->set($redisKey, json_encode($classFinishDetailList));
                }
            }
        }
    }
}