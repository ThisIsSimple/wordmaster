@extends('layouts')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <div class="container">
        <div class="row py-5">
            <div class="col col-12 col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12">
                <h2>로그인</h2>
                <div class="card mb-3">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">이메일</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="이메일">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">비밀번호</label>
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="비밀번호">
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    로그인 유지
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-2">로그인</button>
                            <a href="#" class="btn btn-facebook btn-block mb-2">Facebook 로그인</a>
                            <a href="#" class="btn btn-naver btn-block mb-2">네이버 로그인</a>
                            <div class="text-center">
                                <a href="#" class="text-muted">아직 회원이 아니신가요?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="#" class="text-muted">메인으로 돌아가기</a>
            </div>
        </div>
    </div>
@endsection