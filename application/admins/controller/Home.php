<?php

namespace app\admins\controller;

/**
 * 后台首页
 */
class Home extends BaseAdmin {

  public function index(){
    return $this->fetch();
  }

  // 欢迎页面
  public function welcome() {
    return $this->fetch();
  }
}