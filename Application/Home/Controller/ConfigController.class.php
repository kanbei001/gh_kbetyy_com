<?php
namespace Home\Controller;
use Think\Controller;
class ConfigController extends BaseController {
    /**
     * Ip显示
     * @return [type] [description]
     */
    public function index($tps){
        $wher = 'parent_id='.$tps;
        $sets['tps'] = $tps;
        $sets['title'] = D('QxgroupView')->getTitle($tps);
        $query=M('Config')->field('id,name,u_id,state')->where($wher)->select();  
        $this->assign( 'items', $query); 
        $this->assign( 'sets', $sets); 
        $this->main_menu='参数设置管理';
        $this->son_menu='登录'.$sets['title'].'管理';
        $this->display();
    }
    /**
     * 添加类型
     */
     public function add(){
        if($_POST){ 
            $data = $_POST; 
            if( ($msg = D('QxgroupView')->checkData($data)) != '' ){
                $this->error($msg);
                return false;
            }
            if(M('Config')->add($data)){   
                $this->success(I('do').'成功');
            }else{
                $this->error(I('do').'失败');
            }
        }else{
            $this->assign('tps',I('tps'));
            $this->assign('do','添加');
            $this->display();
        }
       
    }
    /**
     * 修改类型
     * +
     * @return [type] [description]
     */
    public function edit(){  
        if($_POST){ 
            $data = $_POST; 
            if( ($msg = D('QxgroupView')->checkData($data)) != '' ){
                $this->error($msg);
                return false;
            }
            if(M('Config')->save($data)){   
                $this->success(I('do').'成功');
            }else{
                $this->error(I('do').'失败');
            }
        }else{
            $item = M('Config')->field('id,name,u_id')->find(I('id')); 
            $this->assign($item);
            $this->assign('tps',I('tps'));
            $this->assign('do','修改');
            $this->display('add');
        }
    }
    /**
     * 删除类型
     * @return [type] [description]
     */
    public function del(){
        $ids=explode(',',I('id'));
        foreach($ids as $key=>$value){
            $item = M('Config')->find(I('id'));
                if($_SESSION['m_id']!=1){
                $this->error('没有权限！');
            }
        }
        //如果删除的分类有子类，则提高其等级
        $where['id']=array('in',$ids);
        $row=M('Config')->where($where)->delete();
        if($row){
            $this->success('删除成功');
        }else{
            $this->error('删除失败！');
        }
    }
}