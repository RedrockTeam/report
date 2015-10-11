<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	// public function index(){
	//     if($this->getStumByOpenId()){
	//     	$this->display();
	//     }else{
	//     	$this->error('您没有绑定小帮手哦');
	//     }
	// }
	// //入口方法
	public function index(){
		$this->display();
	}

	private function getStumByOpenId(){
		$openid = I('get.openid');
	    if($openid){
	        session('openid', $openid);
	    }else{
	        $this->error('没有openid');
	    }
	    //获取openid

	    $string = 'dsadsadsadsadsadsa';
	    $time = time();
	    $access = array(
	            'token' => 'gh_68f0a1ffc303',
	            'timestamp' => $time,
	            'string' => $string,
	            'secret' => sha1(sha1($time) . md5($string) . "redrock"),
	            'openid' => $openid
	    );
	    $url =  "http://hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/bindVerify";
	    $res = $this->curl_api($url, $access);
	    if($res['stuId']){
	        $stuId = $res['stuId'];
	        session('stuId', $stuId);
	        return 1;
	    }else{
	        $this->error('您没有绑定小帮手哦');
	    }
	    //获取学号
	}
	//通过获取openid获取学号的方法

 	public function LoadData(){//主页面数据的抓取方法
		$time = I('get.time');//下拉的次数


		$conf = [
			'id' => 1635841,
			'appId' => 'a66222d0-f5ba-4fe5-86d4-a3cd01815db4',
			'cateId' => '01',
			'rzm' => 1635841,
			'wxdjh' => 'a66222d0-f5ba-4fe5-86d4-a3cd01815db4',
			'hfmyd' => '满意',
			'hfjy' =>'这是测试数据，请穆老师处理',
 		];


		$res = send_request('InfoById', $conf);//获取从接口拿到的保修单数据
		if($res){
			D('Globle')->cacheRefresh($res);//每次查询的时候跟新本地缓存
			$this->ajaxReturn($res, 'json');//返回json
		}else{                                     //查看是否为接口问题
			$where = ['wx_bxrrzm' => $conf['id']];	
			if($res = M('Globle')->where($where)->select()){   //本地有数据就调用本地的
				$this->ajaxReturn($res, 'json');                             
			}else{
				$this->ajaxReturn(false);//表示没有数据
			}
		}
 	}
 	/*获取主页面信息以及下拉的处理的方法 
	获取地点的先后顺序是先请求远端，
	如果远端没有数据，可能是本身没有，也可能是跪了
	如果是跪了本地有缓存就调用缓存，如果没有就是没有数据，
	返回false
 	*/

 	
}
