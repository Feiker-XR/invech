<?php
namespace app\home\controller;
use app\home\controller\SiteController;
/**
 * 站点首页
 */

class IndexController extends SiteController {

	/**
     * 主页
     */
    public function index()
    {
    	//MEDIA信息
        $media = $this->getMedia();

    	$this->assign('media', $media)   ;
        $this->siteDisplay(config('tpl_index')) ;
    }

    /**
     * 页面不存在
     */
    public function error404(){
        @header("status: 404 not found");
    	$this->siteDisplay('error_404');
    }

    /**
     * 反馈数据入库
     */
    public function feedback()
    {
        $lifeTime = 60 * 60 * 1; //生存周期一个小时
        session_set_cookie_params($lifeTime);
        session_start();
        $data = $_REQUEST ;
        $status = 0 ;
        $data= [
            'nickname'     => $data['nickname'],
            'contact_type' => $data['contact_type'],
            'contact'      => $data['contact'],
            'content'      => $data['content'],
            'type'          =>1, //1:PC端  2:移动端
        ];
        $status = target('Feedback')->addData($data) ;
        $_SESSION['if_submit_feedback'] = 1 ;
        echo $status ; die;
    }

    /**
     * 是否已经提交过了反馈信息
     */
    public function isFeedback()
    {
        session_start();
        $status = '' ;
        if ($_SESSION['if_submit_feedback']){
            $status = 'already' ;
        }
        echo $status ; die;
    }

}