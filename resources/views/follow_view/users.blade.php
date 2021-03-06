@extends('layouts.app')
@section('title' ,'المستخدمين') 
@section('content')  
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row" >
      <div class="col-md-6"> 
        <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
          <h6 class="border-bottom border-gray pb-2 mb-0">المستخدمين</h6>
          @foreach ($users as $user)
          <div class="media text-muted pt-3">
            <div class="question_header_picture ml-3" style="background-image: url({{asset('images/avatar/'.$user->avatar)}});"></div>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
              <div class="d-flex justify-content-between align-items-center w-100">
              <a href="{{asset("user_info/$user->id/$user->name")}}"> <strong class="text-gray-dark">{{$user->name}}</strong></a>
                <form method="POST" action="{{url('follow')}}">
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                    {{ csrf_field() }}
                  <input type="submit" class="btn btn-outline-success" value="إرسال الطلب">
                </form>  
              </div>
            </div>
          </div>
          @endforeach
          <small class="d-block text-right mt-3">
            <a href="#">جميع المستخدمين</a>
          </small>
        </div>
      </div>  
      <!--
      </div>  
      <div class="row"> --> 
        <div class="col-md-6">
          <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
            <h6 class="border-bottom border-gray pb-2 mb-0">الطلبات المرسلة</h6>
            @foreach ($requests as $request)
            <div class="media text-muted pt-3">
              <img src="{{asset('images/avatar/'.$request->to_user->avatar)}}" alt="" class="col-sm-2 mr-2 rounded" style="margin-right: -3%;width: 50px;height: 50px;">
              <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                <div class="d-flex justify-content-between align-items-center w-100">
                  <strong class="text-gray-dark">{{$request->to_user->name}}</strong>
                  <form method="post" action="{{action('FollowController@destroy', $request['id'])}}">
                  {{ csrf_field() }}
                    <input type="submit" name="" class="btn btn-outline-warning" value="حذف الطلب" >
                    <input name="_method" type="hidden" value="DELETE">
                  </form>  
                </div>
                <?php $request->created_at = strtotime('created_at');?>
                <span class="d-block">تم إرساله بتاريخ {{date('m-d-Y')}}</span>
              </div>
            </div>
            @endforeach
            <small class="d-block text-right mt-3">
              <a href="#">جميع التحديثات</a>
            </small>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection