<?php
namespace Home\Controller;
use Think\Controller;
class SubmitController extends Controller {
	public function index(){
		if(!session('stuId')){
			$this->error('请先登陆');
		}else{
			$this->display();
		}
	}

	public function submit(){
		//先接受get数组，然后再填充到conf里面
		$conf = [
			'rzm' => 1635841,
			'xm' => '杜泽萱',
			'ip' => '202.202.41.125',
			'bt' => '这是测试数据，请穆老师处理',
			'fwxmh' => 01,
			'bxdh' => 18580024667,
			'fwquy' => '',
			'wxdd' => '27栋',
			'bxnr' => '这是测试数据，请穆老师处理',
			'wxdjh' => 'a66222d0-f5ba-4fe5-86d4-a3cd01815db4',
			'hfmyd' => '满意',
			'hfjy' =>'这是测试数据，请穆老师处理',
		];

		$wxdh = send_request('RepairApp', $conf);//提交
		if($wxdh){
			$this->ajaxReturn(true);
		}else{
			$this->ajaxReturn(false);
		}
	}
}
