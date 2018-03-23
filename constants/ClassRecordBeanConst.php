<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/13
 * Time: 下午4:13
 */

namespace app\modules\constants;


class ClassRecordBeanConst
{
    const CLASS_STATUS_PRE_CREATE       = 0;    //预创建
    const CLASS_STATUS_NORMAL           = 1;    //正常
    const CLASS_STATUS_GRADUATE         = 2;    //已毕业
    const CLASS_STATUS_GRADUATE_SAVE    = 3;    //毕业后保留

    const GRADE_KINDERGARTEN_SMALL      = 1;    //幼儿园小班
    const GRADE_KINDERGARTEN_MID        = 2;    //幼儿园中班
    const GRADE_KINDERGARTEN_BIG        = 3;    //幼儿园大班

    const GRADE_PRIMARY_SCHOOL_FIRST    = 4;    //小学一年级
    const GRADE_PRIMARY_SCHOOL_SECOND   = 5;    //小学二年级
    const GRADE_PRIMARY_SCHOOL_THIRD    = 6;    //小学三年级
    const GRADE_PRIMARY_SCHOOL_FOURTH   = 7;    //小学四年级
    const GRADE_PRIMARY_SCHOOL_FIFTH    = 8;    //小学五年级
    const GRADE_PRIMARY_SCHOOL_SIXTH    = 9;    //小学六年级
    const GRADE_PRIMARY_SCHOOL_SEVENTH  = 10;   //小学七年级

    const GRADE_JUNIOR_HIGH_SCHOOL_FIRST    = 11;  //初一
    const GRADE_JUNIOR_HIGH_SCHOOL_SECOND   = 12;  //初二
    const GRADE_JUNIOR_HIGH_SCHOOL_THIRD    = 13;  //初三
    const GRADE_JUNIOR_HIGH_SCHOOL_FOURTH   = 14;  //初四

    const GRADE_HIGH_SCHOOL_FIRST       = 15;   //高一
    const GRADE_HIGH_SCHOOL_SECOND      = 16;   //高二
    const GRADE_HIGH_SCHOOL_THIRD       = 17;   //高三
}