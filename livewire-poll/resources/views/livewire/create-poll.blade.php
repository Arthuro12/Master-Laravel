<div>
    <form>
        <label>Poll Title</label>
        <input type="text" wire:model.live="title" />
        <h5>
            Current title: {{ $title }}
        </h5>
    </form>
</div>
