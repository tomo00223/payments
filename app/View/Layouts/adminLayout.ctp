<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">

    <title>
        個別決済画面発行ページ
    </title>

    <link rel="shortcut icon" href="http://elite.sc/assets_front/images/favicon.ico">

    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('../theme/css/bootstrap.min');
        echo $this->Html->css('../theme/css/jquery-ui');
        echo $this->Html->css('../theme/css/jquery.gritter');
        echo $this->Html->css('../theme/css/font-awesome.min');
        // echo $this->Html->css('../theme/css/style');
        echo $this->Html->css('../theme/css/widgets');

        echo $this->Html->css('Adminstyle');
        echo $this->Html->css('Admin');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

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
    </div>

        <!-- Javascript files -->
        <!-- jQuery -->
        <?php echo $this->Html->script('../theme/js/jquery'); ?>
        <?php echo $this->Html->script('../theme/js/bootstrap.min');?>
        <?php echo $this->Html->script('../theme/js/jquery-ui.min');?>
        <?php echo $this->Html->script('../theme/js/jquery.gritter.min');?>
        <?php echo $this->Html->script('../theme/js/respond.min');?>
        <?php echo $this->Html->script('../theme/js/html5shiv');?>
        <?php echo $this->Html->script('admincustom');?>

</body>
</html>
