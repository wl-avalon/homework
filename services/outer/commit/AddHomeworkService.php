<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:08
 */

namespace app\modules\services\outer\commit;
use app\modules\apis\IDAllocApi;
use app\modules\constants\HomeworkRecordBeanConst;
use app\modules\models\beans\HomeworkItemBean;
use app\modules\models\beans\HomeworkRecordBean;
use app\modules\models\HomeworkItemModel;
use app\modules\models\HomeworkRecordModel;
use sp_framework\components\Assert;

class AddHomeworkService
{
    public static function addHomework($creatorUuid, $homeworkContent, $homeworkDate){
        $idResponse         = IDAllocApi::batch(count($homeworkContent) + 1);
        if(empty($idResponse['data'])){
            return false;
        }
        $uuidList           = explode(',', $idResponse['data']);
        Assert::isTrue(count($uuidList) < count($homeworkContent) + 1, "网络繁忙,请稍后再试", "获取作业ID失败");
        $homeworkRecordUuid     = array_shift($uuidList);

        $homeworkRecordBeanData = [
            'uuid'              => $homeworkRecordUuid,
            'creator_uuid'      => $creatorUuid,
            'homework_status'   => HomeworkRecordBeanConst::HOMEWORK_STATUS_CREATE_DONE,
            'homework_date'     => $homeworkDate,
            'create_time'       => date('Y-m-d H:i:s'),
        ];
        $homeworkRecordBean = new HomeworkRecordBean($homeworkRecordBeanData);
        HomeworkRecordModel::insertOneRecord($homeworkRecordBean);

        $i = 0;
        $homeworkItemBeanList = [];
        foreach($homeworkContent as $homeworkContentItem){
            $content = trim($homeworkContentItem['content']);
            $homeworkContent = [
                'content' => $content,
            ];
            $homeworkItemBeanData = [
                'uuid'              => $uuidList[$i],
                'homework_uuid'     => $homeworkRecordUuid,
                'creator_uuid'      => $creatorUuid,
                'homework_content'  => json_encode($homeworkContent),
                'create_time'       => date('Y-m-d H:i:s'),
            ];
            $homeworkItemBean = new HomeworkItemBean($homeworkItemBeanData);
            $homeworkItemBeanList[] = $homeworkItemBean;
        }
        HomeworkItemModel::insertBatchRecord($homeworkItemBeanList);
        return [];
    }
}