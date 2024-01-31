<div>
    <form>
        <label>Poll Title</label>
        <input type="text" wire:model.live="title" />
        <h5>
            Current title: {{ $title }}
        </h5>
        
        <button class="btn mb-4" wire:click.prevent="addOption">Add Option</button>

        @foreach ($options as $index => $option)
            <div class="mb-4">
                {{ $index }} - {{ $option }}
            </div>
        @endforeach
    </form>
</div>
