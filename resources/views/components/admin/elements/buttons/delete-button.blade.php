<form method="POST" action="{{ $route }}" {{ $attributes }}>
    @method('DELETE')
    @csrf
    <button class="button__delete text-danger bg-transparent border-0" title="remove"><i class="fa fa-trash"></i></button>
</form>

<style>
    .button__delete:hover {
        color: rgb(122, 19, 33) !important;
    }
</style>
