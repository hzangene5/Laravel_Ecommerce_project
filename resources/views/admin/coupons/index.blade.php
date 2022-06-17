@extends('admin.layouts.admin')

@section('title')
index coupons
@endsection

@section('content')

<!-- Content Row -->
<div class="row">

  <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">
    <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
      <h5 class="font-weight-bold"> لیست کوپن ها ({{$coupons->total()}})</h5>
      <div>
        <a class="btn btn-sm btn-outline-primary" href="{{route('admin.coupons.create')}}">
          <i class="fa fa-plus"></i>
          ایجاد کوپن
        </a>
      </div>
    </div>
    <div>
      <table class="table table-borderd table-striped text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>نام</th>
            <th>کد</th>
            <th>نوع</th>
            <th>تاریخ انقضا</th>
            <th>عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupons as $key => $coupon)
          <tr>
            <th>
              {{ $coupons->firstItem() + $key}}
            </th>
            <th>
              {{ $coupon->name }}
            </th>
            <th>
              {{ $coupon->code }}
            </th>
            <th>
              {{ $coupon->type }}
            </th>

            <th>
              {{ verta($coupon->expire_at) }}
            </th>
            <th>
              <a class="btn btn-sm btn-outline-success" href="{{route('admin.coupons.show' , ['coupon' => $coupon->id ] )}}">نمایش</a>
              <a class="btn btn-sm btn-outline-info mr-2" href="{{route('admin.coupons.edit' , ['coupon' => $coupon->id ] )}}">ویرایش</a>
            </th>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center mt-5">
      {{ $coupons->render()}}
    </div>

  </div>
</div>
@endsection