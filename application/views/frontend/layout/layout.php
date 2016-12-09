<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : 'CROSS INFINITY'; ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="Author" content="CROSS INFINITY">
    <meta name="copyright" content="CROSS INFINITY">
    <meta name="title" content="CROSS INFINITY">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="<?php echo base_url('/assets/frontend/images') ?>/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('/assets/frontend/images') ?>/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/normalize.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/main.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/magnific-popup.css') ?>" />
    <?php 
    if(isset($styles)){
        foreach ($styles as $style) {
            echo '<link rel="stylesheet" href="'.base_url('assets/frontend/css').'/'.$style.'" />';
        }
    }
    ?>

    <link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/custom.css') ?>" />
    <script src="<?php echo base_url('/assets/frontend/js/modernizr-2.6.2-respond-1.1.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/frontend/js/jquery-1.11.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/frontend/js/jquery.validate.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/frontend/js/html5shiv-printshiv.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/frontend/js/picturefill.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/frontend/js/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/frontend/js/main.js'); ?>"></script>
</head>
<body class ="<?php if(isset($body_css)) echo $body_css; ?>">
<?php echo $content_for_layout; ?>

<?php 
    if(isset($scripts)){
        foreach ($scripts as $script) {
            echo '<script  src="'.base_url('assets/frontend/js').'/'.$script.'"></script>';
        }
    }
?>
<script src="<?php echo base_url('/assets/frontend/js/custom.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('/assets/frontend/css/all.min.css') ?>" />
<div id="test-modal" class="mfp-hide white-popup-block">
    <center>
    <br>
    <h1 style="line-height:28px;color:#ea8d5b">ただいま実装中。<br>Coming soon!!</h1>
    <br>
    </center>
    
    <button title="Close (Esc)" type="button" class="mfp-close phuc-close">Close</button>
</div>
</body>
</html>
