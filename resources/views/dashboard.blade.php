    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Folders</title>

        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <style>
            /* Add this style block to your HTML or link to an external CSS file */

            /* Remove borders for the table and its cells */
            #dataTable,
            #dataTable th,
            #dataTable td {
                border: none;
            }

            /* Add borders to the table header cells (optional) */
            #dataTable th {
                border-bottom: 1px solid #ddd;
                /* You can customize the border color */
            }

            .form-group {
                position: relative;
                display: block;
                margin: 0;
                padding: 0;
            }

            .form-style {
                padding: 13px 20px;
                padding-left: 55px;
                height: 48px;
                width: 100%;
                font-weight: 500;
                border-radius: 4px;
                font-size: 14px;
                line-height: 22px;
                letter-spacing: 0.5px;
                outline: none;
                color: black;
                background-color: whitesmoke;
                border: none;
                -webkit-transition: all 200ms linear;
                transition: all 200ms linear;
                box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
            }

            .avatar {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                overflow: hidden;

                background-color: #3498db;
                /* Set your desired background color */
                color: #ffffff;
                /* Set your desired text color */
                font-size: 20px;
                /* Set your desired font size */
            }
        </style>
    </head>

    <body>
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Folders') }}
                </h2>
            </x-slot>

            <div class="card  mb-4 mx-auto" style="width: 100%">
                <div class="card-header py-3 ">
                    <div class="btn-group">
                        <button type="button" class="btn mt-4"
                            style="width: 200px; background-color: white; color: black" data-toggle="modal"
                            data-target="#addModal" aria-expanded="false">
                            <i class="fa-solid fa-plus"></i> NEW
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#addModal">Option
                                    1</a></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#addModal">Option
                                    2</a></li>
                            <!-- Add more options as needed -->
                        </ul>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-between text-center ">
                    <div class="table-responsive mx-auto ">
                        <table class="table  table-hover  " id="dataTable" width="100%" cellspacing="0"
                            style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th style="display: none">prod_id</th>
                                    <th>Name</th>
                                    <th>Date Created</th>
                                    <th>Owner</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($folders as $folder)
                                    @php
                                        $dateString = $folder->date_created;
                                        $carbonDate = \Carbon\Carbon::parse($dateString);
                                        $formattedDate = $carbonDate->format('M j Y');
                                    @endphp

                                    {{ $formattedDate }}


                                    <tr>

                                        <td style="display: none">prod_id</td>

                                        <td> <a href="/files"><i class="fa-solid fa-folder"></i> {{ $folder->f_name }}
                                            </a></td>

                                        <td>{{ $formattedDate }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar mr-2">
                                                    <span id="initials">M</span>
                                                </div>
                                                <div>
                                                    me
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Edit Icon -->
                                            <a>
                                                <i class="bi bi-pencil-square " data-toggle="modal"
                                                    data-target="#renameModal"></i> </a>
                                            &nbsp;

                                            <!-- Delete Icon -->
                                            <a onclick="return confirm('Are you sure?')" href="/delete_product">
                                                <i class="bi bi-trash-fill"></i> </a>
                                            &nbsp;

                                            <i class="bi bi-star" data-toggle="modal" data-target="#stockModal"></i>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>






            <!--ADD Folder -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Folder
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/new_folder" method="post">
                                {{ csrf_field() }}
                                <div class="row">

                                    <input type="hidden" name="product_id" id="product_id" value="">
                                    <input type="hidden" name="current_stocks" id="current_stocks" value="">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label for="email">Folder Name : </label>

                                            <input type="text" name="folder" class="form-style" id="folder"
                                                autocomplete="off">
                                            @error('art')
                                                <span style="color:red;">{{ $message }}</span>
                                            @enderror
                                            <i class="input-icon uil uil-at"></i>
                                        </div>

                                    </div>
                                </div>
                                <br>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-outline-danger" type="button"
                                data-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-primary" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!--Rename Folder -->
            <div class="modal fade" id="renameModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Rename Folder
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/new_stocks" method="post">
                                {{ csrf_field() }}
                                <div class="row">

                                    <input type="hidden" name="product_id" id="product_id" value="">
                                    <input type="hidden" name="current_stocks" id="current_stocks" value="">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label for="email">Folder Name : </label>

                                            <input type="text" name="rename_folder" class="form-style"
                                                id="rename_folder" autocomplete="off">
                                            @error('art')
                                                <span style="color:red;">{{ $message }}</span>
                                            @enderror
                                            <i class="input-icon uil uil-at"></i>
                                        </div>

                                    </div>
                                </div>
                                <br>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-outline-danger" type="button"
                                data-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-primary" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






        </x-app-layout>



        <!-- Template Main JS File -->
        <script src="{{ asset('assets/js/main.js') }}"></script>


        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>




    </body>

    </html>
