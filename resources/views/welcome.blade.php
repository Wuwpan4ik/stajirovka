@extends('layouts.index')
@section('content')
    <div class="table-title">
        <h3>Data Table</h3>
    </div>
    <div class="table__container">
        <table class="table-fill">
            <thead>
            <tr>
                <th class="text-left">Имя</th>
                <th class="text-left">email</th>
                <th class="text-left">Возраст</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @foreach($users as $user)
                <tr class="table__row" data-user_id="{{ $user->id }}" title="Просмотреть задачи">
                    <td class="text-left">{{ $user->name }}</td>
                    <td class="text-left">{{ $user->email }}</td>
                    <td class="text-left">{{ $user->age }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="modal" class="modal fade"></div>
    @include('components.add_task_popup')
@endsection
@section('scripts')
    <script src="{{ asset("js/modal.js") }}"></script>
    <script>
        $(".table__row").click(async function (){
            $('.modal').load(`/task/${$(this).data('user_id')}`)
            $(".modal").each(function () {
                $(this).fadeIn(200);
                $("body, html").addClass("modal-open");
                $(".modal-backdrop").addClass("in");
                $(this).addClass("in");
            });
        })
    </script>
@endsection
