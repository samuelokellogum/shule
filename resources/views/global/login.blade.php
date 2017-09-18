@extends('global.main2')
@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="{{ route('authUser') }}" method="post">
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" name="email" class="form-control" placeholder="email" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button class="btn btn-default" type="submit" >Log in</button>
                    </div>
                    @if(isset($error))
                    <div style="color: red">{{ $error }}</div>
                    @endif
                    <div class="clearfix"></div>

                    <div class="separator">
                        <div>
                            <h1><i class="fa fa-paw"></i> Shule!</h1>
                            <p>©<?php echo date('Y')?> All Rights Reserved. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
