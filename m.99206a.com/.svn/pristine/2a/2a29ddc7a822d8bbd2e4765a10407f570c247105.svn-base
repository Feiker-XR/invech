<?php
// +----------------------------------------------------------------------
// | Author: leon
// +----------------------------------------------------------------------

namespace think\paginator\driver;

use think\Paginator;

class Pay extends Paginator
{
    
    /**
     * 上一页按钮
     * @param string $text
     * @return string
     */
    protected function getPreviousButton($text = "&laquo;")
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(
            $this->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 下一页按钮
     * @param string $text
     * @return string
     */
    protected function getNextButton($text = '&raquo;')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 尾页按钮
     * @param string $text
     * @return string
     */
    protected function getLastButton($text = '&raquo;')
    {
        if ($this->currentPage == $this->lastPage) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->lastPage());

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 添加额外参数
     * @param array params=['总记录'=>455,'总金额'=>123.45]
     * @return string
     */
    public function extra($params)
    {
        $this->options['extra'] = $params;
        return $this;
    }
    
    /**
     * 其他按钮
     * @return string
     */
    protected function getExtraButton()
    {
        $html = '';
        if(isset($this->options['extra'])){
            foreach($this->options['extra'] as $key => $value){
                $html .= $this->getExtraPageWrapper($key . ':' . $value);
            }
        }
        return $html;
    }    
    
    /**
     * 页码按钮
     * @return string
     */
    protected function getLinks()
    {
        if ($this->simple)
            return '';

        $block = [
            'first'  => null,
            'slider' => null,
            'last'   => null
        ];

        $side   = 3;
        $window = $side * 2;

        if ($this->lastPage < $window + 6) {
            $block['first'] = $this->getUrlRange(1, $this->lastPage);
        } elseif ($this->currentPage <= $window) {
            $block['first'] = $this->getUrlRange(1, $window + 2);
            $block['last']  = $this->getUrlRange($this->lastPage - 1, $this->lastPage);
        } elseif ($this->currentPage > ($this->lastPage - $window)) {
            $block['first'] = $this->getUrlRange(1, 2);
            $block['last']  = $this->getUrlRange($this->lastPage - ($window + 2), $this->lastPage);
        } else {
            $block['first']  = $this->getUrlRange(1, 2);
            $block['slider'] = $this->getUrlRange($this->currentPage - $side, $this->currentPage + $side);
            $block['last']   = $this->getUrlRange($this->lastPage - 1, $this->lastPage);
        }

        $html = '';

        if (is_array($block['first'])) {
            $html .= $this->getUrlLinks($block['first']);
        }

        if (is_array($block['slider'])) {
            $html .= $this->getDots();
            $html .= $this->getUrlLinks($block['slider']);
        }

        if (is_array($block['last'])) {
            $html .= $this->getDots();
            $html .= $this->getUrlLinks($block['last']);
        }

        return $html;
    }

    /**
     * 渲染分页html
     * @return mixed
     */
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<div class="pagination"><ul>%s %s %s %s</ul></div>',                    
                $this->getLinks(),
                $this->getNextButton('下一页'),
                $this->getLastButton('尾页'),
                $this->getExtraButton()
            );            
        }else{
            return sprintf(
                '<div class="pagination"><ul>%s</ul></div>',
                $this->getExtraButton()
            );                
        }
    }

    /**
     * 生成一个可点击的按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<li><a href="' . htmlentities($url) . '">' . $page . '</a></li>';
    }

    /**
     * 生成一个禁用的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        //return '<li class="disabled"><span>' . $text . '</span></li>';
        return;
    }

    /**
     * 生成一个激活的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        //return '<li class="active"><span>' . $text . '</span></li>';
        return '<li class="active"><a href="javascript:;">' . $text . '</a></li>';
    }

    /**
     * 生成一个其他的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getExtraPageWrapper($text)
    {        
        return '<li><a href="javascript:;">' . $text . '</a></li>';
    }
    /**
     * 生成省略号按钮
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('...');
    }

    /**
     * 批量生成页码按钮.
     *
     * @param  array $urls
     * @return string
     */
    protected function getUrlLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getPageLinkWrapper($url, $page);
        }

        return $html;
    }

    /**
     * 生成普通页码按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getPageLinkWrapper($url, $page)
    {
        if ($page == $this->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page);
    }
}
