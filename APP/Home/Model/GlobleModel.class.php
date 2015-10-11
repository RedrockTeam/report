<?php
namespace Home\Model;
use Think\Model;
class GlobleModel extends Model {
    public function cacheRefresh($data){
    	foreach ($data as $key => $value) {
    		$conf[$key] = $value[0]["#text"];
    	}
    	$where = [
    		'wx_djh' => $conf['wx_djh'],
    	];
    	if(M('globle')->where($where)->select()){
    		M('globle')->where($where)->delete();
    		M('globle')->data($conf)->add();
    	}else{
    		M('globle')->data($conf)->add();
    	}
    }
    //跟新本地缓存
}
