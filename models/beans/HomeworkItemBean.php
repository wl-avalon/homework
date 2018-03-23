<?php
/**
 * Create by script:createSqlBean.php
 * Date is:2018-03-13
 * Time is:09:59:36
 */

namespace app\modules\models\beans;

/**
 * Comment: 作业条目表
 * Engine: InnoDB
 * Default Charset: utf8
 * Class HomeworkItemBean
 * Package namespace app\modules\models\beans
 */
class HomeworkItemBean
{
    private $id                 = null; //BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID'
    private $uuid               = null; //VARCHAR(100) DEFAULT '' COMMENT '作业条目唯一ID'
    private $homework_uuid      = null; //VARCHAR(100) DEFAULT '' COMMENT '作业记录ID'
    private $creator_uuid       = null; //VARCHAR(100) DEFAULT '' COMMENT '创建者ID'
    private $homework_content   = null; //TEXT COMMENT '作业内容'
    private $create_time        = null; //TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间'
    private $update_time        = null; //TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
    
    public function __construct($input){
        $this->id                   = $input['id']                  ?? null;
        $this->uuid                 = $input['uuid']                ?? null;
        $this->homework_uuid        = $input['homework_uuid']       ?? null;
        $this->creator_uuid         = $input['creator_uuid']        ?? null;
        $this->homework_content     = $input['homework_content']    ?? null;
        $this->create_time          = $input['create_time']         ?? null;
        $this->update_time          = $input['update_time']         ?? null;
    }
    
    public function toArray(){
        return [
            'id'                => $this->id,
            'uuid'              => $this->uuid,
            'homework_uuid'     => $this->homework_uuid,
            'creator_uuid'      => $this->creator_uuid,
            'homework_content'  => $this->homework_content,
            'create_time'       => $this->create_time,
            'update_time'       => $this->update_time,
        ];
    }
    
    public function getID()                 {return $this->id;}
    public function getUuid()               {return $this->uuid;}
    public function getHomeworkUuid()       {return $this->homework_uuid;}
    public function getCreatorUuid()        {return $this->creator_uuid;}
    public function getHomeworkContent()    {return $this->homework_content;}
    public function getCreateTime()         {return $this->create_time;}
    public function getUpdateTime()         {return $this->update_time;}
    
    public function setID($id)                              {$this->id                  = $id;}
    public function setUuid($uuid)                          {$this->uuid                = $uuid;}
    public function setHomeworkUuid($homework_uuid)         {$this->homework_uuid       = $homework_uuid;}
    public function setCreatorUuid($creator_uuid)           {$this->creator_uuid        = $creator_uuid;}
    public function setHomeworkContent($homework_content)   {$this->homework_content    = $homework_content;}
    public function setCreateTime($create_time)             {$this->create_time         = $create_time;}
    public function setUpdateTime($update_time)             {$this->update_time         = $update_time;}
}
