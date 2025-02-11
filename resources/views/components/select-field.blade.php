<select {{ $attributes->merge(['class' => 'border-[2px] rounded-[15px] h-[50px] hover:bg-background']) }}>
{{$slot}}    
</select>