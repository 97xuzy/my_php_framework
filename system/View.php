<?php
class View
{
	protected $data = [];
	
    protected function render($template, array $var = array() )
    {
    	extract($var);						// 抽取数组中的变量
    	ob_end_clean ();					//关闭顶层的输出缓冲区内容
    	ob_start ();						// 开始一个新的缓冲区
    	require _VIEW_dir . $template . '.html';		//加载视图view
    	$content = ob_get_contents ();		// 获得缓冲区的内容
    	ob_end_clean ();					// 关闭缓冲区
    
    	//ob_end_flush();					// 这个是直接输出缓冲区的内容了，不用再次缓存起来。
    	ob_start();							//开始新的缓冲区，给后面的程序用
    	return $content;					// 返回文本，此处也可以字节echo出来，并结束代码。
    }
    public static function stylesheet($filename)
    {
    	//return '<link rel="stylesheet" type="text/css" href="' . _STYLESHEET_dir.$filename.'.css' . '">';
    	return _STYLESHEET_dir.$filename.'.css';
    }
    public static function script($filename)
    {
    	return '<script src="' . _SCRIPT_dir.$filename . '"></script>';
    }
	
/*
	protected function display($file)
    {
        extract($this->data);
 
        include $file;
    }
 
    protected function assign($key, $value)
    {
        $this->data[$key] = $value;
    }
*/
}
