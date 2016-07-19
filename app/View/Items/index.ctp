    <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
      <div class="container">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
          <!-- <a href="#" class="navbar-brand">ELITES PAYMENTS</a> -->
                    <a href="index.html" class="navbar-brand"> <span class="bold"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
 ELITES PAYMENTS</span></a>

        </div>
      </div>
    </div>

    <!-- Main content starts -->
    <div class="content">


    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-sm-12">
                        <h3>ELITES商材一覧</h3>

                          <?php foreach($items as $item) :?>
                             <a href="/payments/items/id/<?=$item['Item']['cha_rec_id'] ?>" >
                            <table class="table-hover" style="border:solid 1px #000; margin-bottom:10px; width:100%;">
                              <tr>
                                <td class="col-sm-4"><?=h($item['Item']['name'])?></td>
                                <td  class="col-sm-8" style = "border-left:solid 1px #000;"><?=h($item['Item']['description'])?><br><?=h(number_format($item['Item']['amount']))?>円
                                </td>
                              </tr>
                            </table>
                            </a>

                          <?php endforeach ;?>

                          <!-- ページネーション機能 -->
                          <div style = "text-align:center;">
                          <?php
                            if($p_limit <= $maxitem){
                            echo $this->Paginator->prev('< 前へ ');
                            echo $this->Paginator->numbers();
                            echo $this->Paginator->next(' 次へ >');
                            }
                          ?>
                          </div>


                    </div>
                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
        <!-- /SERVICES -->
    </div>
    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- CONTACT -->
        <section class="module-small">

            <div class="container">

                <div class="row">

                    <!-- CONTENT BOX -->
                    <div class="col-xs-6">
                        <div class="content-box">
                            <div class="content-box-title font-inc">
                                <p class="m-b-0">株式会社NOWALL</p>
                            </div>
                            <p>
                                <a href="http://nowall.co.jp/" target="_blank">会社概要</a>
                                <a href="http://nowall.co.jp/legal" target="_blank">特定商取引法に基づく表示</a>
                            </p>
                        </div>
                    </div>
                    <!-- /CONTENT BOX -->

                    <!-- CONTENT BOX -->
                    <div class="col-xs-6">
                        <p class="m-b-0" style="font-size: 1.5em">アクセス</p>
                        <p class="m-b-0" style="font-size: 1.5em">〒160-0023 東京都新宿区西新宿6丁目10番1号 セントラルパークタワー ラ・トゥール新宿 6階</p>
                    </div>
                    <!-- /CONTENT BOX -->
                </div>

            </div>

        </section>
        <!-- /CONTACT -->

        <!-- FOOTER -->
        <footer class="footer">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">
                        <p class="copyright font-inc m-b-0">© 2015 <a href="http://nowall.co.jp/" target="_blank">NOWALL, Inc.</a> All Rights Reserved.</p>
                    </div>

                </div>

            </div>

        </footer>
        <!-- /FOOTER -->

    </div>
    <!-- /WRAPPER -->


    <div class="clearfix"></div>
    </div><!--/ Content ends -->
