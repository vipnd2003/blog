@if ($_message = session('message-success'))
    <p class="alert alert-success">{{ $_message }}</p>
@elseif ($_message = session('message-warning'))
    <p class="alert alert-warning">{{ $_message }}</p>
@elseif ($_message = session('message-error'))
    <p class="alert alert-danger">{{ $_message }}</p>
@endif