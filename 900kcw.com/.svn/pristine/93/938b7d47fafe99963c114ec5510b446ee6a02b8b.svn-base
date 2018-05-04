<?php
namespace app\article\controller;
use app\home\controller\SiteController;
/**
 * 栏目页面
 */

class CategoryController extends SiteController {

    /**
     * 栏目页
     */
    public function index(){
        $classId = request('get.class_id',0,'intval');
        $urlName = request('get.urlname');
        $select = request('get.info');
        if (empty($classId)&&empty($urlName)) {
            $this->error404();
        }
        //获取栏目信息
        $model = target('CategoryArticle');
        if(!empty($classId)){
            $categoryInfo=$model->getInfo($classId);
        }else if(!empty($urlName)){
            $map = array();
            $map['urlname'] = $urlName;
            $categoryInfo=$model->getWhereInfo($map);
        }else{
            $this->error404();
        }
        $classId = $categoryInfo['class_id'];
        //信息判断
        if (!is_array($categoryInfo)){
            $this->error404();
        }
        if(strtolower($categoryInfo['app'])<>APP_NAME){
            $this->error404();
        }
        $url_info = array(
            'app'      =>'article',
            'class_id' => $classId,
            'urlname'  => $categoryInfo['urlname'],
            );
        //获取条件参数
        $param = target('duxcms/Content')->stringToArray($select);
        //获取自定义查询条件
        $info['fieldset_id'] = $categoryInfo['fieldset_id'];
        $info['issearch'] = '1';
        $selects = target('duxcms/Field')->loadList($info);
        //自动生成多条件查询url 免去页面js传参
        foreach ($selects as $k => $v) {
            $condition[$v['field']]['name'] = $v['name'];
            $condition[$v['field']]['url'] = target('duxcms/Content')->route($v['field'],$param,'all',$url_info,$selects);
            $condition[$v['field']]['value'] = 'all';
            if (!empty($v['config'])) {
                $fields = explode(',', $v['config']);
                $k = 1;
                foreach ($fields as $a => $d) {
                    $condition[$v['field']]['config'][$a]['name'] = $d;
                    $condition[$v['field']]['config'][$a]['url'] =  target('duxcms/Content')->route($v['field'],$param,$k,$url_info,$selects);
                    $condition[$v['field']]['config'][$a]['value'] = 'all';
                    $k++;
                }
            }
        }

        //位置导航
        $crumb = target('duxcms/Category')->loadCrumb($classId);
        //设置查询条件
        $where='';
        if ($categoryInfo['type'] == 0) {
            $classIds = target('duxcms/Category')->getSubClassId($classId);
        }
        if(empty($classIds)){
            $classIds = $categoryInfo['class_id'];
        }
        $where['A.status'] = 1;
        $where[] = 'C.class_id in ('.$classIds.')';

        //分页参数
        $size = intval($categoryInfo['page']); 
        if (empty($size)) {
            $listRows = 20;
        } else {
            $listRows = $size;
        }
        //查询内容数据
        $modelContent = target('ContentArticle');
        if(!empty($categoryInfo['content_order'])){

            $categoryInfo['content_order'] = $categoryInfo['content_order'].',';
        }
        $pageList = $modelContent->page($listRows)->loadList($where,$limit,$categoryInfo['content_order'].'A.time desc,A.content_id desc',$categoryInfo['fieldset_id']);
        $this->pager = $modelContent->pager;
        //URL参数
        $pageMaps = array();
        $pageMaps['class_id'] = $classId;
        $pageMaps['urlname'] = $urlName;
        //获取分页
        $page = $this->getPageShow($pageMaps);
        //查询上级栏目信息
        $parentCategoryInfo = target('duxcms/Category')->getInfo($categoryInfo['parent_id']);
        //获取顶级栏目信息
        $topCategoryInfo = target('duxcms/Category')->getInfo($crumb[0]['class_id']);
        //MEDIA信息
        $media = $this->getMedia($categoryInfo['name'],$categoryInfo['keywords'],$categoryInfo['description']);
        //模板赋值
        $this->assign('categoryInfo', $categoryInfo);
        $this->assign('parentCategoryInfo', $parentCategoryInfo);
        $this->assign('topCategoryInfo', $topCategoryInfo);
        $this->assign('crumb', $crumb);
        $this->assign('pageList', $pageList);
        $this->assign('page', $page);
        $this->assign('media', $media);
        $this->assign('pageMaps', $pageMaps);
        $this->assign('condition', $condition);
        $this->siteDisplay($categoryInfo['class_tpl']);
    }


