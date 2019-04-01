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

    <tr>
        <td><a href="#">NAME</a></td>
        <td>
            <a class="copy" data-clipboard-text="#">
                <strong>USERNAME</strong>
            </a></td>
        <td>
            <a class="copy" data-clipboard-text="alöskdfjaöyp">
                <strong>*********</strong>
            </a>
        </td>
        <td><a href="#">go to</a></td>
        <td><a href="#">Update | <a
                    href="#">Delete</a></a></td>
    </tr>
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