<?php
namespace org\jfa\todo\simple;
/**
 * I am the applications layout file. All the veiws are rendered inside of me.
 */
$layoutBaseURI = getBaseURI();
?>
<!DOCTYPE html>
<html>
<head>
<title><?= APP_TITLE ?></title>
<link rel="stylesheet" href="<?= $layoutBaseURI ?>/public/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= $layoutBaseURI ?>/public/css/style.css">
<script type="text/javascript" src="<?= $layoutBaseURI ?>/public/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="<?= $layoutBaseURI ?>/public/js/bootstrap.min.js"></script>
</head>
<body>
<?php view('menu.php') ?>
<?php view('response.php') ?>
<?php include getViewState()->getView(); ?>
<?php view('footer.php') ?>
</body>
</html>
