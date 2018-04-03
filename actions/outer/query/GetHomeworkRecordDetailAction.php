<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/4/3
 * Time: 下午7:50
 */

namespace app\modules\actions\outer\query;
use app\modules\services\outer\query\GetHomeworkRecordDetailService;
use sp_framework\actions\BaseAction;

class GetHomeworkRecordDetailAction extends BaseAction
{
    private $homeworkRecordUuid;

    protected function formatParams()
    {
        $this->homeworkRecordUuid   = $this->get('homeworkRecordUuid');
    }

    public function execute()
    {
        return GetHomeworkRecordDetailService::getHomeworkRecordDetail($this->homeworkRecordUuid);
    }
}