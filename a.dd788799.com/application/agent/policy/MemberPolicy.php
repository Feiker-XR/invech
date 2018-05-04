<?php

namespace app\agent\policy;

use app\common\model\Member;

class MemberPolicy
{
    //操作会员- 编辑,删除,查看
    //策略判断,当前用户是否能操作(查看,修改,删除)指定会员;
    public function optMember(Member $current, Member $member){
        return $current->isAgentOf($member);
    }
}
