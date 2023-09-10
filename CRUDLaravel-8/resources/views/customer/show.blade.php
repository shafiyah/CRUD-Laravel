@extends('layout.template')
@section('content')

<form action='{{url('customer')}}' method='post'>
@csrf
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
</div>
@endif

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <h2>Customer</h2>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='name' id="name" value="{{$data->cst_name}}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="dob" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='dob' id="dob" value="{{$data->cst_dob}}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nationality" class="col-sm-2 col-form-label">Kewarganegaraan</label>
            <div class="col-sm-10">
            <select name="nationality" id="nationality" class="form-control" disabled = "true">
                @foreach($nationality as $key => $value) 
                @if ($value->nationality_id == $data->nationality_id) 
                <option value="{{$value->nationality_id}}" selected >{{$value->nationality_name.'-'.$value->nationality_code}}</option>
                @else
                <option value="{{$value->nationality_id}}">{{$value->nationality_name.'-'.$value->nationality_code}}</option>
                @endif
                @endforeach  
            </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name='email' id="email" value="{{$data->cst_email}}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="phone" class="form-control" name='phone' id="phone" value="{{$data->cst_phoneNum}}" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="keluarga" class="col-sm-2 col-form-label">Keluarga</label>
        </div>
       <br>
        <div>
          <table class="table table-bordered" id="dynamicTable">  
            <tr>
                <th>Relasi</th>
                <th>Name</th>
                <th>Tanggal Lahir</th>
               
            </tr>
            @foreach($data->familyList as $key2 => $value2) 
            <tr>  
                <td><input type="text" name="addmorerelasi[]" placeholder="relasi" class="form-control" value="{{$value2->fl_relation}}" readonly/></td> 
                <td><input type="text" name="addmorename[]" placeholder="Masukan Nama" class="form-control" value="{{$value2->fl_name}}" readonly/></td>  
                <td><input type="date" name="addmoredob[]" placeholder="Pilih Tanggal" class="form-control" value="{{$value2->fl_dob}}" readonly/></td>  
            </tr>  
            @endforeach
          </table>  
        </div>  
</form>
</div>

<script type="text/javascript"> 
$("#add").click(function(){
    $("#dynamicTable").append('<tr><td><input type="text" name="addmorerelasi[]" placeholder="relasi" class="form-control" /></td><td><input type="text" name="addmorename[]" placeholder="Masukan Nama" class="form-control" /></td>  <td><input type="date" name="addmoredob[]" placeholder="Pilih Tanggal" class="form-control" /></td>  <td><button type="button" class="btn btn-danger remove-tr">Hapus</button></td></tr>');
    });

$(document).on('click', '.remove-tr', function(){  
     $(this).parents('tr').remove();
});  

</script>

   <!-- AKHIR FORM -->
@endsection
