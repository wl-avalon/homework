<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 上午11:17
 */

namespace app\modules\services\outer\commit;
use app\modules\apis\IDAllocApi;
use app\modules\constants\ClassRecordBeanConst;
use app\modules\models\beans\ClassRecordBean;
use app\modules\models\ClassRecordModel;
use sp_framework\components\Assert;

class AddClassService
{
    public static function addClass($schoolUuid, $className, $nowGrade, $createTime, $graduateTime){
        $idResponse = IDAllocApi::nextId();
        Assert::isTrue(!empty($idResponse['data']['nextId']), "网络繁忙,请稍后再试", "获取classUuid失败");
        $classUuid = $idResponse['data']['nextId'];

        $classRecordBeanData = [
            'uuid'                  => $classUuid,
            'school_uuid'           => $schoolUuid,
            'class_name'            => $className,
            'class_create_grade'    => $nowGrade,
            'class_grade'           => $nowGrade,
            'class_create_time'     => $createTime,
            'graduate_time'         => $graduateTime,
            'class_status'          => ClassRecordBeanConst::CLASS_STATUS_NORMAL,
            'create_time'           => date('Y-m-d H:i:s'),
        ];
        $classRecordBean = new ClassRecordBean($classRecordBeanData);
        ClassRecordModel::insertOneRecord($classRecordBean);
        return [];
    }
}