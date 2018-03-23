<?php
/**
 * Create by script:createSqlBean.php
 * Date is:2018-03-13
 * Time is:09:59:36
 */

namespace app\modules\models\beans;

/**
 * Comment: 作业记录表
 * Engine: InnoDB
 * Default Charset: utf8
 * Class HomeworkRecordBean
 * Package namespace app\modules\models\beans
 */
class HomeworkRecordBean
{
    private $id                 = null; //BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID'
    private $uuid               = null; //VARCHAR(100) DEFAULT '' COMMENT '作业唯一ID'
    private $creator_uuid       = null; //VARCHAR(100) DEFAULT '' COMMENT '创建者ID'
    private $homework_status    = null; //TINYINT(4) DEFAULT 0 COMMENT '作业状态 0:已创建 1:布置完成 2:已发送'
    private $homework_date      = null; //DATE DEFAULT '0000-00-00' COMMENT '布置作业日期'
    private $create_time        = null; //TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间'
    private $update_time        = null; //TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
    
    public function __construct($input){
        $this->id               = $input['id']              ?? null;
        $this->uuid             = $input['uuid']            ?? null;
        $this->creator_uuid     = $input['creator_uuid']    ?? null;
        $this->homework_status  = $input['homework_status'] ?? null;
        $this->homework_date    = $input['homework_date']   ?? null;
        $this->create_time      = $input['create_time']     ?? null;
        $this->update_time      = $input['update_time']     ?? null;
    }
    
    public function toArray(){
        return [
            'id'                => $this->id,
            'uuid'              => $this->uuid,
            'creator_uuid'      => $this->creator_uuid,
            'homework_status'   => $this->homework_status,
            'homework_date'     => $this->homework_date,
            'create_time'       => $this->create_time,
            'update_time'       => $this->update_time,
        ];
    }
    
    public function getID()                 {return $this->id;}
    public function getUuid()               {return $this->uuid;}
    public function getCreatorUuid()        {return $this->creator_uuid;}
    public function getHomeworkStatus()     {return $this->homework_status;}
    public function getHomeworkDate()       {return $this->homework_date;}
    public function getCreateTime()         {return $this->create_time;}
    public function getUpdateTime()         {return $this->update_time;}
    
    public function setID($id)                              {$this->id              = $id;}
    public function setUuid($uuid)                          {$this->uuid            = $uuid;}
    public function setCreatorUuid($creator_uuid)           {$this->creator_uuid    = $creator_uuid;}
    public function setHomeworkStatus($homework_status)     {$this->homework_status = $homework_status;}
    public function setHomeworkDate($homework_date)         {$this->homework_date   = $homework_date;}
    public function setCreateTime($create_time)             {$this->create_time     = $create_time;}
    public function setUpdateTime($update_time)             {$this->update_time     = $update_time;}
}
