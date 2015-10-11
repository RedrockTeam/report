<?php
namespace Home\Model;
use Think\Model;
class GlobleModel extends Model {
    public function cacheRefresh($data){
        if(count($data) == 27){
        	$this->run($data);
        }else{
            foreach ($data as $key) {
               $this->run($key);
            }
        }
    }
    //跟新本地缓存

    private function run($data){
        foreach ($data as $key => $value) {
            $conf[$key] = $value[0]["#text"];
        }
        $conf['stunum'] = session('stuId');
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
    //刷新具体方法

    public function get_5_contends($time){
        $where = [
            'stunum' => session('stuId'),
        ];
        if($message = M('globle')->where($where)->select()){
            return array_slice($message, $time * 5, 5);
        }else{
            return false;
        }
        
    }
}
