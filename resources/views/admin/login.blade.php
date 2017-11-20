<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>登陆-米亚后台管理</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body class="login-page">
        <div class="top-content login">
            <div class="inner-bg">
                <div class="container">
                    @if(Session::has('danger'))
                        <div class="alert alert-danger">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>登录</h3>
                                    <p>请输入用户名和密码：</p>
                                </div>
                            </div>

                            <div class="form-bottom">
                                @if (count($errors) > 0)
                                  <div class="alert alert-danger">
                                      <ul>
                                          @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                                @endif
                                <form role="form" action="{{ route('login') }}" method="post" class="login-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">用户名：</label>
                                        <input type="text" name="username" placeholder="用户名..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">密码：</label>
                                        <input type="password" name="password" placeholder="密码..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">登录</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="backstretch"></div>
        <script type="text/javascript" src="../js/bootstrap.js"></script>
    </body>
</html>