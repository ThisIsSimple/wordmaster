@extends('layouts')

@section('content')
    <div class="row no-gutters">
        <section id="left" class="py-5 col col-12 col-lg-2">
            <div id="note-list" class="list-group mb-5">
                <a href="#" class="list-group-item list-group-item-action note active" data-note-id="0">
                    전체보기
                </a>
                @foreach ($notes as $note)
                    <input type="text" class="list-group-item list-group-item-action note" value="{{ $note->name }}"
                           data-note-id="{{ $note->id }}" readonly>
                @endforeach
                <a href="#" id="add-note" class="list-group-item list-group-item-action">단어장 추가 <i class="fa fa-plus"
                                                                                                   aria-hidden="true"></i></a>
            </div>
            <div class="list-group mt-5">
                <p class="list-group-item list-group-item-action">다른 사용자로부터</p>
                <a href="#" class="list-group-item list-group-item-action active">
                    센과 치히로의 행방불명
                </a>
                <a href="#" class="list-group-item list-group-item-action">하울의 움직이는 성</a>
                <a href="#" class="list-group-item list-group-item-action">경선식 영어 단어</a>
                <a href="#" class="list-group-item list-group-item-action">단어장 찾기 <i class="fa fa-plus"
                                                                                     aria-hidden="true"></i></a>
            </div>
        </section>
        <section id="content" class="col col-12 col-lg-7">
            <div class="container p-5">
                <ul class="nav nav-pills justify-content-center mb-3">
                    <li class="nav-item">
                        <a class="nav-link classify classify-by-all active" href="#">전체보기</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link classify classify-by-type" href="#">품사별</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link classify classify-by-language" href="#">언어별</a>
                    </li>
                </ul>
                <ul id="type-list" class="nav nav-pills justify-content-center mb-5" style="display: none;"></ul>
                <div id="word-list" class="row mt-5">
                    @foreach ($words as $word)
                        <div class="col col-12 col-md-4 word" data-note-id="{{ $word->note_id }}"
                             data-word-id="{{ $word->id }}">
                            <a class="delete-word" style="display: none;">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <input type="text" class="word-input word-input-word" placeholder="단어"
                                               value="{{ $word->word }}">
                                    </h4>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <input type="text" class="word-input word-input-meaning text-muted"
                                               placeholder="뜻"
                                               value="{{ $word->meaning }}">
                                    </h6>
                                    <p class="card-text small">
                                        <input type="text" class="word-input word-input-type" placeholder="품사"
                                               value="{{ $word->type }}">
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col col-12 col-md-4">
                        <div id="add-word" class="card word plus text-center" data-toggle="tooltip" data-placement="top"
                             title="Add New Word" style="display: none;">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <h6 class="card-subtitle mb-2 text-muted" style="vertical-align: middle"><i
                                            class="fa fa-plus fa-2x" aria-hidden="true"></i></h6>
                                <p class="card-text small"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="delete-note" class="btn btn-primary" style="display: none;">단어장 삭제</button>
            </div>
        </section>
        <section id="right" class="col col-12 col-lg-3">
            <div class="container p-5">
                <div class="text-center mb-5">
                    <img src="{{ asset('img/blank.png') }}" class="rounded mb-3" alt="profile_images" width="100%">
                    <h3>전윤민</h3>
                    <h5>@cordelia273</h5>
                </div>
                <div class="row no-gutters text-center">
                    <div id="flip" class="col col-4 p-3" data-toggle="tooltip" data-placement="top"
                         title="Filp Word/Meaning">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </div>
                    <div class="col col-4 p-3" data-toggle="tooltip" data-placement="top" title="My Word Analysis">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </div>
                    <div class="col col-4 p-3" data-toggle="tooltip" data-placement="top" title="Settings">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </div>
                    <div class="col col-4 p-3" data-toggle="tooltip" data-placement="top" title="Word Test">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    </div>
                    <div class="col col-4 p-3" data-toggle="tooltip" data-placement="top" title="Share">
                        <i class="fa fa-share" aria-hidden="true"></i>
                    </div>
                    <div class="col col-4 p-3" data-toggle="tooltip" data-placement="top" title="Log Out">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection