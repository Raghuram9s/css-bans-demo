import DataTable from 'datatables.net-dt';
import {formatDuration, calculateProgress} from '../utility/utility';

let dataTable = null;
function loadBans() {
     dataTable = new DataTable("#bansList", {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/list/bans",
            "headers": {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            "type": "POST",
            "dataType": "json"
        },
        "language": {
            "search": "Search by player steamid:",
            'processing': '<div class="spinner"></div>'

        },
         order: [[0, 'desc']],
        "columns": [
            {"data": "id"},
            {
                "data": "player_name", "render": function (data, type, row, meta) {
                    return `<a href="https://steamcommunity.com/profiles/${row.player_steamid}">${data}</a>`;
                }
            },
            {"data": "admin_steamid"},
            {"data": "admin_name"},
            {"data": "reason"},
            {"data": "duration"},
            {"data": "ends"},
            {
                "data": "created", "render": function (data, type, row, meta) {
                    return formatDuration(data);
                }
            },
            {"data": "server_id"},
            {"data": "status"},
            {"data": "action"},
            {
                "data": "duration", "render": function (data, type, row, meta) {
                    const progress = calculateProgress(row.created, row.ends);
                    return `
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated custom-progress bg-danger"
                    role="progressbar" style="width:  ${progress}%" aria-valuenow="${progress}"
                    aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>`
                }
            }
        ]
    });
}
loadBans();

$(document).on('click', '.unban-btn', function() {
    var playerSteamid = $(this).data('player-steamid');
      $.ajax({
        url: '/players/'+playerSteamid+'/unban',
        type: 'PUT',
        dataType: 'json',
        data: {
            playerSteamid: playerSteamid
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            toastr.success('Player unbanned successfully.');
            dataTable.ajax.reload();
        },
        error: function(xhr, status, error) {
            toaster.error('Failed to unban player!');
        }
    });
});
