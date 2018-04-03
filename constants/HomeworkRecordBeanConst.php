<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午6:43
 */

namespace app\modules\constants;


class HomeworkRecordBeanConst
{
    const HOMEWORK_STATUS_CREATE        = 0;    //已创建
    const HOMEWORK_STATUS_CREATE_DONE   = 1;    //布置完成
    const HOMEWORK_STATUS_SEND_DONE     = 2;    //已发送

    public static $subjectMap = ['无', '语文','数学','英语','物理','化学','生物','历史','地理','政治', '其他'];
}