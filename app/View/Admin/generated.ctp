    <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
      <div class="container">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
          <a href="/payments/admin/generate" class="navbar-brand"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> ELITES PAYMENTS</a>
        </div>
      </div>
    </div>

    <!-- Main content starts -->
    <div class="content">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <div class="sidebar-inner">
          <!--- Sidebar navigation -->
          <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
          <ul class="navi">
            <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->

            <li class="nred"><?=$this->Html->link('個別決済画面発行',
                                                  array('controller'=>'admin',
                                                        'action'=>'generate'));?></li>
          </ul>
          <!--/ Sidebar navigation -->


        </div>
      </div>
      <!-- Sidebar ends -->

      <!-- Main bar -->
      <div class="mainbar">
        <!-- Page heading -->
        <div class="page-head">
          <!-- Page heading -->
          <h2 class="pull-left">発行完了</h2>
          <div class="clearfix"></div>
        </div><!--/ Page heading ends -->
        <!-- Matter -->
        <div class="matter">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <!-- Table starts.  -->
                <div class="widget wblue">
                  <div class="widget-head">
                    <div class="pull-left">以下の内容で決済画面を発行し、お客様へ送信しました</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget-content">
                    <div class="table-responsive">
                      <table class="table table-bordered table-generated">
                        <tr>
                          <td class="col-md-3">NOWALL担当者</td>
                          <td class="col-md-9"><?=$sendData['Admin']['nowall-name'];?></td>
                        </tr>
                        <tr>
                          <td class="col-md-3">お名前</td>
                          <td class="col-md-9"><?=$sendData['Admin']['name'];?></td>
                        </tr>

                        <tr>
                          <td class="col-md-3">メールアドレス</td>
                          <td class="col-md-9"><?=$sendData['Admin']['email'];?></td>
                        </tr>

                        <tr>
                          <td class="col-md-3">決済金額</td>
                          <td class="col-md-9"><?=number_format($sendData['Admin']['amount'])."円";?>
                              <?php if($sendData['Admin']['period']) echo "(月額)";
                                    else echo "(今月1回)";?>
                          </td>
                        </tr>

                        <tr>
                          <td class="col-md-3">決済内容</td>
                          <td class="col-md-9"><?=$sendData['Admin']['summary'];?></td>
                        </tr>
                        <tr>
                          <td class="col-xs-3 col-sm-3 col-md-3">決済URL</td>
                          <td class="col-xs-9 col-sm-9 col-md-9"><?=$sendData['Admin']['url'];?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <p>※メールが届かない場合、アドレス間違いや受信拒否されている可能性が
                あります。その場合は上記URLをお客様へ別途お伝えください。</p>
              </div>
            </div>
          </div>
        </div><!--/ Matter ends -->
      </div><!--/ Mainbar ends -->
      <div class="clearfix"></div>
    </div><!--/ Content ends -->

