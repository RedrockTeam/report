<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
	    if($this->getStumByOpenId()){
	     	// $this->firstLoad();
	     	$this->LoadData();
	    	$this->display();
	    }else{
	    	$this->error('您没有绑定小帮手哦');
	    }
	}

	private function getStumByOpenId(){
		//$openid = I('get.openid');
		//需要替换的地方
		$openid = 'ouRCyjsp3eo3FJil24fV625V_6no';
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
	    $url1 =  "http://hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/bindVerify";
	    $res1 = $this->curl_api($url1, $access);
	    $url2 = "http://hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/userInfo";
	    $res2 = $this->curl_api($url2, $access);
	    if($res1['stuId']){
	        $stuId = $res1['stuId'];
	        session('stuId', $stuId);
	     	session('usrname', $res2['data']['nickname']);
	        return 1;
	    }else{
	        $this->error('您没有绑定小帮手哦');
	    }
	    //获取学号
	}
	//通过获取openid获取学号的方法

	private function curl_api($url, $data){
        // 初始化一个curl对象
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query($data) );
        // 运行curl，获取网页。
        $contents = json_decode(curl_exec($ch),true);
        // 关闭请求
        curl_close($ch);
        return $contents;
    }

    public function firstLoad(){
		$conf = [
			'id' => 1635841,
			//'id' => session('stuId'),
			//需要替换的地方
 		];
		$res = send_request('InfoById', $conf);//获取从接口拿到的保修单数据
		if($res){
			if(count($res) <= 5){
				D('Globle')->cacheRefresh($res);//每次查询的时候跟新本地缓存
				$this->ajaxReturn($res, 'json');//返回json
			}else if(count($res) != 27){
				D('Globle')->cacheRefresh($res);
				$top5 = array_slice($res, 1, 5);
				$this->ajaxReturn($top5, 'json');
			}else{
				D('Globle')->cacheRefresh($res);//每次查询的时候跟新本地缓存
				$this->ajaxReturn($res, 'json');//返回json
			}
		}else{                                     //查看是否为接口问题
			$where = ['stunum' => session('stuId')];	
			if($res = M('Globle')->where($where)->select()){   //本地有数据就调用本地的
				$top5 = array_slice($res, 1, 5);
				$this->ajaxReturn($res, 'json');                             
			}else{
				$this->ajaxReturn(false);//表示没有数据
			}
		}
    }
    //页面刷新的时候从远端获取返回顶部5条刷新缓存

 	public function LoadData(){//主页面数据的抓取方法
		$time = I('get.time');//下拉的次数
		$conf = [
			'id' => session('stuId'),
 		];
		$res = D('Globle')->get_5_contends($time);
		$this->ajaxReturn($res, 'json');
 	}
 	/*获取主页面信息以及下拉的处理的方法 
	获取地点的先后顺序是先请求远端，
	如果远端没有数据，可能是本身没有，也可能是跪了
	如果是跪了本地有缓存就调用缓存，如果没有就是没有数据，
	返回false
 	*/
}
