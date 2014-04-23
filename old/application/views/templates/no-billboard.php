<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/reset.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/960.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>public/css/style.css" />
        
        <link href="data:image/x-icon;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAA/Pz8AKNfFQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIiIiAAAAAAAiIiIAAAAAACIRIgAAAAAAIhEiAAAAAAAiESIAAAAAACIRIgAAAAAAIhEiIiIiAAAiESIiIiIAACIRERERIgAAIhEREREiAAAiESIiIiIAACIRIiIiIgAAIhEREREiAAAiERERESIAACIiIiIiIgAAIiIiIiIiDgfwAA4H8AAOB/AADgfwAA4H8AAOB/AADgAQAA4AEAAOABAADgAQAA4AEAAOABAADgAQAA4AEAAOABAADgAQAA" rel="icon" type="image/x-icon" />
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="http://formigone.com/pubrecs/icons/formigone-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://formigone.com/pubrecs/icons/formigone-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://formigone.com/pubrecs/icons/formigone-icon-114x114.png" />
        <title><?= $meta["title"]; ?></title>
    </head>
    <body>
         <?php if (isset($raw_icon)): ?><img src="<?= $raw_icon; ?>" style="display: none;"/><?php endif; ?>
        <?= $template["header"]; ?>
        
        <div id="billboard_wannabe"></div>
        
        <div id="main">
            <?= $content; ?>
        </div>
        
        <?= $template["footer"]; ?>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?= $meta["ga"]; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
    </body>
</html>
