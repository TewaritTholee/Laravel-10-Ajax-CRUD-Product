<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Ajax CRUD Tutorial Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CDN เก่า --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CDN ใหม่ --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    {{-- ฟอนต์ --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: "Noto Sans Thai", sans-serif;
        }
    </style>

</head>
<body>
      
<div class="container">
    <h1>Laravel 10 Ajax CRUD Tutorial Example</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> สร้างผลิตภัณฑ์ใหม่</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียด</th>
                <th width="280px">แสดงผล</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
     
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">ชื่อสินค้า</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
       
                    <div class="form-group">
                        <label class="col-sm-4 control-label">รายละเอียดสินค้า</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>
        
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">บันทึกข้อมูล
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      
</body>

<style>
    body {
        font-family: "Noto Sans Thai", sans-serif;
        background-color: #f8f9fa;
        padding: 20px;
    }
    .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .container h1 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #343a40;
    }
    .btn {
        border-radius: 5px;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    .modal-header {
        background-color: #007bff;
        color: #ffffff;
        border-radius: 5px 5px 0 0;
    }
    .modal-title {
        margin: 0;
        font-size: 1.25rem;
    }
    .form-horizontal .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .form-group input:focus, .form-group textarea:focus {
        border-color: #007bff;
        outline: none;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .data-table {
        width: 100%;
        margin-top: 20px;
    }
    .data-table th, .data-table td {
        text-align: center;
        vertical-align: middle;
    }
    .data-table th {
        background-color: #007bff;
        color: #ffffff;
    }
    .data-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .data-table tbody tr:hover {
        background-color: #e9ecef;
    }

    
</style>

      
<script type="text/javascript">
  $(function () {
      
    /* Pass Header Token */ 
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      
    /* Render DataTable*/
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products-ajax-crud.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'detail', name: 'detail'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

      
    /* Click to Button */
    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("สร้างผลิตภัณฑ์ใหม่");
        $('#ajaxModel').modal('show');
    });
      
    /* Click to Edit Button*/

    $('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get("{{ route('products-ajax-crud.index') }}" +'/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("แก้ไขข้อมูลสินค้า");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#product_id').val(data.id);
          $('#name').val(data.name);
          $('#detail').val(data.detail);
      })
    });
      
    /* Create Product Code*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('กำลังบันทึกข้อมูล...');
      
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('products-ajax-crud.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
       
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
           
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
      
    /* Delete Product Code*/

    $('body').on('click', '.deleteProduct', function () {
        var product_id = $(this).data("id");
        
        // ใช้ SweetAlert สำหรับการยืนยัน
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบข้อมูล!',
            cancelButtonText: 'ไม่'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('products-ajax-crud.store') }}" + '/' + product_id,
                    success: function (data) {
                        Swal.fire(
                            'ลบแล้ว!',
                            'ข้อมูลของคุณถูกลบเรียบร้อยแล้ว.',
                            'success'
                        )
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        Swal.fire(
                            'เกิดข้อผิดพลาด!',
                            'ไม่สามารถลบข้อมูลได้.',
                            'error'
                        )
                    }
                });
            }
        })
    });

       
  });
</script>
</html>