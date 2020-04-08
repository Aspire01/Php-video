<?php

namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

/**
 * 测试文件
 */

class Test extends Controller {
  public function index() {
    $this->db = new Sysdb;
    // $ret = $this->db->table('admins')->field('id,username')->where(array('id'=> 1))->item(); // 查询单条数据

    $ret = $this->db->table('admins')->field('id,username')->where(array('id'=> 1))->lists(); // 查询多条数据
    var_dump($ret);
  }
}

