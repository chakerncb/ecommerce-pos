<x-filament-panels::page
    @class([
        'fi-resource-view-record-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
        'fi-resource-record-' . $record->getKey(),
    ])
>
    @php
        $relationManagers = $this->getRelationManagers();
        $hasCombinedRelationManagerTabsWithContent = $this->hasCombinedRelationManagerTabsWithContent();
        $record = $this->getRecord();

        $statusColor = match ($record->status) {
            'completed', 'paid', 'delivered' => 'success',
            'pending', 'processing' => 'warning',
            'cancelled', 'failed', 'refunded' => 'danger',
            default => 'gray',
        };
    @endphp

    <x-filament::section>
        <x-slot name="heading">
            {{ trans('filament-ecommerce::messages.orders.print.order') }} #{{ $record->uuid }}
        </x-slot>

        <x-slot name="headerEnd">
            <x-filament::badge :color="$statusColor" size="lg">
                {{ str($record->status)->upper() }}
            </x-filament::badge>
        </x-slot>

        {{-- Parties + Meta --}}
        <div class="grid grid-cols-1 gap-y-8 lg:grid-cols-3 lg:gap-x-12">
            {{-- From --}}
            @if ($record->company)
                <div>
                    @if ($record->company?->getFirstMediaUrl('logo'))
                        <img
                            src="{{ $record->company->getFirstMediaUrl('logo') }}"
                            alt="{{ $record->company->name }}"
                            class="h-10 mb-3 object-contain"
                        />
                    @endif

                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        {{ trans('filament-ecommerce::messages.orders.print.from') }}
                    </p>

                    <div class="mt-2 space-y-0.5 text-sm text-gray-950 dark:text-white">
                        <p class="text-base font-semibold">{{ $record->company?->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $record->company?->ceo }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $record->company?->address }}</p>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ $record->company?->zip }} {{ $record->company?->city }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $record->company?->country?->name }}</p>
                    </div>
                </div>
            @endif

            {{-- To --}}
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                    {{ trans('filament-ecommerce::messages.orders.print.to') }}
                </p>

                <div class="mt-2 space-y-0.5 text-sm text-gray-950 dark:text-white">
                    <p class="text-base font-semibold">{{ $record->name }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $record->email }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $record->phone }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ $record->address }}</p>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $record->wilaya }}, {{ $record->municipality }}
                    </p>
                </div>
            </div>

            {{-- Meta --}}
            <dl class="space-y-3 lg:justify-self-end lg:text-right">
                <div class="flex items-center justify-between gap-6 lg:justify-end">
                    <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        {{ trans('filament-ecommerce::messages.orders.print.issue_date') }}
                    </dt>
                    <dd class="text-sm font-medium text-gray-950 dark:text-white">
                        {{ $record->created_at->toDateString() }}
                    </dd>
                </div>
                <div class="flex items-center justify-between gap-6 lg:justify-end">
                    <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        {{ trans('filament-ecommerce::messages.orders.print.due_date') }}
                    </dt>
                    <dd class="text-sm font-medium text-gray-950 dark:text-white">
                        {{ $record->created_at->toDateString() }}
                    </dd>
                </div>
                <div class="flex items-center justify-between gap-6 lg:justify-end">
                    <dt class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        {{ trans('filament-ecommerce::messages.orders.print.source') }}
                    </dt>
                    <dd>
                        <x-filament::badge color="primary">
                            {{ str($record->source)->upper() }}
                        </x-filament::badge>
                    </dd>
                </div>
            </dl>
        </div>
    </x-filament::section>

    {{-- Line items --}}
    <x-filament::section>
        <x-slot name="heading">
            {{ trans('filament-ecommerce::messages.orders.print.item') }}
        </x-slot>

        <div class="fi-ta-ctn overflow-x-auto rounded-xl border border-gray-200 dark:border-white/10">
            <table class="fi-ta-table w-full text-left">
                <thead class="divide-y divide-gray-200 dark:divide-white/10 bg-gray-50 dark:bg-white/5">
                    <tr class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        <th class="px-4 py-3">{{ trans('filament-ecommerce::messages.orders.print.item') }}</th>
                        <th class="px-4 py-3 text-right">{{ trans('filament-ecommerce::messages.orders.print.price') }}</th>
                        <th class="px-4 py-3 text-right">{{ trans('filament-ecommerce::messages.orders.print.discount') }}</th>
                        <th class="px-4 py-3 text-right">{{ trans('filament-ecommerce::messages.orders.print.vat') }}</th>
                        <th class="px-4 py-3 text-right">{{ trans('filament-ecommerce::messages.orders.print.qty') }}</th>
                        <th class="px-4 py-3 text-right">{{ trans('filament-ecommerce::messages.orders.print.total') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                    @foreach ($record->ordersItems as $item)
                        <tr class="text-sm text-gray-950 dark:text-white">
                            <td class="px-4 py-3 font-medium">
                                {{ $item->product?->name ?? $item->item }}
                            </td>
                            <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">
                                {!! dollar($item->price) !!}
                            </td>
                            <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">
                                {!! dollar($item->discount) !!}
                            </td>
                            <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">
                                {!! dollar($item->tax) !!}
                            </td>
                            <td class="px-4 py-3 text-right text-gray-600 dark:text-gray-400">
                                {{ $item->qty }}
                            </td>
                            <td class="px-4 py-3 text-right font-semibold">
                                {!! dollar($item->total) !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        <div class="mt-6 flex justify-end">
            <dl class="w-full max-w-xs space-y-2 text-sm">
                <div class="flex items-center justify-between border-b border-gray-200 py-2 dark:border-white/10">
                    <dt class="font-medium text-gray-950 dark:text-white">
                        {{ trans('filament-ecommerce::messages.orders.print.sub_total') }}
                    </dt>
                    <dd class="text-gray-600 dark:text-gray-400">
                        {!! dollar(($record->total + $record->discount) - ($record->vat + $record->shipping)) !!}
                    </dd>
                </div>

                @if ($record->vat)
                    <div class="flex items-center justify-between border-b border-gray-200 py-2 dark:border-white/10">
                        <dt class="font-medium text-gray-950 dark:text-white">
                            {{ trans('filament-ecommerce::messages.orders.print.vat') }}
                        </dt>
                        <dd class="text-success-600 dark:text-success-400">
                            {!! dollar($record->vat) !!}
                        </dd>
                    </div>
                @endif

                @if ($record->shipping)
                    <div class="flex items-center justify-between border-b border-gray-200 py-2 dark:border-white/10">
                        <dt class="font-medium text-gray-950 dark:text-white">
                            {{ trans('filament-ecommerce::messages.orders.print.shipping') }}
                        </dt>
                        <dd class="text-success-600 dark:text-success-400">
                            {!! dollar($record->shipping) !!}
                        </dd>
                    </div>
                @endif

                @if ($record->coupon)
                    <div class="flex items-center justify-between border-b border-gray-200 py-2 dark:border-white/10">
                        <dt class="font-medium text-gray-950 dark:text-white">
                            {{ trans('filament-ecommerce::messages.orders.print.coupon') }}
                            <x-filament::badge color="danger" size="sm">
                                {{ $record->coupon->code }}
                            </x-filament::badge>
                        </dt>
                        <dd class="text-danger-600 dark:text-danger-400">
                            {!! dollar($record->coupon->discount($record->total)) !!}
                        </dd>
                    </div>
                @endif

                @if ($record->discount)
                    <div class="flex items-center justify-between border-b border-gray-200 py-2 dark:border-white/10">
                        <dt class="font-medium text-gray-950 dark:text-white">
                            {{ trans('filament-ecommerce::messages.orders.print.discount') }}
                        </dt>
                        <dd class="text-danger-600 dark:text-danger-400">
                            @if ($record->coupon)
                                {!! dollar($record->discount - $record->coupon->discount($record->total)) !!}
                            @else
                                {!! dollar($record->discount) !!}
                            @endif
                        </dd>
                    </div>
                @endif

                <div class="flex items-center justify-between pt-3">
                    <dt class="text-base font-bold text-gray-950 dark:text-white">
                        {{ trans('filament-ecommerce::messages.orders.print.total') }}
                    </dt>
                    <dd class="text-base font-bold text-primary-600 dark:text-primary-400">
                        {!! dollar($record->total) !!}
                    </dd>
                </div>
            </dl>
        </div>

        @if ($record->notes)
            <div class="mt-6 rounded-xl bg-gray-50 p-4 dark:bg-white/5">
                <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                    {{ trans('filament-ecommerce::messages.orders.print.notes') }}
                </p>
                <p class="mt-1 text-sm text-gray-950 dark:text-white">
                    {{ $record->notes }}
                </p>
            </div>
        @endif
    </x-filament::section>

    @if (count($relationManagers))
        <x-filament-panels::resources.relation-managers
            :active-locale="isset($activeLocale) ? $activeLocale : null"
            :active-manager="$this->activeRelationManager ?? ($hasCombinedRelationManagerTabsWithContent ? null : array_key_first($relationManagers))"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        >
            @if ($hasCombinedRelationManagerTabsWithContent)
                <x-slot name="content">
                    @if ($this->hasInfolist())
                        {{ $this->infolist }}
                    @else
                        {{ $this->form }}
                    @endif
                </x-slot>
            @endif
        </x-filament-panels::resources.relation-managers>
    @endif
</x-filament-panels::page>