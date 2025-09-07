<?php

use function Livewire\Volt\{state, rules, mount};
use App\Models\Memo;

state([
    'memo' => null,
    'title' => '',
    'body' => '',
]);

rules([
    'title' => ['required', 'max:50'],
    'body' => ['required', 'max:2000'],
]);

mount(function (Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->body = $memo->body;
});

$save = function () {
    $validated = $this->validate();

    $this->memo->update($validated);

    $this->redirect(route('memos.show', $this->memo), navigate: true);
};

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">メモの編集</h2>

                <form wire:submit="save" class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                        <input type="text" wire:model="title" id="title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">本文</label>
                        <textarea wire:model="body" id="body" rows="10"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        @error('body')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('memos.show', $memo) }}"
                            class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            キャンセル
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            更新
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
