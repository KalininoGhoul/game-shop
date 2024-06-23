<div class="filter filter__active">
    <h2 class="filter_title">{{ $title }}</h2>
    <div class="filter_options">
        <div class="filter_options-inner">
            @foreach($options as $option)
                <label class="filter_option">
                    <input id="" type="checkbox" name="{{ $name }}[]" value="{{ $option->slug }}">
                    <span>{{ $option->name }}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
