@extends('layout.template')
@section('content')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <!-- <div class="pb-3">
      <form class="d-flex" action="" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
          <button class="btn btn-secondary" type="submit">Cari</button>
      </form>
    </div> -->
    
    <div class="pb-3">
      <a href='{{route('customer.create')}}' class="btn btn-primary pull-right">+ Tambah Data</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">Nama</th>
                <th class="col-md-3">Tanggal Lahir</th>
                <th class="col-md-2">Phone</th>
                <th class="col-md-2">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value) 
            <tr>
                <td>{{$value->cst_name}}</td>
                <td>{{date_format(date_create($value->cst_dob),'d-m-Y')}}</td>
                <td>{{$value->cst_phoneNum}}</td>
                <td>{{$value->cst_email}}</td>
                <td>
                    <a href='{{route('customer.show',$value->cst_id)}}' class="btn btn-info btn-sm">view</a>
                    <a href='{{route('customer.edit',$value->cst_id)}}' class="btn btn-warning btn-sm">Edit</a>
                    <form action='{{route('customer.destroy',$value->cst_id)}}' method='POST'>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- AKHIR DATA -->
@endsection
        
    