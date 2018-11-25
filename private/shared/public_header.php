<!DOCTYPE html>

<html lang="en">
<head>
    <title>The CMS <?php if(isset($page_title)) { echo ' - ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/css/public.css'); ?>" />
</head>

<body>
    <header>
        <h1>
            <a href="<?php echo url_for('/index.php');?>">
                <img id="logo" src="<?php echo url_for('/imas/logo_cms.png'); ?>" alt="Logo The CMS" />
            </a>
        </h1>
    </header>
