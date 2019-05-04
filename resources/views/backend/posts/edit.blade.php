@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/simplemde-markdown-editor/css/simplemde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Edit Post') }}</h3>
                        <div class="card-tools">
                            <a class="btn btn-info"
                               href="{{ route('admin.posts.index') }}">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Form::model($post,['route'=>['admin.posts.update',$post->id],'files'=>true]) }}
                        @method('PUT')
                        @include('backend.posts._form',['buttonText'=> __('Update')])
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="media" tabindex="-1" role="dialog" aria-labelledby="mediaTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaTitle">{{ __('Select Image/Input URL') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="media-list" class="container-fluid">

                    </div>
                </div>
                <div class="modal-footer">
                    <label for="url">{{ __('URL') }}:</label>
                    <input type="text" name="url" id="url" class="form-control">
                    <button type="button" id="select" class="btn btn-primary">{{ __('Select') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('vendor/simplemde-markdown-editor/js/simplemde.min.js') }}"></script>
    <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.full.min.js') }}"></script>
    <script>
        var simplemde = new SimpleMDE({
            toolbarTips: true,
            promptURLs: true,
            showIcons: ["code", "table"],
            hideIcons: ["side-by-side", "fullscreen"],
            toolbar: [{
                name: "bold",
                action: SimpleMDE.toggleBold,
                className: "fa fa-bold",
                title: "Bold",
            },
                {
                    name: "italic",
                    action: SimpleMDE.toggleItalic,
                    className: "fa fa-italic",
                    title: "Italic",
                }, {
                    name: "heading",
                    action: SimpleMDE.toggleHeadingSmaller,
                    className: "fa fa-header",
                    title: "Heading",
                }, {
                    name: "strikethrough",
                    action: SimpleMDE.toggleStrikethrough,
                    className: "fa fa-strikethrough",
                    title: "Strikethrough",
                },
                "|", {
                    name: "code",
                    action: SimpleMDE.toggleCodeBlock,
                    className: "fa fa-code",
                    title: "Code",
                }, {
                    name: "quote",
                    action: SimpleMDE.toggleBlockquote,
                    className: "fa fa-quote-left",
                    title: "Quote",
                }, {
                    name: "unordered-list",
                    action: SimpleMDE.toggleUnorderedList,
                    className: "fa fa-list-ul",
                    title: "Generic List",
                }, {
                    name: "ordered-list",
                    action: SimpleMDE.toggleOrderedList,
                    className: "fa fa-list-ol",
                    title: "Numbered List",
                },
                "|", {
                    name: "link",
                    action: SimpleMDE.drawLink,
                    className: "fa fa-link",
                    title: "Create Link",
                }, {
                    name: "table",
                    action: SimpleMDE.drawTable,
                    className: "fa fa-table",
                    title: "Insert Table",
                }, {
                    name: "horizontal-rule",
                    action: SimpleMDE.drawHorizontalRule,
                    className: "fa fa-minus",
                    title: "Insert Horizontal Line",
                },
                {
                    name: "custom",
                    action: function customFunction() {
                        var url = '{{ route('admin.media.list') }}';
                        getMedia(url);
                        $('#media').modal('show');
                    },
                    className: "fa fa-image",
                    title: "Custom Button",
                },
                "|", {
                    name: "preview",
                    action: SimpleMDE.togglePreview,
                    className: "fa fa-eye no-disable",
                    title: "Toggle Preview",
                },
            ],
        });

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#select_image').on('change', function (e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });

        function _replaceSelection(cm, active, startEnd, url) {
            if (/editor-preview-active/.test(cm.getWrapperElement().lastChild.className))
                return;

            var text;
            var start = startEnd[0];
            var end = startEnd[1];
            var startPoint = cm.getCursor("start");
            var endPoint = cm.getCursor("end");
            if (url) {
                end = end.replace("#url#", url);
            }
            if (active) {
                text = cm.getLine(startPoint.line);
                start = text.slice(0, startPoint.ch);
                end = text.slice(startPoint.ch);
                cm.replaceRange(start + end, {
                    line: startPoint.line,
                    ch: 0
                });
            } else {
                text = cm.getSelection();
                cm.replaceSelection(start + text + end);

                startPoint.ch += start.length;
                if (startPoint !== endPoint) {
                    endPoint.ch += start.length;
                }
            }
            cm.setSelection(startPoint, endPoint);
            cm.focus();
        }

        $(document).ready(function () {
            $(document).on('click', '.medium', function () {
                $('.card-body').removeClass('active');
                $(this).closest('.card-body').addClass('active');
                var url = $(this).find('img').attr('src');
                $('#url').val(url);
            });

            $(document).on('click', '#select', function (e) {
                e.preventDefault();
                $('#media').modal('hide');
                var url = $('#url').val();
                var cm = simplemde.codemirror;
                // var stat = editor.getState(cm);
                var stat = simplemde.getState(cm);
                var options = simplemde.options;
                console.log(url);
                if (url) {
                    _replaceSelection(cm, stat.image, options.insertTexts.image, url);
                }
            });

            $(document).on('click', '.media-filter-submit', function (e) {
                e.preventDefault();
                var url = '{{ route('admin.media.list') }}';
                var formData = $('#media-filter').serialize();
                getMedia(url, formData);
            });

            $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                getMedia($(this).attr('href'));
            });
        });

        function getMedia(url, data = null) {
            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                success: function (data) {
                    $('#media-list').html(data);
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    </script>
@endsection
