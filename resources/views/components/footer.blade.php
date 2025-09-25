<footer class="footer">
  
  <div class="footer-content">
    <div>
      <h3>{{ __('footer.about_us') }}</h3>
      <p>{{ __('footer.about_line_1') }}</p>
      <p>{{ __('footer.about_line_2') }}</p>
      <p>{{ __('footer.about_line_3') }}</p>
    </div>

    <div>
      <h3>{{ __('footer.contact') }}</h3>
      <p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
      <p>Tel: <a href="tel:+31123456789">+31 12 345 6789</a></p>
      <p>{{ __('footer.address') }}</p>
    </div>

    <div>
      <h3>{{ __('footer.social_links') }}</h3>
      <ul>
        <li><a href="#">{{ __('footer.facebook') }}</a></li>
        <li><a href="#">{{ __('footer.twitter') }}</a></li>
        <li><a href="#">{{ __('footer.instagram') }}</a></li>
        <li><a href="#">{{ __('footer.youtube') }}</a></li>
      </ul>
    </div>
  </div>

  <div class="copyright">
    © {{ __('misc.copyright') }}
  </div>
</footer>


<!-- analytics code -->              
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30506707-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- Einde analytics code -->

<script language="Javascript" type="text/javascript"> 
 
 if (top.location!= self.location) { 
  top.location = self.location.href
 } 
 
</script>
