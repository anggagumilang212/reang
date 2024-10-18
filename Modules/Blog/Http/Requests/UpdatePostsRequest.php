<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePostsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => ['required', 'string', 'max:60'],
            // 'slug'          => ['required', 'string', Rule::unique('posts', 'slug')->ignore($this->post)],
            'slug'          => ['required', 'string', 'unique:posts,slug,' . $this->post->id],
            'description'   => ['required', 'string', 'max:250'],
            'content'       => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_posts');
    }
}
