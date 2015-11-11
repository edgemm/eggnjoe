				</section>
				<!-- /#conent -->
			</main>
	
	<footer class="footer" role="contentinfo">
				
				<section class="container clear">

					<nav class="footer-nav footer-nav-bubble">

						<ul class="footer-bubble-list clear">
							<li class="footer-home-item"><a href="/" class="footer-bubble-link footer-social-home img-replace" target="_blank">Home</a></li>
							<li><a href="http://www.youtube.com/ElmersRestaurant" class="footer-bubble-link footer-social-youtube img-replace" target="_blank">YouTube</a></li>
							<li><a href="http://instagram.com/eggnjoe" class="footer-bubble-link footer-social-instagram img-replace" target="_blank">Instagram</a></li>
							<li><a href="http://www.facebook.com/eggnjoe" class="footer-bubble-link footer-social-facebook img-replace" target="_blank">Facebook</a></li>
						</ul>

					</nav>

					<nav class="footer-nav footer-nav-text">
					<?php // add utility menu for footer
						add_navigation( "footer" );
					?>
					</nav>
					
					<p class="footer-copyright">
						&copy; <?php echo date('Y'); ?> ENJ Franchise Systems, LLC. All rights reserved.
					</p>

				</section>

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
