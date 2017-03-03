<?php
class Controller
{
	
	protected $data = [];
	
	protected function load($view_dir)
	{
		
	}
	protected function render($template, array $data = array() )
	{		
		extract($data);						// 抽取数组中的变量
		
		ob_end_clean();					//关闭顶层的输出缓冲区内容
		ob_start ();						// 开始一个新的缓冲区
		echo '';
		$_FilePath = _VIEW_dir . $template . '.php';
		
		ob_end_flush();
		
		clearstatcache();
		if(file_exists($_FilePath))
		{
			require (_VIEW_dir . $template . '.php');		//加载视图view
		}
		else
			echo "Cannot find View File";
		
		//$content = ob_get_contents ();		// 获得缓冲区的内容
		//ob_end_clean ();					// 关闭缓冲区
	
		//ob_end_flush();						// 这个是直接输出缓冲区的内容了，不用再次缓存起来。
		//ob_start();							//开始新的缓冲区，给后面的程序用
		
		return $content;					// 返回文本，此处也可以字节echo出来，并结束代码。
	}
	
	
}
