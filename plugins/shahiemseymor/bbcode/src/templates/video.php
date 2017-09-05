<?php if ($player === 'embed') { ?>
    <embed src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" type="application/x-shockwave-flash"></embed>
<?php } else { ?>
    <iframe src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0"></iframe>
<?php } ?>