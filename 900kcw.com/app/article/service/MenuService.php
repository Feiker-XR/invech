<?php
namespace app\article\service;
/**
 * 后台菜单接口
 */
class MenuService{
    /**
     * 获取菜单结构
     */
    public function getAdminMenu(){
        return array(
            'Article' => array(
                'name' => '内容',
                'icon' => 'folder',
                'order' => 1,
                'app'   =>'cate'
            )
        );
    }
    


}
