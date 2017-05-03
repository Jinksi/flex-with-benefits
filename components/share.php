<?php // https://simplesharingbuttons.com ?>

<ul class="share-buttons">
  <li>Share this post</li>
  <li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><i class="fa fa-facebook" aria-hidden="true"></i><span class="sr-only">Share on Facebook</span></a></li>
  <li><a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;"><i class="fa fa-twitter" aria-hidden="true"></i><span class="sr-only">Tweet</span></a></li>
  <li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><i class="fa fa-google-plus" aria-hidden="true"></i><span class="sr-only">Share on Google+</span></a></li>
</ul>
