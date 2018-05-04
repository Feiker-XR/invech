<?php
namespace app\duxcms\model;
use app\base\model\BaseModel;
/**
 * 碎片表操作
 */
class FragmentModel extends BaseModel {
    //完成
    protected $_auto = array (
         array('content','html_in',3,'function'),
     );
    //验证
    protected $_validate = array(
        array('name','require', '碎片名称不能为空', 1),
        array('label','require', '碎片标识不能为空', 1),
        array('label','', '碎片标识不能重复', 1,'unique'),
        array('content','require', '碎片内容不能为空', 1),
    );

    /**
     * 获取列表
     * @return array 列表
     */
    public function loadList(){
        return  $this->select();
    }

    /**
     * 获取统计
     * @return int 数量
     */
    public function countList(){
        return  $this->count();
    }

    /**
     * 获取信息
     * @param int $fragmentId ID
     * @return array 信息
     */
    public function getInfo($fragmentId)
    {
        $map = array();
        $map['fragment_id'] = $fragmentId;
        return $this->getWhereInfo($map);
    }

    /**
     * 获取信息
     * @param array $where 条件
     * @return array 信息
     */
    public function getWhereInfo($where)
    {
        return $this->where($where)->find();
    }

    /**
     * 更新信息
     * @param string $type 更新类型
     * @return bool 更新状态
     */
    public function saveData($type = 'add'){
        $data = $this->create();
        if(!$data){
            return false;
        }
        if($type == 'add'){
            return $this->add();
        }
        if($type == 'edit'){
            if(empty($data['fragment_id'])){
                return false;
            }
            $status = $this->save();
            if($status === false){
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * 删除信息
     * @param int $fragmentId ID
     * @return bool 删除状态
     */
    public function delData($fragmentId)
    {
        $map = array();
        $map['fragment_id'] = $fragmentId;
        return $this->where($map)->delete();
    }

    /**
     * 碎片类型
     * @param int $fieldsetId ID
     * @return bool 删除状态
     */
    public function typeField()
    {
        $list=array(
            1=> array(
                'name'=>'文本框',
                'property'=>1,
                'html'=>'text',
                ),
            2=> array(
                'name'=>'多行文本',
                'property'=>3,
                'html'=>'textarea',
                ),
            3=> array(
                'name'=>'编辑器',
                'property'=>3,
                'html'=>'editor',
                ),
            4=> array(
                'name'=>'文件上传',
                'property'=>1,
                'html'=>'fileUpload',
                ),
            5=> array(
                'name'=>'单图片上传',
                'property'=>1,
                'html'=>'imgUpload',
                ),
            6=> array(
                'name'=>'日期和时间',
                'property'=>2,
                'html'=>'textTime',
                ),
            
        );
        return $list;
    }    

    /**
     * 字段HTML
     * @param array $config 字段配置
     * @return string HTML信息
     */
    public function htmlFieldFull($type,$content)
    {
        switch ($type) {
            case '1'://文本框
                $html = '
                    <input type="text" class="input" id="content" name="content" size="60"  value="'.$content.'">
                ';
                break;
            case '2'://多行文本
                $html = '
                    <textarea class="input" id="content" name="content" rows="3" cols="62">'.$content.'</textarea>
                ';
                break;
            case '3'://编辑器
                $html = '
                    <textarea class="input js-editor" id="content" name="content" rows="20" >'.html_out($content).'</textarea>
                ';
                break;
            case '4'://文件上传
                $html = '
                    <input type="text" class="input" id="content" name="content" size="40"  value="'.$content.'">
                    <a class="button bg-blue button-small js-file-upload" data="content" id="content_upload" href="javascript:;" ><span class="icon-upload"> 上传</span></a>
                ';
                break;
            case '5'://图片上传
                $html = '
                    <input type="text" class="input" id="content" name="content" size="38"  value="'.$content.'">
                    <a class="button bg-blue button-small js-img-upload" data="content" id="content_upload" preview="content_preview" href="javascript:;" ><span class="icon-upload"> 上传</span></a>
                    <a class="button bg-blue button-small icon-picture-o" id="content_preview" href="javascript:;" > 预览</a>
                ';
                break;

            case '6'://日期和时间
                if(!empty($content)){
                    $content = date('Y/m/d H:i:s',$content);
                }
                $html = '
                    <input type="text" class="input  js-time" id="content" name="content" size="60"  value="'.$content.'">
                ';
                break;
        }
        return $html;

    }    
}
