<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {
                font-family: "Open Sans", sans-serif;
                line-height: 1.6;
            }

            .add-todo-input,
            .edit-todo-input {
                outline: none;
            }

            .add-todo-input:focus,
            .edit-todo-input:focus {
                border: none !important;
                box-shadow: none !important;
            }

            .view-opt-label,
            .date-label {
                font-size: 0.8rem;
            }

            .edit-todo-input {
                font-size: 1.7rem !important;
            }

            .todo-actions {
                visibility: hidden !important;
            }

            .todo-item:hover .todo-actions {
                visibility: visible !important;
            }

            .todo-item.editing .todo-actions .edit-icon {
                display: none !important;
            }

        </style>
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




    </head>
    <body >
    <div class="container m-5 p-2 rounded mx-auto bg-light shadow">
        <!-- App title section -->

        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                    <i class="fa fa-check bg-primary text-white rounded p-2"></i>
                    <u>My Todo-s</u>
                </div>
            </div>
        </div>
        <!-- Create todo section -->
        <form method="post" action="{{route('create-todo')}}">
            @csrf
            <div class="row m-1 p-3">
                <div class="col col-11 mx-auto">
                    <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                        <div class="col">
                            <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded" name="task" type="text" placeholder="Add new todo here.." required>
                        </div>
                        <div class="col-auto m-0 px-2 d-flex align-items-center">
                            <label class="text-secondary my-2 p-0 px-1 view-opt-label due-date-label d-none">Due date not set</label>
                            <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded" type="datetime-local" name="deadline" placeholder="Add new .." required>
                            <input class="form-control border-0 bg-transparent rounded" type="text" id="timezone" name="timezone" value="" readonly>
                        </div>
                        <div class="col-auto px-0 mx-0 mr-2">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="p-2 mx-4 border-0 border-bottom"></div>
        <div class="p-2 mx-4 border-0 border-bottom"></div>
        <!-- View options section -->
        <!-- Todo list section -->
        <div class="row mx-1 px-5 pb-3 w-80">
            <div class="col mx-auto">
                <!-- Todo Item 2 -->
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Deadline</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todos as $todo)
                        <tr>
                            <td>
                                {!! $todo->id !!}
                            </td>
                            <td>
                                {!! $todo->task !!}
                            </td>
                            <td>
                                {!! $todo->deadline !!}
                            </td>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>
</html>
<script>
    var today = new Date().toISOString().slice(0, 16);
    document.getElementsByName("deadline")[0].min = today;
    document.getElementById('timezone').value = Intl.DateTimeFormat().resolvedOptions().timeZone

    $(function () {
        $('#example').DataTable({
            columns: [
                {data: 'id', name: 'id'},
                {data: 'task', name: 'task'},
                {
                    data: 'deadline',
                    name: 'deadline',
                    render: function (data, type) {

                        var date = new Date(data+' UTC');
                        return date.toString()
                        //return moment(data).local().format('DD M YYYY HH:mm:ss');
                        //return data;
                    }
                },
            ],
        });
    });
</script>
