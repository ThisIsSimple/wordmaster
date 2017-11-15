$(function () {
    $('*').tooltip();

    var word_list = $('#word-list');
    var word_model = '<div class="col col-12 col-md-4"><div class="card word text-center"><div class="card-body"><h4 class="card-title"><input type="text" class="word-input word-input-word" placeholder="단어"></h4><h6 class="card-subtitle mb-2 text-muted"><input type="text" class="word-input word-input-meaning text-muted" placeholder="뜻"></h6><p class="card-text small"><input type="text" class="word-input word-input-type" placeholder="품사"></p></div></div></div>';

    var note_list = $('#note-list');
    var note_model = '<a href="#" class="list-group-item list-group-item-action note" data-note-id="0">새로운 단어장</a>';

    function create_word_model(note_id, word_id) {
        return '<div class="col col-12 col-md-4 word" data-note-id="' + note_id + '" data-word-id="' + word_id + '"><a class="delete-word" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i></a><div class="card text-center"><div class="card-body"><h4 class="card-title"><input type="text" class="word-input word-input-word" placeholder="단어"></h4><h6 class="card-subtitle mb-2 text-muted"><input type="text" class="word-input word-input-meaning text-muted" placeholder="뜻"></h6><p class="card-text small"><input type="text" class="word-input word-input-type" placeholder="품사"></p></div></div></div>';
    }

    function create_note_model(note_id, name) {
        return '<input type="text" class="list-group-item list-group-item-action note" value="' + name + '" data-note-id="' + note_id + '">';
        // return '<a href="#" class="list-group-item list-group-item-action note" data-note-id="' + note_id + '">' + name + '</a>';
    }

    function create_type_model(type_name) {
        // if(type_name == "기타") {
        //     return '<li class="nav-item"><a class="nav-link" href="#" data-type-name="">'+type_name+'</a></li>';
        // } else {
            return '<li class="nav-item"><a class="nav-link" href="#" data-type-name="'+type_name+'">'+type_name+'</a></li>';
        // }
    }

    $(document).on('click', window, function () {
        // if($('.note').hasClass('active')) {
        //     $('.note').prop('readonly', true);
        // }
    });

    // 단어에 마우스 올렸을때 삭제 버튼 보이게 하는 코드
    $(document).on('mouseenter', '.word', function (event) {
        var me = $(this);
        me.find('.delete-word').css('display', 'block');
    }).on('mouseleave', '.word', function () {
        var me = $(this);
        me.find('.delete-word').css('display', 'none');
    });

    // 단어 추가
    $(document).on('click', '#add-word', function () {
        var me = $(this);
        var note_id = $('.note.active').data('note-id');

        $.get({
            url: '/words/create?note_id=' + note_id,
            dataType: 'json',
            data: {},
            success: function (data) {
                me.parent().before(create_word_model(data.note_id, data.word_id));
            }
        });
    });

    // 단어 삭제
    $(document).on('click', '.delete-word', function () {
        var me = $(this);
        var word_id = me.parent().data('word-id');

        $.get({
            url: '/words/delete',
            dataType: 'json',
            data: {
                word_id: word_id
            },
            success: function () {
                $('.word[data-word-id=' + word_id + ']').remove();
            }
        })
    });

    // Enter 두번 입력으로 단어를 추가함
    var newToggle = 0;
    $(window).keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();

            setTimeout(function () {
                newToggle = 0;
            }, 500);

            if (newToggle == 1) {
                $('.plus').click();
                newToggle = 0;
            }
            newToggle = 1;
        }
    });

    // 노트 선택 및 폼 활성화
    $(document).on('click', '.note', function () {
        var me = $(this);
        $('#type-list .nav-link').removeClass('active');

        if (me.hasClass('active')) {
            me.prop('readonly', false);
        }

        $('.note').removeClass('active');
        $(this).addClass('active');

        var note_id = $('.note.active').data('note-id');


        if (note_id == 0) {
            $('.word').show();
            $('#add-word').hide();
            $('#delete-note').hide();
        } else {
            $('.word').hide();
            $('.word[data-note-id=' + note_id + ']').show();
            $('#add-word').show();
            $('#delete-note').show();
        }
    });

    // 노트 수정
    $(document).on('keyup', 'input.note', function () {
        var me = $(this);

        var note_id = me.data('note-id');
        var note_name = me.val();

        $.get({
            url: '/note/update',
            dataType: 'json',
            data: {
                note_id: note_id,
                note_name: note_name,
            },
            success: function (data) {
            }
        });
    });

    // 노트 추가
    $(document).on('click', '#add-note', function () {
        var note = $(this);

        $.get({
            url: '/note/create',
            dataType: 'json',
            data: {},
            success: function (data) {
                var note_id = data.note_id;
                var name = data.name;

                note.before(create_note_model(note_id, '새로운 단어장'));
            }
        });
    });

    // 노트 삭제
    $(document).on('click', '#delete-note', function () {
        var note_id = $('.note.active').data('note-id');

        $.get({
            url: 'note/delete',
            dataType: 'json',
            data: {
                note_id: note_id
            },
            success: function () {
                $('.note.active').remove();
                $('.note').click();
            }
        })
    });

    // 단어 수정
    $(document).on('keyup', '#word-list input', function () {
        var me = $(this);

        var word = me.parent().parent().parent().parent();
        var word_id = word.data('word-id');

        var word_word = word.find('.word-input-word').val();
        var word_meaning = word.find('.word-input-meaning').val();
        var word_type = word.find('.word-input-type').val();

        $.get({
            url: '/words/update',
            dataType: 'json',
            data: {
                word_id: word_id,
                word: word_word,
                meaning: word_meaning,
                type: word_type
            },
            success: function (data) {
            }
        });
    }, function () {
        var me = $(this);

        var word = me.parent().parent().parent().parent();
        var word_id = word.data('word-id');

        var word_word = word.find('.word-input-word').val();
        var word_meaning = word.find('.word-input-meaning').val();
        var word_type = word.find('.word-input-type').val();

        $.get({
            url: '/words/update',
            dataType: 'json',
            data: {
                word_id: word_id,
                word: word_word,
                meaning: word_meaning,
                type: word_type
            },
            success: function (data) {
            }
        });
    });

    // 단어 뜻/의미 토글
    var flipToggle = 0;
    $('#flip').on('click', function () {
        if (flipToggle == 0) {
            $('.word-input-meaning').parent().css("display", "none");
            $('.word-input-type').parent().css("display", "none");
            $('.word-input-word').css("margin", "20px 0");
            flipToggle = 1;
        } else {
            $('.word-input-meaning').parent().css("display", "block");
            $('.word-input-type').parent().css("display", "block");
            $('.word-input-word').css("margin", "0");
            flipToggle = 0;
        }
    });

    // 분류별
    $(document).on('click', '.classify', function () {
        $('#type-list').hide();

        var me = $(this);

        if(me.hasClass('classify-by-all')) {
            $('.word').show();
        } else if(me.hasClass('classify-by-type')) {
            $('#type-list').show();
        }

        if (!me.hasClass('disabled')) {
            $('.classify').removeClass('active');
            me.addClass('active');
        }
    });

    $(document).on('click', '.classify.classify-by-all', function() {
        $('.word').show();
        $('.word.plus').hide();
    });

    // 분류 목록 뽑기
    $(document).on('click', '.classify.classify-by-type', function() {
        var type_list = [];

        var word_list = $('.word');
        var type_el = $('#type-list');
        type_el.html('');

        var type_model = '<li class="nav-item"><a class="nav-link" href="#"></a></li>';

        word_list.each(function(key, value) {
            var type = $(this).find('.word-input-type').val();
            if(typeof(type) != 'undefined') {
                if(type == "") type = "기타";
                if ($.inArray(type, type_list) == -1) type_list.push(type);
            }
        });

        type_list.forEach(function(value, key) {
            type_el.append(create_type_model(value));
        });

        console.log(type_list);
    });

    // 품사별 분류 선택
    $(document).on('click', '#type-list .nav-link', function() {
        var type = $(this).data('type-name');
        var word = $('.word');

        var note_id = $('.note.active').data('note-id');

        if(!$(this).hasClass('disabled')) {
            $('#type-list .nav-link').removeClass('active');
            $(this).addClass('active');
        }

        word.hide();
        if(note_id != 0) {
            word.each(function (key, value) {
                if ($(this).find('.word-input-type').val() == type && $(this).data('note-id') == note_id) {
                    $(this).show();
                }
            });
        } else {
            word.each(function (key, value) {
                if ($(this).find('.word-input-type').val() == type) {
                    $(this).show();
                }
            });
        }
        if(note_id != 0) {
            $('.word.plus').show();
        }
    });
});