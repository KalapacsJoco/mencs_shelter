<div
    class="absolute right-0 z-50"
    x-data="{open: false, sexOptions: false, ageOptions: false, colorOptions: false}">
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
                x-on:click="sexOptions = true">Sex
                <div
                    x-show="sexOptions==true">
                    <label for="male">Male</label>
                    <input name="sex" type="radio" value="male">
                    <label for="female">Female</label>
                    <input name="sex" type="radio" value="female">
                </div>
            </div>
            <div
                x-on:click="ageOptions = true">Age
                <div
                    x-show="ageOptions==true">
                    <input name="age" type="radio" value="<1">
                    <label for="age">Less than 1 </label><br>
                    <input name="age" type="radio" value="1-5">
                    <label for="age">1-5</label><br>
                    <input name="age" type="radio" value=">5">
                    <label for="age">Greater than 5</label>
                </div>
            </div>
            <div x-on:click="colorOptions = true">Color
                <div x-show="colorOptions== true">
                    @foreach ($colors as $color)
                    <label for="color">{{$color}}</label>
                    <input type="checkbox" value="{{$name}}">
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>