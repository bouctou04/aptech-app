	<footer>
							<div class="text-center">
								
							</div>
						</footer>
				</section>

		<!-- Begin Script Import -->
		<script src="style/js/jquery.js"></script>
		<script src="style/js/popper.js"></script>
		<script src="style/js/main.js"></script>
		<script src="style/js/app.js"></script>
		<script>
			setInterval('load_chat()', 500);
			function load_chat() {
				$('#chat').load('include/load_chat.php');
				}

			setInterval('load_inline()', 500);
			function inline() {
				$('#inline').load('include/en_ligne.php');
				}

			// 	setInterval('load_messages()', 500);
			// function load_messages() {
			// 	$('#messages').load('include/load_messages.php');
			// 	}
		</script>
		<!-- End Script Import -->

	</body>
</html>