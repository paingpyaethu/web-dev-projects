</div>
<footer class="footer border-top mt-5">
	<div class="d-flex justify-content-center">
		<span class="text-muted text-center d-block d-sm-inline-block">
			Copyright © 2021 <a href="" >Paing Pyae Thu</a>. All rights reserved.
		</span>
	</div>
</footer>
</div>
</div>
</div>
</section>

<!-------------------- JQuery.js -------------------->
<script src="<?php echo $url; ?>/assets/vendor/jquery/dist/jquery.js"></script>
<!-------------------- Bootstrap.js -------------------->
<script src="<?php echo $url; ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-------------------- JQuery-dataTable -------------------->
<script src="<?php echo $url; ?>/assets/vendor/datatable/js/jquery.dataTables.min.js"></script>
<!-------------------- DataTable.Bootstrap5 -------------------->
<script src="<?php echo $url; ?>/assets/vendor/datatable/js/dataTables.bootstrap5.min.js"></script>
<!-------------------- main.js -------------------->
<script src="<?php echo $url; ?>/assets/js/main.js"></script>

<script>
    const currentPage = location.href;
    $(".menu-item-link").each(function () {
        let links = $(this).attr("href");
        if(currentPage === links){
            $(this).addClass('active');
        }
    });
</script>

</body>
</html>