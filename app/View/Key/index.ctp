    <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
      <div class="container">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> ELITES PAYMENTS</a>
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
                    <div class="col-md-12">
                        <h3>決済情報を入力する</h3>
                        <form method="post" action="index">
                        <table class="table table-bordered table-generated">
                            <tbody>
                                <tr>
                                    <th class="col-xs-4 col-sm-3 col-md-2">担当者名</th><td class="col-xs-8 col-sm-9 col-md-10"><?=$nowallname;?></td>
                                </tr>
                                <tr>
                                    <th class="col-xs-4 col-sm-3 col-md-2">お名前</th><td class="col-xs-8 col-sm-9 col-md-10"><?=$name;?>様</td>
                                </tr>
                                <tr>
                                    <th class="col-xs-4 col-sm-3 col-md-2">メールアドレス</th><td class="col-xs-8 col-sm-9 col-md-10"><?=$email;?></td>
                                </tr>
                                <tr>
                                    <th class="col-xs-4 col-sm-3 col-md-2">決済金額</th><td class="col-xs-8 col-sm-9 col-md-10"><?=number_format($amount)."円 ";
                                        if(!$period) echo "(今月のみ)";
                                        else echo "(月額)";?></td>
                                </tr>
                                <tr>
                                    <th class="col-xs-4 col-sm-3 col-md-2">決済内容</th><td class="col-xs-8 col-sm-9 col-md-10"><?=$summary;?></td>
                                </tr>
                                <tr>
                                    <th class="col-xs-4 col-sm-3 col-md-2">カード情報</th>
                                    <td class="col-xs-8 col-sm-9 col-md-10">
                                        <script src="https://checkout.webpay.jp/v3/" class="webpay-button" data-key="test_public_cKKcPY89vgl2ba03eD0zAgix" data-lang="ja" data-partial="true"></script>
                                        (※入力されたカード情報は、WebPayのシステムを通じて安全に送信されます)
                                        <?php if(isset($webpaytoken_error['0'])) echo "<br><span class=\"text-danger\">".$webpaytoken_error['0']."</span>";?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" name="agree" value=""> 上記決済内容を確認した上で支払いを行います。<br>
                                        <?php if(isset($agree_error['0'])) echo "<span class=\"text-danger\">".$agree_error['0']."</span><br>";?>
                                        <input type="submit" value="決済を実行する" class="btn btn-primary">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="hidden" name="nowallname" value=<?=$nowallname; ?>>
                        <input type="hidden" name="name" value=<?=$name; ?>>
                        <input type="hidden" name="email" value=<?=$email; ?>>
                        <input type="hidden" name="summary" value=<?=$summary; ?>>
                        <input type="hidden" name="amount" value=<?=$amount; ?>>
                        <input type="hidden" name="period" value=<?=$period; ?>>
                        <input type="hidden" name="key" value=<?=$key; ?>>
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

