<?php
/**
 * Create by script:createSqlBean.php
 * Date is:2018-03-26
 * Time is:11:24:21
 */

namespace app\modules\models\beans;

/**
 * Comment: 作业进度表
 * Engine: InnoDB
 * Default Charset: utf8
 * Class HomeworkScheduleBean
 * Package namespace app\modules\models\beans
 */
class HomeworkScheduleBean
{
    private $id                 = null; //BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID'
    private $uuid               = null; //VARCHAR(100) DEFAULT '' COMMENT '作业条目唯一ID'
    private $homework_item_uuid = null; //VARCHAR(100) DEFAULT '' COMMENT '作业记录ID'
    private $student_uuid       = null; //VARCHAR(100) DEFAULT '' COMMENT '学生ID'
    private $recorder_uuid      = null; //VARCHAR(100) DEFAULT '' COMMENT '记录者ID'
    private $cost_time          = null; //INT(11) DEFAULT 0 COMMENT '花费时间,单位:分钟'
    private $create_time        = null; //TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间'
    private $update_time        = null; //TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
    
    public function __construct($input){
        $this->id                   = $input['id']                  ?? null;
        $this->uuid                 = $input['uuid']                ?? null;
        $this->homework_item_uuid   = $input['homework_item_uuid']  ?? null;
        $this->student_uuid         = $input['student_uuid']        ?? null;
        $this->recorder_uuid        = $input['recorder_uuid']       ?? null;
        $this->cost_time            = $input['cost_time']           ?? null;
        $this->create_time          = $input['create_time']         ?? null;
        $this->update_time          = $input['update_time']         ?? null;
    }
    
    public function toArray(){
        return [
            'id'                    => $this->id,
            'uuid'                  => $this->uuid,
            'homework_item_uuid'    => $this->homework_item_uuid,
            'student_uuid'          => $this->student_uuid,
            'recorder_uuid'         => $this->recorder_uuid,
            'cost_time'             => $this->cost_time,
            'create_time'           => $this->create_time,
            'update_time'           => $this->update_time,
        ];
    }
    
    public function getID()                 {return $this->id;}
    public function getUuid()               {return $this->uuid;}
    public function getHomeworkItemUuid()   {return $this->homework_item_uuid;}
    public function getStudentUuid()        {return $this->student_uuid;}
    public function getRecorderUuid()       {return $this->recorder_uuid;}
    public function getCostTime()           {return $this->cost_time;}
    public function getCreateTime()         {return $this->create_time;}
    public function getUpdateTime()         {return $this->update_time;}
    
    public function setID($id)                                  {$this->id                  = $id;}
    public function setUuid($uuid)                              {$this->uuid                = $uuid;}
    public function setHomeworkItemUuid($homework_item_uuid)    {$this->homework_item_uuid  = $homework_item_uuid;}
    public function setStudentUuid($student_uuid)               {$this->student_uuid        = $student_uuid;}
    public function setRecorderUuid($recorder_uuid)             {$this->recorder_uuid       = $recorder_uuid;}
    public function setCostTime($cost_time)                     {$this->cost_time           = $cost_time;}
    public function setCreateTime($create_time)                 {$this->create_time         = $create_time;}
    public function setUpdateTime($update_time)                 {$this->update_time         = $update_time;}
}
