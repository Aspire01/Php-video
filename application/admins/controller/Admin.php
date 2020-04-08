<?php

namespace app\admins\controller;

class Admin extends BaseAdmin 
{
  /**
   * 渲染页面以及数据
   */
  public function index() {
    $data['lists'] =  $this->db->table('admins')->lists();
    $this->assign('data',$data);
    return  $this->fetch();
  }
}