<div
    class="absolute right-0"
    x-data="{open: false, sexOptions: false}">
    <button
        x-on:click="open=!open"
        class="primary-button-default">
        <span>Detailed search</span> <x-swg.paws-swg />
    </button>
    <section
        class="bg-background"
        x-show="open==true">
        <div>
            <div
                x-on:click="sexOptions = !sexOptions">Sex
            </div>
            <input x-show="sexOptions==true" type="radio" value="Male">
        </div>

    </section>
</div>