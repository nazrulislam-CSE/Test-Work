<x-app-layout>
    @push('css')
    <style>
        .dt-buttons {
            margin-left: 30px;
        }
     </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <h1 class="text-center text-success mt-4 mb-4"><b></b></h1>
        <div class="card">
            <div class="card-header border-bottom d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <p class="card-title my-0 mb-2 mb-sm-0">Post List <span id="posCount" class="badge bg-danger side-badge" style="font-size: 17px;"></span></p>
                <div class="d-flex">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#add_post" class="btn btn-success me-2">
                        <i class="fas fa-plus d-inline"></i> Add Post
                    </a>
                </div>
            </div> 

            <!-- Add Post Modal Code Start-->
            <div class="modal fade" id="add_post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title text-success font-weight-bolder">Add Post</h6>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="post_form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-xl-12 col-lg-12 col-md-6 mt-3">
                                        <div class="input-group post_input">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                            <input type="text" data-bs-toggle="tooltip-primary" title="Post Title"
                                                value="" class="form-control" name="title"
                                                id="title" placeholder="Enter Post Title">
                                            <div class="invalid-feedback show"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xl-12 col-lg-12 col-md-6 mt-3">
                                        <div class="input-group post_input">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                           <textarea name="content" id="content" class="form-control" cols="5" rows="5" placeholder="Enter Post Description"></textarea>
                                        </div>
                                        <div class="invalid-feedback show"> </div>
                                    </div>

                                    <div class="form-group col-xl-10 col-lg-6 col-md-10 mt-3">
                                        <div class="row">
                                            <div class="col-lg-10 mt-1">
                                                <div class="input-group post_input">
                                                    <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                                    <input class="form-control m-t-xxs" id="image" name="image" type="file" placeholder="Student Photo" data-bs-toggle="tooltip-primary" title="Student Photo" data-bs-placement="top" >
                                                </div>
                                                <div class="invalid-feedback show" ></div>
                                            </div>
                                            <div class="col-lg-2 mt-1">
                                                <img class="img-fluid" id="showImage" src="{{ (!empty($profile->image)) ? url('upload/admin_images/'.$profile->image):url('upload/post/user.png') }}" alt="Student Photo" style="width:50px; height: 50px;"  >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-xl-12 col-lg-12 col-md-6 mt-3">
                                        <div class="input-group post_input" data-bs-toggle="tooltip-primary" title="Status" data-bs-placement="top">
                                            <span class="input-group-text"><i class="fas fa-user-nurse"></i></span>
                                            <select name="status" id="status" class="selectpicker form-control m-t-xxs status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-success add_post"> <i class="fa fa-plus"></i> Add Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Add Post Modal Code close--->

            <!-- Update Post Modal Code Start-->
            <div class="modal fade" id="update_post" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title text-success font-weight-bolder">Edit Post</h6>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="post_id">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-xl-12 col-lg-12 col-md-6 mt-3">
                                        <div class="input-group post_input">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                            <input type="text" data-bs-toggle="tooltip-primary" title="Post Title"
                                                value="" class="form-control" name="title"
                                                id="title" placeholder="Enter Post Title">
                                            <div class="invalid-feedback show"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xl-12 col-lg-12 col-md-6 mt-3">
                                        <div class="input-group post_input">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                           <textarea name="content" id="content" class="form-control" cols="5" rows="5" placeholder="Enter Post Description"></textarea>
                                        </div>
                                        <div class="invalid-feedback show"> </div>
                                    </div>

                                    <div class="form-group col-xl-10 col-lg-6 col-md-10 mt-3">
                                        <div class="row">
                                            <div class="col-lg-10 mt-1">
                                                <div class="input-group post_input">
                                                    <span class="input-group-text"><i class="fas fa-photo"></i></span>
                                                    <input class="form-control m-t-xxs" id="image" name="image" type="file" placeholder="Student Photo" data-bs-toggle="tooltip-primary" title="Student Photo" data-bs-placement="top" >
                                                </div>
                                                <div class="invalid-feedback show" ></div>
                                            </div>
                                            <div class="col-lg-2 mt-1">
                                                <img class="img-fluid" id="showImage" src="{{ (!empty($profile->image)) ? url('upload/admin_images/'.$profile->image):url('upload/post/user.png') }}" alt="Student Photo" style="width:50px; height: 50px;"  >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-xl-12 col-lg-12 col-md-6 mt-3">
                                        <div class="input-group post_input" data-bs-toggle="tooltip-primary" title="Status" data-bs-placement="top">
                                            <span class="input-group-text"><i class="fas fa-user-nurse"></i></span>
                                            <select name="status" id="status" class="selectpicker form-control m-t-xxs status">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-success update_post"> <i class="far fa-paper-plane"></i> Update Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Update Post Modal Code close--->

            <div class="card-header">
                <div class="row">
                    <div class="col col-9"><b></b></div>
                    <div class="col col-3">
                        <div id="daterange"  class="float-end" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> 
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="post_table">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@push('js')
 <!-- DataTables CSS and JS -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
 <!-- DataTables Buttons CSS and JS -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

 <script>
    $.ajaxSetup({
        headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

    <script type="text/javascript">
        var start_date = moment().startOf('month');
        var end_date = moment().endOf('month');
    
        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));
    
        $('#daterange').daterangepicker({
            startDate : start_date,
            endDate : end_date
        }, function(start_date, end_date){
            $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));
    
            datatable.draw();
        });
        
        var datatable;

        $(document).ready(function() {
            datatable = $('#post_table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "pageLength": 2,
                ajax: {
                    url : "{{ route('post.index') }}",
                    data : function(data){
                        data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    },
                    dataSrc: function (json) {
                        // Update the Admission count
                        $('#posCount').text(json.recordsTotal);
                        return json.data;
                    }
                },
                dom: 'lBfrtip', // 'B' for buttons
                buttons: {
                    buttons: [
                        {
                            extend: 'excel',
                            className: 'btn btn-success',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-warning',
                            text: '<i class="fas fa-file-csv"></i> CSV',
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-danger',
                            text: '<i class="fas fa-file-pdf"></i> PDF',
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-primary',
                            text: '<i class="fas fa-print"></i> Print',
                        },
                        {
                            text: 'Reload',
                            className: 'btn btn-info',
                            text: '<i class="fas fa-sync-alt"></i> Reload',
                            action: function (e, dt, node, config) {
                                dt.ajax.reload();
                            }
                        },
                        {
                            text: 'Reset',
                            className: 'btn btn-secondary',
                            text: '<i class="fas fa-undo"></i> Reset',
                            action: function (e, dt, node, config) {
                                // Clear any filters or search inputs
                                $('.dataTables_filter input').val('');
                                
                                // Redraw the table
                                dt.search('').draw();
                            }
                        },
                    ],
                    dom: {
                        button: {
                            className: 'btn-group mt-1'
                        }
                    }
                },
                drawCallback: function (settings) {
                    // Update the admission count on every draw
                    $('#postCount').text(datatable.page.info().recordsDisplay);
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data:'title',
                        name:'title',
                    },
                    {
                        data:'content',
                        name:'content',
                    },
                    {
                        data:'image',
                        name:'image',
                    },
                    {
                        data:'status',
                        name:'status',
                    },
                    {
                        data:'action',
                        name:'action',
                    }
                ]
            });


        });
        
        </script>
         <script type="text/javascript">
            $(document).ready(function(){
                $('#image').change(function(e){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#showImage').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
        <script>
            $(document).ready(function () {
               $('#post_form').validate({
                  errorElement: 'div',
                  errorPlacement: function (error, element) {
                        // Add Bootstrap class for styling
                        error.addClass('text-danger');
                        
                        // Check if the element has an ID and it matches a specific pattern
                        if (element.attr('id') && element.attr('id').endsWith('_Error')) {
                           // Insert error message after the input element
                           error.insertAfter(element);
                        } else {
                           // Use Toastr to show a notification for other elements
                           toastr.error(element.attr('name') + ': ' + error.text(), 'Error');
                        }
                  },
                  highlight: function (element, errorClass, validClass) {
                        // Add Bootstrap class for highlighting the error
                        $(element).addClass('is-invalid');
                  },
                  unhighlight: function (element, errorClass, validClass) {
                        // Remove Bootstrap class when the error is fixed
                        $(element).removeClass('is-invalid');
                  },
                  rules: {
                        title: {
                            required: true,
                            minlength: 3
                        },
                        content: {
                            required: true
                        },
                        
                    },
               });
            });
         </script>

<script>
    $(document).ready(function(){
        $(document).on('click', '.add_post', function(e){
                e.preventDefault();

                let title = $('#title').val();
                let content = $('#content').val();
                let image=document.getElementById('image').files;
                let status = $('#status').val();

                let formData= new FormData();
                formData.append('title',title);
                formData.append('content',content);
                formData.append('status',status);
                if(image[0]!=null){
                    formData.append('image',image[0]);
                }

                axios.post("{{ route('post.store') }}",formData)
                .then(res=>{
                    console.log(res.data);

                    if(res.data.res == 'success'){
                        $('#add_post').modal('hide');

                        // toastr.success(res.data.message);
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Post Added Successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Reset the form
                        $('#post_form')[0].reset();

                        // Clear input values
                        $('.post_input input').val('');


                        // Clear image input (assuming it's an input type file)
                        $('.post_input input[type="file"]').val('');
                        datatable.ajax.reload();
                        // Reset the image to the default image
                        $('#showImage').attr('src', 'upload/post/user.png');
                    }else if(res.data.error){
                    
                        var keys=Object.keys(res.data.error);

                        keys.forEach(function(d){
                        $('#'+d).addClass('is-invalid');
                        toastr.error(res.data.error[d][0]);
                        $('#'+d+'_msg').text(res.data.error[d][0]);
                        $('#'+d+'_msg').show();
                        })
                    }

                })

        });
     });

</script>

<script>
    $(document).delegate(".deleteRow", "click", function(){
        let route = $(this).data('url');
        let itemName = $(this).data('item-name');
        if (itemName === undefined) {
        // Display a SweetAlert error if itemName is undefined
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Post Title is undefined. Unable to delete.',
            });
        } else {
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to permanently delete ${capitalizeFirstLetter(itemName)}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value == true) {
                    axios.delete(route)
                        .then((data) => {
                            console.log(data);
                            if(data.data.message){
                                $('#post_form').modal('hide');
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: `${capitalizeFirstLetter(itemName)} deleted successfully!`,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                datatable.ajax.reload();
                               
                                // toastr.error(data.data.message);
                            }else if(data.data.warning){
                                // toastr.error(data.data.warning);
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Post Not Deleted,Some Problem Here!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                        })
                }
            });
        }
    });
