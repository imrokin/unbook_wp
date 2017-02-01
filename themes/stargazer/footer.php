				<?php hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template. ?>

			</div><!-- #main -->

			<?php hybrid_get_sidebar( 'subsidiary' ); // Loads the sidebar/subsidiary.php template. ?>

		</div><!-- .wrap -->

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<div class="wrap">

				<?php hybrid_get_menu( 'social' ); // Loads the menu/social.php template. ?>

				<p class="credit">
					<?php printf(
						// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link. */
						__( 'Copyright &#169; %1$s %2$s.', 'stargazer' ),
						date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
					); ?>
				</p><!-- .credit -->

			</div><!-- .wrap -->

		</footer><!-- #footer -->

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>


</html>