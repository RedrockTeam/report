<?php
namespace Home\Controller;
use Think\Controller;
class DetailController extends Controller{
	public function index(){
		$this->display();
	}

	public function getInfo_by_wxdh(){
		//$wxdh = I('get.wxdh');
		// $conf = [
		// 	'id' => session('stuId'),
		// 	'appId' => $wxdh,
		// ];
		//需要替换的地方

		$conf = [
			'appId' => 'a66222d0-f5ba-4fe5-86d4-a3cd01815db4',
			'id' => '1635841',
		];

		$message = send_request('Detail', $conf);
		if($message){
			$this->ajaxReturn($message, 'json');
		}else{
			$this->ajaxReturn(false);
		}
	} 
}
