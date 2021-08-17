@if ($comment->is_active == 1)
    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="is_active" value="0">
            <button class="btn btn-warning btn-sm" type="submit">Unapprove</button>
    </form>
@elseif ($comment->is_active == 0)
    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="is_active" value="1">
            <button class="btn btn-info btn-sm" type="submit">Approve</button>
    </form>
@endif