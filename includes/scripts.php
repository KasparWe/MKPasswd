<!-- SCRIPTS -->
<script>
    function search() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<!-- bootbox code -->
<script src="../js/bootbox.js"></script>
<script src="../js/bootbox.locales.min.js"></script>
<script>
    $(document).on("click", ".show-alert", function(e) {
        bootbox.alert("Hello world!", function() {
            console.log("Alert Callback");
        });
    });
</script><!-- JQuery -->


<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.js"></script>
<script>
    var clipboard = new ClipboardJS('.copy');

    clipboard.on('success', function (e) {
        console.log("Password copied");

        e.clearSelection();
    });
</script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
