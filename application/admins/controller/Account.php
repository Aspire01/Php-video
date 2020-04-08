<?php


namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Account extends Controller
{ 
  /**
   * 登录
   */
  public function login() {
   return $this->fetch();
  }
  
  /**
   * 执行登录操作
   */
  public function doLoin() {
    $username = trim(input('post.username'));
    $pwd = trim(input('post.pwd'));
    $verify = trim(input('post.verify'));

    if($username === '') {
      exit(json_encode(array('code'=>1 ,'msg' =>'用户名不能为空')));
    }
    if($pwd === '') {
      exit(json_encode(array('code'=>1 ,'msg' =>'密码不能为空')));
    }
    if($verify === '') {
      exit(json_encode(array('code'=>1 ,'msg' =>'验证码不能为空')));
    }
    // 验证验证码的正确性
    if(!captcha_check($verify)){
      exit(json_encode(array('code'=>1 ,'msg' =>'验证码有误')));
    }
    // 验证用户
    $this->db = new Sysdb;
    $admin = $this->db->table('admins')->where(array('username'=> $username))->item();
    if(!$admin) {
      exit(json_encode(array('code'=>1 ,'msg' =>'用户名不存在')));
    }
    if($pwd !== $admin['password']){
      exit(json_encode(array('code'=> 1, 'msg'=> '密码错误')));
    }
    if($admin['status'] === 1) {
      exit(json_encode(array('code'=>1 , 'msg'=> '用户已禁用')));
    }
    // 设置session
    session('admin',$admin);
    exit(json_encode(array('code'=>0, 'msg'=> '登录成功')));
  }
}