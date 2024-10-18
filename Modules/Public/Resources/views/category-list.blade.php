<ul class="list-unstyled categories-clouds m-b-0">
    <li class="{{ empty(request('category')) ? 'active' : '' }}">
        <a href="{{ route('public.blog') }}"
            style="text-decoration: none; display: block; border: 1px solid; padding: 6px 10px; border-radius: 3px; {{ empty(request('category')) ? 'background-color: #4253cf; color: #ffffff;' : '' }}">All</a>
    </li>

    @foreach ($post_categories as $category)
        <li class="{{ request('category') == $category->slug ? 'active' : '' }}">
            <a href="{{ route('public.blog', ['category' => $category->slug]) }}"
                style="text-decoration: none; display: block; border: 1px solid; padding: 6px 10px; border-radius: 3px; {{ request('category') == $category->slug ? 'background-color: #4253cf; color: #ffffff;' : '' }}">
                {{ str_repeat('-', $count) . ' ' . $category->title }}
            </a>
        </li>
    @endforeach
</ul>
