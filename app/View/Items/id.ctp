    <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
      <div class="container">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
          <a href="/payments/items" class="navbar-brand"> <span class="bold"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
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
                        <h3>決済情報を入力する</h3>

                        <form action="../purchased" method="post">
                        <table class="table table-bordered table-generated">
                            <tbody>
                                <tr>
                                    <th class="col-md-2">担当者名</th>
                                    <td class="col-md-11">
                                      <input type="text" class="input-md col-sm-5" id="nowall_name" placeholder="担当者" name="nowall_name" required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">お名前</th>
                                    <td class="col-md-11">
                                    <input type="text" class="input-md col-sm-5" id="name" placeholder="お名前" name="name" required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">メールアドレス</th><td class="col-md-11">
                                    <input type="email" class="input-md col-sm-8" id="email" placeholder="メールアドレス" name="email" required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">決済金額</th><td class="col-md-11">
                                    <?=h(number_format($items['Item']['amount'])) ?>円
                                        </td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">決済内容</th><td class="col-md-11"><?=h($items['Item']['name']) ?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">カード情報</th>
                                    <td class="col-md-11">
                                        <script src="https://checkout.webpay.jp/v3/" class="webpay-button" data-key="test_public_cKKcPY89vgl2ba03eD0zAgix" data-lang="ja" data-partial="true"></script>
                                        (※入力されたカード情報は、WebPayのシステムを通じて安全に送信されます)
                                        <?php if(isset($webpaytoken_error['0'])) echo "<br><span class=\"text-danger\">".$webpaytoken_error['0']."</span>";?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" name="last_check" required> 上記決済内容を確認した上で支払いを行います。<br>

                                        <input type="submit" value="決済を実行する" class="btn btn-primary">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="hidden" name="id" value=<?=h($items['Item']['id']);?> />
                        <input type="hidden" name="cha_rec_id" value=<?=h($items['Item']['cha_rec_id']);?> />
                        <input type="hidden" name="amount" value=<?=h($items['Item']['amount']);?> />
                        <input type="hidden" name="description" value=<?=h($items['Item']['name']);?> />

                        </form>




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
