<?php // Place $content directly within the tags to not leave any whitespace for <pre> ?>

<pre class="decoda-code<?php if (!empty($lang)) { echo ' ' . $classPrefix . $lang; } ?>"<?php if (!empty($hl)) { printf(' %s="%s"', $highlightAttribute, $hl); } ?>><code><?php echo $content; ?></code></pre>