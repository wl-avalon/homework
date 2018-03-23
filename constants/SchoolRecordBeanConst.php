<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/12
 * Time: 下午6:14
 */

namespace app\modules\constants;


class SchoolRecordBeanConst
{
    const SCHOOL_STATUS_PREREGISTER = 0;    //预注册
    const SCHOOL_STATUS_NORMAL      = 1;    //正常
    const SCHOOL_STATUS_REPORT_LOSS = 2;    //挂失(临时不用)
    const SCHOOL_STATUS_LOG_OUT     = 3;    //注销
}