
<script>
    var clipboard = new ClipboardJS('.copy');

    clipboard.on('success', function (e) {
        console.log("Password copied");

        e.clearSelection();
    });
</script>
<table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">Name
        </th>
        <th class="th-sm">Username
        </th>
        <th class="th-sm">Password
        </th>
        <th class="th-sm">URL
        </th>
        <th class="th-sm">Action
        </th>
    </tr>
    </thead>
    <tbody>
    <!-- FOOR LOOP -->
    <?php listPasswd() ?>
    <!-- END FOR LOOP -->
    </tbody>
    <tfoot>
    <tr>
        <th class="th-sm">Name
        </th>
        <th class="th-sm">Username
        </th>
        <th class="th-sm">Password
        </th>
        <th class="th-sm">URL
        </th>
        <th class="th-sm">Action
        </th>

    </tr>
    </tfoot>
</table>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
