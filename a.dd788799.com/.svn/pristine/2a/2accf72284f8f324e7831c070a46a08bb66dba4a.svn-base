<?php

namespace app\index\controller;

use app\index\Base;
use app\common\model\Help as HelpModel;
use app\common\model\HelpCat as HelpCatModel;
class Help extends Base
{   
    
   public  function show($id=''){
        $help_cat = HelpCatModel::allHelpCat();
        if(!$id){
            $id = '8';
        }
        
        $help = HelpModel::get($id);
     
        $this->assign('help_cat',$help_cat);
        $this->assign('id',$id);
        $this->assign('help',$help);
        return $this->fetch();
    }

}
