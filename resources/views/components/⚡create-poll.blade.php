<?php

use Livewire\Component;

new class extends Component
{
    public $title;
};
?>

<div>
    <form>
        <label>Poll Title</label>
        <input  type="text" wire:model.live="title"/>
        Current title: {{ $title }}
    </form>
</div>
