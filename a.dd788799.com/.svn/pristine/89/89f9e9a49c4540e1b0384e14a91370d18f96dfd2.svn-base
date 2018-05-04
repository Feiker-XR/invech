<?php
namespace app\admin\controller;
use app\admin\Base;
use think\captcha\Captcha;

class Test extends Base
{
    public function apply()
    {

    }    

    public function inbox()
    {
        $query = (new MemberModel)->getInboxBuilder('admin');
        $list = $query->where('status',0)->paginate();
        $this->assign('list',$list);



        $member = Member::get(312);
        $query = $member->getInboxBuilder('member');

        $agent = Member::get(313);
        $query = $member->getInboxBuilder('agent');



    }     

    public function apply(){
        $member = Member::get(303);
        $member->apply('agent');
        $member->apply('withdraw');  
        

        $apply = Apply::get(1);
        $this-user->agree_audit($apply,'辅导辅导辅导');  

    }


}