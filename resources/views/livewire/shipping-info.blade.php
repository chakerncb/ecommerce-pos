<div class="row">
    <div class="col-lg-4">
        <div class="mb-4 mb-lg-0">
            <label class="form-label">State</label>
            <select name="wilaya" id="wilaya" wire:model="selectedWilaya" wire:change="updateMunicipalities">
                <option value="">Select a state</option>
                @foreach($wilayas as $wilaya)
                    <option value="{{ $wilaya->wilaya_name_ascii }}">{{ $wilaya->wilaya_name_ascii }}</option>
                @endforeach
            </select>
            @error('wilaya') 
               <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-4 mb-lg-0">
            <label class="form-label">Municipality</label>
            <select name="municipality" id="municipality" wire:model="selectedMunicipality" wire:change="getZipCode">
                <option value="">Select a municipality</option>
                @foreach($municipalities as $municipality)
                    <option value="{{ $municipality }}">{{ $municipality }}</option>
                @endforeach
            </select>
            @error('municipality') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-0">
            <label class="form-label" for="zip-code">Zip / Postal code</label>
            <input name="zip-code" type="text" class="form-control" id="zip-code" placeholder="Postal code" wire:model="postalCode" value="{{$postalCode}}" readonly>
            @error('postalCode') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
