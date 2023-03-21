<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Barang extends BaseController
{
  private $model;

  // constructor
  public function __construct()
  {
    // Load model
    $this->model = new \App\Models\M_Barang();
  }
}
