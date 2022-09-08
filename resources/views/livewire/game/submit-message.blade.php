<div x-data="{
    message: @entangle('message').defer,
    send () {
        console.log(this.message);
        if(this.message.trim() !== '') {
            $wire.sendMessage();
        }
    },
}">
    <div class="flex flex-row items-center space-x-3" wire:ignore>
        <div class="w-full relative">
            <textarea
                    placeholder="Nachricht eingeben"
                    x-model="message"
                    class="transition-all w-full rounded-xl border-gray-300 focus:border-gray-800 resize-none "
                    style="height: 42px"
                    x-on:focus="$el.style.height = '100px'"
                    x-on:blur="$el.style.height = '42px'"
                    x-on:keydown="(event) => {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        send();
                    }
                }"
            ></textarea>
            <div class="absolute bottom-2 right-0" wire:loading>
                <x-spinner class="text-gray-700"></x-spinner>
            </div>
        </div>
        <div>

            <button class="group" x-on:click="send">
                <x-heroicon-o-paper-airplane class="w-6 h-6 text-gray-500 group-hover:hidden" />
                <x-heroicon-s-paper-airplane x-cloak class="w-6 h-6 text-gray-500 hidden group-hover:block" />
            </button>
        </div>
    </div>


</div>
