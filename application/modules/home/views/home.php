<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        input[type=text],
        input[type=password],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
        }

        .info {
            padding: 5px 10px;
            font-size: smaller;
            color: crimson;
            line-height: 5px;
            background-color: bisque;
            margin: 20px 0px;
        }
    </style>
    <title>Login</title>
</head>

<body>

    <?php include_once(__DIR__ . '/header.php'); ?>

    <div class="container">
        <h2>Rank Table</h2>
        <p>Displaying rank data in the below table...</p>
        <table class="table table-bordered" id="rankTable">
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Value</th>
                    <th>Rank</th>
                    <?php if(isset($loginDetail['username']) && $loginDetail['username'] == 'manager') { ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Record</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="srno" name="id">

                        <label for="value">Value</label>
                        <input type="text" id="value" name="value" placeholder="Value">

                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="<?php echo base_url('node_modules/socket.io/client-dist/socket.io.js'); ?>"></script>

<script>
    var data = [];
    $(document).ready(function() {

        fetchData();

        $('#editForm').submit(function(event) {
            event.preventDefault();
            let id = $('#srno').val();
            let value = $('#value').val();

            let formData = {
                id: id,
                value: value
            };

            $.ajax({
                url: '<?php echo base_url("/update-rank") ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#myModal').modal('hide');
                        // alert('Update successfully.');
                        // fetchData();

                        socket.emit("editRankValueEvent", {
                            data: response
                        });

                    } else {
                        alert('Somethin went wrong. Please try again.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again later.');
                }
            });
        });
    });

    function fetchData() {
        $.ajax({
            url: '<?php echo base_url("/rank-list") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    data = response.data;
                    setData(response.data);
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again later.');
            }
        });
    }

    function setData(data) {
        if (data.length > 0) {
            let html = data.map((row, index) => {
                return `<tr>
                            <td>${index + 1}</td>
                            <td>${row.value}</td>
                            <td>Rank ${row.rank}</td>
                            <?php if(isset($loginDetail['username']) && $loginDetail['username'] == 'manager') { ?>
                            <td>
                                <a href="javascript:" data-id="${row.id}"" onClick="editRecord(this)">Edit</a>
                            </td>
                            <?php } ?>
                        </tr>`;
            });

            $('#rankTable tbody').html(html);
        } else {
            let html = data.map((row) => {
                return `<tr>
                            <td colspan="4">No Record Found.</td>
                        </tr>`;
            });

            $('#rankTable tbody').html(html);
        }
    }

    function editRecord(obj) {

        $('#myModal').modal('show');

        let id = $(obj).data('id');
        let row = data.find((item) => {
            return (item.id == id)
        })
        // console.log($(obj).data('id'), data, row);

        $('#editForm').find('#srno').val(row.id);
        $('#editForm').find('#value').val(row.value);
    }

    ///// scoket configuration
    const socket = io("http://localhost:3000");

    socket.on("connect", () => {
        console.log("Connected to Socket.IO server");
    });

    socket.on("disconnect", () => {
        console.log("Disconnected from Socket.IO server");
    });

    // Trigger the custom event when a button is clicked
    /* $("#triggerButton").on("click", () => {
        socket.emit("custom_event", {
            data: "Some data"
        });
    }); */

    // Listen for the response event from the server
    socket.on("afterEditRankValueEvent", (serverData) => {
        // debugger
        fetchData();
        console.log("Received response from server:", serverData);
    });
</script>


</html>