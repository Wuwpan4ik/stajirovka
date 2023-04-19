@extends("layouts.index")
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Task/create.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1>Добавить задачу</h1>
        <form action="{{ route('task.update', $task->id) }}" method="POST" class="decor">
            @csrf
            @method('PATCH')
            <div class="form-left-decoration"></div>
            <div class="form-right-decoration"></div>
            <div class="circle"></div>
            <div class="form-inner">
                <input type="text" placeholder="Название" value="{{ $task->title }}" name="title">
                <textarea placeholder="Описание..." rows="5" name="description">{{ $task->description }}</textarea>

                <div class="checkbox" style="display:flex; justify-content: left; align-items: center; gap: 10px">
                    <label class="toggleButton">
                        <input type="hidden" name="status" value="0" />
                        <input type="checkbox" name="status" value="1">
                        <div style="background-color: #3e94ec">
                            <svg viewBox="0 0 44 44">
                                <path d="M14,24 L21,31 L39.7428882,11.5937758 C35.2809627,6.53125861 30.0333333,4 24,4 C12.95,4 4,12.95 4,24 C4,35.05 12.95,44 24,44 C35.05,44 44,35.05 44,24 C44,19.3 42.5809627,15.1645919 39.7428882,11.5937758" transform="translate(-2.000000, -2.000000)"></path>
                            </svg>
                        </div>
                    </label>
                    Сделано
                    <a class="dribbble" target="_blank"><img src="https://dribbble.com/assets/logo-small-2x-9fe74d2ad7b25fba0f50168523c15fda4c35534f9ea0b1011179275383035439.png" alt=""></a>
                </div>
                <select name="user_id" id="cusSelectbox">
                    <option style="z-index: 100;" value="0">Выберите пользователя</option>
                    @foreach($users as $user)
                        <option style="z-index: 100;" value="{{ $user->id }}">{{ Str::limit($user->name, 20) }}</option>
                    @endforeach
                </select>
                <button type="submit" href="/">Обновить</button>
            </div>
        </form>
    </div>

@endsection
@section("scripts")
    <script>
        {{-- Checkbox --}}
        var toggle = document.querySelector('.toggleButton input')
        var animate = setInterval(() => {
            toggle.checked = !toggle.checked
        }, 3000)

        document.querySelector('body').addEventListener('click', () => {
            clearInterval(animate);
        })
        @if($task->status == 1) toggle.checked = "checked" @endif
    </script>
    <script>
        {{-- Select --}}
        $(function () {

            var defaultselectbox = $('#cusSelectbox');
            var numOfOptions = $('#cusSelectbox').children('option').length;

            // hide select tag
            defaultselectbox.addClass('s-hidden');

            // wrapping default selectbox into custom select block
            defaultselectbox.wrap('<div class="cusSelBlock"></div>');

            // creating custom select div
            defaultselectbox.after('<div class="selectLabel"></div>');

            // getting default select box selected value
            $('.selectLabel').text($(`option[value="{{ $task->user_id }}"]`).text());

            // appending options to custom un-ordered list tag
            var cusList = $('<ul/>', { 'class': 'options'} ).insertAfter($('.selectLabel'));

            // generating custom list items
            for(var i=0; i< numOfOptions; i++) {
                $('<li/>', {
                    text: defaultselectbox.children('option').eq(i).text(),
                    rel: defaultselectbox.children('option').eq(i).val()
                }).appendTo(cusList);
            }

            // open-list and close-list items functions
            function openList() {
                for(var i=0; i< numOfOptions; i++) {
                    $('.options').children('li').eq(i).attr('tabindex', i).css(
                        'transform', 'translateY('+(i*100+100)+'%)').css(
                        'transition-delay', i*30+'ms');
                }
            }

            function closeList() {
                for(var i=0; i< numOfOptions; i++) {
                    $('.options').children('li').eq(i).css(
                        'transform', 'translateY('+i*0+'px)').css('transition-delay', i*0+'ms');
                }
                $('.options').children('li').eq(1).css('transform', 'translateY('+2+'px)');
                $('.options').children('li').eq(2).css('transform', 'translateY('+4+'px)');
            }

            // click event functions
            $('.selectLabel').click(function () {
                $(this).toggleClass('active');
                if( $(this).hasClass('active') ) {
                    openList();
                    focusItems();
                }
                else {
                    closeList();
                }
            });

            $(".options li").on('keypress click', function(e) {
                e.preventDefault();
                $('.options li').siblings().removeClass();
                closeList();
                $('.selectLabel').removeClass('active');
                $('.selectLabel').text($(this).text());
                $.each(defaultselectbox.find(`option`), function (count, item){
                    $(item).removeAttr('selected')
                })

                defaultselectbox.find(`option[value="${$(this).attr("rel")}"]`).attr('selected', 'selected');
                $('.selected-item p span').text($('.selectLabel').text());
            });

        });

        function focusItems() {

            $('.options').on('focus', 'li', function() {
                $this = $(this);
                $this.addClass('active').siblings().removeClass();
            }).on('keydown', 'li', function(e) {
                $this = $(this);
                if (e.keyCode == 40) {
                    $this.next().focus();
                    return false;
                } else if (e.keyCode == 38) {
                    $this.prev().focus();
                    return false;
                }
            }).find('li').first().focus();

        }
    </script>
    <script>
        $(`option[value="{{ $task->user_id }}"]`).attr('selected', 'selected');
    </script>
@endsection
