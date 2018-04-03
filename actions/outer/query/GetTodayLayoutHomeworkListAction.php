<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/2
 * Time: 上午10:42
 */

namespace app\modules\actions\outer\query;
use app\modules\services\outer\query\GetTodayLayoutHomeworkListService;
use sp_framework\actions\BaseAction;

class GetTodayLayoutHomeworkListAction extends BaseAction
{
    private $classUuid;
    private $teacherID;
    private $type;

    protected function formatParams()
    {
        $this->classUuid    = $this->get('classUuid');
        $this->teacherID    = $this->get('memberID');
        $this->type         = $this->get('type');
    }

    public function execute(){
        return GetTodayLayoutHomeworkListService::getTodayLayoutHomeworkList($this->classUuid, $this->type, $this->teacherID);
    }
}