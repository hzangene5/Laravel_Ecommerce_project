@extends('admin.layouts.admin')

@section('title')
index permissions
@endsection

@section('content')

<!-- Content Row -->
<div class="row">

  <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">
    <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
      <h5 class="font-weight-bold"> لیست مجوزها ({{$permissions->total()}})</h5>
    <div>
    <a class="btn btn-sm btn-outline-primary" href="{{route('admin.permissions.create')}}">
        <i class="fa fa-plus"></i>
        ایجاد مجوز
      </a>
    </div>
    </div>
    <div>
      <table class="table table-borderd table-striped text-center">
         <thead>
           <tr>
             <th>#</th>
             <th>نام</th>
             <th>نام نمایشی</th>
             <th>عملیات</th>
           </tr>
         </thead>
         <tbody>
           @foreach($permissions as $key => $permission)
               <tr>
                 <th>
                    {{ $permissions->firstItem() + $key}}
                 </th>
                 <th>
                   {{ $permission->display_name }}
                 </th>
                 <th>
                   {{ $permission->name }}
                 </th>
                 <th>
                  <th>
                    <a class="btn btn-sm btn-outline-info mr-2" href="{{route('admin.permissions.edit' , ['permission' => $permission->id ] )}}">ویرایش</a>
                  </th>
               </tr>
           @endforeach
         </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center mt-5">
       {{ $permissions->render()}}
   </div>

  </div>
</div>  
  @endsection