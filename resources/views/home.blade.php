
<?php
use Illuminate\Support\Facades\Auth;
$user =Auth::user();
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                @if( $user->address=="")
                  {{ __('You are logged in!') }}
                    <div class="card-body">
                        <form action="{{url('add-address-crypto')}}" method="post"> @csrf
                            <div class="form-group">
                                <label  >crypto address</label>
                                <input type="text" class="form-control" id="addressCrypto" name="addressCrypto" placeholder="add your crypto addresse">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                @else
                   <div style="align-items: center ;margin-left: 20px">
                       you are a member !
                   </div>
                @endif

                <div class="card-body">
                    @if(Session::has('success_message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success_message')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
