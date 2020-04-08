<?php

namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class BaseAdmin extends Controller { 
  
  public function __construct()
  {
    parent::__construct();
    $this->_admin = session('admin');
    if(!$this->_admin){
      header('Location: /admins/Account/login'); // 相当于是重定向
      exit();
    }

    // 用户权限 访问控制器方法

    $this->db = new Sysdb;
  }

}