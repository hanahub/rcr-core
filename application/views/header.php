<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Lang" content="en">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Shopify Products Importer</title>
    
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    
    <?php if ($current_template == "control_panel") : ?>
        <?php foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <script src="<?php echo base_url(); ?>assets/plugins/jquery.blockUI/jquery.blockUI.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatables/jquery.dataTables.min.js"></script>                    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-datatables/jquery.dataTables.min.css">
    
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>                    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.css">
    
    <script src="<?php echo base_url(); ?>assets/plugins/prettyPhoto_3.1.6/js/jquery.prettyPhoto.js"></script>                    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/prettyPhoto_3.1.6/css/prettyPhoto.css">
    
            
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">            
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script>
        var base_url = "<?php echo base_url(); ?>";        
    </script>
</head>


<body class="<?php echo $current_template; ?>">
    
    <div id="content_wrap">
        <div id="content">
        
            <div class="top">
                <div class="top_content">
                    <?php if (isset($user)) : ?>
                    <div class="left_side">
                        <a class="avatar_link" href="#"><img src="<?php echo $user['picture']['url'];?>" class="avatar"/></a>
                        <a href="#" class="link_btn name_link"><?php echo $user['name']; ?></a>
                    </div>
                    <div class="right_side">
                        <a href="<?php echo base_url(); ?>logout" class="link_btn logout_btn">Log Out</a>
                    </div>    
                    <?php endif; ?>
                </div>
            </div>
            <?php
                if (isset($message)) {
                    echo "<div class='message'>";
                        echo $message;
                    echo "</div>";
                }                
            ?>
            
            <div class="main">    
                <div class="main_content">
                    <div class="main_wrap clearfix">
                        <?php if (isset($user)) : ?>
                        <div class="left">
                            <div class="left_content">                    
                                <a href="<?php echo base_url() . 'home/'; ?>" class="menu_item"><span><i class="fb_icon fb_icon_ad"></i><span>Ad Accounts</span></span></a>
                                <a href="<?php echo base_url() . 'pages/'; ?>" class="menu_item"><span><i class="fb_icon fb_icon_page"></i><span>Pages</span></span></a>
                                <a href="<?php echo base_url() . 'post/'; ?>" class="menu_item"><span><i class="fb_icon fb_icon_facebook"></i><span>Post</span></span></a>
                                <a href="<?php echo base_url() . 'control_panel/'; ?>" class="menu_item"><span><i class="fb_icon fb_icon_table"></i><span>Control Panel</span></span></a>
                            </div>
                        </div>
                        <?php endif; ?>
            
            