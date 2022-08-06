@extends('template.template')

@section('content')
    <div class="container" style="margin-top: 100px;">
        @if ($passage_list)
            <h4 id="header_title">Pilih Kitab:</h4>
            <strong id="breadcrumb"></strong>
            <div class="card mb-3">
                <div class="card-body" style="height: 250px; overflow: auto;">
                    @foreach ($passage_list as $a)
                        <a class="passage_choose" data-passage="{{ $a->book_name }}"
                            data-total_chapter="{{ $a->total_chapter }}">{{ $a->book_name }}</a><br>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@endsection

@push('custom-js')
    <script>
        var passage_content = $('.card-body').html();
        var passage = '';
        var chapter = '';
        var chapter_content = ``;

        $('body').on('click', '.passage_choose', function(e) {
            e.preventDefault();
            passage = $(this).data('passage');
            var totalChapter = $(this).data('total_chapter');

            console.log(totalChapter);

            let content = ``;
            $('#header_title').text('Pilih Pasal');
            for (let i = 1; i <= totalChapter; i++) {
                content += `<a href="" class="chapter_choose" data-chapter="` + i + `">` + i + `</a><br>`
            }
            $('.card-body').html(content);

            chapter_content = content;

            $('#breadcrumb').append(`<a href="" id="bc_passage">` + passage + `</a>`);
        });

        $('body').on('click', '#bc_passage', function(e) {
            e.preventDefault();
            $('.card-body').html(passage_content);
            $('#breadcrumb').text('');
        });
        $('body').on('click', '#bc_chapter', function(e) {
            e.preventDefault();
            $('.card-body').html(chapter_content);
            $('#breadcrumb').html(`<a href="" id="bc_passage">` + passage + `</a>`);
        });

        $('body').on('click', '.chapter_choose', function(e) {
            e.preventDefault();
            chapter = $(this).data('chapter');

            $.ajax({
                url: '/bible/getTotalVerse/' + passage + '/' + chapter,
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                success: function(result) {
                    $('#breadcrumb').append(`<a href="" id="bc_chapter"> > ` + chapter + `</a>`);
                    var totalVerse = result;
                    $('#header_title').text('Pilih Ayat');
                    var content = ``;
                    for (let i = 1; i <= totalVerse; i++) {
                        content += `<a href="" class="verse_choose" data-verse="` + i + `">` + i +
                            `</a><br>`
                    }
                    $('.card-body').html(content);
                    $.LoadingOverlay("hide");
                }
            });
        });
    </script>
@endpush
