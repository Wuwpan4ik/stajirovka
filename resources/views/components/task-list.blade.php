<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
            <h4 class="modal-title">Список задач</h4>
        </div>
        <div class="modal-body">
            <div class="modal-item">
                <div class="modal-block">Название</div>
                <div class="modal-block">Описание</div>
                <div class="modal-block">Редактировать</div>
                <div class="modal-block">Удалить</div>
            </div>
            @foreach($tasks as $task)
                <div class="modal-item">
                    <div class="modal-body__title modal-block">
                        {{ $task->title }}
                    </div>
                    <div class="modal-body__description modal-block" style="word-break: break-all">
                        {{ $task->description }}
                    </div>
                    <div class="modal-block">
                        <a href="{{ route('task.edit', $task->id) }}">Изменить</a>
                    </div>
                    <div class="modal-block">
                        <form class="delete__form" action="{{ route('task.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
            <button type="button" class="btn">Close</button>
        </div>
    </div>
</div>
<script>
    initilize_popup();
</script>
