<div>
    <label for="{{ $name }}" class="mb-1 flex items-center">
        <input type="radio" name="{{ $name }}" value="" @checked(!request($name)) />
        <span class="ml-2">All</span>
    </label>

    @foreach ($options as $key => $value) 
        <label for="{{ $name }}" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $value }}" @checked($value == request($name)) />
            <span class="ml-2">{{ gettype($key) == 'string' ? $key : $value }}</span>
        </label>
    @endforeach
</div>