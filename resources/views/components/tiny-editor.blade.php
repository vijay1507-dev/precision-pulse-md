<textarea
  name="{{ $name }}"
  id="{{ $id }}"
  class="tinymce form-control"
>{{ old($name, $value ?? '') }}</textarea>