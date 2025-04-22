<div>
    <select 
        wire:model="selectedLanguage" 
        wire:change="changeLanguage($event.target.value)"
        class="form-select">
        <option value="hu" {{ $selectedLanguage === 'hu' ? 'selected' : '' }}>Hungarian</option>
        <option value="en" {{ $selectedLanguage === 'en' ? 'selected' : '' }}>English</option>
    </select>
</div>
