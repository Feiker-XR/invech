<?php
// +----------------------------------------------------------------------
// | describe=>  日志类
// +----------------------------------------------------------------------
// | CreateDate=> 2017年11月23日
// +----------------------------------------------------------------------
// | Author=>
// +----------------------------------------------------------------------

class Log {

    public $suffix = '.txt';

    /**
     * 写入新日志
     * @param string $content
     * @param string $logPath
     */
    public function add($content='',$logDirPath='./log')
    {
        $dirName = date('Y_m_d',time()) ; //以每天的日期命名
        $dirPath = $logDirPath.'/'.$dirName ;
        $this->mkdirs($dirPath) ; //日志目录不存在时,创建之
        $filePath = $this->getFilePath($dirPath) ; //获得文件路径
        $this->writeContentToLog($filePath,$content) ; //写入日志
    }

    /**
     *  将内容写入日志文件
     * @param $filePath
     * @param $content
     */
    private  function writeContentToLog($filePath,$content)
    {
        $content  =  date('Y-m-d H:i:s',time())."\t :".$content ;
        $content .= "\r\n\r\n" ;
        $fp       = fopen($filePath, "a+") ;
        $flag     = fwrite($fp,$content) ;
        fclose($fp) ;
    }

    /**
     * 返回日志文件路径
     * @param $logDirPath
     */
    public function getFilePath($logDirPath)
    {
        $fileName = date('H',time()) ;
        return $logDirPath.'/'.$fileName.$this->suffix ;
    }

    /**
     *  如果没有日志目录则创建日志目录
     * @param string $path
     * @param string $mode
     */
    public function mkdirs($path='',$mode='777')
    {
        if (!is_dir($path)) {
            mkdir($path,$mode)  ;
            chmod($path, $mode) ;
        }
    }

}
