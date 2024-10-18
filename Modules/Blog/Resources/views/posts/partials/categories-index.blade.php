@foreach ($data->categories as $category)
    <span class="badge badge-primary">
        {{ $category->title }}
    </span>
@endforeach
<a class="text-primary" href="{{ route('posts.edit', $data->id) }}">.......</a>
