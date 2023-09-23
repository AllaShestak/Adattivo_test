'use strict'

function index() {
    this.workspaceChange = function (event) {
        let workspace_id = $('#workspace').val();

        if (workspace_id !== '') {

            $.ajax({
                url: '/getSpaces/' + workspace_id,
                success: function (data, textStatus, jqXHR) {
                    if(data.ok) {

                        let html = '<option value="" selected>Select a space</option>';

                        for (let space of data.spaces) {
                            html += '<option value="' + space.id + '">' + space.name + '</option>';
                        }

                        $('#space').html(html);
                    } else {
                        swal("Oops! Someting Wrong!", data.error, "error");
                    }
                }
            })
        } else {
            let html = '<option value="" selected>Select a space</option>';
            $('#space').html(html);
        }
    }
    this.spaceChange = function (event) {
        let space_id = $('#space').val();

        if (space_id !== '') {

            $.ajax({
                url: '/getLists/' + space_id,
                success: function (data, textStatus, jqXHR) {
                    if(data.ok) {
                    let html = '<option value="" selected>Select a list</option>';

                    for (let lists of data.list) {
                        html += '<option value="' + lists.id + '">' + lists.name + '</option>';
                    }

                    $('#lists').html(html);
                } else {
                    swal("Oops! Someting Wrong!", data.error, "error");
                }
                }
            })
        } else {
            let html = '<option value="" selected>Select a list</option>';
            $('#lists').html(html);
        }
    }

    this.usersChange = function (event) {
        let list_id = $('#lists').val();

        if (list_id !== '') {

            $.ajax({
                url: '/getUsers/' + list_id,
                success: function (data, textStatus, jqXHR) {
                    if(data.ok) {
                    let html = '';

                    for (let members of data.members) {
                        html += '<option value="' + members.id + '">' + members.username + '</option>';
                    }

                    $('#assegnatari').html(html);
                    $('#osservatori').html(html);
                } else {
                    swal("Oops! Someting Wrong!", data.error, "error");
                }
                }
            })
        } else {
            let html = '';
            $('#assegnatari').html(html);
            $('#osservatori').html(html);
        }
    }

    this.addTask = function (event) {
        event.preventDefault();

        let token = $('[name="_token"]').val();
        let workspace_id = $('#workspace').val();
        let space_id = $('#space').val();
        let list_id = $('#lists').val();
        let assegnat_id = $('#assegnatari').val();
        let osservatori_id = $('#osservatori').val();
        let slack_id = $('#slack').val();
        let taskName = $('#taskName').val();
        let taskDescription = $('#taskDescription').val();

        if (workspace_id !== "" && slack_id !== "" && list_id !== "" && space_id !== "" && osservatori_id.length > 0 && taskDescription !== "" && taskName !== "" && assegnat_id.length > 0) {
            $.ajax({
                url: '/addTask',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    workspace_id: workspace_id,
                    space_id: slack_id,
                    list_id: list_id,
                    assegnat_id: assegnat_id,
                    osservatori_id: osservatori_id,
                    slack_id: slack_id,
                    taskName: taskName,
                    taskDescription: taskDescription
                },
                success: function (data, textStatus, jqXHR) {
                    if(data.ok) {
                        swal("Success!", "Task created!", "success").then(function(){
                            window.location.reload();
                        });
                    } else {
                        swal("Oops! Someting Wrong!", data.error, "error");
                    }
                }
            })
        } else {

        }
    }
}
let obj = new index();
$(document).on("change", '#workspace', obj.workspaceChange);
$(document).on("change", '#space', obj.spaceChange);
$(document).on("change", '#lists', obj.usersChange);
$(document).on("click", '#task', obj.addTask);

