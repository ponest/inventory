
<div id="footer">
    <p>&copy <?= date('Y'). "  ";  ?>iPF-Softwares</p>
</div>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="DataTables/media/js/dataTables.bootstrap4.min.js"></script>

<script>
    $('#myData').dataTable();
</script>
<script>
    var d = new Date();
    var n = d.toDateString();
    document.getElementById("date").innerHTML = n;
</script>
<script src="assets/js/inventory.js"></script>
<script src="assets/js/registration.js"></script>
<script src="assets/js/sales.js"></script>
</body>

</html>
