@extends('layouts.app')
@section('title' ,'الأصدقاء') 
@section('content')  
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6"> 
        <div class=" p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
          <h6 class="border-bottom border-gray pb-2 mb-0">طلبات المتابعة</h6>
          @foreach ($follow_requests as $request)
          <div class="media text-muted pt-3">
            <img src="{{asset('images/avatar/'.$request->from_user->avatar)}}" alt="" class="col-sm-2 mr-2 rounded" style="margin-right: -3%;width: 50px;height: 50px;">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
              <div class="d-flex justify-content-between align-items-center w-100">
                <strong class="text-gray-dark">{{$request->from_user->name}}</strong>
                <form method="post" action="{{action('FollowController@destroy', $request['id'])}}">
                  {{ csrf_field() }}
                    <input type="submit" name="" class=" ml-4 btn btn-outline-warning" value="رفض الطلب" style="margin-right: 76%;">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="redirect_to" type="hidden" value="user/followers">
                  </form> 
                  <form method="post" action="{{action('FollowController@update', $request['id'])}}">
                  {{ csrf_field() }}
                  <div>
                    <input type="submit" class=" mr-4 btn btn-outline-success" value="قبول الطلب">
                    <input name="_method" type="hidden" value="PATCH">
                  </div>
                  </form>

              </div>
              <?php $request->created_at = strtotime('created_at');?>
              <span class="d-block">تم إرساله بتاريخ {{date('m-d-Y')}}</span>
            </div>
          </div>
          @endforeach
          <small class="d-block text-right mt-3">
            <a href="#">جميع الطلبات</a>
          </small>
        </div>
      </div>  
      <!--
      </div>  
      <div class="row"> --> 
        <div class="col-md-6">
          <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
            <h6 class="border-bottom border-gray pb-2 mb-0">الأصدقاء</h6>
              @foreach ($followers as $follower)
              @php
                $user = $follower->from_user->id == auth()->user()->id ? $follower->to_user : $follower->from_user;
              @endphp
            <div class="media text-muted pt-3">
              <div class="question_header_picture ml-3" style="background-image: url({{asset('images/avatar/'.$user->avatar)}});"></div>
              <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                  <a href="{{url('user/'.$user->id.'/posts')}}"><strong class="text-gray-dark">{{ $user->name}}</strong></a>
                  <form method="post" action="{{action('FollowController@destroy', $follower['id'])}}">
                  {{ csrf_field() }}
                    <input type="submit" class="btn btn-outline-danger" value="{{ $follower->from_user->id == auth()->user()->id ? 'إلغاء المتابعة' : 'حذفه من المتابعين' }}">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="redirect_to" type="hidden" value="user/followers">
                  </form>  
                </div>
                <span class="d-block ">{{ $follower->from_user->id == auth()->user()->id ? 'تتابعه ' : 'يتابعك ' }} {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>
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