</script>

    <!-------------- Post Edit --------------->
    <script>
        function post_edit(id) {
            var data_id = id;
            var url = '{{ route('post.edit', ':id') }}';
            url = url.replace(':id', data_id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    $('#post_id').val(data.post.id);
                    $('#title').val(data.post.title);
                    $('#content').val(data.post.content);
                    $('#status').val(data.post.status);
                    $('#image').val(data.post.image).trigger('change');
                }
            });
        }
    </script>

    <!-------------- Post Update --------------->
    <script>
        $(document).ready(function() {

            $(document).on('click', '.update_post', function(e) {
                e.preventDefault();

                let post_id = $('#post_id').val();
                let title = $('#title').val();
                let content = $('#content').val();
                let status = $('#status').val();
                let formData = new FormData();
                formData.append('post_id', post_id);
                formData.append('title', title);
                formData.append('content', content);
                formData.append('status', status);


                axios.post("{{ URL::to('/post/update/') }}/" + post_id, formData)
                    .then(function(res) {
                        console.log(res);

                        if (res.data.status == 'success') {
                            datatable.ajax.reload();
                            $('#update_post').modal('hide');
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Post Updated Successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // toastr.success(res.data.message);

                        }

                    });

            });

        });
    </script>

    @endpush
</x-app-layout>
