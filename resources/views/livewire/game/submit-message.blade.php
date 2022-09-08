<div x-data="{
    message: @entangle('message').defer,
    send () {
        if(this.message.trim() !== '') {
            $wire.sendMessage();
        }
    },
    resize() {
        const textarea = this.$refs.textarea;
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }
}">
    <div class="flex flex-row items-center space-x-3">
        <div class="w-full relative">
            <textarea
                    x-ref="textarea"
                    placeholder="Nachricht eingeben"
                    x-model="message"
                    class="transition-all w-full rounded-xl border-gray-300 focus:border-gray-800 resize-none "
                    rows="1"
{{--                    style="height: 42px"--}}
                    x-on:input="resize"
{{--                    x-on:focus="$el.style.height = '100px'"--}}
{{--                    x-on:blur="$el.style.height = '42px'"--}}
                    x-on:keydown="(event) => {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        send();
                    }
                }"
            ></textarea>
            <div class="absolute w-full left-0 top-0 h-full" wire:loading>
                <div class="h-full w-full flex flex-row justify-end items-center">
                    <x-spinner class="text-gray-700"></x-spinner>
                </div>
            </div>
        </div>
        <div>

            <button class="group" x-on:click="send" wire:loading.attr="disabled">
                <x-heroicon-o-paper-airplane class="w-6 h-6 text-gray-500 group-hover:hidden" />
                <x-heroicon-s-paper-airplane x-cloak class="w-6 h-6 text-gray-500 hidden group-hover:block" />
            </button>
        </div>
    </div>


</div>