    /**
     * 栏目页
     */
    public function filter(){
        $classId = request('get.class_id',0,'intval');
        $urlName = request('get.urlname');
        $select = request('get.info');

        if (empty($classId)&&empty($urlName)) {
            $this->error404();
        }
        //获取栏目信息
        $model = target('CategoryArticle');
        if(!empty($classId)){
            $categoryInfo=$model->getInfo($classId);
        }else if(!empty($urlName)){
            $map = array();
            $map['urlname'] = $urlName;
            $categoryInfo=$model->getWhereInfo($map);
        }else{
            $this->error404();
        }
        $classId = $categoryInfo['class_id'];
        //信息判断
        if (!is_array($categoryInfo)){
            $this->error404();
        }
        if(strtolower($categoryInfo['app'])<>APP_NAME){
            $this->error404();
        }

        $url_info = array(
            'app'      =>'article',
            'class_id' => $classId,
            'urlname'  => $categoryInfo['urlname'],
            );
        //获取条件参数
        $param = target('duxcms/Content')->stringToArray($select);
        //智能生成多条件url
        $info['fieldset_id'] = $categoryInfo['fieldset_id'];
        $info['issearch'] = '1';
        $selects = target('duxcms/Field')->loadList($info);
        foreach ($selects as $k => $v) {
            $condition[$v['field']]['name'] = $v['name'];
            $condition[$v['field']]['url'] = target('duxcms/Content')->route($v['field'],$param,'all',$url_info);
             $condition[$v['field']]['value'] = $param[$v['field']];
            if (!empty($v['config'])) {
                $fields = explode(',', $v['config']);
                $k=1;
                foreach ($fields as $a => $d) {
                    $condition[$v['field']]['config'][$a]['name'] = $d;
                    $condition[$v['field']]['config'][$a]['url'] =  target('duxcms/Content')->route($v['field'],$param,$k,$url_info,$selects);
                    $condition[$v['field']]['config'][$a]['i'] = $k;
                    $condition[$v['field']]['config'][$a]['value'] = $param[$v['field']];
                    $k++;
                }
            }
        }

        //位置导航
        $crumb = target('duxcms/Category')->loadCrumb($classId);
        //设置查询条件
        $where='';
        if ($categoryInfo['type'] == 0) {
            $classIds = target('duxcms/Category')->getSubClassId($classId);
        }
        if(empty($classIds)){
            $classIds = $categoryInfo['class_id'];
        }
        foreach ($param as $key => $value) {
            if ($value == 'all') {
               $where[] = 'D.'.$key .' is not null';
            }else{
                $where[] = 'FIND_IN_SET('.$value.',D.'.$key .')';
            }
        }
        $where['A.status'] = 1;
        $where[] = 'C.class_id in ('.$classIds.')';

        //分页参数
        $size = intval($categoryInfo['page']); 
        if (empty($size)) {
            $listRows = 20;
        } else {
            $listRows = $size;
        }
        //查询内容数据
        $modelContent = target('ContentArticle');
        if(!empty($categoryInfo['content_order'])){

            $categoryInfo['content_order'] = $categoryInfo['content_order'].',';
        }
        $pageList = $modelContent->page($listRows)->loadList($where,$limit,$categoryInfo['content_order'].'A.time desc,A.content_id desc',$categoryInfo['fieldset_id']);
        $this->pager = $modelContent->pager;
        //URL参数
        $pageMaps = array();
        $pageMaps['class_id'] = $classId;
        $pageMaps['urlname'] = $urlName;
        //获取分页
        $page = $this->getPageShow($pageMaps);
        //查询上级栏目信息
        $parentCategoryInfo = target('duxcms/Category')->getInfo($categoryInfo['parent_id']);
        //获取顶级栏目信息
        $topCategoryInfo = target('duxcms/Category')->getInfo($crumb[0]['class_id']);
        //MEDIA信息
        $media = $this->getMedia($categoryInfo['name'],$categoryInfo['keywords'],$categoryInfo['description']);
        //模板赋值
        $this->assign('categoryInfo', $categoryInfo);
        $this->assign('parentCategoryInfo', $parentCategoryInfo);
        $this->assign('topCategoryInfo', $topCategoryInfo);
        $this->assign('crumb', $crumb);
        $this->assign('pageList', $pageList);
        $this->assign('page', $page);
        $this->assign('media', $media);
        $this->assign('pageMaps', $pageMaps);
        $this->assign('condition', $condition);
        $this->siteDisplay($categoryInfo['class_tpl']);
    }

}