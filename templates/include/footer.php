
</section>
<footer class="mt-3">
    <div class="col-12">
        <p class="text-center text-muted">&copy; 2020 - Mon app</p>
    </div>
</footer>

		<!-- Begin Script Import -->
		<script src="/templates/style/js/jquery.js"></script>
		<script src="/templates/style/js/popper.js"></script>
		<script src="/templates/style/materialize/js/materialize.js"></script>
		<script src="/templates/style/js/app.js"></script>
		<script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });

            $(document).ready(function(){
                $('.collapsible').collapsible();
            });

            $(document).ready(function() {
                $('input#input_text, textarea#textarea2').characterCounter();
            });

            $('.dropdown-trigger').dropdown();

            $(document).ready(function(){
                $('.carousel').carousel();
            });

            $(document).ready(function(){
                $('.modal').modal();
            });

            setInterval('load_chat()', 500);
			function load_chat() {
				$('#chat').load('load_chat.php');
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