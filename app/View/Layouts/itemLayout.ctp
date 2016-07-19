<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta name="description" content="ELITES | プログラミングで、自由を手に入れよう。">
    <meta name="author" content="NOWALL, Inc.">

    <title>
        <?php echo $title_for_layout ;?>
    </title>

    <link rel="shortcut icon" href="http://elite.sc/assets_front/images/favicon.ico">
    <!-- <link rel="shortcut icon" href="/payments/app/webroot/elites/img/ELITES_LOGO2.png"> -->

    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('../theme/css/bootstrap.min');
        echo $this->Html->css('../theme/css/jquery-ui');
        echo $this->Html->css('../theme/css/jquery.gritter');

        echo $this->Html->css('../theme/css/font-awesome.min');
        echo $this->Html->css('../theme/css/style');
        echo $this->Html->css('../theme/css/widgets');

        echo $this->Html->css('../elites/css/simpletextrotator');

        echo $this->Html->css('../elites/css/font-awesome.min');
        echo $this->Html->css('../elites/css/et-line-font');
        echo $this->Html->css('../elites/css/magnific-popup');
        echo $this->Html->css('../elites/css/flexslider');

        // echo $this->Html->css('../elites/css/animate.min');
        echo $this->Html->css('../elites/css/animate');
        echo $this->Html->css('../elites/css/style-items');

        echo $this->Html->css('../elites/css/custom');

        echo $this->Html->css('Key');

        echo $this->Html->script('../elites/js/6116');
        // echo $this->Html->script('../elites/js/common');
        echo $this->Html->script('../elites/js/gtm');
        // echo $this->Html->script('../elites/js/stats');
        // echo $this->Html->script('../elites/js/util');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>


        <!-- jQuery UI -->
        <link rel="stylesheet" href="/payments/app/webroot/css/css/jquery-ui.css">
        <!-- jQuery Gritter -->
        <link rel="stylesheet" href="/payments/app/webroot/css/css/jquery.gritter.css">

</head>
<body>
    <div id="container">
        <div id="header">

        </div>

        <div id="content">

            <?php echo $this->Flash->render(); ?>

            <?php echo $this->fetch('content'); ?>
        </div>

        <div id="footer">

        </div>

    </div><!-- container -->

</body>
</html>
